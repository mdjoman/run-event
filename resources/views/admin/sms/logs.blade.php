@extends('admin.layouts.app')

@section('title', 'SMS Logs - Admin')
@section('page-title', 'SMS Logs')
@section('page-subtitle', 'History of all SMS sent to runners')

@section('body')

{{-- Tabs --}}
<div class="flex gap-2 mb-5">
    <a href="{{ route('admin.sms.index') }}"
       class="px-4 py-2 rounded-lg text-sm font-semibold bg-white text-slate-700 hover:bg-slate-100 transition shadow-sm">
        <i class="fa-solid fa-paper-plane mr-1"></i> Broadcast
    </a>
    <a href="{{ route('admin.sms.logs') }}"
       class="px-4 py-2 rounded-lg text-sm font-semibold bg-gradient-to-r from-brandPink to-pink-600 text-white shadow-md">
        <i class="fa-solid fa-list-check mr-1"></i> SMS Logs
    </a>
</div>

{{-- Filters --}}
<form method="GET" class="bg-white rounded-xl shadow-sm p-4 mb-5 card-glossy">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">

        <div class="lg:col-span-2">
            <label class="block text-xs font-semibold text-slate-600 mb-1">
                <i class="fa-solid fa-search mr-1 text-brandPink"></i> Search
            </label>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Phone, name, message..."
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
                <option value="">All</option>
                <option value="sent"   @selected(request('status') === 'sent')>Sent</option>
                <option value="failed" @selected(request('status') === 'failed')>Failed</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">
                <i class="fa-solid fa-calendar mr-1 text-brandPink"></i> From
            </label>
            <input type="date" name="date_from" value="{{ request('date_from') }}"
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        <div>
            <label class="block text-xs font-semibold text-slate-600 mb-1">
                <i class="fa-solid fa-calendar mr-1 text-brandPink"></i> To
            </label>
            <input type="date" name="date_to" value="{{ request('date_to') }}"
                   class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm
                          focus:ring-2 focus:ring-brandPink focus:border-transparent focus:outline-none transition">
        </div>

        <div class="sm:col-span-2 lg:col-span-4 flex flex-col sm:flex-row gap-2 pt-1">
            <button class="flex-1 sm:flex-none px-5 py-2.5 bg-gradient-to-r from-brandPink to-pink-600
                           hover:from-pink-600 hover:to-brandPink text-white rounded-lg text-sm font-semibold
                           transition shadow-md hover:shadow-lg">
                <i class="fa-solid fa-filter mr-1"></i> Apply Filters
            </button>
            <a href="{{ route('admin.sms.logs') }}"
               class="flex-1 sm:flex-none px-5 py-2.5 bg-slate-100 text-slate-700 rounded-lg text-sm font-semibold
                      hover:bg-slate-200 transition text-center">
                <i class="fa-solid fa-rotate-left mr-1"></i> Reset
            </a>
        </div>
    </div>
</form>

{{-- Log table --}}
<div class="bg-white rounded-xl shadow-sm overflow-hidden card-glossy">
    <div class="hidden lg:block overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600 uppercase text-xs">
                <tr>
                    <th class="px-5 py-3 text-left font-semibold">#ID</th>
                    <th class="px-5 py-3 text-left font-semibold">Recipient</th>
                    <th class="px-5 py-3 text-left font-semibold">Phone</th>
                    <th class="px-5 py-3 text-left font-semibold">Event</th>
                    <th class="px-5 py-3 text-left font-semibold">Message</th>
                    <th class="px-5 py-3 text-left font-semibold">Status</th>
                    <th class="px-5 py-3 text-left font-semibold">Sent At</th>
                    <th class="px-5 py-3 text-right font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($logs as $log)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-3 font-semibold text-slate-800">#{{ $log->id }}</td>
                        <td class="px-5 py-3">
                            <div class="font-semibold text-slate-800">{{ $log->recipient_name ?? '—' }}</div>
                            @if($log->registration_id)
                                <div class="text-xs text-slate-500">Reg #{{ $log->registration_id }}</div>
                            @endif
                        </td>
                        <td class="px-5 py-3 font-mono text-xs text-slate-700">{{ $log->to_phone }}</td>
                        <td class="px-5 py-3 text-slate-700 max-w-[150px] truncate">{{ $log->event?->title ?? '—' }}</td>
                        <td class="px-5 py-3 max-w-[280px]">
                            <p class="truncate text-slate-600 text-xs">{{ $log->message }}</p>
                            <p class="text-[10px] text-slate-400">{{ $log->message_length }} chars</p>
                        </td>
                        <td class="px-5 py-3">
                            @if($log->status === 'sent')
                                <span class="badge bg-green-100 text-green-700"><i class="fa-solid fa-check text-[10px]"></i> Sent</span>
                            @else
                                <span class="badge bg-red-100 text-red-700"><i class="fa-solid fa-xmark text-[10px]"></i> Failed</span>
                            @endif
                        </td>
                        <td class="px-5 py-3 text-xs text-slate-500">
                            {{ $log->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="px-5 py-3 text-right">
                            <a href="{{ route('admin.sms.logs.show', $log) }}"
                               class="inline-flex w-8 h-8 items-center justify-center rounded-lg
                                      bg-blue-50 text-brandBlue hover:bg-blue-100 active:scale-95 transition"
                               title="View">
                                <i class="fa-solid fa-eye text-xs"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-5 py-10 text-center text-slate-500">
                            <i class="fa-regular fa-folder-open text-3xl mb-2 block text-slate-300"></i>
                            <p class="text-sm font-medium">No SMS logs found.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Mobile cards --}}
    <div class="lg:hidden divide-y divide-slate-100">
        @forelse($logs as $log)
            <div class="p-4">
                <div class="flex items-start justify-between gap-2 mb-2">
                    <div class="min-w-0">
                        <p class="font-semibold text-sm text-slate-800 truncate">
                            {{ $log->recipient_name ?? 'Unknown' }}
                            <span class="text-xs text-slate-400">#{{ $log->id }}</span>
                        </p>
                        <p class="text-xs text-slate-500 font-mono">{{ $log->to_phone }}</p>
                    </div>
                    @if($log->status === 'sent')
                        <span class="badge bg-green-100 text-green-700">Sent</span>
                    @else
                        <span class="badge bg-red-100 text-red-700">Failed</span>
                    @endif
                </div>
                <p class="text-xs text-slate-600 mb-2 line-clamp-2">{{ $log->message }}</p>
                <div class="flex items-center justify-between text-[10px] text-slate-400">
                    <span>{{ $log->created_at->diffForHumans() }}</span>
                    <a href="{{ route('admin.sms.logs.show', $log) }}"
                       class="text-brandBlue font-semibold">View →</a>
                </div>
            </div>
        @empty
            <div class="p-10 text-center text-slate-500">
                <i class="fa-regular fa-folder-open text-4xl mb-3 block text-slate-300"></i>
                <p class="text-sm">No SMS logs found.</p>
            </div>
        @endforelse
    </div>

    @if($logs->hasPages())
        <div class="px-4 sm:px-5 py-3 border-t border-slate-100">
            {{ $logs->links() }}
        </div>
    @endif
</div>

@endsection
