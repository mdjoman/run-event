@extends('admin.layouts.app')

@section('title', 'Events - Admin')
@section('page-title', 'Manage Events')
@section('page-subtitle', 'Create, edit, and manage your running events')

@section('body')

<div class="flex items-center justify-between mb-5">
    <form method="GET" class="flex items-center gap-3">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Search events..."
               class="px-4 py-2 border border-slate-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brandPink w-64">
        <button class="px-4 py-2 bg-slate-800 text-white rounded-lg text-sm hover:bg-slate-700">
            <i class="fa-solid fa-search"></i>
        </button>
    </form>

    <button onclick="openEventModal()"
            class="bg-brandPink hover:bg-pink-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold flex items-center gap-2 transition">
        <i class="fa-solid fa-plus"></i> Add New Event
    </button>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600 uppercase text-xs">
                <tr>
                    <th class="px-5 py-3 text-left font-semibold">Event</th>
                    <th class="px-5 py-3 text-left font-semibold">Date & Time</th>
                    <th class="px-5 py-3 text-left font-semibold">Location</th>
                    <th class="px-5 py-3 text-left font-semibold">Slots</th>
                    <th class="px-5 py-3 text-left font-semibold">Fee</th>
                    <th class="px-5 py-3 text-left font-semibold">Status</th>
                    <th class="px-5 py-3 text-right font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($events as $event)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-brandPink to-brandPurple flex items-center justify-center text-white font-bold">
                                    <i class="fa-solid fa-person-running"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-800">{{ $event->title }}</p>
                                    <p class="text-xs text-slate-500">{{ $event->category }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-slate-700">
                            <div class="font-medium">{{ $event->event_date->format('d M Y') }}</div>
                            <div class="text-xs text-slate-500">{{ $event->start_time }}</div>
                        </td>
                        <td class="px-5 py-4 text-slate-600">
                            <i class="fa-solid fa-location-dot text-brandPink"></i> {{ $event->location }}
                        </td>
                        <td class="px-5 py-4">
                            <span class="font-semibold text-slate-800">{{ $event->registered }}</span>
                            <span class="text-slate-400"> / {{ $event->slots }}</span>
                        </td>
                        <td class="px-5 py-4 font-semibold text-slate-800">BDT {{ number_format($event->fee) }}</td>
                        <td class="px-5 py-4">
                            @php
                                $colors = [
                                    'active'    => 'bg-green-100 text-green-700',
                                    'draft'     => 'bg-slate-100 text-slate-700',
                                    'completed' => 'bg-blue-100 text-blue-700',
                                    'cancelled' => 'bg-red-100 text-red-700',
                                ];
                            @endphp
                            <span class="badge {{ $colors[$event->status] ?? 'bg-slate-100 text-slate-700' }}">
                                {{ ucfirst($event->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick='openViewModal(@json($event))'
                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-brandBlue hover:bg-blue-100 transition"
                                        title="View">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </button>
                                <button onclick='openEventModal(@json($event))'
                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition"
                                        title="Edit">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </button>
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST"
                                      onsubmit="return confirm('Delete this event?')">
                                    @csrf @method('DELETE')
                                    <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition"
                                            title="Delete">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-5 py-10 text-center text-slate-500">
                            <i class="fa-regular fa-folder-open text-3xl mb-2 block"></i>
                            No events found. Click "Add New Event" to create one.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-5 py-3 border-t border-slate-100">
        {{ $events->links() }}
    </div>
</div>

{{-- ============= EVENT MODAL (Create / Edit) ============= --}}
<div id="eventModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between sticky top-0 bg-white z-10">
            <h3 id="eventModalTitle" class="text-lg font-bold text-slate-800">Add New Event</h3>
            <button onclick="closeEventModal()" class="text-slate-400 hover:text-slate-700 text-2xl leading-none">&times;</button>
        </div>

        <form id="eventForm" method="POST" action="{{ route('admin.events.store') }}" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="_method" id="eventMethod" value="POST">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Event Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="ev_title" required
                           class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Location <span class="text-red-500">*</span></label>
                    <input type="text" name="location" id="ev_location" required
                           class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Category <span class="text-red-500">*</span></label>
                    <input type="text" name="category" id="ev_category" placeholder="5K / 10K / 21K" required
                           class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Event Date <span class="text-red-500">*</span></label>
                    <input type="date" name="event_date" id="ev_date" required
                           class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Start Time <span class="text-red-500">*</span></label>
                    <input type="time" name="start_time" id="ev_time" required
                           class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Fee (BDT) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="fee" id="ev_fee" required
                           class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Total Slots <span class="text-red-500">*</span></label>
                    <input type="number" name="slots" id="ev_slots" required
                           class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status" id="ev_status" required
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
                        <option value="draft">Draft</option>
                        <option value="active">Active</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Image Path (optional)</label>
                    <input type="text" name="image" id="ev_image" placeholder="img/ur1.jpeg"
                           class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Description</label>
                    <textarea name="description" id="ev_desc" rows="3"
                              class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none"></textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeEventModal()"
                        class="px-4 py-2 rounded-lg text-sm font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200">
                    Cancel
                </button>
                <button type="submit"
                        class="px-5 py-2 rounded-lg text-sm font-semibold bg-brandPink text-white hover:bg-pink-700">
                    <i class="fa-solid fa-check mr-1"></i> Save Event
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ============= EVENT VIEW MODAL ============= --}}
<div id="viewModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-800">Event Details</h3>
            <button onclick="closeViewModal()" class="text-slate-400 hover:text-slate-700 text-2xl leading-none">&times;</button>
        </div>
        <div class="p-6 space-y-3 text-sm">
            <div><span class="font-semibold text-slate-600">Title:</span> <span id="v_title" class="text-slate-800"></span></div>
            <div><span class="font-semibold text-slate-600">Location:</span> <span id="v_location" class="text-slate-800"></span></div>
            <div><span class="font-semibold text-slate-600">Date:</span> <span id="v_date" class="text-slate-800"></span></div>
            <div><span class="font-semibold text-slate-600">Time:</span> <span id="v_time" class="text-slate-800"></span></div>
            <div><span class="font-semibold text-slate-600">Category:</span> <span id="v_category" class="text-slate-800"></span></div>
            <div><span class="font-semibold text-slate-600">Fee:</span> <span id="v_fee" class="text-slate-800"></span></div>
            <div><span class="font-semibold text-slate-600">Slots:</span> <span id="v_slots" class="text-slate-800"></span></div>
            <div><span class="font-semibold text-slate-600">Registered:</span> <span id="v_registered" class="text-slate-800"></span></div>
            <div><span class="font-semibold text-slate-600">Status:</span> <span id="v_status" class="text-slate-800"></span></div>
            <div><span class="font-semibold text-slate-600">Description:</span> <p id="v_desc" class="text-slate-600 mt-1"></p></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openEventModal(event = null) {
        const modal = document.getElementById('eventModal');
        const form = document.getElementById('eventForm');
        const title = document.getElementById('eventModalTitle');
        const method = document.getElementById('eventMethod');
        const base = "{{ route('admin.events.store') }}";

        if (event) {
            title.textContent = 'Edit Event';
            form.action = "{{ url('admin/events') }}/" + event.id;
            method.value = 'PUT';

            document.getElementById('ev_title').value     = event.title;
            document.getElementById('ev_location').value  = event.location;
            document.getElementById('ev_category').value  = event.category;
            document.getElementById('ev_date').value      = event.event_date.split('T')[0];
            document.getElementById('ev_time').value      = event.start_time;
            document.getElementById('ev_fee').value       = event.fee;
            document.getElementById('ev_slots').value     = event.slots;
            document.getElementById('ev_status').value    = event.status;
            document.getElementById('ev_image').value     = event.image ?? '';
            document.getElementById('ev_desc').value      = event.description ?? '';
        } else {
            title.textContent = 'Add New Event';
            form.action = base;
            method.value = 'POST';
            form.reset();
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeEventModal() {
        const modal = document.getElementById('eventModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function openViewModal(event) {
        document.getElementById('v_title').textContent      = event.title;
        document.getElementById('v_location').textContent   = event.location;
        document.getElementById('v_date').textContent       = event.event_date.split('T')[0];
        document.getElementById('v_time').textContent       = event.start_time;
        document.getElementById('v_category').textContent   = event.category;
        document.getElementById('v_fee').textContent        = 'BDT ' + event.fee;
        document.getElementById('v_slots').textContent      = event.slots;
        document.getElementById('v_registered').textContent = event.registered;
        document.getElementById('v_status').textContent     = event.status;
        document.getElementById('v_desc').textContent       = event.description ?? '—';

        const modal = document.getElementById('viewModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeViewModal() {
        const modal = document.getElementById('viewModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endpush

@endsection