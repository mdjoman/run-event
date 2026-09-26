@extends('admin.layouts.app')

@section('title', 'Registrations - Admin')
@section('page-title', 'Registrations')
@section('page-subtitle', 'Manage runner registrations and payment statuses')

@section('body')

{{-- ============ FILTERS ============ --}}
<form method="GET" class="bg-white rounded-xl shadow-sm p-4 mb-5 flex flex-wrap items-end gap-3">
    <div class="flex-1 min-w-[180px]">
        <label class="block text-xs font-semibold text-slate-600 mb-1">Search</label>
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Name, phone, trx id..."
               class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
    </div>

    <div class="min-w-[160px]">
        <label class="block text-xs font-semibold text-slate-600 mb-1">Status</label>
        <select name="status" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
            <option value="">All</option>
            @foreach(['pending','approved','rejected','cancelled'] as $s)
                <option value="{{ $s }}" @selected(request('status') === $s)>{{ ucfirst($s) }}</option>
            @endforeach
        </select>
    </div>

    <div class="min-w-[200px]">
        <label class="block text-xs font-semibold text-slate-600 mb-1">Event</label>
        <select name="event_id" class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
            <option value="">All Events</option>
            @foreach($events as $e)
                <option value="{{ $e->id }}" @selected(request('event_id') == $e->id)>{{ $e->title }}</option>
            @endforeach
        </select>
    </div>

    <button class="px-4 py-2 bg-brandPink text-white rounded-lg text-sm font-semibold hover:bg-pink-700">
        <i class="fa-solid fa-filter"></i> Filter
    </button>

    <a href="{{ route('admin.registrations.index') }}"
       class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg text-sm font-semibold hover:bg-slate-200">
        Reset
    </a>
</form>

{{-- ============ TABLE ============ --}}
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
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
                        {{-- BIB --}}
                        <td class="px-5 py-3">
                            @if($reg->bib_number)
                                <span class="inline-block px-2 py-1 rounded-md bg-green-50 text-green-700 text-xs font-bold">
                                    {{ $reg->bib_number }}
                                </span>
                            @else
                                <span class="text-slate-400 text-xs">—</span>
                            @endif
                        </td>

                        {{-- RUNNER --}}
                        <td class="px-5 py-3">
                            <div class="font-semibold text-slate-800">{{ $reg->first_name }} {{ $reg->last_name }}</div>
                            <div class="text-xs text-slate-500">
                                <i class="fa-solid fa-phone text-[10px]"></i> {{ $reg->phone }}
                            </div>
                        </td>

                        {{-- WHATSAPP NUMBER --}}
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

                        {{-- EVENT --}}
                        <td class="px-5 py-3 text-slate-700">{{ $reg->event?->title ?? '—' }}</td>

                        {{-- CATEGORY --}}
                        <td class="px-5 py-3">
                            <span class="badge bg-blue-50 text-brandBlue">{{ $reg->category }}</span>
                        </td>

                        {{-- AMOUNT --}}
                        <td class="px-5 py-3 font-semibold text-slate-800">BDT {{ number_format($reg->amount) }}</td>

                        {{-- PAYMENT --}}
                        <td class="px-5 py-3">
                            <div class="text-xs text-slate-600">{{ $reg->payment_method }}</div>
                            <div class="text-[10px] text-slate-400">{{ $reg->trx_id ?? '—' }}</div>
                        </td>

                        {{-- STATUS --}}
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

                        {{-- ACTIONS --}}
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-2">

                                {{-- WhatsApp Send --}}
                                <button type="button"
                                        class="notifyBtn w-8 h-8 flex items-center justify-center rounded-lg bg-green-50 text-green-600 hover:bg-green-100 transition"
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

                                {{-- SMS Send --}}
                                <button type="button"
                                        class="notifyBtn w-8 h-8 flex items-center justify-center rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-100 transition"
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

                                {{-- Update Status --}}
                                <button onclick='openStatusModal(@json($reg))'
                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-purple-50 text-purple-600 hover:bg-purple-100 transition"
                                        title="Update Status">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </button>

                                {{-- View --}}
                                <a href="{{ route('admin.registrations.show', $reg) }}"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-brandBlue hover:bg-blue-100 transition"
                                   title="View">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.registrations.destroy', $reg) }}" method="POST"
                                      onsubmit="return confirm('Delete this registration?')">
                                    @csrf @method('DELETE')
                                    <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100"
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
                            <i class="fa-regular fa-folder-open text-3xl mb-2 block"></i>
                            No registrations found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-5 py-3 border-t border-slate-100">
        {{ $registrations->links() }}
    </div>
</div>

{{-- ============= STATUS UPDATE MODAL ============= --}}
<div id="statusModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-800">Update Registration Status</h3>
            <button onclick="closeStatusModal()" class="text-slate-400 hover:text-slate-700 text-2xl leading-none">&times;</button>
        </div>

        <form id="statusForm" method="POST" action="" class="p-6 space-y-4">
            @csrf
            @method('PUT')

            <div class="bg-slate-50 rounded-lg p-3 text-sm">
                <p class="font-semibold text-slate-800" id="sm_runner"></p>
                <p class="text-slate-500 text-xs mt-1" id="sm_event"></p>
                <p class="text-slate-500 text-xs">Amount: <span id="sm_amount" class="font-semibold text-slate-700"></span></p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                <select name="status" id="sm_status" required
                        class="w-full px-3 py-2.5 border border-slate-200 rounded-lg text-sm font-semibold
                            text-slate-800 bg-white focus:ring-2 focus:ring-brandPink focus:outline-none
                            cursor-pointer transition">
                    <option value="" disabled>— Select Status —</option>
                    <option value="pending"   class="text-yellow-700 font-semibold">⏳ Pending</option>
                    <option value="approved"  class="text-green-700 font-semibold">✅ Approved</option>
                    <option value="rejected"  class="text-red-700 font-semibold">❌ Rejected</option>
                    <option value="cancelled" class="text-slate-700 font-semibold">🚫 Cancelled</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Admin Note (optional)</label>
                <textarea name="admin_note" id="sm_note" rows="2"
                          placeholder="Reason for approval/rejection..."
                          class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeStatusModal()"
                        class="px-4 py-2 rounded-lg text-sm font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200">
                    Cancel
                </button>
                <button type="submit"
                        class="px-5 py-2 rounded-lg text-sm font-semibold bg-brandPink text-white hover:bg-pink-700">
                    <i class="fa-solid fa-check mr-1"></i> Update Status
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ============= NOTIFY MODAL (WHATSAPP / SMS) ============= --}}
<div id="notifyModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden z-[60] items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[92vh] overflow-y-auto">

        {{-- Header --}}
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-800 flex items-center gap-2">
                <i id="notifyIcon" class="fa-brands fa-whatsapp text-2xl text-green-500"></i>
                <span id="notifyTitleText">Send WhatsApp Message</span>
            </h3>
            <button onclick="closeNotifyModal()" class="text-slate-400 hover:text-slate-700 text-2xl leading-none">&times;</button>
        </div>

        <div class="p-6 space-y-4">
            {{-- To info --}}
            <div class="bg-slate-50 rounded-lg p-3 text-sm">
                <p class="text-slate-500 text-xs">Send to:</p>
                <p class="font-bold text-slate-800" id="notifyToName"></p>
                <p class="text-xs text-slate-500" id="notifyToPhone"></p>
            </div>

            {{-- Message --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Message Preview <span class="text-xs text-slate-400 font-normal">(editable)</span>
                </label>
                <textarea id="notifyMessage" rows="12"
                          class="w-full px-3 py-2 border border-slate-200 rounded-lg text-xs font-mono leading-relaxed
                                 focus:ring-2 focus:ring-brandPink focus:outline-none resize-y"></textarea>
            </div>

            {{-- Buttons --}}
            <div class="flex gap-3 pt-2">
                <button type="button" id="notifyCopyBtn"
                        class="flex-1 px-4 py-2.5 rounded-lg text-sm font-semibold
                               bg-slate-100 text-slate-700 hover:bg-slate-800 hover:text-white transition">
                    <i class="fa-solid fa-copy mr-1"></i> Copy Text
                </button>
                <a href="#" id="notifySendBtn" target="_blank"
                   class="flex-1 px-4 py-2.5 rounded-lg text-sm font-semibold text-center
                          bg-green-500 text-white hover:bg-green-600 transition">
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
        document.getElementById('sm_amount').textContent = 'BDT ' + reg.amount;
        document.getElementById('sm_note').value         = reg.admin_note ?? '';

        document.getElementById('statusForm').action = "{{ url('admin/registrations') }}/" + reg.id + "/status";

        const statusSelect = document.getElementById('sm_status');
        statusSelect.value = reg.status ?? '';

        const modal = document.getElementById('statusModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeStatusModal() {
        const modal = document.getElementById('statusModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // ================= NOTIFY MODAL (WhatsApp / SMS) =================
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

    // Professional WhatsApp message
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
* Bring a valid photo ID / Mobile phone carrying this messege.
* Keep your BIB Number safe — it is required on race day.
* Report to the venue at least 30 minutes before start time.

For any queries, feel free to contact us.

We look forward to seeing you at the starting line !

Warm regards,
Run BURJOWAN Team
"More Than a Race, It's a Movement."

Contact (WhatsApp):
+880 19 1146 9861
+880 17 1154 3414"`;
    }

    // Short SMS message
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
                notifyIcon.className    = 'fa-solid fa-comment-sms text-2xl text-sky-500';
                notifyMsg.value         = buildSmsMessage(d);
                notifySend.className    = 'flex-1 px-4 py-2.5 rounded-lg text-sm font-semibold text-center bg-sky-500 text-white hover:bg-sky-600 transition';
                notifySend.innerHTML    = '<i class="fa-solid fa-comment-sms mr-1"></i> Send SMS';
            } else {
                notifyTitle.textContent = 'Send WhatsApp Confirmation';
                notifyIcon.className    = 'fa-brands fa-whatsapp text-2xl text-green-500';
                notifyMsg.value         = buildWaMessage(d);
                notifySend.className    = 'flex-1 px-4 py-2.5 rounded-lg text-sm font-semibold text-center bg-green-500 text-white hover:bg-green-600 transition';
                notifySend.innerHTML    = '<i class="fa-brands fa-whatsapp mr-1"></i> Send';
            }

            notifyToName.textContent = d.name;
            notifyToPh.textContent   = d.phone;

            updateNotifyLink(cleanPhone);

            notifyModal.classList.remove('hidden');
            notifyModal.classList.add('flex');
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
    }

    notifyModal.addEventListener('click', (e) => {
        if (e.target === notifyModal) closeNotifyModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeNotifyModal();
            closeStatusModal();
        }
    });

    // ================= COPY BUTTON =================
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