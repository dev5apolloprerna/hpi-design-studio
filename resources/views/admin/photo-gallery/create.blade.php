@extends('layouts.admin')

@section('title', 'Add Photo')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card p-4">
            <h6 class="fw-semibold mb-3">Add Photo</h6>
            <form action="{{ route('admin.photo-gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @if ($categories->isEmpty())
                        <div class="form-text text-danger">No Photo Gallery categories yet. <a href="{{ route('admin.categories.create') }}">Create one first</a>.</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Photo</label>
                    <input type="file" name="image" accept="image/*" class="form-control" required>
                    <div class="form-text">JPG, PNG or WEBP. Max 4MB.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active" selected>Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-brand text-white"><i class="bi bi-check-circle"></i> Save</button>
                <a href="{{ route('admin.photo-gallery.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
