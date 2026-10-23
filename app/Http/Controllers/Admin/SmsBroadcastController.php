<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Models\SmsLog;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SmsBroadcastController extends Controller
{
    /* =========================================================
     |  INDEX — broadcast page
     ========================================================= */
    public function index(Request $request)
    {
        $query = Registration::with('event')->latest();

        // ---- Event filter ----
        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        // ---- Status filter ----
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // ---- Exact ID filter ----
        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        // ---- BIB filter (partial) ----
        if ($request->filled('bib')) {
            $query->where('bib_number', 'like', '%' . $request->bib . '%');
        }

        // ---- Free-text search (name, phone, whatsapp, BIB, ID) ----
        if ($request->filled('search')) {
            $s = trim($request->search);
            $query->where(function ($q) use ($s) {
                $q->where('first_name', 'like', "%{$s}%")
                ->orWhere('last_name', 'like', "%{$s}%")
                ->orWhere('phone', 'like', "%{$s}%")
                ->orWhere('whatsapp_number', 'like', "%{$s}%")
                ->orWhere('bib_number', 'like', "%{$s}%")
                ->orWhere('id', 'like', "%{$s}%");
            });
        }

        // ---- Category filter ----
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // ---- Payment method filter ----
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        // ---- Attended filter ----
        if ($request->filled('attended')) {
            $query->where('attended', $request->attended === '1');
        }

        // ---- Only records that actually have a phone number ----
        $query->where(function ($q) {
            $q->whereNotNull('phone')->where('phone', '!=', '')
            ->orWhere(function ($q2) {
                $q2->whereNotNull('whatsapp_number')->where('whatsapp_number', '!=', '');
            });
        });

        $registrations = $query->paginate(25)->withQueryString();
        $events        = Event::orderBy('title')->get();
        $categories    = Registration::query()
            ->select('category')->distinct()->pluck('category')->filter()->values();

        return view('admin.sms.index', compact('registrations', 'events', 'categories'));
    }

    /* =========================================================
     |  SEND — bulk SMS
     ========================================================= */
    public function send(Request $request, SmsService $sms)
    {
        $data = $request->validate([
            'registration_ids'   => 'required|array|min:1',
            'registration_ids.*' => 'exists:registrations,id',
            'message'            => 'required|string|min:1|max:1000',
        ]);

        $message = trim($data['message']);
        $batchId = (string) Str::uuid();

        $registrations = Registration::with('event')
            ->whereIn('id', $data['registration_ids'])
            ->get();

        $sent   = 0;
        $failed = 0;

        foreach ($registrations as $reg) {
            $to = $reg->whatsapp_number ?: $reg->phone;

            if (empty($to)) {
                SmsLog::create([
                    'registration_id' => $reg->id,
                    'event_id'        => $reg->event_id,
                    'sent_by'         => Auth::id(),
                    'to_phone'        => '-',
                    'recipient_name'  => $reg->full_name,
                    'message'         => $message,
                    'message_length'  => mb_strlen($message),
                    'status'          => 'failed',
                    'error'           => 'No phone number',
                    'batch_id'        => $batchId,
                ]);
                $failed++;
                continue;
            }

            $status = 'sent';
            $error  = null;

            try {
                $result = $sms->send($to, $message);

                if (empty($result['success'])) {
                    $status = 'failed';
                    $error  = $result['error'] ?? 'Unknown error';
                    $failed++;
                } else {
                    $sent++;
                }
            } catch (\Throwable $e) {
                $status = 'failed';
                $error  = $e->getMessage();
                $failed++;
                Log::error('Broadcast SMS exception: ' . $e->getMessage(), [
                    'registration_id' => $reg->id,
                ]);
            }

            SmsLog::create([
                'registration_id' => $reg->id,
                'event_id'        => $reg->event_id,
                'sent_by'         => Auth::id(),
                'to_phone'        => $to,
                'recipient_name'  => $reg->full_name,
                'message'         => $message,
                'message_length'  => mb_strlen($message),
                'status'          => $status,
                'error'           => $error,
                'batch_id'        => $batchId,
            ]);

            usleep(300_000); // throttle 300ms between sends
        }

        $msg = "SMS broadcast complete — Sent: {$sent}, Failed: {$failed}.";

        return redirect()
            ->route('admin.sms.index', $request->only(['event_id','status','search','category','payment_method','attended','id','bib']))
            ->with('success', $msg);
    }

    /* =========================================================
     |  LOGS — SMS log listing
     ========================================================= */
    public function logs(Request $request)
    {
        $query = SmsLog::with(['registration', 'event', 'sender'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('to_phone', 'like', "%{$s}%")
                  ->orWhere('recipient_name', 'like', "%{$s}%")
                  ->orWhere('message', 'like', "%{$s}%");
            });
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $logs   = $query->paginate(25)->withQueryString();
        $events = Event::orderBy('title')->get();

        return view('admin.sms.logs', compact('logs', 'events'));
    }

    /* =========================================================
     |  SHOW LOG
     ========================================================= */
    public function showLog(SmsLog $log)
    {
        $log->load(['registration', 'event', 'sender']);
        return view('admin.sms.log-show', compact('log'));
    }
}
