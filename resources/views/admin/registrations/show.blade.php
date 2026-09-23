@extends('admin.layouts.app')

@section('title', 'Registration #' . $registration->id)
@section('page-title', 'Registration Details')
@section('page-subtitle', 'Full information of registration #' . $registration->id)

@section('body')

@php
    $statusStyles = [
        'pending'   => ['badge' => 'bg-amber-50 text-amber-700 ring-amber-200',   'dot' => 'bg-amber-500',   'icon' => 'fa-clock',         'label' => 'Pending Review'],
        'approved'  => ['badge' => 'bg-emerald-50 text-emerald-700 ring-emerald-200','dot' => 'bg-emerald-500','icon' => 'fa-circle-check',  'label' => 'Approved'],
        'rejected'  => ['badge' => 'bg-rose-50 text-rose-700 ring-rose-200',      'dot' => 'bg-rose-500',    'icon' => 'fa-circle-xmark',  'label' => 'Rejected'],
        'cancelled' => ['badge' => 'bg-slate-50 text-slate-700 ring-slate-200',   'dot' => 'bg-slate-500',   'icon' => 'fa-ban',           'label' => 'Cancelled'],
    ];
    $s = $statusStyles[$registration->status] ?? $statusStyles['pending'];

    $avatarPalette = [
        'from-pink-500 to-rose-600',
        'from-violet-500 to-indigo-600',
        'from-sky-500 to-cyan-600',
        'from-teal-500 to-emerald-600',
        'from-orange-500 to-amber-600',
        'from-fuchsia-500 to-pink-600',
    ];
    $colorIdx = crc32($registration->full_name) % count($avatarPalette);
    $avatarGradient = $avatarPalette[$colorIdx];
    $initials = strtoupper(substr($registration->first_name, 0, 1) . substr($registration->last_name, 0, 1));
@endphp

{{-- ========== TOP BAR ========== --}}
<div class="flex flex-wrap items-center justify-between gap-2 mb-4">
    <div class="flex items-center gap-2.5">
        <a href="{{ route('admin.registrations.index') }}"
           class="w-9 h-9 rounded-lg bg-white shadow-sm border border-slate-200 flex items-center justify-center text-slate-600 hover:text-brandPink hover:border-brandPink transition">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <p class="text-[10px] uppercase tracking-wider text-slate-400 font-semibold">Registrations</p>
            <p class="text-sm font-semibold text-slate-800 leading-tight">#{{ $registration->id }} · {{ $registration->full_name }}</p>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <button onclick="window.print()"
                class="px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:border-brandPink hover:text-brandPink transition">
            <i class="fa-solid fa-print"></i> Print
        </button>
        <button onclick='openStatusModal(@json($registration))'
                class="px-3 py-1.5 rounded-lg bg-brandPink text-white text-xs font-semibold hover:bg-pink-700 transition">
            <i class="fa-solid fa-pen-to-square"></i> Update Status
        </button>
    </div>
</div>

{{-- ========== PROFILE HEADER ========== --}}
<div class="bg-gradient-to-r from-slate-900 via-slate-800 to-brandPink rounded-xl shadow-md p-4 mb-4 text-white relative overflow-hidden">
    <div class="absolute -top-8 -right-8 w-32 h-32 rounded-full bg-white/5"></div>
    <div class="absolute -bottom-12 -right-2 w-40 h-40 rounded-full bg-white/5"></div>

    <div class="relative flex flex-wrap items-center gap-4">
        {{-- Avatar --}}
            <div class="relative shrink-0">
                @if($registration->profile_image)
                    <img src="{{ asset('storage/' . $registration->profile_image) }}"
                        alt="{{ $registration->full_name }}"
                        class="w-16 h-16 rounded-full object-cover shadow-xl ring-2 ring-white/20">
                @else
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br {{ $avatarGradient }} flex items-center justify-center text-2xl font-bold shadow-xl ring-2 ring-white/20">
                        {{ $initials }}
                    </div>
                @endif
                <span class="absolute -bottom-0.5 -right-0.5 w-6 h-6 rounded-full bg-white flex items-center justify-center text-xs
                            @if($registration->status === 'approved') text-emerald-600
                            @elseif($registration->status === 'rejected') text-rose-600
                            @elseif($registration->status === 'cancelled') text-slate-600
                            @else text-amber-600 @endif">
                    <i class="fa-solid {{ $s['icon'] }}"></i>
                </span>
        </div>

        {{-- Name + meta --}}
        <div class="flex-1 min-w-[180px]">
            <h2 class="text-lg font-bold leading-tight">{{ $registration->full_name }}</h2>
            <p class="text-xs text-slate-300 mt-0.5">
                <i class="fa-solid fa-phone mr-1 text-[10px]"></i> {{ $registration->phone }}
                @if($registration->email)
                    <span class="mx-1.5 text-slate-500">•</span>
                    <i class="fa-regular fa-envelope mr-1 text-[10px]"></i> {{ $registration->email }}
                @endif
            </p>
            <div class="flex flex-wrap items-center gap-1.5 mt-2">
                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-white/10 backdrop-blur ring-1 ring-white/20">
                    <i class="fa-solid fa-person-running mr-1"></i>{{ $registration->category }}
                </span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-white/10 backdrop-blur ring-1 ring-white/20">
                    <i class="fa-solid fa-shirt mr-1"></i>{{ $registration->tshirt_size }}
                </span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-white/10 backdrop-blur ring-1 ring-white/20">
                    <i class="fa-solid fa-flag-checkered mr-1"></i>{{ $registration->event?->title }}
                </span>
            </div>
        </div>

        {{-- Status badge --}}
        <div class="text-right shrink-0">
            <p class="text-[10px] uppercase tracking-wider text-slate-400 mb-1">Status</p>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-bold text-xs bg-white text-slate-800 shadow">
                <span class="w-1.5 h-1.5 rounded-full {{ $s['dot'] }} animate-pulse"></span>
                {{ $s['label'] }}
            </span>
        </div>
    </div>
</div>

{{-- ========== MAIN GRID ========== --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

    {{-- LEFT COLUMN --}}
    <div class="lg:col-span-2 space-y-4">

        {{-- PERSONAL INFO --}}
        <div class="bg-white rounded-xl shadow-sm p-4">
            <div class="flex items-center gap-2.5 mb-3 pb-3 border-b border-slate-100">
                <div class="w-8 h-8 rounded-lg bg-pink-50 text-brandPink flex items-center justify-center">
                    <i class="fa-solid fa-user text-sm"></i>
                </div>
                <div>
                    <h3 class="font-bold text-slate-800 text-sm leading-tight">Personal Information</h3>
                    <p class="text-[10px] text-slate-500">Basic details of the runner</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-3 text-sm">
                <div>
                    <p class="text-[10px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Full Name</p>
                    <p class="font-semibold text-slate-800 text-[13px]">{{ $registration->full_name }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Phone</p>
                    <p class="font-semibold text-slate-800 text-[13px]">{{ $registration->phone }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Email</p>
                    <p class="font-semibold text-slate-800 text-[13px]">{{ $registration->email ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Gender</p>
                    <p class="font-semibold text-slate-800 text-[13px]">{{ $registration->gender }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Date of Birth</p>
                    <p class="font-semibold text-slate-800 text-[13px]">{{ $registration->dob?->format('d M Y') }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">NID / Passport</p>
                    <p class="font-semibold text-slate-800 text-[13px]">{{ $registration->nid ?? '—' }}</p>
                </div>
                <div class="sm:col-span-2">
                    <p class="text-[10px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Address</p>
                    <p class="font-semibold text-slate-800 text-[13px]">{{ $registration->address ?? '—' }}</p>
                </div>
            </div>
        </div>

        {{-- EVENT & PAYMENT --}}
        <div class="bg-white rounded-xl shadow-sm p-4">
            <div class="flex items-center gap-2.5 mb-3 pb-3 border-b border-slate-100">
                <div class="w-8 h-8 rounded-lg bg-teal-50 text-brandTeal flex items-center justify-center">
                    <i class="fa-solid fa-shirt text-sm"></i>
                </div>
                <div>
                    <h3 class="font-bold text-slate-800 text-sm leading-tight">Event & Payment</h3>
                    <p class="text-[10px] text-slate-500">Event category and payment info</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-3 text-sm">
                <div class="sm:col-span-2">
                    <p class="text-[10px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Event</p>
                    <p class="font-semibold text-slate-800 text-[13px]">{{ $registration->event?->title ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Category</p>
                    <span class="inline-block px-2 py-0.5 rounded-full text-[11px] font-semibold bg-blue-50 text-brandBlue">
                        {{ $registration->category }}
                    </span>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">T-Shirt Size</p>
                    <span class="inline-block px-2 py-0.5 rounded-full text-[11px] font-semibold bg-teal-50 text-brandTeal">
                        {{ $registration->tshirt_size }}
                    </span>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Amount</p>
                    <p class="font-bold text-slate-800 text-[15px]">BDT {{ number_format($registration->amount) }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Payment Method</p>
                    <p class="font-semibold text-slate-800 text-[13px]">{{ $registration->payment_method }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Transaction ID</p>
                    <p class="font-mono text-[12px] font-semibold text-slate-800 bg-slate-50 rounded px-2 py-1 inline-block">
                        {{ $registration->trx_id ?? '—' }}
                    </p>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Sender Phone Last 3</p>
                    <p class="font-mono text-[12px] font-semibold text-slate-800 bg-slate-50 rounded px-2 py-1 inline-block tracking-widest">
                        {{ $registration->sender_phone_last3 ?? '—' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- EMERGENCY CONTACT --}}
        <div class="bg-white rounded-xl shadow-sm p-4">
            <div class="flex items-center gap-2.5 mb-3 pb-3 border-b border-slate-100">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-brandBlue flex items-center justify-center">
                    <i class="fa-solid fa-phone text-sm"></i>
                </div>
                <div>
                    <h3 class="font-bold text-slate-800 text-sm leading-tight">Emergency Contact</h3>
                    <p class="text-[10px] text-slate-500">Person to contact in case of emergency</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-3 text-sm">
                <div>
                    <p class="text-[10px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Name</p>
                    <p class="font-semibold text-slate-800 text-[13px]">{{ $registration->emergency_name }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-wide text-slate-400 font-semibold mb-0.5">Phone</p>
                    <p class="font-semibold text-slate-800 text-[13px]">{{ $registration->emergency_phone }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- RIGHT COLUMN --}}
    <div class="space-y-4">

        {{-- STATUS CARD --}}
        <div class="bg-white rounded-xl shadow-sm p-4">
            <div class="flex items-center justify-between mb-3">
                <h3 class="font-bold text-slate-800 text-sm">
                    <i class="fa-solid fa-flag text-brandPink mr-1.5"></i> Status
                </h3>
                <button onclick='openStatusModal(@json($registration))'
                        class="text-[11px] font-semibold text-brandPink hover:underline">
                    <i class="fa-solid fa-pen text-[10px]"></i> Change
                </button>
            </div>

            <div class="rounded-lg p-3 text-center ring-1 {{ $s['badge'] }}">
                <i class="fa-solid {{ $s['icon'] }} text-2xl mb-1"></i>
                <p class="font-bold text-[13px]">{{ $s['label'] }}</p>
                <p class="text-[10px] opacity-75 mt-0.5">Updated {{ $registration->updated_at->diffForHumans() }}</p>
            </div>

            @if($registration->admin_note)
                <div class="mt-3 p-2.5 rounded-lg bg-slate-50 border-l-3 border-brandPink">
                    <p class="text-[10px] font-bold uppercase tracking-wide text-slate-500 mb-1">
                        <i class="fa-solid fa-note-sticky"></i> Admin Note
                    </p>
                    <p class="text-[12px] text-slate-700 leading-relaxed">{{ $registration->admin_note }}</p>
                </div>
            @endif
        </div>

        {{-- TIMELINE --}}
        <div class="bg-white rounded-xl shadow-sm p-4">
            <h3 class="font-bold text-slate-800 text-sm mb-3">
                <i class="fa-solid fa-clock-rotate-left text-violet-500 mr-1.5"></i> Timeline
            </h3>

            <div class="relative pl-5">
                <div class="absolute left-1.5 top-2 bottom-2 w-0.5 bg-slate-200"></div>

                <div class="relative mb-4">
                    <div class="absolute -left-3.5 top-0.5 w-2.5 h-2.5 rounded-full bg-brandPink ring-3 ring-pink-100"></div>
                    <p class="text-[12px] font-semibold text-slate-800 leading-tight">Registration Created</p>
                    <p class="text-[10px] text-slate-500 mt-0.5">{{ $registration->created_at->format('d M Y, h:i A') }}</p>
                </div>

                @if($registration->updated_at->ne($registration->created_at))
                    <div class="relative">
                        <div class="absolute -left-3.5 top-0.5 w-2.5 h-2.5 rounded-full {{ $s['dot'] }} ring-3 ring-slate-100"></div>
                        <p class="text-[12px] font-semibold text-slate-800 leading-tight">Status Updated</p>
                        <p class="text-[10px] text-slate-500 mt-0.5">{{ $registration->updated_at->format('d M Y, h:i A') }}</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- QUICK ACTIONS --}}
        <div class="bg-white rounded-xl shadow-sm p-4">
            <h3 class="font-bold text-slate-800 text-sm mb-3">
                <i class="fa-solid fa-bolt text-brandOrange mr-1.5"></i> Quick Actions
            </h3>

            <div class="space-y-1.5">
                <a href="tel:{{ $registration->phone }}"
                   class="flex items-center gap-2.5 px-3 py-2 rounded-lg bg-slate-50 hover:bg-brandPink hover:text-white transition text-[12px] font-semibold text-slate-700">
                    <i class="fa-solid fa-phone w-4 text-xs"></i> Call Runner
                </a>

                @if($registration->email)
                    <a href="mailto:{{ $registration->email }}"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-lg bg-slate-50 hover:bg-brandPink hover:text-white transition text-[12px] font-semibold text-slate-700">
                        <i class="fa-regular fa-envelope w-4 text-xs"></i> Send Email
                    </a>
                @endif

                <form action="{{ route('admin.registrations.destroy', $registration) }}" method="POST"
                      onsubmit="return confirm('Delete this registration permanently?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg bg-rose-50 hover:bg-rose-600 hover:text-white transition text-[12px] font-semibold text-rose-700">
                        <i class="fa-solid fa-trash w-4 text-xs"></i> Delete Registration
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ============= STATUS UPDATE MODAL ============= --}}
<div id="statusModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm">
        <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-sm font-bold text-slate-800">Update Registration Status</h3>
            <button onclick="closeStatusModal()" class="text-slate-400 hover:text-slate-700 text-xl leading-none">&times;</button>
        </div>

        <form id="statusForm" method="POST" action="{{ route('admin.registrations.updateStatus', $registration) }}" class="p-4 space-y-3">
            @csrf
            @method('PUT')

            <div class="bg-slate-50 rounded-lg p-2.5 text-xs">
                <p class="font-semibold text-slate-800">{{ $registration->full_name }}</p>
                <p class="text-slate-500 mt-0.5">{{ $registration->event?->title }}</p>
                <p class="text-slate-500 mt-0.5">Amount: <span class="font-semibold text-slate-700">BDT {{ number_format($registration->amount) }}</span></p>
            </div>

            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wide text-slate-600 mb-1.5">
                    Status <span class="text-rose-500">*</span>
                </label>
                <select name="status" id="sm_status" required
                        class="w-full px-3 py-2 border border-slate-200 rounded-lg text-[13px] font-semibold
                               text-slate-800 bg-white focus:ring-2 focus:ring-brandPink focus:outline-none cursor-pointer">
                    <option value="pending"   @selected($registration->status === 'pending')>Pending</option>
                    <option value="approved"  @selected($registration->status === 'approved')>Approved</option>
                    <option value="rejected"  @selected($registration->status === 'rejected')>Rejected</option>
                    <option value="cancelled" @selected($registration->status === 'cancelled')>Cancelled</option>
                </select>
            </div>

            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wide text-slate-600 mb-1.5">
                    Admin Note <span class="text-slate-400 font-normal normal-case">(optional)</span>
                </label>
                <textarea name="admin_note" rows="2" placeholder="Reason for approval/rejection..."
                          class="w-full px-3 py-2 border border-slate-200 rounded-lg text-[12px] focus:ring-2 focus:ring-brandPink focus:outline-none resize-none">{{ $registration->admin_note }}</textarea>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                <button type="button" onclick="closeStatusModal()"
                        class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-1.5 rounded-lg text-xs font-semibold bg-brandPink text-white hover:bg-pink-700">
                    <i class="fa-solid fa-check mr-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openStatusModal() {
        const modal = document.getElementById('statusModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeStatusModal() {
        const modal = document.getElementById('statusModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    document.getElementById('statusModal')?.addEventListener('click', e => {
        if (e.target === e.currentTarget) closeStatusModal();
    });
</script>
@endpush

@endsection