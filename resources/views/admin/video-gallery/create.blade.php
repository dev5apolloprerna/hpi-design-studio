@extends('layouts.admin')

@section('title', 'Add Video')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card p-4">
            <h6 class="fw-semibold mb-3">Add Video</h6>
            <form action="{{ route('admin.video-gallery.store') }}" method="POST">
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
                        <div class="form-text text-danger">No Video Gallery categories yet. <a href="{{ route('admin.categories.create') }}">Create one first</a>.</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Video URL</label>
                    <input type="url" name="video_url" value="{{ old('video_url') }}" class="form-control" placeholder="https://www.youtube.com/watch?v=..." required>
                    <div class="form-text">Just paste the video link (YouTube, Vimeo, etc.) — no upload needed.</div>
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
                <a href="{{ route('admin.video-gallery.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
