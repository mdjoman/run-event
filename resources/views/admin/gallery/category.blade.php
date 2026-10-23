@extends('admin.layouts.app')
<style>
    #savebutton.bg-blue-600 {
        --tw-bg-opacity: 1;
        background-color: #8BC34A !important;
    }
</style>
@section('title', 'Gallery - Admin')
@section('page-title', 'Gallery Categories')
@section('body')
<div class="container-fluid px-4 py-4">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <div class="bg-white shadow-sm rounded-lg border border-slate-200">
                <div class="border-b border-slate-200 px-6 py-4 flex justify-between items-center">
                    <h3 class="font-semibold text-slate-700">
                        {{ isset($category) ? 'Edit Category' : 'Add New Category' }}
                    </h3>
                    @if(isset($category))
                        <a href="{{ route('admin.gallery.category.index') }}" class="text-sm text-blue-600 hover:underline">Cancel</a>
                    @endif
                </div>
                <div class="p-6">
                    <form action="{{ isset($category) ? route('admin.gallery.category.update', $category->id) : route('admin.gallery.category.store') }}" method="POST">
                        @csrf
                        @if(isset($category))
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label for="name"class="block text-sm font-medium text-slate-600 mb-1">Category Name</label>
                            <input type="text" name="name" id="name" value="{{ isset($category) ? $category->name : old('name') }}" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="" required>
                        </div>
                        <button type="submit"  id="savebutton" class="w-full bg-blue-600 text-white font-medium py-2 px-4 rounded-md hover:bg-blue-700 transition">
                            {{ isset($category) ? 'Update Category' : 'Save Category' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div>
            <div class="bg-white shadow-sm rounded-lg border border-slate-200">
                <div class="border-b border-slate-200 px-6 py-4">
                    <h3 class="font-semibold text-slate-700">Category List</h3>
                </div>
                <div class="overflow-x-auto p-4">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 text-slate-600 text-sm">
                                <th class="py-2 px-3">#</th>
                                <th class="py-2 px-3">Name</th>
                                <th class="py-2 px-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @forelse($categories as $key => $cat)
                                <tr>
                                    <td class="py-3 px-3">{{ $key + 1 }}</td>
                                    <td class="py-3 px-3 font-medium text-slate-800">{{ $cat->name }}</td>
                                    <td class="py-3 px-3 text-center">
                                        <div class="inline-flex items-center space-x-2">
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.gallery.category.edit', $cat->id) }}" class="inline-flex items-center justify-center w-8 h-8 bg-blue-50 text-blue-600 rounded-md hover:bg-blue-100 transition" title="Edit" style="margin-top: -15px;">
                                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                                            </a>

                                            <!-- Delete Button -->
                                            <form action="{{ route('admin.gallery.category.destroy', $cat->id) }}" method="POST" class="inline-flex" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center w-8 h-8 bg-red-50 text-red-600 rounded-md hover:bg-red-100 transition" title="Delete">
                                                    <i class="fa-solid fa-trash text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-6 text-slate-500">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
