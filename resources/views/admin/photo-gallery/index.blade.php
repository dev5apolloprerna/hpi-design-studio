@extends('layouts.admin')

@section('title', 'Photo Gallery')

@section('content')
<div class="card p-3 p-md-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold mb-0">Photo Gallery</h6>
        <a href="{{ route('admin.photo-gallery.create') }}" class="btn btn-brand text-white btn-sm">
            <i class="bi bi-plus-lg"></i> Add Photo
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($photos as $photo)
                    <tr>
                        <td><img src="{{ $photo->image_url }}" class="thumb" alt="{{ $photo->title }}"></td>
                        <td class="fw-semibold">{{ $photo->title }}</td>
                        <td>{{ $photo->category->name ?? '—' }}</td>
                        <td>
                            <span class="badge {{ $photo->status === 'active' ? 'badge-active' : 'badge-inactive' }}">
                                {{ ucfirst($photo->status) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.photo-gallery.edit', $photo) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.photo-gallery.destroy', $photo) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this photo? The uploaded image file will also be removed.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No photos found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $photos->links() }}
</div>
@endsection
