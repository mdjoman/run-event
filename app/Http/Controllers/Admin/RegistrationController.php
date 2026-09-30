<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use App\Models\User;
use App\Mail\NewRegistrationAdminMail;
use App\Mail\RegistrationConfirmationMail;
use App\Mail\RegistrationRejectedMail;
use App\Mail\RegistrationApprovedMail;
use App\Services\SmsService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    /* =========================================================
     |  INDEX
     ========================================================= */
    public function index(Request $request)
    {
        $query = Registration::with('event')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('first_name', 'like', "%{$s}%")
                  ->orWhere('last_name', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%")
                  ->orWhere('trx_id', 'like', "%{$s}%");
            });
        }

        $registrations = $query->paginate(15)->withQueryString();
        $events = Event::orderBy('title')->get();

        return view('admin.registrations.index', compact('registrations', 'events'));
    }

    /* =========================================================
     |  CREATE
     ========================================================= */
    public function create()
    {
        $events = Event::where('status', 'active')->orderBy('event_date')->get();
        return view('admin.registrations.create', compact('events'));
    }

    /* =========================================================
     |  STORE
     ========================================================= */
    public function store(Request $request, SmsService $sms)
    {
        // ---------- 1. VALIDATION ----------
        $validated = $request->validate([
            'first_name'         => 'required|string|max:100',
            'last_name'          => 'required|string|max:100',
            'phone'              => 'required|string|max:20',
            'whatsapp_number'    => 'required|string|max:20',
            'blood_group'        => 'required|string|max:20',
            'email'              => 'nullable|email|max:255',
            'gender'             => 'required|in:Male,Female,Other',
            'dob'                => 'required',
            'nid'                => 'required|string|max:50',
            'address'            => 'nullable|string|max:500',

            'emergency_name'     => 'required|string|max:100',
            'emergency_phone'    => 'required|string|max:20',

            'event_id'           => 'required|exists:events,id',
            'event_price'        => 'required',

            'category'           => 'required|string|max:50',
            'tshirt'             => 'required|in:S,M,L,XL,XXL',

            'payment_method'     => 'required|in:bKash,Card,Cash,Nagad',
            'sender_phone_last3' => 'required|string|max:3',
            'trx_id'             => 'required|string|max:100',

            'profile_image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:51200',

            'confirm_terms'      => 'accepted',
        ], [
            'confirm_terms.accepted' => 'You must agree to the event rules and regulations.',
            'profile_image.max'      => 'Profile image must not exceed 50 MB.',
            'profile_image.image'    => 'Profile image must be a valid image file.',
        ]);

        // ---------- 2. PROFILE IMAGE ----------
        $profileImagePath = $request->hasFile('profile_image')
            ? $request->file('profile_image')->store('registrations/profiles', 'public')
            : null;

        // ---------- 3. FETCH EVENT ----------
        $event = Event::findOrFail($validated['event_id']);

        // ---------- 4. CREATE ----------
        $registration = Registration::create([
            'event_id'           => $validated['event_id'],
            'first_name'         => $validated['first_name'],
            'last_name'          => $validated['last_name'],
            'phone'              => $validated['phone'],
            'whatsapp_number'    => $validated['whatsapp_number'],
            'blood_group'        => $validated['blood_group'],
            'email'              => $validated['email'] ?? null,
            'gender'             => $validated['gender'],
            'dob'                => Carbon::createFromFormat('d/m/Y', $validated['dob'])->format('Y-m-d'),
            'nid'                => $validated['nid'],
            'address'            => $validated['address'] ?? null,
            'emergency_name'     => $validated['emergency_name'],
            'emergency_phone'    => $validated['emergency_phone'],
            'category'           => $validated['category'],
            'tshirt_size'        => $validated['tshirt'],
            'amount'             => str_replace(',', '', $validated['event_price']),
            'payment_method'     => $validated['payment_method'],
            'sender_phone_last3' => $validated['sender_phone_last3'],
            'trx_id'             => $validated['trx_id'],
            'status'             => 'pending',
            'profile_image'      => $profileImagePath,
        ]);

        // ---------- 5. SMS — CUSTOMER ----------
        $this->sendCustomerReceivedSms($sms, $registration, $event);

        // ---------- 6. SMS — ADMINS ----------
        $this->sendAdminNewRegistrationSms($sms, $registration, $event);

        // ---------- 7. EMAIL — SUBMITTER ----------
        $this->queueConfirmationEmail($registration);

        // ---------- 8. EMAIL — ADMINS ----------
        $this->queueAdminEmails($registration);

        // ---------- 9. INLINE QUEUE WORKER ----------
        $this->runInlineQueueWorker($registration->id);

        // ---------- 10. RESPOND ----------
        $msg = "Registration #{$registration->id} created successfully! Awaiting review.";

        if ($request->expectsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => $msg,
                'redirect' => route('home'),
            ]);
        }

        return redirect()->route('home')->with('success', $msg);
    }

    /* =========================================================
     |  SHOW
     ========================================================= */
    public function show(Registration $registration)
    {
        $registration->load('event');
        return view('admin.registrations.show', compact('registration'));
    }

    /* =========================================================
     |  EDIT
     ========================================================= */
    public function edit(Registration $registration)
    {
        $events = Event::orderBy('title')->get();
        return view('admin.registrations.edit', compact('registration', 'events'));
    }

    /* =========================================================
     |  UPDATE
     ========================================================= */
    public function update(Request $request, Registration $registration)
    {
        $validated = $request->validate([
            'first_name'      => 'required|string|max:100',
            'last_name'       => 'required|string|max:100',
            'phone'           => 'required|string|max:20',
            'email'           => 'nullable|email|max:255',
            'gender'          => 'required|in:Male,Female,Other',
            'dob'             => 'required|date|before:today',
            'nid'             => 'required|string|max:50',
            'address'         => 'nullable|string|max:500',
            'emergency_name'  => 'required|string|max:100',
            'emergency_phone' => 'required|string|max:20',
            'category'        => 'required|string|max:50',
            'tshirt'          => 'required|in:S,M,L,XL,XXL',
            'profile_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:51200',
        ]);

        $data = $validated;
        unset($data['profile_image']);

        $data['tshirt_size'] = $validated['tshirt'];
        unset($data['tshirt']);

        // Replace profile image if new one uploaded
        if ($request->hasFile('profile_image')) {
            if ($registration->profile_image && Storage::disk('public')->exists($registration->profile_image)) {
                Storage::disk('public')->delete($registration->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')
                ->store('registrations/profiles', 'public');
        }

        $registration->update($data);

        return redirect()
            ->route('admin.registrations.show', $registration)
            ->with('success', "Registration #{$registration->id} updated successfully!");
    }

    /* =========================================================
     |  UPDATE STATUS
     ========================================================= */
    public function updateStatus(Request $request, Registration $registration, SmsService $sms)
    {
        $data = $request->validate([
            'status'     => 'required|in:pending,approved,rejected,cancelled',
            'admin_note' => 'nullable|string|max:500',
        ]);

        $oldStatus = $registration->status;
        $newStatus = $data['status'];

        $bibJustGenerated = false;

        // ---------- BIB NUMBER (only on first approval) ----------
        if ($newStatus === 'approved' && empty($registration->bib_number)) {
            $code = substr(trim($registration->category), 0, 1);

            $lastBib = Registration::where('event_id', $registration->event_id)
                ->where('category', $registration->category)
                ->whereNotNull('bib_number')
                ->where('bib_number', 'like', $code . '%')
                ->orderByDesc('id')
                ->lockForUpdate()
                ->value('bib_number');

            $next = $lastBib ? (int) substr($lastBib, 1) + 1 : 1;

            $data['bib_number'] = $code . str_pad($next, 3, '0', STR_PAD_LEFT);
            $bibJustGenerated = true;
        }

        // ---------- UPDATE ----------
        $registration->update($data);
        $registration->refresh();

        $event = $registration->event;

        // ---------- EVENT.REGISTERED COUNTER ----------
        if ($event) {
            if ($newStatus === 'approved' && $oldStatus !== 'approved') {
                $event->increment('registered');
            } elseif ($newStatus !== 'approved' && $oldStatus === 'approved') {
                if ($event->registered > 0) {
                    $event->decrement('registered');
                }
            }
        }

        // ---------- FIRST-TIME FLAGS ----------
        $isFirstApproval  = ($newStatus === 'approved' && $oldStatus !== 'approved');
        $isFirstRejection = ($newStatus === 'rejected' && $oldStatus !== 'rejected');

        // ---------- APPROVAL EMAIL ----------
        $shouldSendApprovalEmail = $isFirstApproval && !empty($registration->email);

        if ($shouldSendApprovalEmail) {
            try {
                Mail::to($registration->email)
                    ->queue(new RegistrationApprovedMail($registration));

                Log::info('Approval email queued', [
                    'registration_id' => $registration->id,
                    'bib_number'      => $registration->bib_number,
                    'email'           => $registration->email,
                ]);
            } catch (\Throwable $e) {
                Log::error('Approval email queue failed: ' . $e->getMessage(), [
                    'registration_id' => $registration->id,
                ]);
            }
        }

        // ---------- REJECT EMAIL ----------
        $shouldSendRejectionEmail = $isFirstRejection && !empty($registration->email);

        if ($shouldSendRejectionEmail) {
            try {
                Mail::to($registration->email)
                    ->queue(new RegistrationRejectedMail($registration));
            } catch (\Throwable $e) {
                Log::error('Rejection email queue failed: ' . $e->getMessage(), [
                    'registration_id' => $registration->id,
                ]);
            }
        }

        // ---------- APPROVAL SMS ----------
        $smsTo = null;

        if ($isFirstApproval) {
            $smsTo = $registration->whatsapp_number ?: $registration->phone;

            if (!empty($smsTo)) {
                $message = $this->buildApprovalSmsText($registration, $event);
                $this->sendSmsSafe($sms, $smsTo, $message, 'Approval SMS', $registration->id);
            } else {
                Log::warning('Approval SMS skipped — no phone number', [
                    'registration_id' => $registration->id,
                ]);
            }
        }

        // ---------- REJECTION SMS ----------
        $rejectTo = null;

        if ($isFirstRejection) {
            $rejectTo = $registration->whatsapp_number ?: $registration->phone;

            if (!empty($rejectTo)) {
                $message = $this->buildRejectionSmsText($registration, $event);
                $this->sendSmsSafe($sms, $rejectTo, $message, 'Rejection SMS', $registration->id);
            }
        }

        // ---------- INLINE QUEUE WORKER ----------
        if ($shouldSendApprovalEmail) {
            $this->runInlineQueueWorker($registration->id);
        }

        // ---------- SUCCESS MESSAGE ----------
        $msg = "Registration #{$registration->id} marked as {$newStatus}.";

        if ($bibJustGenerated) {
            $msg .= " BIB number {$registration->bib_number} assigned.";
        }
        if ($shouldSendApprovalEmail) {
            $msg .= " Confirmation email sent to {$registration->email}.";
        }
        if ($smsTo) {
            $msg .= " Confirmation SMS sent to {$smsTo}.";
        }
        if ($rejectTo) {
            $msg .= " Rejection SMS sent to {$rejectTo}.";
        }

        return redirect()->back()->with('success', $msg);
    }

    /* =========================================================
     |  DESTROY
     ========================================================= */
    public function destroy(Registration $registration)
    {
        $event       = $registration->event;
        $wasApproved = $registration->status === 'approved';

        $registration->delete();

        if ($wasApproved && $event && $event->registered > 0) {
            $event->decrement('registered');
        }

        return redirect()->route('admin.registrations.index')
            ->with('success', "Registration #{$registration->id} deleted successfully.");
    }


    /* =========================================================
     |  PRIVATE — SMS HELPERS
     ========================================================= */

    /**
     * Send SMS to the customer when registration is received.
     */
    private function sendCustomerReceivedSms(SmsService $sms, Registration $registration, Event $event): void
    {
        $to = $registration->whatsapp_number ?: $registration->phone;

        if (empty($to)) {
            Log::warning('Customer SMS skipped — no phone number', [
                'registration_id' => $registration->id,
            ]);
            return;
        }

        $message = "Dear {$registration->first_name} {$registration->last_name},\n\n"
                 . "Your registration for {$event->title} has been received.\n\n"
                 . "Registration ID: #{$registration->id}\n"
                 . "Category: {$registration->category}\n"
                 . "Amount: BDT " . number_format($registration->amount) . "\n"
                 . "Status: Pending review\n\n"
                 . "We will notify you once it is approved.\n"
                 . "- Run BURJOWAN Team";

        $this->sendSmsSafe($sms, $to, $message, 'Customer SMS', $registration->id);
    }

    /**
     * Send SMS to admins when a new registration is received.
     */
    private function sendAdminNewRegistrationSms(SmsService $sms, Registration $registration, Event $event): void
    {
        $admins = User::where('role', 'admin')
            ->whereNotNull('phone')
            ->where('phone', '!=', '')
            ->get(['id', 'name', 'phone']);

        if ($admins->isEmpty()) {
            Log::info('Admin SMS skipped — no admin phones found', [
                'registration_id' => $registration->id,
            ]);
            return;
        }

        $message = "NEW REGISTRATION REQUEST ALERT\n\n"
                 . "ID: #{$registration->id}\n"
                 . "Name: {$registration->first_name} {$registration->last_name}\n"
                 . "Event: {$event->title}\n"
                 . "Category: {$registration->category}\n"
                 . "Amount: BDT " . number_format($registration->amount) . "\n"
                 . "TrxID: {$registration->trx_id}\n"
                 . "Status: Pending review\n\n"
                 . "Login to admin panel to approve/reject.";

        foreach ($admins as $admin) {
            $this->sendSmsSafe($sms, $admin->phone, $message, 'Admin SMS', $registration->id, [
                'admin_id' => $admin->id,
            ]);

            usleep(300_000); // 300ms gap to avoid rate-limit
        }
    }

    /**
     * Safe SMS send — wraps send + logging + error handling.
     */
    private function sendSmsSafe(
        SmsService $sms,
        string $to,
        string $message,
        string $context,
        ?int $registrationId = null,
        array $extra = []
    ): void {
        try {
            $result = $sms->send($to, $message);

            if (empty($result['success'])) {
                Log::error("{$context} failed", array_merge([
                    'registration_id' => $registrationId,
                    'phone'           => $to,
                    'error'           => $result['error'] ?? 'Unknown error',
                ], $extra));
                return;
            }

            Log::info("{$context} sent", array_merge([
                'registration_id' => $registrationId,
                'phone'           => $to,
            ], $extra));

        } catch (\Throwable $e) {
            Log::error("{$context} exception: " . $e->getMessage(), array_merge([
                'registration_id' => $registrationId,
                'phone'           => $to,
            ], $extra));
        }
    }

    /* =========================================================
     |  PRIVATE — SMS TEMPLATES
     ========================================================= */

    private function buildApprovalSmsText(Registration $registration, Event $event): string
    {
        return "Congratulations {$registration->first_name}!\n\n"
             . "Your registration for {$event->title} has been APPROVED.\n\n"
             . "Registration ID: #{$registration->id}\n"
             . "Category: {$registration->category}\n"
             . "BIB Number: {$registration->bib_number}\n"
             . "T-Shirt Size: {$registration->tshirt_size}\n"
             . "Amount: BDT " . number_format($registration->amount) . "\n\n"
             . "Please collect your BIB and Race Kit before race day.\n\n"
             . "See you at the starting line!\n"
             . "- Run BURJOWAN Team";
    }

    private function buildRejectionSmsText(Registration $registration, Event $event): string
    {
        $reason = $registration->admin_note
            ? "Reason: {$registration->admin_note}\n\n"
            : '';

        return "Dear {$registration->first_name},\n\n"
             . "Your registration #{$registration->id} "
             . "for {$event->title} has been REJECTED.\n\n"
             . $reason
             . "Please contact the organizers for more details.\n"
             . "- Run BURJOWAN Team";
    }

    /* =========================================================
     |  PRIVATE — EMAIL HELPERS
     ========================================================= */

    private function queueConfirmationEmail(Registration $registration): void
    {
        if (empty($registration->email)) {
            return;
        }

        try {
            Mail::to($registration->email)
                ->queue(new RegistrationConfirmationMail($registration));
        } catch (\Throwable $e) {
            Log::error('Confirmation email queue failed: ' . $e->getMessage(), [
                'registration_id' => $registration->id,
                'email'           => $registration->email,
            ]);
        }
    }

    private function queueAdminEmails(Registration $registration): void
    {
        $adminEmails = User::where('role', 'admin')
            ->whereNotNull('email')
            ->where('email', '!=', '')
            ->pluck('email')
            ->unique()
            ->values()
            ->all();

        foreach ($adminEmails as $index => $email) {
            try {
                Mail::to($email)->later(
                    now()->addSeconds($index * 5),
                    new NewRegistrationAdminMail($registration)
                );
            } catch (\Throwable $e) {
                Log::error('Admin email queue failed: ' . $e->getMessage(), [
                    'registration_id' => $registration->id,
                    'email'           => $email,
                ]);
            }
        }
    }

    /* =========================================================
     |  PRIVATE — INLINE QUEUE WORKER
     ========================================================= */

    private function runInlineQueueWorker(int $registrationId): void
    {
        try {
            Artisan::call('queue:work', [
                '--stop-when-empty' => true,
                '--tries'           => 3,
                '--timeout'         => 55,
                '--max-time'        => 55,
                '--quiet'           => true,
            ]);
        } catch (\Throwable $e) {
            Log::error('Inline queue worker failed: ' . $e->getMessage(), [
                'registration_id' => $registrationId,
            ]);
        }
    }
}
