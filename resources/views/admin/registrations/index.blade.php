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
                    <th class="px-5 py-3 text-left font-semibold">#</th>
                    <th class="px-5 py-3 text-left font-semibold">Runner</th>
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
                        <td class="px-5 py-3 text-slate-500 font-medium">#{{ $reg->id }}</td>
                        <td class="px-5 py-3">
                            <div class="font-semibold text-slate-800">{{ $reg->full_name }}</div>
                            <div class="text-xs text-slate-500">{{ $reg->phone }}</div>
                        </td>
                        <td class="px-5 py-3 text-slate-700">{{ $reg->event?->title ?? '—' }}</td>
                        <td class="px-5 py-3">
                            <span class="badge bg-blue-50 text-brandBlue">{{ $reg->category }}</span>
                        </td>
                        <td class="px-5 py-3 font-semibold text-slate-800">BDT {{ number_format($reg->amount) }}</td>
                        <td class="px-5 py-3">
                            <div class="text-xs text-slate-600">{{ $reg->payment_method }}</div>
                            <div class="text-[10px] text-slate-400">{{ $reg->trx_id ?? '—' }}</div>
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
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick='openStatusModal(@json($reg))'
                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-purple-50 text-purple-600 hover:bg-purple-100 transition"
                                        title="Update Status">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </button>
                                <a href="{{ route('admin.registrations.show', $reg) }}"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-brandBlue hover:bg-blue-100 transition"
                                   title="View">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </a>
                                <form action="{{ route('admin.registrations.destroy', $reg) }}" method="POST"
                                      onsubmit="return confirm('Delete this registration?')">
                                    @csrf @method('DELETE')
                                    <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100 "
                                            title="Delete">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-5 py-10 text-center text-slate-500">
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
               <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                    <select name="status" id="sm_status" required
                            class="w-full px-3 py-2.5 border border-slate-200 rounded-lg text-sm font-semibold
                                text-slate-800 bg-white focus:ring-2 focus:ring-brandPink focus:outline-none
                                cursor-pointer transition">
                        <option value="" disabled>— Select Status —</option>

                        <option value="pending"
                                class="text-yellow-700 font-semibold">
                            ⏳ Pending
                        </option>

                        <option value="approved"
                                class="text-green-700 font-semibold">
                            ✅ Approved
                        </option>

                        <option value="rejected"
                                class="text-red-700 font-semibold">
                            ❌ Rejected
                        </option>

                        <option value="cancelled"
                                class="text-slate-700 font-semibold">
                            🚫 Cancelled
                        </option>
                    </select>
                </div>
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

@push('scripts')
<script>
    function openStatusModal(reg) {
        document.getElementById('sm_runner').textContent = reg.first_name + ' ' + reg.last_name;
        document.getElementById('sm_event').textContent  = reg.event ? reg.event.title : '—';
        document.getElementById('sm_amount').textContent = 'BDT ' + reg.amount;
        document.getElementById('sm_note').value         = reg.admin_note ?? '';

        // Set form action
        document.getElementById('statusForm').action = "{{ url('admin/registrations') }}/" + reg.id + "/status";

        // Check the current status radio
        document.querySelectorAll('#statusForm input[name="status"]').forEach(r => {
            r.checked = (r.value === reg.status);
        });

        const modal = document.getElementById('statusModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeStatusModal() {
        const modal = document.getElementById('statusModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endpush

@endsection