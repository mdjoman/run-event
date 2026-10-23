@extends('admin.layouts.app')

@section('title', 'Blogs - Admin')
@section('page-title', 'Manage Blogs')

@section('body')
<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-5 border-b border-slate-100 flex justify-between items-center">
        <h3 class="font-bold text-slate-800 text-lg">All Blogs</h3>
    </div>

    @if(session('success'))
        <div class="m-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse table-auto">
            <thead>
                <tr class="bg-slate-50 text-slate-500 uppercase text-xs tracking-wider border-b border-slate-100">
                    <th class="p-4 font-semibold w-16">ID</th>
                    <th class="p-4 font-semibold w-1/5">Title</th>
                    <th class="p-4 font-semibold w-2/5">Description</th>
                    <th class="p-4 font-semibold">Status</th>
                    <th class="p-4 font-semibold">Created At</th>
                    <th class="p-4 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-slate-700 text-sm">
                @forelse($blogs as $blog)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="p-4 font-medium">{{ $blog->id }}</td>
                        <td class="p-4 font-semibold text-slate-900">{{ $blog->title }}</td>
                        <td class="p-4 text-slate-600 max-w-xs truncate md:max-w-md lg:max-w-lg" title="{{ $blog->description }}">
                            {{ $blog->description }}
                        </td>
                        <td class="p-4">
                            @if(isset($blog->is_approved) && $blog->is_approved)
                                <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-2.5 py-1 rounded-full">Approved</span>
                            @else
                                <span class="bg-amber-100 text-amber-700 text-xs font-bold px-2.5 py-1 rounded-full">Pending</span>
                            @endif
                        </td>
                        <td class="p-4 text-slate-500">{{ $blog->date ? \Carbon\Carbon::parse($blog->date)->format('d M, Y') : ($blog->created_at?->format('d M, Y') ?? 'N/A') }}</td>
                        <td class="p-4 text-right space-x-1 whitespace-nowrap">
                            <form action="{{ route('admin.blog.status', $blog->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-8 h-8 inline-flex items-center justify-center rounded-lg {{ ($blog->is_approved ?? false) ? 'bg-amber-50 text-amber-600 hover:bg-amber-100' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }} transition" title="{{ ($blog->is_approved ?? false) ? 'Make Pending' : 'Approve' }}">
                                    <i class="fa-solid {{ ($blog->is_approved ?? false) ? 'fa-rotate-left' : 'fa-check' }} text-xs"></i>
                                </button>
                            </form>

                            <a href="{{ route('admin.blog.edit', $blog) }}" class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition" title="Edit">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </a>

                            <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition" title="Delete">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-400">
                            No blogs found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($blogs->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $blogs->links() }}
        </div>
    @endif
</div>

@endsection
