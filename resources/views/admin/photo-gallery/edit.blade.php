@extends('layouts.admin')

@section('title', 'Edit Photo')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card p-4">
            <h6 class="fw-semibold mb-3">Edit Photo</h6>
            <img src="{{ $photoGallery->image_url }}" class="mb-3 rounded" style="max-width:200px;">
            <form action="{{ route('admin.photo-gallery.update', $photoGallery) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Category</label>
                    <select name="category_id" class="form-select" required>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $photoGallery->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Title</label>
                    <input type="text" name="title" value="{{ old('title', $photoGallery->title) }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Replace Photo (optional)</label>
                    <input type="file" name="image" accept="image/*" class="form-control">
                    <div class="form-text">Leave empty to keep the current photo. Uploading a new one deletes the old file.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $photoGallery->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status', $photoGallery->status) === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $photoGallery->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-brand text-white"><i class="bi bi-check-circle"></i> Update</button>
                <a href="{{ route('admin.photo-gallery.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
