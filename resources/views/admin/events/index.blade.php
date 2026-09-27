@extends('admin.layouts.app')

@section('title', 'Events - Admin')
@section('page-title', 'Manage Events')
@section('page-subtitle', 'Create, edit, and manage your running events')

@section('body')

{{-- ============ TOP BAR ============ --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">

    {{-- Search Form --}}
    <form method="GET" class="flex items-center gap-2 w-full sm:w-auto">
        <div class="relative flex-1 sm:flex-none">
            <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Search events..."
                   class="w-full sm:w-64 pl-9 pr-4 py-2 border border-slate-200 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-brandPink focus:border-transparent
                          transition">
        </div>
        <button class="px-4 py-2 bg-slate-800 text-white rounded-lg text-sm hover:bg-slate-700 transition flex-shrink-0">
            <i class="fa-solid fa-search"></i>
            <span class="hidden sm:inline ml-1">Search</span>
        </button>

        @if(request('search'))
            <a href="{{ route('admin.events.index') }}"
               class="px-3 py-2 bg-slate-100 text-slate-600 rounded-lg text-sm hover:bg-slate-200 transition flex-shrink-0"
               title="Clear search">
                <i class="fa-solid fa-xmark"></i>
            </a>
        @endif
    </form>

    {{-- Add Event Button — now a link to create page --}}
    <a href="{{ route('admin.events.create') }}"
       class="bg-gradient-to-r from-brandPink to-pink-600 hover:from-pink-600 hover:to-brandPink
              text-white px-5 py-2.5 rounded-lg text-sm font-semibold flex items-center justify-center
              gap-2 transition shadow-md hover:shadow-lg w-full sm:w-auto">
        <i class="fa-solid fa-plus"></i>
        <span>Add New Event</span>
    </a>
</div>

{{-- ============ EVENTS CARD ============ --}}
<div class="bg-white rounded-xl shadow-sm overflow-hidden card-glossy">

    {{-- ===== DESKTOP TABLE ===== --}}
    <div class="hidden lg:block overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600 uppercase text-xs">
                <tr>
                    <th class="px-5 py-3 text-left font-semibold">Event</th>
                    <th class="px-5 py-3 text-left font-semibold">Date & Time</th>
                    <th class="px-5 py-3 text-left font-semibold">Location</th>
                    <th class="px-5 py-3 text-left font-semibold">Categories</th>
                    <th class="px-5 py-3 text-left font-semibold">Slots</th>
                    <th class="px-5 py-3 text-left font-semibold">Status</th>
                    <th class="px-5 py-3 text-right font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($events as $event)
                    @php
                        $distances = collect($event->categories ?? [])->pluck('distance')->filter()->take(3);
                    @endphp
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-brandPink to-purple-600
                                            flex items-center justify-center text-white font-bold shadow-md flex-shrink-0">
                                    <i class="fa-solid fa-person-running"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-800 truncate">{{ $event->title }}</p>
                                    <p class="text-xs text-slate-500 truncate">
                                        {{ $event->subtitle ?? $event->category ?? '—' }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-slate-700">
                            <div class="font-medium">{{ $event->event_date?->format('d M Y') ?? '—' }}</div>
                            <div class="text-xs text-slate-500">{{ $event->start_time ?? '—' }}</div>
                        </td>
                        <td class="px-5 py-4 text-slate-600">
                            <i class="fa-solid fa-location-dot text-brandPink"></i> {{ $event->location ?? '—' }}
                        </td>
                        <td class="px-5 py-4">
                            @if($distances->count())
                                <div class="flex flex-wrap gap-1">
                                    @foreach($distances as $d)
                                        <span class="badge bg-blue-50 text-brandBlue">{{ $d }}</span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-slate-400 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <span class="font-semibold text-slate-800">{{ $event->registered }}</span>
                            <span class="text-slate-400"> / {{ $event->slots }}</span>
                        </td>
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

                                {{-- View → show page --}}
                                <a href="{{ route('admin.events.show', $event) }}"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-brandBlue hover:bg-blue-100 transition"
                                   title="View">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </a>

                                {{-- Edit → edit page --}}
                                <a href="{{ route('admin.events.edit', $event) }}"
                                   class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition"
                                   title="Edit">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST"
                                      onsubmit="return confirm('Delete this event?')">
                                    @csrf @method('DELETE')
                                    <button class="w-8 h-8 flex items-center justify-center rounded-lg
                                                   bg-red-50 text-red-600 hover:bg-red-100 transition"
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
                            <i class="fa-regular fa-folder-open text-3xl mb-2 block text-slate-300"></i>
                            <p class="text-sm font-medium">No events found.</p>
                            <p class="text-xs mt-1">Click "Add New Event" to create your first one.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- ===== MOBILE / TABLET CARD LIST ===== --}}
    <div class="lg:hidden divide-y divide-slate-100">
        @forelse($events as $event)
            @php
                $colors = [
                    'active'    => 'bg-green-100 text-green-700',
                    'draft'     => 'bg-slate-100 text-slate-700',
                    'completed' => 'bg-blue-100 text-blue-700',
                    'cancelled' => 'bg-red-100 text-red-700',
                ];
                $progress = $event->slots > 0
                    ? round(($event->registered / $event->slots) * 100)
                    : 0;
            @endphp

            <div class="p-4 hover:bg-slate-50 transition">

                {{-- Header --}}
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-brandPink to-purple-600
                                flex items-center justify-center text-white font-bold shadow-md flex-shrink-0">
                        <i class="fa-solid fa-person-running"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-start justify-between gap-2">
                            <div class="min-w-0">
                                <p class="font-semibold text-slate-800 truncate">{{ $event->title }}</p>
                                <p class="text-xs text-slate-500 truncate">
                                    {{ $event->subtitle ?? $event->category ?? '—' }}
                                </p>
                            </div>
                            <span class="badge {{ $colors[$event->status] ?? 'bg-slate-100 text-slate-700' }} flex-shrink-0">
                                {{ ucfirst($event->status) }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Info --}}
                <div class="grid grid-cols-2 gap-3 mb-3 text-xs">
                    <div class="flex items-center gap-2 text-slate-600">
                        <i class="fa-regular fa-calendar text-brandPink w-4"></i>
                        <span class="truncate">{{ $event->event_date?->format('d M Y') ?? '—' }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-600">
                        <i class="fa-regular fa-clock text-brandPink w-4"></i>
                        <span class="truncate">{{ $event->start_time ?? '—' }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-slate-600 col-span-2">
                        <i class="fa-solid fa-location-dot text-brandPink w-4"></i>
                        <span class="truncate">{{ $event->location ?? '—' }}</span>
                    </div>
                </div>

                {{-- Slots progress --}}
                <div class="mb-3">
                    <div class="flex items-center justify-between text-xs mb-1">
                        <span class="text-slate-500">Slots filled</span>
                        <span class="font-semibold text-slate-700">
                            {{ $event->registered }} / {{ $event->slots }}
                            <span class="text-slate-400 font-normal">({{ $progress }}%)</span>
                        </span>
                    </div>
                    <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-brandPink to-purple-500 rounded-full transition-all duration-500"
                             style="width: {{ $progress }}%"></div>
                    </div>
                </div>

                {{-- Fee + Actions --}}
                <div class="flex items-center justify-between pt-3 border-t border-slate-100">
                    <div>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider">Fee</p>
                        <p class="font-bold text-slate-800 text-sm">BDT {{ number_format($event->fee) }}</p>
                    </div>

                    <div class="flex items-center gap-2">
                        {{-- View --}}
                        <a href="{{ route('admin.events.show', $event) }}"
                           class="w-9 h-9 flex items-center justify-center rounded-lg
                                  bg-blue-50 text-brandBlue hover:bg-blue-100 transition"
                           title="View">
                            <i class="fa-solid fa-eye text-xs"></i>
                        </a>

                        {{-- Edit --}}
                        <a href="{{ route('admin.events.edit', $event) }}"
                           class="w-9 h-9 flex items-center justify-center rounded-lg
                                  bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition"
                           title="Edit">
                            <i class="fa-solid fa-pen text-xs"></i>
                        </a>

                        {{-- Delete --}}
                        <form action="{{ route('admin.events.destroy', $event) }}" method="POST"
                              onsubmit="return confirm('Delete this event?')">
                            @csrf @method('DELETE')
                            <button class="w-9 h-9 flex items-center justify-center rounded-lg
                                           bg-red-50 text-red-600 hover:bg-red-100 transition"
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
                <p class="text-sm font-medium mb-1">No events found</p>
                <p class="text-xs">Click "Add New Event" to create your first one.</p>
            </div>
        @endforelse
    </div>

    {{-- ===== PAGINATION ===== --}}
    @if($events->hasPages())
        <div class="px-4 sm:px-5 py-3 border-t border-slate-100">
            {{ $events->links() }}
        </div>
    @endif
</div>

@endsection