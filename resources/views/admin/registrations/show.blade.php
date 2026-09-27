@extends('admin.layouts.app')

@section('title', 'Registration #' . $registration->id)
@section('page-title', 'Registration Details')
@section('page-subtitle', 'Full information of registration #' . $registration->id)

@section('body')

@php
    $statusStyles = [
        'pending'   => ['badge' => 'bg-amber-50 text-amber-800 ring-amber-300',    'dot' => 'bg-amber-600',   'icon' => 'fa-clock',         'label' => 'Pending Review'],
        'approved'  => ['badge' => 'bg-emerald-50 text-emerald-800 ring-emerald-300','dot' => 'bg-emerald-600','icon' => 'fa-circle-check',  'label' => 'Approved'],
        'rejected'  => ['badge' => 'bg-rose-50 text-rose-800 ring-rose-300',       'dot' => 'bg-rose-600',    'icon' => 'fa-circle-xmark',  'label' => 'Rejected'],
        'cancelled' => ['badge' => 'bg-slate-100 text-slate-800 ring-slate-300',   'dot' => 'bg-slate-600',   'icon' => 'fa-ban',           'label' => 'Cancelled'],
    ];
    $s = $statusStyles[$registration->status] ?? $statusStyles['pending'];

    $avatarPalette = [
        'from-pink-600 to-rose-700',
        'from-violet-600 to-indigo-700',
        'from-sky-600 to-cyan-700',
        'from-teal-600 to-emerald-700',
        'from-orange-600 to-amber-700',
        'from-fuchsia-600 to-pink-700',
    ];
    $colorIdx = crc32($registration->full_name) % count($avatarPalette);
    $avatarGradient = $avatarPalette[$colorIdx];
    $initials = strtoupper(substr($registration->first_name, 0, 1) . substr($registration->last_name, 0, 1));
@endphp

{{-- ========== TOP BAR ========== --}}
<div class="flex flex-wrap items-center justify-between gap-2 mb-3">
    <div class="flex items-center gap-2.5">
        <a href="{{ route('admin.registrations.index') }}"
           class="w-8 h-8 rounded-lg bg-white shadow-sm border border-slate-200 flex items-center justify-center text-slate-700 hover:text-brandPink hover:border-brandPink transition">
            <i class="fa-solid fa-arrow-left text-xs"></i>
        </a>
        <div>
            <p class="text-[9px] uppercase tracking-[0.12em] text-slate-500 font-bold">Registrations</p>
            <p class="text-[13.5px] font-extrabold text-slate-900 leading-tight">#{{ $registration->id }} · {{ $registration->full_name }}</p>
        </div>
    </div>

    <div class="flex items-center gap-2 flex-wrap">

        {{-- WhatsApp Send --}}
        <button type="button"
                class="notifyBtn px-3 py-1.5 rounded-lg bg-green-50 border border-green-200 text-[11px] font-bold
                       text-green-700 hover:bg-green-500 hover:text-white hover:border-green-500 transition"
                title="Send WhatsApp"
                data-mode="whatsapp"
                data-name="{{ $registration->first_name }} {{ $registration->last_name }}"
                data-phone="{{ $registration->whatsapp_number ?? $registration->phone }}"
                data-event="{{ $registration->event?->title ?? 'Event' }}"
                data-event-date="{{ $registration->event?->event_date ?? '' }}"
                data-event-location="{{ $registration->event?->location ?? '' }}"
                data-bib="{{ $registration->bib_number ?? 'N/A' }}"
                data-category="{{ $registration->category }}">
            <i class="fa-brands fa-whatsapp"></i>
            <span class="hidden sm:inline ml-1">WhatsApp</span>
        </button>

        {{-- SMS Send --}}
        <button type="button"
                class="notifyBtn px-3 py-1.5 rounded-lg bg-sky-50 border border-sky-200 text-[11px] font-bold
                       text-sky-700 hover:bg-sky-500 hover:text-white hover:border-sky-500 transition"
                title="Send SMS"
                data-mode="sms"
                data-name="{{ $registration->first_name }} {{ $registration->last_name }}"
                data-phone="{{ $registration->whatsapp_number ?? $registration->phone }}"
                data-event="{{ $registration->event?->title ?? 'Event' }}"
                data-event-date="{{ $registration->event?->event_date ?? '' }}"
                data-event-location="{{ $registration->event?->location ?? '' }}"
                data-bib="{{ $registration->bib_number ?? 'N/A' }}"
                data-category="{{ $registration->category }}">
            <i class="fa-solid fa-comment-sms"></i>
            <span class="hidden sm:inline ml-1">SMS</span>
        </button>

        {{-- Print --}}
        <button onclick="window.print()"
                class="px-3 py-1.5 rounded-lg bg-white border border-slate-300 text-[11px] font-bold text-slate-800
                       hover:border-brandPink hover:text-brandPink transition">
            <i class="fa-solid fa-print"></i>
            <span class="hidden sm:inline ml-1">Print</span>
        </button>

        {{-- Update Status --}}
        <button onclick='openStatusModal()'
                class="px-3 py-1.5 rounded-lg bg-brandPink text-white text-[11px] font-bold
                       hover:bg-pink-700 transition shadow-sm">
            <i class="fa-solid fa-pen-to-square"></i>
            <span class="hidden sm:inline ml-1">Update Status</span>
        </button>
    </div>
</div>

{{-- ========== PROFILE HEADER ========== --}}
<div class="bg-gradient-to-r from-slate-900 via-slate-900 to-brandPink rounded-xl shadow-md px-4 py-3 mb-3 text-white relative overflow-hidden">
    <div class="absolute -top-8 -right-8 w-28 h-28 rounded-full bg-white/5"></div>
    <div class="absolute -bottom-12 -right-2 w-36 h-36 rounded-full bg-white/5"></div>

    <div class="relative flex flex-wrap items-center gap-3">
        <div class="relative shrink-0">
            @if($registration->profile_image)
                <img src="{{ asset('storage/' . $registration->profile_image) }}"
                    alt="{{ $registration->full_name }}"
                    class="w-14 h-14 rounded-full object-cover shadow-xl ring-2 ring-white/25">
            @else
                <div class="w-14 h-14 rounded-full bg-gradient-to-br {{ $avatarGradient }} flex items-center justify-center text-xl font-extrabold shadow-xl ring-2 ring-white/25">
                    {{ $initials }}
                </div>
            @endif
            <span class="absolute -bottom-0.5 -right-0.5 w-5 h-5 rounded-full bg-white flex items-center justify-center text-[10px] shadow
                        @if($registration->status === 'approved') text-emerald-700
                        @elseif($registration->status === 'rejected') text-rose-700
                        @elseif($registration->status === 'cancelled') text-slate-700
                        @else text-amber-700 @endif">
                <i class="fa-solid {{ $s['icon'] }}"></i>
            </span>
        </div>

        <div class="flex-1 min-w-[180px]">
            <h2 class="text-[15.5px] font-extrabold leading-tight tracking-tight">{{ $registration->full_name }}</h2>
            <p class="text-[11px] text-slate-200 mt-0.5">
                <i class="fa-solid fa-phone mr-1 text-[9px] text-slate-300"></i> {{ $registration->phone }}
                @if($registration->email)
                    <span class="mx-1.5 text-slate-400">•</span>
                    <i class="fa-regular fa-envelope mr-1 text-[9px] text-slate-300"></i> {{ $registration->email }}
                @endif
            </p>
            <div class="flex flex-wrap items-center gap-1.5 mt-1.5">
                <span class="px-2 py-0.5 rounded-full text-[9.5px] font-bold bg-white/15 backdrop-blur ring-1 ring-white/25">
                    <i class="fa-solid fa-person-running mr-1"></i>{{ $registration->category }}
                </span>
                <span class="px-2 py-0.5 rounded-full text-[9.5px] font-bold bg-white/15 backdrop-blur ring-1 ring-white/25">
                    <i class="fa-solid fa-shirt mr-1"></i>{{ $registration->tshirt_size }}
                </span>
                @if($registration->bib_number)
                    <span class="px-2 py-0.5 rounded-full text-[9.5px] font-extrabold bg-emerald-500 ring-1 ring-emerald-300 shadow-sm">
                        <i class="fa-solid fa-hashtag mr-0.5"></i>BIB {{ $registration->bib_number }}
                    </span>
                @endif
                @if($registration->blood_group)
                    <span class="px-2 py-0.5 rounded-full text-[9.5px] font-extrabold bg-rose-600 ring-1 ring-rose-300/70 shadow-sm">
                        <i class="fa-solid fa-droplet mr-0.5"></i>{{ $registration->blood_group }}
                    </span>
                @endif
                <span class="px-2 py-0.5 rounded-full text-[9.5px] font-bold bg-white/15 backdrop-blur ring-1 ring-white/25">
                    <i class="fa-solid fa-flag-checkered mr-1"></i>{{ $registration->event?->title }}
                </span>
            </div>
        </div>

        <div class="text-right shrink-0">
            <p class="text-[9px] uppercase tracking-[0.12em] text-slate-300 mb-0.5 font-bold">Status</p>
            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full font-extrabold text-[10.5px] bg-white text-slate-900 shadow">
                <span class="w-1.5 h-1.5 rounded-full {{ $s['dot'] }} animate-pulse"></span>
                {{ $s['label'] }}
            </span>
        </div>
    </div>
</div>

{{-- ========== MAIN GRID ========== --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-3">

    {{-- LEFT COLUMN --}}
    <div class="lg:col-span-2 space-y-3">

        {{-- PERSONAL INFO --}}
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-3.5">
            <div class="flex items-center gap-2 mb-2.5 pb-2.5 border-b border-slate-200">
                <div class="w-7 h-7 rounded-lg bg-pink-100 text-pink-700 flex items-center justify-center">
                    <i class="fa-solid fa-user text-xs"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-slate-900 text-[13px] leading-tight tracking-tight">Personal Information</h3>
                    <p class="text-[9px] text-slate-500 font-medium">Basic details of the runner</p>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-x-4 gap-y-2.5 text-[12.5px]">
                <div class="col-span-2 sm:col-span-1">
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Full Name</p>
                    <p class="font-bold text-slate-900 leading-tight">{{ $registration->full_name }}</p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Phone</p>
                    <p class="font-bold text-slate-900 leading-tight">{{ $registration->phone }}</p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">WhatsApp</p>
                    @if($registration->whatsapp_number)
                        <a href="https://wa.me/{{ preg_replace('/[^\d]/', '', $registration->whatsapp_number) }}"
                           target="_blank"
                           class="font-bold text-green-700 hover:text-green-800 leading-tight">
                            <i class="fa-brands fa-whatsapp text-[10px]"></i> {{ $registration->whatsapp_number }}
                        </a>
                    @else
                        <p class="font-bold text-slate-400 leading-tight">—</p>
                    @endif
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Email</p>
                    <p class="font-bold text-slate-900 leading-tight truncate">{{ $registration->email ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Gender</p>
                    <p class="font-bold text-slate-900 leading-tight">{{ $registration->gender }}</p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Blood Group</p>
                    @if($registration->blood_group)
                        <span class="inline-block px-2 py-0.5 rounded-md text-[11px] font-extrabold bg-rose-100 text-rose-800 leading-tight ring-1 ring-rose-200">
                            <i class="fa-solid fa-droplet text-[9px]"></i> {{ $registration->blood_group }}
                        </span>
                    @else
                        <p class="font-bold text-slate-400 leading-tight">—</p>
                    @endif
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Date of Birth</p>
                    <p class="font-bold text-slate-900 leading-tight">{{ $registration->dob?->format('d M Y') ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">NID / Passport</p>
                    <p class="font-bold text-slate-900 leading-tight">{{ $registration->nid ?? '—' }}</p>
                </div>
                <div class="col-span-2 sm:col-span-3">
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Address</p>
                    <p class="font-bold text-slate-900 leading-tight">{{ $registration->address ?? '—' }}</p>
                </div>
            </div>
        </div>

        {{-- EVENT & PAYMENT --}}
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-3.5">
            <div class="flex items-center gap-2 mb-2.5 pb-2.5 border-b border-slate-200">
                <div class="w-7 h-7 rounded-lg bg-teal-100 text-teal-800 flex items-center justify-center">
                    <i class="fa-solid fa-shirt text-xs"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-slate-900 text-[13px] leading-tight tracking-tight">Event & Payment</h3>
                    <p class="text-[9px] text-slate-500 font-medium">Event category and payment info</p>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-x-4 gap-y-2.5 text-[12.5px]">
                <div class="col-span-2 sm:col-span-3">
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Event</p>
                    <p class="font-bold text-slate-900 leading-tight">{{ $registration->event?->title ?? '—' }}</p>
                </div>

                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">BIB Number</p>
                    @if($registration->bib_number)
                        <span class="inline-block px-2 py-0.5 rounded-md text-[11px] font-extrabold bg-emerald-100 text-emerald-800 leading-tight ring-1 ring-emerald-200">
                            <i class="fa-solid fa-hashtag text-[9px]"></i> {{ $registration->bib_number }}
                        </span>
                    @else
                        <p class="font-bold text-slate-400 leading-tight">Not assigned</p>
                    @endif
                </div>

                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Category</p>
                    <span class="inline-block px-2 py-0.5 rounded-full text-[10.5px] font-extrabold bg-blue-100 text-blue-800 ring-1 ring-blue-200">
                        {{ $registration->category }}
                    </span>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">T-Shirt Size</p>
                    <span class="inline-block px-2 py-0.5 rounded-full text-[10.5px] font-extrabold bg-teal-100 text-teal-800 ring-1 ring-teal-200">
                        {{ $registration->tshirt_size }}
                    </span>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Amount</p>
                    <p class="font-extrabold text-slate-900 text-[14px] leading-tight">BDT {{ number_format($registration->amount) }}</p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Payment Method</p>
                    <p class="font-bold text-slate-900 leading-tight">{{ $registration->payment_method }}</p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Transaction ID</p>
                    <p class="font-mono text-[11.5px] font-bold text-slate-900 bg-slate-100 rounded px-1.5 py-0.5 inline-block ring-1 ring-slate-200">
                        {{ $registration->trx_id ?? '—' }}
                    </p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Sender Phone (Last 3)</p>
                    <p class="font-mono text-[11.5px] font-bold text-slate-900 bg-slate-100 rounded px-1.5 py-0.5 inline-block tracking-widest ring-1 ring-slate-200">
                        {{ $registration->sender_phone_last3 ?? '—' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- EMERGENCY CONTACT --}}
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-3.5">
            <div class="flex items-center gap-2 mb-2.5 pb-2.5 border-b border-slate-200">
                <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-800 flex items-center justify-center">
                    <i class="fa-solid fa-phone text-xs"></i>
                </div>
                <div>
                    <h3 class="font-extrabold text-slate-900 text-[13px] leading-tight tracking-tight">Emergency Contact</h3>
                    <p class="text-[9px] text-slate-500 font-medium">Person to contact in case of emergency</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-x-4 gap-y-2.5 text-[12.5px]">
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Name</p>
                    <p class="font-bold text-slate-900 leading-tight">{{ $registration->emergency_name }}</p>
                </div>
                <div>
                    <p class="text-[9px] uppercase tracking-[0.1em] text-slate-500 font-bold mb-0.5">Phone</p>
                    <p class="font-bold text-slate-900 leading-tight">{{ $registration->emergency_phone }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- RIGHT COLUMN --}}
    <div class="space-y-3">

        {{-- STATUS CARD --}}
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-3.5">
            <div class="flex items-center justify-between mb-2.5">
                <h3 class="font-extrabold text-slate-900 text-[13px] tracking-tight">
                    <i class="fa-solid fa-flag text-brandPink mr-1.5"></i> Status
                </h3>
                <button onclick='openStatusModal()'
                        class="text-[10px] font-bold text-brandPink hover:underline">
                    <i class="fa-solid fa-pen text-[9px]"></i> Change
                </button>
            </div>

            <div class="rounded-lg p-2.5 text-center ring-2 {{ $s['badge'] }}">
                <i class="fa-solid {{ $s['icon'] }} text-xl mb-0.5"></i>
                <p class="font-extrabold text-[12px]">{{ $s['label'] }}</p>
                <p class="text-[9px] opacity-80 mt-0.5 font-semibold">Updated {{ $registration->updated_at->diffForHumans() }}</p>
            </div>

            @if($registration->admin_note)
                <div class="mt-2.5 p-2 rounded-lg bg-slate-100 border-l-2 border-brandPink">
                    <p class="text-[9px] font-extrabold uppercase tracking-[0.1em] text-slate-700 mb-0.5">
                        <i class="fa-solid fa-note-sticky"></i> Admin Note
                    </p>
                    <p class="text-[11px] text-slate-800 leading-relaxed font-medium">{{ $registration->admin_note }}</p>
                </div>
            @endif
        </div>

        {{-- SEND NOTIFICATION --}}
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-3.5">
            <h3 class="font-extrabold text-slate-900 text-[13px] mb-2.5 tracking-tight">
                <i class="fa-solid fa-paper-plane text-green-600 mr-1.5"></i> Send Notification
            </h3>

            <div class="space-y-1.5">
                {{-- WhatsApp --}}
                <button type="button"
                        class="notifyBtn w-full flex items-center gap-2 px-2.5 py-2 rounded-lg
                               bg-green-50 border border-green-200 hover:bg-green-500 hover:text-white
                               hover:border-green-500 transition text-[11.5px] font-bold text-green-800"
                        data-mode="whatsapp"
                        data-name="{{ $registration->first_name }} {{ $registration->last_name }}"
                        data-phone="{{ $registration->whatsapp_number ?? $registration->phone }}"
                        data-event="{{ $registration->event?->title ?? 'Event' }}"
                        data-event-date="{{ $registration->event?->event_date ?? '' }}"
                        data-event-location="{{ $registration->event?->location ?? '' }}"
                        data-bib="{{ $registration->bib_number ?? 'N/A' }}"
                        data-category="{{ $registration->category }}">
                    <i class="fa-brands fa-whatsapp w-4 text-sm"></i>
                    <span>Send WhatsApp</span>
                </button>

                {{-- SMS --}}
                <button type="button"
                        class="notifyBtn w-full flex items-center gap-2 px-2.5 py-2 rounded-lg
                               bg-sky-50 border border-sky-200 hover:bg-sky-500 hover:text-white
                               hover:border-sky-500 transition text-[11.5px] font-bold text-sky-800"
                        data-mode="sms"
                        data-name="{{ $registration->first_name }} {{ $registration->last_name }}"
                        data-phone="{{ $registration->whatsapp_number ?? $registration->phone }}"
                        data-event="{{ $registration->event?->title ?? 'Event' }}"
                        data-event-date="{{ $registration->event?->event_date ?? '' }}"
                        data-event-location="{{ $registration->event?->location ?? '' }}"
                        data-bib="{{ $registration->bib_number ?? 'N/A' }}"
                        data-category="{{ $registration->category }}">
                    <i class="fa-solid fa-comment-sms w-4 text-sm"></i>
                    <span>Send SMS</span>
                </button>
            </div>
        </div>

        {{-- TIMELINE --}}
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-3.5">
            <h3 class="font-extrabold text-slate-900 text-[13px] mb-2.5 tracking-tight">
                <i class="fa-solid fa-clock-rotate-left text-violet-600 mr-1.5"></i> Timeline
            </h3>

            <div class="relative pl-4">
                <div class="absolute left-1 top-2 bottom-2 w-0.5 bg-slate-300"></div>

                <div class="relative mb-3">
                    <div class="absolute -left-3 top-1 w-2 h-2 rounded-full bg-brandPink ring-2 ring-pink-200"></div>
                    <p class="text-[11.5px] font-extrabold text-slate-900 leading-tight">Registration Created</p>
                    <p class="text-[9.5px] text-slate-600 mt-0.5 font-semibold">{{ $registration->created_at->format('d M Y, h:i A') }}</p>
                </div>

                @if($registration->updated_at->ne($registration->created_at))
                    <div class="relative">
                        <div class="absolute -left-3 top-1 w-2 h-2 rounded-full {{ $s['dot'] }} ring-2 ring-slate-200"></div>
                        <p class="text-[11.5px] font-extrabold text-slate-900 leading-tight">Status Updated</p>
                        <p class="text-[9.5px] text-slate-600 mt-0.5 font-semibold">{{ $registration->updated_at->format('d M Y, h:i A') }}</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- QUICK ACTIONS --}}
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-slate-100 p-3.5">
            <h3 class="font-extrabold text-slate-900 text-[13px] mb-2.5 tracking-tight">
                <i class="fa-solid fa-bolt text-brandOrange mr-1.5"></i> Quick Actions
            </h3>

            <div class="space-y-1.5">
                <a href="tel:{{ $registration->phone }}"
                   class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg bg-slate-100 hover:bg-brandPink hover:text-white transition text-[11.5px] font-bold text-slate-800">
                    <i class="fa-solid fa-phone w-3.5 text-[11px]"></i> Call Runner
                </a>

                @if($registration->whatsapp_number)
                    <a href="https://wa.me/{{ preg_replace('/[^\d]/', '', $registration->whatsapp_number) }}"
                       target="_blank"
                       class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg bg-green-100 hover:bg-green-700 hover:text-white transition text-[11.5px] font-bold text-green-800">
                        <i class="fa-brands fa-whatsapp w-3.5 text-[11px]"></i> WhatsApp Chat
                    </a>
                @endif

                @if($registration->email)
                    <a href="mailto:{{ $registration->email }}"
                       class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg bg-slate-100 hover:bg-brandPink hover:text-white transition text-[11.5px] font-bold text-slate-800">
                        <i class="fa-regular fa-envelope w-3.5 text-[11px]"></i> Send Email
                    </a>
                @endif

                <form action="{{ route('admin.registrations.destroy', $registration) }}" method="POST"
                      onsubmit="return confirm('Delete this registration permanently?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-full flex items-center gap-2 px-2.5 py-1.5 rounded-lg bg-rose-100 hover:bg-rose-700 hover:text-white transition text-[11.5px] font-bold text-rose-800">
                        <i class="fa-solid fa-trash w-3.5 text-[11px]"></i> Delete Registration
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- ============= STATUS UPDATE MODAL ============= --}}
<div id="statusModal" class="fixed inset-0 bg-black/60 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm">
        <div class="px-4 py-3 border-b border-slate-200 flex items-center justify-between">
            <h3 class="text-sm font-extrabold text-slate-900">Update Registration Status</h3>
            <button onclick="closeStatusModal()" class="text-slate-500 hover:text-slate-900 text-xl leading-none">&times;</button>
        </div>

        <form id="statusForm" method="POST" action="{{ route('admin.registrations.updateStatus', $registration) }}" class="p-4 space-y-3">
            @csrf
            @method('PUT')

            <div class="bg-slate-100 rounded-lg p-2.5 text-xs ring-1 ring-slate-200">
                <p class="font-extrabold text-slate-900">{{ $registration->full_name }}</p>
                <p class="text-slate-600 mt-0.5 font-semibold">{{ $registration->event?->title }}</p>
                <p class="text-slate-600 mt-0.5 font-semibold">Amount: <span class="font-extrabold text-slate-900">BDT {{ number_format($registration->amount) }}</span></p>
            </div>

            <div>
                <label class="block text-[11px] font-extrabold uppercase tracking-[0.08em] text-slate-700 mb-1.5">
                    Status <span class="text-rose-600">*</span>
                </label>
                <select name="status" id="sm_status" required
                        class="w-full px-3 py-2 border border-slate-300 rounded-lg text-[13px] font-bold
                               text-slate-900 bg-white focus:ring-2 focus:ring-brandPink focus:outline-none cursor-pointer">
                    <option value="pending"   @selected($registration->status === 'pending')>Pending</option>
                    <option value="approved"  @selected($registration->status === 'approved')>Approved</option>
                    <option value="rejected"  @selected($registration->status === 'rejected')>Rejected</option>
                    <option value="cancelled" @selected($registration->status === 'cancelled')>Cancelled</option>
                </select>
            </div>

            <div>
                <label class="block text-[11px] font-extrabold uppercase tracking-[0.08em] text-slate-700 mb-1.5">
                    Admin Note <span class="text-slate-500 font-medium normal-case">(optional)</span>
                </label>
                <textarea name="admin_note" rows="2" placeholder="Reason for approval/rejection..."
                          class="w-full px-3 py-2 border border-slate-300 rounded-lg text-[12px] focus:ring-2 focus:ring-brandPink focus:outline-none resize-none">{{ $registration->admin_note }}</textarea>
            </div>

            <div class="flex justify-end gap-2 pt-3 border-t border-slate-200">
                <button type="button" onclick="closeStatusModal()"
                        class="px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-200 text-slate-800 hover:bg-slate-300">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-1.5 rounded-lg text-xs font-bold bg-brandPink text-white hover:bg-pink-700">
                    <i class="fa-solid fa-check mr-1"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ============= NOTIFY MODAL (WhatsApp / SMS) ============= --}}
<div id="notifyModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden z-[60] items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg max-h-[92vh] overflow-y-auto">

        {{-- Header --}}
        <div class="px-5 py-3.5 border-b border-slate-200 flex items-center justify-between sticky top-0 bg-white z-10">
            <h3 class="text-[15px] font-extrabold text-slate-900 flex items-center gap-2">
                <i id="notifyIcon" class="fa-brands fa-whatsapp text-xl text-green-500"></i>
                <span id="notifyTitleText">Send WhatsApp Message</span>
            </h3>
            <button onclick="closeNotifyModal()" class="text-slate-400 hover:text-slate-700 text-2xl leading-none">&times;</button>
        </div>

        <div class="p-5 space-y-3.5">
            {{-- To info --}}
            <div class="bg-slate-100 rounded-lg p-3 text-[12.5px] ring-1 ring-slate-200">
                <p class="text-slate-500 text-[9px] uppercase tracking-[0.1em] font-extrabold mb-0.5">Send to:</p>
                <p class="font-extrabold text-slate-900" id="notifyToName"></p>
                <p class="text-[11px] text-slate-600 font-semibold" id="notifyToPhone"></p>
            </div>

            {{-- Message --}}
            <div>
                <label class="block text-[11px] font-extrabold uppercase tracking-[0.08em] text-slate-700 mb-1.5">
                    Message Preview <span class="text-[10px] text-slate-500 font-medium normal-case">(editable)</span>
                </label>
                <textarea id="notifyMessage" rows="12"
                          class="w-full px-3 py-2 border border-slate-300 rounded-lg text-[11px] font-mono leading-relaxed
                                 focus:ring-2 focus:ring-brandPink focus:outline-none resize-y"></textarea>
            </div>

            {{-- Buttons --}}
            <div class="flex gap-2 pt-2">
                <button type="button" id="notifyCopyBtn"
                        class="flex-1 px-4 py-2.5 rounded-lg text-[12px] font-extrabold
                               bg-slate-200 text-slate-800 hover:bg-slate-900 hover:text-white transition">
                    <i class="fa-solid fa-copy mr-1"></i> Copy Text
                </button>
                <a href="#" id="notifySendBtn" target="_blank"
                   class="flex-1 px-4 py-2.5 rounded-lg text-[12px] font-extrabold text-center
                          bg-green-500 text-white hover:bg-green-600 transition shadow-md">
                    <i class="fa-brands fa-whatsapp mr-1"></i> Send
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Toast --}}
<div id="notifyToast"
     class="fixed bottom-8 left-1/2 -translate-x-1/2 translate-y-5
            bg-slate-900 text-white px-6 py-3 rounded-full text-sm font-bold
            shadow-2xl opacity-0 invisible transition-all duration-300 z-[70] pointer-events-none">
    ✅ Copied!
</div>

@push('scripts')
<script>
    // ================= STATUS MODAL =================
    function openStatusModal() {
        const modal = document.getElementById('statusModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function closeStatusModal() {
        const modal = document.getElementById('statusModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }
    document.getElementById('statusModal')?.addEventListener('click', e => {
        if (e.target === e.currentTarget) closeStatusModal();
    });

    // ================= NOTIFY MODAL =================
    const notifyModal  = document.getElementById('notifyModal');
    const notifyMsg    = document.getElementById('notifyMessage');
    const notifyToName = document.getElementById('notifyToName');
    const notifyToPh   = document.getElementById('notifyToPhone');
    const notifySend   = document.getElementById('notifySendBtn');
    const notifyCopy   = document.getElementById('notifyCopyBtn');
    const notifyIcon   = document.getElementById('notifyIcon');
    const notifyTitle  = document.getElementById('notifyTitleText');
    const notifyToast  = document.getElementById('notifyToast');

    let notifyMode = 'whatsapp';

    function buildWaMessage(d) {
        const eventDate = d.date
            ? new Date(d.date).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' })
            : 'To be announced';

        return `Dear ${d.name},

Greetings from Run BURJOWAN!

We are pleased to confirm that your registration has been *APPROVED* for the following event:

━━━━━━━━━━━━━━━━━━━━━━
🏃 EVENT DETAILS
━━━━━━━━━━━━━━━━━━━━━━
Event        : ${d.event}
Date         : ${eventDate}
Location     : ${d.location || 'To be announced'}
Category     : ${d.category}
BiB Number   : ${d.bib}

━━━━━━━━━━━━━━━━━━━━━━
📌 IMPORTANT INSTRUCTIONS
━━━━━━━━━━━━━━━━━━━━━━
* Please collect your BIB and Race Kit just before race day.
* Bring a valid photo ID / Mobile phone carrying this message.
* Keep your BIB Number safe — it is required on race day.
* Report to the venue at least 30 minutes before start time.

For any queries, feel free to contact us.

We look forward to seeing you at the starting line!

Warm regards,
Run BURJOWAN Team
"More Than a Race, It's a Movement."

Contact (WhatsApp):
+880 19 1146 9861
+880 17 1154 3414`;
    }

    function buildSmsMessage(d) {
        return `Dear ${d.name}, Your registration for ${d.event} is APPROVED. Category: ${d.category}, BiB No: ${d.bib}. Please collect your kit before race day. - Run BURJOWAN Team`;
    }

    document.querySelectorAll('.notifyBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            notifyMode = this.dataset.mode || 'whatsapp';

            const d = {
                name:     this.dataset.name,
                phone:    this.dataset.phone,
                event:    this.dataset.event,
                date:     this.dataset.eventDate,
                location: this.dataset.eventLocation,
                bib:      this.dataset.bib,
                category: this.dataset.category,
            };

            const cleanPhone = (d.phone || '').replace(/[^\d]/g, '');

            if (notifyMode === 'sms') {
                notifyTitle.textContent = 'Send SMS Confirmation';
                notifyIcon.className    = 'fa-solid fa-comment-sms text-xl text-sky-500';
                notifyMsg.value         = buildSmsMessage(d);
                notifySend.className    = 'flex-1 px-4 py-2.5 rounded-lg text-[12px] font-extrabold text-center bg-sky-500 text-white hover:bg-sky-600 transition shadow-md';
                notifySend.innerHTML    = '<i class="fa-solid fa-comment-sms mr-1"></i> Send SMS';
            } else {
                notifyTitle.textContent = 'Send WhatsApp Confirmation';
                notifyIcon.className    = 'fa-brands fa-whatsapp text-xl text-green-500';
                notifyMsg.value         = buildWaMessage(d);
                notifySend.className    = 'flex-1 px-4 py-2.5 rounded-lg text-[12px] font-extrabold text-center bg-green-500 text-white hover:bg-green-600 transition shadow-md';
                notifySend.innerHTML    = '<i class="fa-brands fa-whatsapp mr-1"></i> Send';
            }

            notifyToName.textContent = d.name;
            notifyToPh.textContent   = d.phone;

            updateNotifyLink(cleanPhone);

            notifyModal.classList.remove('hidden');
            notifyModal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        });
    });

    function updateNotifyLink(phone) {
        const msg = notifyMsg.value;
        if (notifyMode === 'sms') {
            notifySend.href = `sms:${phone}?body=${encodeURIComponent(msg)}`;
        } else {
            notifySend.href = `https://wa.me/${phone}?text=${encodeURIComponent(msg)}`;
        }
    }

    notifyMsg.addEventListener('input', function () {
        const phone = (notifyToPh.textContent || '').replace(/[^\d]/g, '');
        updateNotifyLink(phone);
    });

    function closeNotifyModal() {
        notifyModal.classList.add('hidden');
        notifyModal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    notifyModal.addEventListener('click', (e) => {
        if (e.target === notifyModal) closeNotifyModal();
    });

    // ================= ESC KEY =================
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeNotifyModal();
            closeStatusModal();
        }
    });

    // ================= COPY =================
    notifyCopy.addEventListener('click', function () {
        const text = notifyMsg.value;

        const showToast = (m) => {
            notifyToast.textContent = m;
            notifyToast.classList.remove('opacity-0', 'invisible', 'translate-y-5');
            clearTimeout(notifyToast._t);
            notifyToast._t = setTimeout(() => {
                notifyToast.classList.add('opacity-0', 'invisible', 'translate-y-5');
            }, 2000);
        };

        const legacyCopy = (str) => {
            const ta = document.createElement('textarea');
            ta.value = str;
            ta.style.position = 'fixed';
            ta.style.top = '-9999px';
            document.body.appendChild(ta);
            ta.select();
            ta.setSelectionRange(0, ta.value.length);
            let ok = false;
            try { ok = document.execCommand('copy'); } catch (e) {}
            document.body.removeChild(ta);
            return ok;
        };

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text)
                .then(() => showToast('✅ Message copied!'))
                .catch(() => showToast(legacyCopy(text) ? '✅ Message copied!' : '❌ Copy failed'));
        } else {
            showToast(legacyCopy(text) ? '✅ Message copied!' : '❌ Copy failed');
        }
    });
</script>
@endpush

@endsection