@extends('admin.layouts.app')

@section('title', 'Dashboard - Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', "Welcome back, " . auth()->user()->name)

@section('body')

{{-- ====== STAT CARDS ====== --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-5 mb-6 sm:mb-8">

    {{-- Total Events --}}
    <div class="card-glossy p-4 sm:p-5 border-l-4 border-brandPink">
        <div class="flex items-center justify-between gap-2">
            <div class="min-w-0">
                <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Total Events</p>
                <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 mt-1">{{ $stats['total_events'] }}</h3>
                <p class="text-[10px] sm:text-xs text-green-600 mt-1 sm:mt-2 truncate">
                    <i class="fa-solid fa-arrow-up"></i> Active season
                </p>
            </div>
            <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-full bg-pink-100 text-brandPink flex items-center justify-center text-lg sm:text-2xl flex-shrink-0">
                <i class="fa-regular fa-calendar-check"></i>
            </div>
        </div>
    </div>

    {{-- Registrations --}}
    <div class="card-glossy p-4 sm:p-5 border-l-4 border-brandBlue">
        <div class="flex items-center justify-between gap-2">
            <div class="min-w-0">
                <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Registrations</p>
                <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 mt-1">{{ number_format($stats['total_registrations']) }}</h3>
                <p class="text-[10px] sm:text-xs text-green-600 mt-1 sm:mt-2 truncate">
                    <i class="fa-solid fa-arrow-up"></i> Total runners
                </p>
            </div>
            <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-full bg-blue-100 text-brandBlue flex items-center justify-center text-lg sm:text-2xl flex-shrink-0">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>
    </div>

    {{-- Pending Payments --}}
    <div class="card-glossy p-4 sm:p-5 border-l-4 border-brandOrange">
        <div class="flex items-center justify-between gap-2">
            <div class="min-w-0">
                <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Pending</p>
                <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 mt-1">{{ $stats['pending_payments'] }}</h3>
                <p class="text-[10px] sm:text-xs text-orange-600 mt-1 sm:mt-2 truncate">
                    <i class="fa-solid fa-clock"></i> Needs review
                </p>
            </div>
            <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-full bg-orange-100 text-brandOrange flex items-center justify-center text-lg sm:text-2xl flex-shrink-0">
                <i class="fa-regular fa-clock"></i>
            </div>
        </div>
    </div>

    {{-- Completed Events --}}
    <div class="card-glossy p-4 sm:p-5 border-l-4 border-brandTeal">
        <div class="flex items-center justify-between gap-2">
            <div class="min-w-0">
                <p class="text-xs sm:text-sm text-slate-500 font-medium truncate">Completed</p>
                <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 mt-1">{{ $stats['completed_events'] }}</h3>
                <p class="text-[10px] sm:text-xs text-teal-600 mt-1 sm:mt-2 truncate">
                    <i class="fa-solid fa-check"></i> All time
                </p>
            </div>
            <div class="w-10 h-10 sm:w-14 sm:h-14 rounded-full bg-teal-100 text-brandTeal flex items-center justify-center text-lg sm:text-2xl flex-shrink-0">
                <i class="fa-solid fa-trophy"></i>
            </div>
        </div>
    </div>

</div>

{{-- ====== MAIN GRID ====== --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 sm:gap-6">

    {{-- Recent Registrations --}}
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm card-glossy overflow-hidden">
        <div class="px-4 sm:px-5 py-3 sm:py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-bold text-slate-800 text-base sm:text-lg flex items-center gap-2">
                <i class="fa-solid fa-users text-brandPink"></i>
                <span class="glossy-text">Recent Registrations</span>
            </h2>
            <a href="{{ route('admin.registrations.index') }}"
               class="text-xs sm:text-sm text-brandPink hover:underline font-medium flex items-center gap-1">
                View All <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>

        {{-- Desktop table --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-600 uppercase text-xs">
                    <tr>
                        <th class="px-5 py-3 text-left font-semibold">Runner</th>
                        <th class="px-5 py-3 text-left font-semibold">Event</th>
                        <th class="px-5 py-3 text-left font-semibold">Amount</th>
                        <th class="px-5 py-3 text-left font-semibold">Status</th>
                        <th class="px-5 py-3 text-left font-semibold">Time</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentRegistrations as $reg)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-5 py-3 font-medium text-slate-800">{{ $reg->full_name }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $reg->event?->title ?? '—' }}</td>
                            <td class="px-5 py-3 font-semibold text-slate-800">BDT {{ number_format($reg->amount) }}</td>
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
                            <td class="px-5 py-3 text-slate-500 text-xs">{{ $reg->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-8 text-center text-slate-500">No registrations yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Mobile card list --}}
        <div class="md:hidden divide-y divide-slate-100">
            @forelse($recentRegistrations as $reg)
                @php
                    $colors = [
                        'pending'   => 'bg-yellow-100 text-yellow-700',
                        'approved'  => 'bg-green-100 text-green-700',
                        'rejected'  => 'bg-red-100 text-red-700',
                        'cancelled' => 'bg-slate-100 text-slate-700',
                    ];
                @endphp
                <div class="p-4 hover:bg-slate-50 transition">
                    <div class="flex items-start justify-between gap-2 mb-2">
                        <p class="font-semibold text-slate-800 text-sm truncate">{{ $reg->full_name }}</p>
                        <span class="badge {{ $colors[$reg->status] ?? '' }} flex-shrink-0">
                            {{ ucfirst($reg->status) }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 truncate mb-1">
                        <i class="fa-regular fa-calendar-check mr-1"></i>
                        {{ $reg->event?->title ?? '—' }}
                    </p>
                    <div class="flex items-center justify-between text-xs">
                        <span class="font-bold text-slate-800">BDT {{ number_format($reg->amount) }}</span>
                        <span class="text-slate-400">{{ $reg->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            @empty
                <p class="p-8 text-center text-slate-500 text-sm">No registrations yet.</p>
            @endforelse
        </div>
    </div>

    {{-- Upcoming Events --}}
    <div class="bg-white rounded-xl shadow-sm card-glossy">
        <div class="px-4 sm:px-5 py-3 sm:py-4 border-b border-slate-100 flex items-center justify-between">
            <h2 class="font-bold text-slate-800 text-base sm:text-lg flex items-center gap-2">
                <i class="fa-regular fa-calendar-check text-brandBlue"></i>
                <span class="glossy-text">Upcoming</span>
            </h2>
            <a href="{{ route('admin.events.index') }}"
               class="text-xs sm:text-sm text-brandPink hover:underline font-medium">
                Manage
            </a>
        </div>

        <div class="p-4 sm:p-5 space-y-4">
            @forelse($upcomingEvents as $event)
                @php
                    $percent = $event->slots > 0 ? round(($event->registered / $event->slots) * 100) : 0;
                @endphp
                <div class="border border-slate-100 rounded-lg p-3 hover:border-brandPink transition">
                    <div class="flex items-start justify-between gap-2">
                        <div class="min-w-0">
                            <h4 class="font-semibold text-slate-800 text-sm truncate">{{ $event->title }}</h4>
                            <p class="text-xs text-slate-500 mt-1 truncate">
                                <i class="fa-solid fa-location-dot"></i> {{ $event->location }}
                            </p>
                            <p class="text-xs text-slate-500 truncate">
                                <i class="fa-regular fa-calendar"></i> {{ $event->event_date->format('d M Y') }}
                            </p>
                        </div>
                        <span class="text-xs bg-blue-50 text-brandBlue px-2 py-1 rounded-full font-semibold flex-shrink-0">
                            {{ $event->registered }}/{{ $event->slots }}
                        </span>
                    </div>

                    <div class="mt-3">
                        <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-brandPink to-purple-500 rounded-full transition-all duration-500"
                                 style="width: {{ $percent }}%"></div>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-1">{{ $percent }}% filled</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-slate-500 text-sm py-4">No upcoming events.</p>
            @endforelse
        </div>
    </div>

</div>

@endsection