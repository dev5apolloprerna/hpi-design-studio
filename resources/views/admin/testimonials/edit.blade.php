@extends('layouts.admin')

@section('title', 'Edit Testimonial')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card p-4">
            <h6 class="fw-semibold mb-3">Edit Testimonial</h6>
            <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Category</label>
                    <select name="category_id" class="form-select" required>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $testimonial->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Name</label>
                    <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Comments</label>
                    <textarea name="comments" class="form-control" rows="4" required>{{ old('comments', $testimonial->comments) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status', $testimonial->status) === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $testimonial->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-brand text-white"><i class="bi bi-check-circle"></i> Update</button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-outline-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
