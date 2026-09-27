@extends('admin.layouts.app')

@section('title', 'Edit Event - ' . $event->title)
@section('page-title', 'Edit Event')
@section('page-subtitle', $event->title)

@section('body')

{{-- ========== TOP BAR ========== --}}
<div class="flex items-center justify-between gap-2 mb-5">
    <div class="flex items-center gap-2.5">
        <a href="{{ route('admin.events.index') }}"
           class="w-9 h-9 rounded-lg bg-white shadow-sm border border-slate-200
                  flex items-center justify-center text-slate-700
                  hover:text-brandPink hover:border-brandPink transition">
            <i class="fa-solid fa-arrow-left text-xs"></i>
        </a>
        <div>
            <p class="text-[9px] uppercase tracking-[0.12em] text-slate-500 font-bold">Events</p>
            <p class="text-[14px] font-extrabold text-slate-900 leading-tight truncate">
                Edit #{{ $event->id }} · {{ $event->title }}
            </p>
        </div>
    </div>

    <div class="flex items-center gap-2">
        <a href="{{ route('admin.events.show', $event) }}"
           class="px-3 py-1.5 rounded-lg bg-blue-50 border border-blue-200
                  text-[11px] font-bold text-blue-700 hover:bg-blue-100 transition">
            <i class="fa-solid fa-eye"></i> View
        </a>
        <a href="{{ route('admin.events.index') }}"
           class="px-3 py-1.5 rounded-lg bg-white border border-slate-300
                  text-[11px] font-bold text-slate-800
                  hover:border-brandPink hover:text-brandPink transition">
            <i class="fa-solid fa-list"></i> All Events
        </a>
    </div>
</div>

{{-- ========== STATUS ========== --}}
<div class="bg-gradient-to-r from-pink-50 to-purple-50 border border-pink-100 rounded-xl p-4 mb-5
            flex items-center justify-between flex-wrap gap-3">
    <div class="flex items-center gap-3">
        <div class="w-10 h-10 rounded-full bg-brandPink text-white flex items-center justify-center font-bold shadow-md">
            <i class="fa-solid fa-pen"></i>
        </div>
        <div>
            <p class="text-[12px] text-slate-500">Currently editing</p>
            <p class="text-[14px] font-extrabold text-slate-800">{{ $event->title }}</p>
        </div>
    </div>
    <div class="flex items-center gap-2 text-[11px]">
        <span class="badge bg-blue-100 text-blue-700">
            <i class="fa-solid fa-users text-[9px]"></i> {{ $event->registered }} registered
        </span>
        <span class="badge bg-emerald-100 text-emerald-700">
            <i class="fa-solid fa-list text-[9px]"></i> {{ count($event->categories ?? []) }} categories
        </span>
    </div>
</div>

{{-- ========== FORM ========== --}}
<form id="eventForm" method="POST" action="{{ route('admin.events.update', $event) }}"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

    @include('admin.events.partials.form', ['event' => $event, 'mode' => 'edit'])

    {{-- ========== SUBMIT BAR ========== --}}
    <div class="sticky bottom-0 bg-white/95 backdrop-blur-sm border-t border-slate-200
                -mx-4 sm:-mx-6 px-4 sm:px-6 py-4 flex flex-col-reverse sm:flex-row justify-between gap-2 sm:gap-3 shadow-lg">

        {{-- Delete (left) --}}
        <button type="button" onclick="confirmDelete()"
                class="w-full sm:w-auto px-5 py-2.5 rounded-lg text-sm font-semibold
                       bg-red-50 text-red-600 border border-red-200
                       hover:bg-red-500 hover:text-white transition">
            <i class="fa-solid fa-trash mr-1"></i> Delete Event
        </button>

        <div class="flex flex-col-reverse sm:flex-row gap-2 sm:gap-3">
            <a href="{{ route('admin.events.index') }}"
               class="w-full sm:w-auto px-5 py-2.5 rounded-lg text-sm font-semibold
                      bg-slate-100 text-slate-700 hover:bg-slate-200 transition text-center">
                <i class="fa-solid fa-xmark mr-1"></i> Cancel
            </a>
            <button type="submit"
                    class="w-full sm:w-auto px-6 py-2.5 rounded-lg text-sm font-semibold
                           bg-gradient-to-r from-brandPink to-pink-600
                           hover:from-pink-600 hover:to-brandPink
                           text-white transition shadow-md hover:shadow-lg">
                <i class="fa-solid fa-check mr-1"></i> Save Changes
            </button>
        </div>
    </div>
</form>

{{-- Hidden delete form --}}
<form id="deleteEventForm" method="POST"
      action="{{ route('admin.events.destroy', $event) }}" class="hidden">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script>
function confirmDelete() {
    if (confirm('⚠️ Delete "{{ $event->title }}" permanently?\n\nThis will also delete all related registrations.')) {
        document.getElementById('deleteEventForm').submit();
    }
}
</script>
@endpush

@endsection