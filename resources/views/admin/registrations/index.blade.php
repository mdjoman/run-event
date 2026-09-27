@extends('admin.layouts.app')

@section('title', 'Registrations - Admin')
@section('page-title', 'Registrations')
@section('page-subtitle', 'Manage runner registrations and payment statuses')

@section('body')

{{-- ============ FILTERS ============ --}}
<form method="GET" class="bg-white rounded-xl shadow-sm p-4 mb-5 card-glossy">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">

        <div class="lg:col-span-2">
            <label class="block text-xs font-semibold text-slate-600 mb-1">
                <i class="fa-solid fa-search mr-1 text-brandPink"></i> Search
            </label>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Name, phone, trx id..."
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">
                <i class="fa-solid fa-circle-dot mr-1 text-brandPink"></i> Status
            </label>
            <select name="status"
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                           focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
                <option value="">All Status</option>
                @foreach(['pending','approved','rejected','cancelled'] as $s)
                    <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">
                <i class="fa-regular fa-calendar-check mr-1 text-brandPink"></i> Event
            </label>
            <select name="event_id"
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                           focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
                <option value="">All Events</option>
                @foreach($events as $e)
                    <option value="{{ $e->id }}" @selected(request('event_id') == $e->id)>{{ $e->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="sm:col-span-2 lg:col-span-4 flex flex-col sm:flex-row gap-2 pt-1">
            <button class="flex-1 sm:flex-none px-5 py-2.5 bg-gradient-to-r from-brandPink to-pink-600
                           hover:from-pink-600 hover:to-brandPink text-white rounded-lg text-sm font-semibold
                           transition shadow-md hover:shadow-lg">
                <i class="fa-solid fa-filter mr-1"></i> Apply Filters
            </button>
            <a href="{{ route('admin.registrations.index') }}"
               class="flex-1 sm:flex-none px-5 py-2.5 bg-slate-100 text-slate-700 rounded-lg text-sm font-semibold
                      hover:bg-slate-200 transition text-center">
                <i class="fa-solid fa-rotate-left mr-1"></i> Reset
            </a>

            @if(request('search') || request('status') || request('event_id'))
                <div class="flex-1 sm:flex-none flex items-center justify-center gap-2 px-3 py-2 bg-blue-50 rounded-lg text-xs text-blue-700 font-medium">
                    <i class="fa-solid fa-info-circle"></i>
                    <span>{{ $registrations->total() }} results</span>
                </div>
            @endif
        </div>

    </div>
</form>

{{-- ============ REGISTRATIONS CARD ============ --}}
<div class="bg-white rounded-xl shadow-sm overflow-hidden card-glossy">

    {{-- ===== DESKTOP TABLE ===== --}}
    <div class="hidden lg:block overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600 uppercase text-xs">
                <tr>
                    <th class="px-5 py-3 text-left font-semibold">BIB</th>
                    <th class="px-5 py-3 text-left font-semibold">Runner</th>
                    <th class="px-5 py-3 text-left font-semibold">WhatsApp</th>
                    <th class="px-5 py-3 text-left font-semibold">Event</th>
                    <th class="px-5 py-3 text-left font-semibold">Category</th>
                    <th class="px-5 py-3 text-left font-semibold">Amount</th>
                    <th class="px-5 py-3 text-left font-semibold">Payment</th>
                    <th class="px-5 py-3 text-left font-semibold">Status</th>
                    <th class="px-5 py-3 text-right font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($registrations as $reg)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-3">
                            @if($reg->bib_number)
                                <span class="inline-block px-2 py-1 rounded-md bg-gradient-to-r from-green-50 to-emerald-50 text-green-700 text-xs font-bold border border-green-100">
                                    {{ $reg->bib_number }}
                                </span>
                            @else
                                <span class="text-slate-400 text-xs">—</span>
                            @endif
                        </td>

                        <td class="px-5 py-3">
                            <div class="font-semibold text-slate-800">{{ $reg->first_name }} {{ $reg->last_name }}</div>
                            <div class="text-xs text-slate-500">
                                <i class="fa-solid fa-phone text-[10px]"></i> {{ $reg->phone }}
                            </div>
                        </td>

                        <td class="px-5 py-3">
                            @php $wa = $reg->whatsapp_number ?? null; @endphp
                            @if($wa)
                                <a href="https://wa.me/{{ preg_replace('/[^\d]/', '', $wa) }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-1 text-green-600 hover:text-green-700 font-semibold text-xs">
                                    <i class="fa-brands fa-whatsapp"></i> {{ $wa }}
                                </a>
                            @else
                                <span class="text-slate-400 text-xs">N/A</span>
                            @endif
                        </td>

                        <td class="px-5 py-3 text-slate-700 max-w-[150px] truncate">{{ $reg->event?->title ?? '—' }}</td>

                        <td class="px-5 py-3">
                            <span class="badge bg-blue-50 text-brandBlue">{{ $reg->category }}</span>
                        </td>

                        <td class="px-5 py-3 font-semibold text-slate-800">BDT {{ number_format($reg->amount) }}</td>

                        <td class="px-5 py-3">
                            <div class="text-xs text-slate-600">{{ $reg->payment_method }}</div>
                            <div class="text-[10px] text-slate-400 font-mono">{{ $reg->trx_id ?? '—' }}</div>
                        </td>

                        <td class="px-5 py-3">
                            @php
                                $colors = [
                                    'pending'   => 'bg-yellow-100 text-yellow-700',
                                    'approved'  => 'bg-green-100 text-green-700',
                                    'rejected'  => 'bg-red-100 text-red-700',
                                    'cancelled' => 'bg-slate-100 text-slate-700',
                                ];
                            @endphp
                            <span class="badge {{ $colors[$reg->status] ?? '' }}">
                                {{ ucfirst($reg->status) }}
                            </span>
                        </td>

                        {{-- Actions (inline — কোনো partial নেই) --}}
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-1.5">

                                <button type="button"
                                        class="notifyBtn w-8 h-8 flex items-center justify-center rounded-lg
                                               bg-green-50 text-green-600 hover:bg-green-100 active:scale-95
                                               transition flex-shrink-0"
                                        title="Send WhatsApp"
                                        data-mode="whatsapp"
                                        data-name="{{ $reg->first_name }} {{ $reg->last_name }}"
                                        data-phone="{{ $reg->whatsapp_number ?? $reg->phone }}"
                                        data-event="{{ $reg->event?->title ?? 'Event' }}"
                                        data-event-date="{{ $reg->event?->event_date ?? '' }}"
                                        data-event-location="{{ $reg->event?->location ?? '' }}"
                                        data-bib="{{ $reg->bib_number ?? 'N/A' }}"
                                        data-category="{{ $reg->category }}">
                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                </button>

                                <button type="button"
                                        class="notifyBtn w-8 h-8 flex items-center justify-center rounded-lg
                                               bg-sky-50 text-sky-600 hover:bg-sky-100 active:scale-95
                                               transition flex-shrink-0"
                                        title="Send SMS"
                                        data-mode="sms"
                                        data-name="{{ $reg->first_name }} {{ $reg->last_name }}"
                                        data-phone="{{ $reg->whatsapp_number ?? $reg->phone }}"
                                        data-event="{{ $reg->event?->title ?? 'Event' }}"
                                        data-event-date="{{ $reg->event?->event_date ?? '' }}"
                                        data-event-location="{{ $reg->event?->location ?? '' }}"
                                        data-bib="{{ $reg->bib_number ?? 'N/A' }}"
                                        data-category="{{ $reg->category }}">
                                    <i class="fa-solid fa-comment-sms text-sm"></i>
                                </button>

                                <button type="button"
                                        onclick='openStatusModal(@json($reg))'
                                        class="w-8 h-8 flex items-center justify-center rounded-lg
                                               bg-purple-50 text-purple-600 hover:bg-purple-100 active:scale-95
                                               transition flex-shrink-0"
                                        title="Update Status">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </button>

                                <a href="{{ route('admin.registrations.show', $reg) }}"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg
                                          bg-blue-50 text-brandBlue hover:bg-blue-100 active:scale-95
                                          transition flex-shrink-0"
                                   title="View Details">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </a>

                                <form action="{{ route('admin.registrations.destroy', $reg) }}" method="POST"
                                      onsubmit="return confirm('Delete this registration?')"
                                      class="flex-shrink-0">
                                    @csrf @method('DELETE')
                                    <button class="w-8 h-8 flex items-center justify-center rounded-lg
                                                   bg-red-50 text-red-600 hover:bg-red-100 active:scale-95 transition"
                                            title="Delete">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-5 py-10 text-center text-slate-500">
                            <i class="fa-regular fa-folder-open text-3xl mb-2 block text-slate-300"></i>
                            <p class="text-sm font-medium">No registrations found.</p>
                            <p class="text-xs mt-1">Try clearing the filters.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ===== MOBILE / TABLET CARD LIST ===== --}}
    <div class="lg:hidden divide-y divide-slate-100">
        @forelse($registrations as $reg)
            @php
                $colors = [
                    'pending'   => 'bg-yellow-100 text-yellow-700',
                    'approved'  => 'bg-green-100 text-green-700',
                    'rejected'  => 'bg-red-100 text-red-700',
                    'cancelled' => 'bg-slate-100 text-slate-700',
                ];
                $initials = strtoupper(
                    substr($reg->first_name ?? '', 0, 1) . substr($reg->last_name ?? '', 0, 1)
                );
            @endphp

            <div class="p-4 hover:bg-slate-50 transition">

                {{-- Header row --}}
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-11 h-11 rounded-full bg-gradient-to-br from-brandPink to-purple-600
                                flex items-center justify-center text-white font-bold text-sm shadow-md flex-shrink-0">
                        {{ $initials ?: '?' }}
                    </div>

                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2">
                            <div class="min-w-0">
                                <p class="font-semibold text-slate-800 truncate text-sm">
                                    {{ $reg->first_name }} {{ $reg->last_name }}
                                </p>
                                <p class="text-xs text-slate-500 truncate">
                                    <i class="fa-solid fa-phone text-[10px]"></i> {{ $reg->phone }}
                                </p>
                            </div>

                            <div class="flex flex-col items-end gap-1 flex-shrink-0">
                                @if($reg->bib_number)
                                    <span class="text-[10px] px-2 py-0.5 rounded-md bg-green-50 text-green-700 font-bold border border-green-100">
                                        BIB {{ $reg->bib_number }}
                                    </span>
                                @endif
                                <span class="badge {{ $colors[$reg->status] ?? '' }}">
                                    {{ ucfirst($reg->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Info grid --}}
                <div class="grid grid-cols-2 gap-2 mb-3 text-xs">
                    <div class="bg-slate-50 rounded-lg p-2">
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider mb-0.5">Event</p>
                        <p class="font-semibold text-slate-700 truncate">{{ $reg->event?->title ?? '—' }}</p>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-2">
                        <p class="text-[10px] text-blue-500 uppercase tracking-wider mb-0.5">Category</p>
                        <p class="font-semibold text-brandBlue truncate">{{ $reg->category }}</p>
                    </div>
                    <div class="bg-green-50 rounded-lg p-2">
                        <p class="text-[10px] text-green-500 uppercase tracking-wider mb-0.5">Amount</p>
                        <p class="font-bold text-green-700">BDT {{ number_format($reg->amount) }}</p>
                    </div>
                    <div class="bg-purple-50 rounded-lg p-2">
                        <p class="text-[10px] text-purple-500 uppercase tracking-wider mb-0.5">Payment</p>
                        <p class="font-semibold text-purple-700 truncate">{{ $reg->payment_method }}</p>
                        <p class="text-[10px] text-purple-500 font-mono truncate">{{ $reg->trx_id ?? '—' }}</p>
                    </div>
                </div>

                {{-- WhatsApp quick link --}}
                @php $wa = $reg->whatsapp_number ?? null; @endphp
                @if($wa)
                    <a href="https://wa.me/{{ preg_replace('/[^\d]/', '', $wa) }}"
                       target="_blank"
                       class="flex items-center justify-between gap-2 px-3 py-2 mb-3 rounded-lg bg-green-50 hover:bg-green-100 transition text-xs">
                        <span class="flex items-center gap-2 text-green-700 font-semibold truncate">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                            {{ $wa }}
                        </span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-green-500 text-[10px] flex-shrink-0"></i>
                    </a>
                @endif

                {{-- Actions (inline — কোনো partial নেই) --}}
                <div class="flex items-center justify-between gap-2 pt-3 border-t border-slate-100">
                    <p class="text-[10px] text-slate-400 flex-shrink-0">
                        <i class="fa-regular fa-clock mr-1"></i>
                        {{ $reg->created_at->diffForHumans() }}
                    </p>

                    <div class="flex items-center gap-1.5">

                        <button type="button"
                                class="notifyBtn w-9 h-9 flex items-center justify-center rounded-lg
                                       bg-green-50 text-green-600 hover:bg-green-100 active:scale-95
                                       transition flex-shrink-0"
                                title="Send WhatsApp"
                                data-mode="whatsapp"
                                data-name="{{ $reg->first_name }} {{ $reg->last_name }}"
                                data-phone="{{ $reg->whatsapp_number ?? $reg->phone }}"
                                data-event="{{ $reg->event?->title ?? 'Event' }}"
                                data-event-date="{{ $reg->event?->event_date ?? '' }}"
                                data-event-location="{{ $reg->event?->location ?? '' }}"
                                data-bib="{{ $reg->bib_number ?? 'N/A' }}"
                                data-category="{{ $reg->category }}">
                            <i class="fa-brands fa-whatsapp text-sm"></i>
                        </button>

                        <button type="button"
                                class="notifyBtn w-9 h-9 flex items-center justify-center rounded-lg
                                       bg-sky-50 text-sky-600 hover:bg-sky-100 active:scale-95
                                       transition flex-shrink-0"
                                title="Send SMS"
                                data-mode="sms"
                                data-name="{{ $reg->first_name }} {{ $reg->last_name }}"
                                data-phone="{{ $reg->whatsapp_number ?? $reg->phone }}"
                                data-event="{{ $reg->event?->title ?? 'Event' }}"
                                data-event-date="{{ $reg->event?->event_date ?? '' }}"
                                data-event-location="{{ $reg->event?->location ?? '' }}"
                                data-bib="{{ $reg->bib_number ?? 'N/A' }}"
                                data-category="{{ $reg->category }}">
                            <i class="fa-solid fa-comment-sms text-sm"></i>
                        </button>

                        <button type="button"
                                onclick='openStatusModal(@json($reg))'
                                class="w-9 h-9 flex items-center justify-center rounded-lg
                                       bg-purple-50 text-purple-600 hover:bg-purple-100 active:scale-95
                                       transition flex-shrink-0"
                                title="Update Status">
                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                        </button>

                        <a href="{{ route('admin.registrations.show', $reg) }}"
                           class="w-9 h-9 flex items-center justify-center rounded-lg
                                  bg-blue-50 text-brandBlue hover:bg-blue-100 active:scale-95
                                  transition flex-shrink-0"
                           title="View Details">
                            <i class="fa-solid fa-eye text-xs"></i>
                        </a>

                        <form action="{{ route('admin.registrations.destroy', $reg) }}" method="POST"
                              onsubmit="return confirm('Delete this registration?')"
                              class="flex-shrink-0">
                            @csrf @method('DELETE')
                            <button class="w-9 h-9 flex items-center justify-center rounded-lg
                                           bg-red-50 text-red-600 hover:bg-red-100 active:scale-95 transition"
                                    title="Delete">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-10 text-center text-slate-500">
                <i class="fa-regular fa-folder-open text-4xl mb-3 block text-slate-300"></i>
                <p class="text-sm font-medium mb-1">No registrations found</p>
                <p class="text-xs">Try adjusting your filters.</p>
            </div>
        @endforelse
    </div>

    @if($registrations->hasPages())
        <div class="px-4 sm:px-5 py-3 border-t border-slate-100">
            {{ $registrations->links() }}
        </div>
    @endif
</div>

{{-- ============= STATUS MODAL ============= --}}
<div id="statusModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-50 items-center justify-center p-3 sm:p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md max-h-[95vh] overflow-y-auto animate-fade-in">

        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 flex items-center justify-between sticky top-0 bg-white z-10 rounded-t-2xl">
            <h3 class="text-base sm:text-lg font-bold glossy-text flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square text-brandPink"></i>
                Update Status
            </h3>
            <button onclick="closeStatusModal()"
                    class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition text-xl leading-none">
                &times;
            </button>
        </div>

        <form id="statusForm" method="POST" action="" class="p-5 sm:p-6 space-y-4">
            @csrf
            @method('PUT')

            <div class="bg-gradient-to-r from-pink-50 to-purple-50 rounded-lg p-3 text-sm border border-pink-100">
                <p class="font-bold text-slate-800" id="sm_runner"></p>
                <p class="text-slate-500 text-xs mt-1" id="sm_event"></p>
                <p class="text-slate-500 text-xs mt-1">
                    Amount: <span id="sm_amount" class="font-semibold text-slate-700"></span>
                </p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select name="status" id="sm_status" required
                        class="w-full px-3 py-2.5 border border-slate-200 rounded-lg text-sm font-semibold
                               text-slate-800 bg-white focus:ring-2 focus:ring-brandPink focus:border-transparent
                               focus:outline-none cursor-pointer transition">
                    <option value="" disabled>— Select Status —</option>
                    <option value="pending"   class="text-yellow-700 font-semibold">⏳ Pending</option>
                    <option value="approved"  class="text-green-700 font-semibold">✅ Approved</option>
                    <option value="rejected"  class="text-red-700 font-semibold">❌ Rejected</option>
                    <option value="cancelled" class="text-slate-700 font-semibold">🚫 Cancelled</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">
                    Admin Note <span class="text-slate-400 font-normal text-xs">(optional)</span>
                </label>
                <textarea name="admin_note" id="sm_note" rows="3"
                          placeholder="Reason for approval/rejection..."
                          class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                                 focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none
                                 transition resize-none"></textarea>
            </div>

            <div class="bg-blue-50 border border-blue-100 rounded-lg p-3 text-xs text-blue-700">
                <i class="fa-solid fa-info-circle mr-1"></i>
                <strong>Note:</strong> Approving a registration will auto-generate a BIB number and send an approval email to the runner.
            </div>

            <div class="flex flex-col-reverse sm:flex-row justify-end gap-2 sm:gap-3 pt-3 border-t border-slate-100">
                <button type="button" onclick="closeStatusModal()"
                        class="w-full sm:w-auto px-4 py-2.5 rounded-lg text-sm font-semibold
                               bg-slate-100 text-slate-700 hover:bg-slate-200 transition">
                    Cancel
                </button>
                <button type="submit"
                        class="w-full sm:w-auto px-5 py-2.5 rounded-lg text-sm font-semibold
                               bg-gradient-to-r from-brandPink to-pink-600 hover:from-pink-600 hover:to-brandPink
                               text-white transition shadow-md hover:shadow-lg">
                    <i class="fa-solid fa-check mr-1"></i> Update Status
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ============= NOTIFY MODAL ============= --}}
<div id="notifyModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden z-[60] items-center justify-center p-3 sm:p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[95vh] overflow-y-auto animate-fade-in">

        <div class="px-5 sm:px-6 py-4 border-b border-slate-100 flex items-center justify-between sticky top-0 bg-white z-10 rounded-t-2xl">
            <h3 class="text-base sm:text-lg font-bold flex items-center gap-2 min-w-0">
                <i id="notifyIcon" class="fa-brands fa-whatsapp text-2xl text-green-500 flex-shrink-0"></i>
                <span id="notifyTitleText" class="glossy-text truncate">Send WhatsApp Message</span>
            </h3>
            <button onclick="closeNotifyModal()"
                    class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition text-xl leading-none flex-shrink-0">
                &times;
            </button>
        </div>

        <div class="p-5 sm:p-6 space-y-4">

            <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-lg p-3 text-sm border border-green-100">
                <p class="text-slate-500 text-xs uppercase tracking-wider mb-1">Send to:</p>
                <p class="font-bold text-slate-800" id="notifyToName"></p>
                <p class="text-xs text-slate-500 flex items-center gap-1">
                    <i class="fa-solid fa-phone"></i>
                    <span id="notifyToPhone"></span>
                </p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Message Preview <span class="text-xs text-slate-400 font-normal">(editable)</span>
                </label>
                <textarea id="notifyMessage" rows="12"
                          class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs font-mono
                                 leading-relaxed focus:ring-2 focus:ring-brandPink focus:border-transparent
                                 focus:outline-none resize-y"></textarea>
                <p class="text-[10px] text-slate-400 mt-1">
                    <i class="fa-solid fa-lightbulb"></i>
                    You can edit the message before sending
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-2 pt-2">
                <button type="button" id="notifyCopyBtn"
                        class="flex-1 px-4 py-2.5 rounded-lg text-sm font-semibold
                               bg-slate-100 text-slate-700 hover:bg-slate-800 hover:text-white transition">
                    <i class="fa-solid fa-copy mr-1"></i> Copy Text
                </button>
                <a href="#" id="notifySendBtn" target="_blank"
                   class="flex-1 px-4 py-2.5 rounded-lg text-sm font-semibold text-center
                          bg-green-500 text-white hover:bg-green-600 transition shadow-md hover:shadow-lg">
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
    function openStatusModal(reg) {
        document.getElementById('sm_runner').textContent = reg.first_name + ' ' + reg.last_name;
        document.getElementById('sm_event').textContent  = reg.event ? reg.event.title : '—';
        document.getElementById('sm_amount').textContent = 'BDT ' + Number(reg.amount).toLocaleString();
        document.getElementById('sm_note').value         = reg.admin_note ?? '';

        document.getElementById('statusForm').action =
            "{{ url('admin/registrations') }}/" + reg.id + "/status";

        document.getElementById('sm_status').value = reg.status ?? '';

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
            ? new Date(d.date).toLocaleDateString('en-GB', {
                day: 'numeric', month: 'long', year: 'numeric'
              })
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
                notifyIcon.className    = 'fa-solid fa-comment-sms text-2xl text-sky-500 flex-shrink-0';
                notifyMsg.value         = buildSmsMessage(d);
                notifySend.className    = 'flex-1 px-4 py-2.5 rounded-lg text-sm font-semibold text-center bg-sky-500 text-white hover:bg-sky-600 transition shadow-md';
                notifySend.innerHTML    = '<i class="fa-solid fa-comment-sms mr-1"></i> Send SMS';
            } else {
                notifyTitle.textContent = 'Send WhatsApp Confirmation';
                notifyIcon.className    = 'fa-brands fa-whatsapp text-2xl text-green-500 flex-shrink-0';
                notifyMsg.value         = buildWaMessage(d);
                notifySend.className    = 'flex-1 px-4 py-2.5 rounded-lg text-sm font-semibold text-center bg-green-500 text-white hover:bg-green-600 transition shadow-md';
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
    document.getElementById('statusModal').addEventListener('click', (e) => {
        if (e.target === document.getElementById('statusModal')) closeStatusModal();
    });

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