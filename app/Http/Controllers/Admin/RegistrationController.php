<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Mail\NewRegistrationAdminMail;
use App\Mail\RegistrationConfirmationMail;
use App\Mail\RegistrationApprovedMail;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
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

    public function create()
    {
        $events = Event::where('status', 'active')->orderBy('event_date')->get();
        return view('admin.registrations.create', compact('events'));
    }

    /**
     * ============================================================
     * STORE — Save a new registration
     * ============================================================
     */
    public function store(Request $request)
    {
        // ---------- 1. VALIDATION ----------
        $validated = $request->validate([
            'first_name'        => 'required|string|max:100',
            'last_name'         => 'required|string|max:100',
            'phone'             => 'required|string|max:20',
            'whatsapp_number'   => 'required|string|max:20',
            'blood_group'       => 'required|string|max:20',
            'email'             => 'nullable|email|max:255',
            'gender'            => 'required|in:Male,Female,Other',
            'dob'               => 'required|date|before:today',
            'nid'               => 'required|string|max:50',
            'address'           => 'nullable|string|max:500',

            'emergency_name'    => 'required|string|max:100',
            'emergency_phone'   => 'required|string|max:20',

            'event_id'          => 'required|exists:events,id',
            'category'          => 'required|string|max:50',
            'tshirt'            => 'required|in:S,M,L,XL,XXL',

            'payment_method'    => 'required|in:bKash,Card,Cash,Nagad',
            'sender_phone_last3'=> 'required|string|max:3',
            'trx_id'            => 'required|string|max:100',

            'profile_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:51200',

            'confirm_terms'     => 'accepted',
        ], [
            'confirm_terms.accepted' => 'You must agree to the event rules and regulations.',
            'profile_image.max'      => 'Profile image must not exceed 50 MB.',
            'profile_image.image'    => 'Profile image must be a valid image file.',
        ]);

        // ---------- 2. HANDLE PROFILE IMAGE ----------
        $profileImagePath = null;
        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')
                ->store('registrations/profiles', 'public');
        }

        // ---------- 3. FETCH EVENT ----------
        $event = Event::findOrFail($validated['event_id']);

        // ---------- 4. PREPARE DATA ----------
        $data = [
            'event_id'           => $validated['event_id'],
            'first_name'         => $validated['first_name'],
            'last_name'          => $validated['last_name'],
            'phone'              => $validated['phone'],
            'whatsapp_number'    => $validated['whatsapp_number'],
            'blood_group'        => $validated['blood_group'],
            'email'              => $validated['email'] ?? null,
            'gender'             => $validated['gender'],
            'dob'                => $validated['dob'],
            'nid'                => $validated['nid'],
            'address'            => $validated['address'] ?? null,
            'emergency_name'     => $validated['emergency_name'],
            'emergency_phone'    => $validated['emergency_phone'],
            'category'           => $validated['category'],
            'tshirt_size'        => $validated['tshirt'],
            'amount'             => $event->fee,
            'payment_method'     => $validated['payment_method'],
            'sender_phone_last3' => $validated['sender_phone_last3'],
            'trx_id'             => $validated['trx_id'],
            'status'             => 'pending',
            'profile_image'      => $profileImagePath,
        ];

        // ---------- 5. SAVE ----------
        $registration = Registration::create($data);

           // ---------- 7. QUEUE CONFIRMATION TO SUBMITTER ----------
            if (!empty($registration->email)) {
                try {
                    Mail::to($registration->email)
                        ->queue(new RegistrationConfirmationMail($registration));
                } catch (\Throwable $e) {
                    Log::error('Failed to queue confirmation email: ' . $e->getMessage(), [
                        'registration_id' => $registration->id,
                        'email'           => $registration->email,
                    ]);
                }
            }

            // ---------- 8. QUEUE ADMIN NOTIFICATIONS (staggered) ----------
            $adminEmails = User::where('role', 'admin')
                ->whereNotNull('email')
                ->where('email', '!=', '')
                ->pluck('email')
                ->unique()
                ->values()
                ->all();

            foreach ($adminEmails as $index => $email) {
                try {
                    Mail::to($email)
                        ->later(now()->addSeconds($index * 5), new NewRegistrationAdminMail($registration));
                    //     ↑ 5-second gap between each admin email to respect Hostinger rate limits
                } catch (\Throwable $e) {
                    Log::error('Failed to queue admin notification: ' . $e->getMessage(), [
                        'registration_id' => $registration->id,
                        'email'           => $email,
                    ]);
                }
            }

           try {
                \Illuminate\Support\Facades\Artisan::call('queue:work', [
                    '--stop-when-empty' => true, 
                    '--tries'           => 3, 
                    '--timeout'         => 55, 
                    '--max-time'        => 55,
                    '--quiet'           => true,
                ]);
            } catch (\Throwable $e) {
                Log::error('Inline queue worker failed: ' . $e->getMessage(), [
                    'registration_id' => $registration->id,
                ]);
            }
        
        // ---------- 9. RESPOND ----------
        if ($request->expectsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => "Registration #{$registration->id} created successfully! Awaiting review.",
                'redirect' => route('home'),
            ]);
        }

        return redirect()->route('home')
            ->with('success', "Registration #{$registration->id} created successfully! Awaiting review.");
    }

    public function show(Registration $registration)
    {
        $registration->load('event');
        return view('admin.registrations.show', compact('registration'));
    }

    public function edit(Registration $registration)
    {
        $events = Event::orderBy('title')->get();
        return view('admin.registrations.edit', compact('registration', 'events'));
    }

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

        // Replace avatar if new one uploaded
        if ($request->hasFile('profile_image')) {
            if ($registration->avatar && Storage::disk('public')->exists($registration->avatar)) {
                Storage::disk('public')->delete($registration->avatar);
            }
            $data['avatar'] = $request->file('profile_image')
                ->store('registrations/avatars', 'public');
        }

        $registration->update($data);

        return redirect()
            ->route('admin.registrations.show', $registration)
            ->with('success', "Registration #{$registration->id} updated successfully!");
    }

    public function updateStatus(Request $request, Registration $registration)
    {
        $data = $request->validate([
            'status'     => 'required|in:pending,approved,rejected,cancelled',
            'admin_note' => 'nullable|string|max:500',
        ]);

        $oldStatus = $registration->status;
        $newStatus = $data['status'];

        $bibJustGenerated = false;

        // ---------- BIB number generate (only on first approval) ----------
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

        // ---------- Update registration ----------
        $registration->update($data);
        $registration->refresh();

        // ==================================================
        // ✅ INCREMENT / DECREMENT event.registered
        // ==================================================
        $event = $registration->event;

        if ($event) {

            // Case 1: new status = approved, old ≠ approved  → INCREMENT
            if ($newStatus === 'approved' && $oldStatus !== 'approved') {
                $event->increment('registered');
            }

            // Case 2: new status ≠ approved, old = approved  → DECREMENT (rollback)
            elseif ($newStatus !== 'approved' && $oldStatus === 'approved') {
                // Prevent negative count
                if ($event->registered > 0) {
                    $event->decrement('registered');
                }
            }

            // Case 3: both approved or both not approved → no change
            // Nothing to do
        }

        // ==================================================
        // ✅ APPROVAL EMAIL
        // ==================================================
        $shouldSendApprovalEmail = (
            $newStatus === 'approved'
            && $oldStatus !== 'approved'
            && !empty($registration->email)
        );

        if ($shouldSendApprovalEmail) {
            try {
                Mail::to($registration->email)
                    ->queue(new RegistrationApprovedMail($registration));

                Log::info('Approval email queued', [
                    'registration_id' => $registration->id,
                    'bib_number'      => $registration->bib_number,
                    'email'           => $registration->email,
                ]);

                // Instant Worker — email এখনই পাঠাবে
                try {
                    Artisan::call('queue:work', [
                        '--stop-when-empty' => true,
                        '--tries'           => 3,
                        '--timeout'         => 55,
                        '--max-time'        => 55,
                        '--quiet'           => true,
                    ]);
                } catch (\Throwable $e) {
                    Log::error('Inline queue worker failed (approval): ' . $e->getMessage(), [
                        'registration_id' => $registration->id,
                    ]);
                }

            } catch (\Throwable $e) {
                Log::error('Failed to queue approval email: ' . $e->getMessage(), [
                    'registration_id' => $registration->id,
                    'email'           => $registration->email,
                ]);
            }
        }

        // ==================================================
        // ✅ SUCCESS MESSAGE
        // ==================================================
        $message = "Registration #{$registration->id} marked as {$newStatus}.";

        if ($bibJustGenerated) {
            $message .= " BIB number {$registration->bib_number} assigned.";
        }

        if ($shouldSendApprovalEmail) {
            $message .= " Confirmation email sent to {$registration->email}.";
        }

        return redirect()
            ->back()
            ->with('success', $message);
    }


   public function destroy(Registration $registration)
    {
        $event = $registration->event;
        $wasApproved = $registration->status === 'approved';

        $registration->delete();

        // If deleted registration was approved, decrement counter
        if ($wasApproved && $event && $event->registered > 0) {
            $event->decrement('registered');
        }

        return redirect()->route('admin.registrations.index')
            ->with('success', "Registration #{$registration->id} deleted successfully.");
    }
}
