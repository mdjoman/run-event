@extends('admin.layouts.app')

@section('title', 'Edit Gallery - Admin')
@section('page-title', 'Edit Gallery Image')

@section('body')
    <div class="container-fluid px-4 py-4">
        <div class="card shadow-sm border-0" style="max-width: 650px; background: #ffffff; border-radius: 10px;">
            <div class="card-header text-white py-3 px-4" style="background-color: #28a745; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                <h5 class="m-0 font-weight-bold"><i class="fas fa-edit me-2"></i> Edit Gallery Image</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Current Image Preview --}}
                    <div class="mb-4">
                        <label class="form-label font-weight-bold text-dark d-block mb-2">Current Image</label>
                        <div class="p-2 border rounded bg-light d-inline-block">
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="Gallery Image" style="width: 140px; height: 90px; object-fit: cover; border-radius: 6px;">
                        </div>
                    </div>

                    {{-- Category Selection --}}
                    <div class="mb-4">
                        <label class="form-label font-weight-bold text-dark">Category</label>
                        <select name="category" class="form-select form-control" required style="padding: 10px; border-radius: 6px; border: 1px solid #ced4da;">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->name }}" {{ $gallery->category == $cat->name ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Replace Image Input --}}
                    <div class="mb-4">
                        <label class="form-label font-weight-bold text-dark">Replace Image <span class="text-muted font-weight-normal">(Optional)</span></label>
                        <input type="file" name="gallery_image" class="form-control" accept="image/*" style="padding: 10px; border-radius: 6px;">
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex justify-content-start align-items-center gap-3 mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-success px-4 py-2 text-white font-weight-bold shadow-sm" style="border-radius: 6px; background-color: #28a745; border: none; display: inline-flex; align-items: center; gap: 8px;">
                            <i class="fas fa-save"></i> Update Changes
                        </button>
                        <a href="{{ route('admin.gallery.index') }}" class="btn btn-outline-secondary px-4 py-2" style="border-radius: 6px;">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
