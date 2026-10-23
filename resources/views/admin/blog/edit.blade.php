@extends('admin.layouts.app')

@section('title', 'Edit Blog - ' . $blog->title)
@section('page-title', 'Edit Blog')
@section('page-subtitle', $blog->title)

@section('body')
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden max-w-2xl mx-auto">
        <div class="p-5 border-b border-slate-100">
            <h3 class="font-bold text-slate-800 text-lg">Edit Blog</h3>
        </div>

        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Title</label>
                <input type="text" name="title" value="{{ old('title', $blog->title) }}" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                @error('title')
                    <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Date</label>
                <input type="date" name="date" value="{{ old('date', $blog->date ? \Carbon\Carbon::parse($blog->date)->format('Y-m-d') : ($blog->created_at?->format('Y-m-d') ?? '')) }}" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                @error('date')
                    <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Description</label>
                <textarea name="description" rows="5" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" required>{{ old('description', $blog->description) }}</textarea>
                @error('description')
                    <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.blog.index') }}" class="px-4 py-2 bg-slate-200 text-slate-700 text-sm rounded-lg hover:bg-slate-300 transition">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700 transition">Update Blog</button>
            </div>
        </form>
    </div>
@endsection
