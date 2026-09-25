<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            // Personal
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

            // Emergency
            'emergency_name'    => 'required|string|max:100',
            'emergency_phone'   => 'required|string|max:20',

            // Event
            'event_id'          => 'required|exists:events,id',
            'category'          => 'required|string|max:50',
            'tshirt'            => 'required|in:S,M,L,XL,XXL',

            // Payment
            'payment_method'    => 'required|in:bKash,Card,Cash',
            'sender_phone_last3'=> 'required|string|max:3',
            'trx_id'            => 'required|string|max:100',

            // Profile image
            'profile_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:51200', // 50 MB

            // Terms
            'confirm_terms'     => 'accepted',
        ], [
            // Custom messages (optional)
            'confirm_terms.accepted' => 'You must agree to the event rules and regulations.',
            'profile_image.max'      => 'Profile image must not exceed 50 MB.',
            'profile_image.image'    => 'Profile image must be a valid image file.',
        ]);

        // ---------- 2. HANDLE PROFILE IMAGE UPLOAD ----------
        $avatarPath = null;

        if ($request->hasFile('profile_image')) {
           $profileImagePath = $request->file('profile_image')
            ->store('registrations/profiles', 'public');
        }

        // ---------- 3. FETCH EVENT (for fee) ----------
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
            'amount'             => $event->fee,           // pull fee from the event
            'payment_method'     => $validated['payment_method'],
            'sender_phone_last3' => $validated['sender_phone_last3'],
            'trx_id'             => $validated['trx_id'],
            'status'             => 'pending',             // default status
            'profile_image' => $profileImagePath ?? null,       // nullable
        ];

        // ---------- 5. SAVE ----------
        $registration = Registration::create($data);

        // ---------- 6. INCREMENT EVENT REGISTERED COUNT ----------
        $event->increment('registered');

        // ---------- 7. REDIRECT WITH SUCCESS ----------
        if ($request->expectsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => "Registration #{$registration->id} created successfully! Awaiting review.",
                'redirect' => route('home'),
            ]);
        }
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

        // ✅ Generate bib number when approved (only once)
        if ($data['status'] === 'approved' && empty($registration->bib_number)) {

            // Get first digit of category (7.5K → 7, 15K → 1, 21.5K → 2)
            $code = substr(trim($registration->category), 0, 1);

            // Find last bib for this event + category
            $lastBib = Registration::where('event_id', $registration->event_id)
                ->where('category', $registration->category)
                ->whereNotNull('bib_number')
                ->where('bib_number', 'like', $code . '%')
                ->orderByDesc('id')
                ->value('bib_number');

            // Increment number (7001 → 7002)
            $next = $lastBib ? (int) substr($lastBib, 1) + 1 : 1;
           
            // Final bib: 7001, 1001, 2001...
            $data['bib_number'] = $code . str_pad($next, 3, '0', STR_PAD_LEFT);
        }

        $registration->update($data);

        return redirect()->route('admin.registrations.index')
            ->with('success', "Registration #{$registration->id} marked as {$data['status']}.");
    }

    public function destroy(Registration $registration)
    {
        // Delete avatar file if exists
        if ($registration->avatar && Storage::disk('public')->exists($registration->avatar)) {
            Storage::disk('public')->delete($registration->avatar);
        }

        $registration->delete();

        return redirect()->route('admin.registrations.index')
            ->with('success', "Registration #{$registration->id} deleted.");
    }
}