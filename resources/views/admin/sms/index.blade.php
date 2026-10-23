@extends('admin.layouts.app')

@section('title', 'SMS Broadcast - Admin')
@section('page-title', 'SMS Broadcast')
@section('page-subtitle', 'Send bulk SMS to registered runners with filters')

@section('body')

{{-- ============ TOP NAV TABS ============ --}}
<div class="flex gap-2 mb-5">
    <a href="{{ route('admin.sms.index') }}"
       class="px-4 py-2 rounded-lg text-sm font-semibold bg-gradient-to-r from-brandPink to-pink-600 text-white shadow-md">
        <i class="fa-solid fa-paper-plane mr-1"></i> Broadcast
    </a>
    <a href="{{ route('admin.sms.logs') }}"
       class="px-4 py-2 rounded-lg text-sm font-semibold bg-white text-slate-700 hover:bg-slate-100 transition shadow-sm">
        <i class="fa-solid fa-list-check mr-1"></i> SMS Logs
    </a>
</div>

{{-- ============ FILTERS ============ --}}
<form method="GET" class="bg-white rounded-xl shadow-sm p-4 mb-5 card-glossy">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">

        <div class="lg:col-span-2">
            <label class="block text-xs font-semibold text-slate-600 mb-1">
                <i class="fa-solid fa-search mr-1 text-brandPink"></i> Search
            </label>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Name, phone, whatsapp..."
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
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
                <i class="fa-solid fa-hashtag mr-1 text-brandPink"></i> Registration ID
            </label>
            <input type="text" name="id" value="{{ request('id') }}"
                   placeholder="e.g. 1023"
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">
                <i class="fa-solid fa-tag mr-1 text-brandPink"></i> BIB Number
            </label>
            <input type="text" name="bib" value="{{ request('bib') }}"
                   placeholder="e.g. B001"
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">
                <i class="fa-solid fa-medal mr-1 text-brandPink"></i> Category
            </label>
            <select name="category"
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                           focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" @selected(request('category') === $cat)>{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">
                <i class="fa-solid fa-wallet mr-1 text-brandPink"></i> Payment
            </label>
            <select name="payment_method"
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                           focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
                <option value="">All</option>
                @foreach(['bKash','Card','Cash','Nagad'] as $pm)
                    <option value="{{ $pm }}" @selected(request('payment_method') === $pm)>{{ $pm }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">
                <i class="fa-solid fa-check-circle mr-1 text-brandPink"></i> Attended
            </label>
            <select name="attended"
                    class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                           focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
                <option value="">All</option>
                <option value="1" @selected(request('attended') === '1')>Yes</option>
                <option value="0" @selected(request('attended') === '0')>No</option>
            </select>
        </div>

        <div class="sm:col-span-2 lg:col-span-4 flex flex-col sm:flex-row gap-2 pt-1">
            <button class="flex-1 sm:flex-none px-5 py-2.5 bg-gradient-to-r from-brandPink to-pink-600
                           hover:from-pink-600 hover:to-brandPink text-white rounded-lg text-sm font-semibold
                           transition shadow-md hover:shadow-lg">
                <i class="fa-solid fa-filter mr-1"></i> Apply Filters
            </button>
            <a href="{{ route('admin.sms.index') }}"
               class="flex-1 sm:flex-none px-5 py-2.5 bg-slate-100 text-slate-700 rounded-lg text-sm font-semibold
                      hover:bg-slate-200 transition text-center">
                <i class="fa-solid fa-rotate-left mr-1"></i> Reset
            </a>
        </div>
    </div>
</form>

{{-- ============ BROADCAST LAYOUT ============ --}}
<form id="broadcastForm" method="POST" action="{{ route('admin.sms.send') }}">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">

        {{-- LEFT: Recipient list --}}
        <div class="lg:col-span-3 bg-white rounded-xl shadow-sm overflow-hidden card-glossy flex flex-col"
             style="max-height: 78vh;">

            {{-- Selection toolbar --}}
            <div class="px-4 py-3 bg-slate-50 border-b border-slate-200 flex items-center justify-between gap-2 flex-shrink-0">
                <div class="flex items-center gap-3">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" id="selectAll"
                               class="w-4 h-4 accent-brandPink cursor-pointer">
                        <span class="text-sm font-semibold text-slate-700">Select All</span>
                    </label>
                    <span id="selectedCount"
                          class="text-xs px-2 py-1 rounded-md bg-brandPink/10 text-brandPink font-bold">
                        0 selected
                    </span>
                </div>
                <span class="text-xs text-slate-500">
                    {{ $registrations->total() }} total
                </span>
            </div>

            {{-- Scrollable list --}}
            <div class="overflow-y-auto flex-1">
                @forelse($registrations as $reg)
                    @php
                        $phone = $reg->whatsapp_number ?: $reg->phone;
                        $statusColors = [
                            'pending'   => 'bg-yellow-100 text-yellow-700',
                            'approved'  => 'bg-green-100 text-green-700',
                            'rejected'  => 'bg-red-100 text-red-700',
                            'cancelled' => 'bg-slate-100 text-slate-700',
                        ];
                    @endphp
                    <label class="flex items-start gap-3 px-4 py-3 border-b border-slate-100 hover:bg-slate-50 cursor-pointer transition">
                        <input type="checkbox" name="registration_ids[]" value="{{ $reg->id }}"
                               class="recipientCheckbox w-4 h-4 mt-1 accent-brandPink cursor-pointer flex-shrink-0">

                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2 mb-1">
                                <p class="font-semibold text-sm text-slate-800 truncate">
                                    {{ $reg->first_name }} {{ $reg->last_name }}
                                    <span class="text-xs text-slate-400 font-normal">#{{ $reg->id }}</span>
                                </p>
                                <span class="badge {{ $statusColors[$reg->status] ?? '' }} flex-shrink-0">
                                    {{ ucfirst($reg->status) }}
                                </span>
                            </div>

                            <div class="flex items-center gap-3 text-xs text-slate-500 flex-wrap">
                                <span><i class="fa-solid fa-phone text-[10px]"></i> {{ $phone ?: 'N/A' }}</span>
                                @if($reg->bib_number)
                                    <span class="px-1.5 py-0.5 rounded bg-green-50 text-green-700 font-bold border border-green-100">
                                        BIB {{ $reg->bib_number }}
                                    </span>
                                @endif
                                <span class="px-1.5 py-0.5 rounded bg-blue-50 text-brandBlue font-semibold">
                                    {{ $reg->category }}
                                </span>
                                <span class="truncate max-w-[140px]">
                                    <i class="fa-regular fa-calendar-check text-[10px]"></i>
                                    {{ $reg->event?->title ?? '—' }}
                                </span>
                            </div>
                        </div>
                    </label>
                @empty
                    <div class="p-10 text-center text-slate-500">
                        <i class="fa-regular fa-folder-open text-4xl mb-3 block text-slate-300"></i>
                        <p class="text-sm font-medium">No recipients found</p>
                        <p class="text-xs mt-1">Try adjusting your filters.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($registrations->hasPages())
                <div class="px-4 py-2 border-t border-slate-100 flex-shrink-0">
                    {{ $registrations->links() }}
                </div>
            @endif
        </div>

        {{-- RIGHT: Message composer --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm card-glossy overflow-hidden flex flex-col"
             style="max-height: 78vh;">
            <div class="px-5 py-3 border-b border-slate-100 bg-slate-50 flex-shrink-0">
                <h3 class="text-sm font-bold glossy-text flex items-center gap-2">
                    <i class="fa-solid fa-comment-dots text-brandPink"></i> Message Composer
                </h3>
            </div>

            <div class="p-5 flex flex-col flex-1 overflow-y-auto">

                {{-- Quick templates --}}
                <div class="mb-3">
                    <label class="block text-xs font-semibold text-slate-600 mb-1">
                        <i class="fa-solid fa-bolt text-brandPink"></i> Quick Templates
                    </label>
                    <div class="flex flex-wrap gap-1.5">
                        <button type="button" class="templateBtn px-2.5 py-1 rounded-md bg-slate-100 hover:bg-slate-200 text-xs font-medium transition"
                            data-text="Dear {name}, your registration for {event} is APPROVED. BIB: {bib}. Category: {category}. Collect your kit before race day. - Run BURJOWAN">
                            ✅ Approved
                        </button>
                        <button type="button" class="templateBtn px-2.5 py-1 rounded-md bg-slate-100 hover:bg-slate-200 text-xs font-medium transition"
                            data-text="Dear {name}, race day reminder! Event: {event}. Report 30 min before start. Carry photo ID. BIB: {bib}. - Run BURJOWAN">
                            ⏰ Reminder
                        </button>
                        <button type="button" class="templateBtn px-2.5 py-1 rounded-md bg-slate-100 hover:bg-slate-200 text-xs font-medium transition"
                            data-text="Dear {name}, thank you for participating in {event}! Results will be published soon. - Run BURJOWAN">
                            🙏 Thanks
                        </button>
                        <button type="button" class="templateBtn px-2.5 py-1 rounded-md bg-slate-100 hover:bg-slate-200 text-xs font-medium transition"
                            data-text="Dear {name}, your BIB {bib} for {event} is ready. Collect your race kit before race day. - Run BURJOWAN">
                            🎽 BIB Ready
                        </button>
                    </div>
                </div>

                {{-- Message textarea --}}
                <label class="block text-xs font-semibold text-slate-600 mb-1">
                    <i class="fa-solid fa-pen text-brandPink"></i> Message
                </label>
                <textarea name="message" id="messageBox" rows="10" required
                          maxlength="1000"
                          placeholder="Type your SMS message here..."
                          class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                                 focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none
                                 transition resize-none font-mono leading-relaxed"></textarea>

                {{-- Character counter --}}
                <div class="flex items-center justify-between mt-1.5 mb-3">
                    <p class="text-[10px] text-slate-400">
                        <i class="fa-solid fa-info-circle"></i>
                        Placeholders: <code class="bg-slate-100 px-1 rounded">{name}</code>
                        <code class="bg-slate-100 px-1 rounded">{event}</code>
                        <code class="bg-slate-100 px-1 rounded">{bib}</code>
                        <code class="bg-slate-100 px-1 rounded">{category}</code>
                    </p>
                    <p id="charCount" class="text-xs font-mono font-bold text-slate-500">
                        0 / 1000
                    </p>
                </div>

                {{-- Send info --}}
                <div class="bg-blue-50 border border-blue-100 rounded-lg p-3 text-xs text-blue-700 mb-3">
                    <i class="fa-solid fa-info-circle mr-1"></i>
                    This will send to <strong id="sendTargetCount">0</strong> selected recipients.
                    Placeholders will be replaced per-recipient.
                </div>

                {{-- Submit --}}
                <button type="submit" id="sendBtn"
                        class="w-full px-5 py-3 rounded-lg text-sm font-semibold
                               bg-gradient-to-r from-brandPink to-pink-600 hover:from-pink-600 hover:to-brandPink
                               text-white transition shadow-md hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>
                    <i class="fa-solid fa-paper-plane mr-1"></i> Send SMS
                </button>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectAll  = document.getElementById('selectAll');
    const checkboxes = () => Array.from(document.querySelectorAll('.recipientCheckbox'));
    const countEl    = document.getElementById('selectedCount');
    const targetEl   = document.getElementById('sendTargetCount');
    const sendBtn    = document.getElementById('sendBtn');
    const messageBox = document.getElementById('messageBox');
    const charCount  = document.getElementById('charCount');

    // --- Selection count ---
    function updateSelection() {
        const all = checkboxes();
        const sel = all.filter(c => c.checked);
        const n   = sel.length;

        countEl.textContent      = n + ' selected';
        targetEl.textContent     = n;
        sendBtn.disabled         = n === 0;
        selectAll.checked        = all.length > 0 && n === all.length;
        selectAll.indeterminate  = n > 0 && n < all.length;
    }

    selectAll.addEventListener('change', function () {
        checkboxes().forEach(c => c.checked = this.checked);
        updateSelection();
    });

    document.querySelectorAll('.recipientCheckbox').forEach(c => {
        c.addEventListener('change', updateSelection);
    });

    // --- Character counter ---
    function updateCount() {
        const n = messageBox.value.length;
        charCount.textContent = n + ' / 1000';
        charCount.className = 'text-xs font-mono font-bold ' +
            (n > 900 ? 'text-red-500' : n > 700 ? 'text-yellow-600' : 'text-slate-500');
    }
    messageBox.addEventListener('input', updateCount);
    updateCount();

    // --- Quick templates ---
    document.querySelectorAll('.templateBtn').forEach(btn => {
        btn.addEventListener('click', function () {
            messageBox.value = this.dataset.text || '';
            updateCount();
            messageBox.focus();
        });
    });

    // --- Submit confirmation ---
    document.getElementById('broadcastForm').addEventListener('submit', function (e) {
        const n = checkboxes().filter(c => c.checked).length;
        if (n === 0) {
            e.preventDefault();
            alert('Please select at least one recipient.');
            return;
        }
        if (!confirm(`Send this SMS to ${n} recipient(s)?`)) {
            e.preventDefault();
        }
    });

    updateSelection();
});
</script>
@endpush

@endsection
