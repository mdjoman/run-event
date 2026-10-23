@extends('admin.layouts.app')

<style>
    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        border-collapse: collapse;
    }
    .table th, .table td {
        padding: 0.75rem;
        vertical-align: middle;
        border: 1px solid #dee2e6;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(198, 249, 126, 0.05);
    }
</style>

@section('title', 'Gallery - Admin')
@section('page-title', 'Manage Gallery')

@section('body')
<div class="container-fluid px-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 20px;">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4 mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-light">
                        <tr style="background-color: green; color: white;">
                            <th style="width: 5%;">#</th>
                            <th style="width: 15%;">Image</th>
                            <th style="width: 25%;">Category</th>
                            <th style="width: 20%;">Status</th>
                            <th style="width: 35%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($galleries as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td class="text-center align-middle">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Image" style="width: 70px; height: 50px; object-fit: cover; border-radius: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: inline-block;">
                                </td>
                                <td><span class="badge bg-secondary px-2 py-1" style="font-size:14px;">{{ ucfirst($item->category) }}</span></td>
                                <td>
                                    @if($item->status == 1)
                                        <span class="badge px-3 py-2" style="background-color: #d1e7dd; color: #0f5132; font-size:14px;"><i class="fas fa-check-circle me-1"></i> Approved</span>
                                    @else
                                        <span class="badge px-3 py-2" style="background-color: #fff3cd; color: #664d03; font-size:14px;"><i class="fas fa-clock me-1"></i> Pending</span>
                                    @endif
                                </td>
                                <td class="p-4 text-centerspace-x-1 whitespace-nowrap">
                                    <form action="{{ route('admin.gallery.status', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-8 h-8 inline-flex items-center justify-center rounded-lg {{ $item->status == 1 ? 'bg-amber-50 text-amber-600 hover:bg-amber-100' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }} transition" title="{{ $item->status == 1 ? 'Make Pending' : 'Approve' }}">
                                            <i class="fa-solid {{ $item->status == 1 ? 'fa-rotate-left' : 'fa-check' }} text-xs"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.gallery.edit', $item->id) }}" class="w-8 h-8 inline-flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100 transition" title="Edit">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>

                                    <form action="{{ route('admin.gallery.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this image?');">
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
                                <td colspan="5" class="text-center py-4 text-muted">No images found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
