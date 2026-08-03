@extends('layouts.admin')

@section('title', 'Video Gallery')

@section('content')
<div class="card p-3 p-md-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold mb-0">Video Gallery</h6>
        <a href="{{ route('admin.video-gallery.create') }}" class="btn btn-brand text-white btn-sm">
            <i class="bi bi-plus-lg"></i> Add Video
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Video URL</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($videos as $video)
                    <tr>
                        <td class="fw-semibold">{{ $video->title }}</td>
                        <td>{{ $video->category->name ?? '—' }}</td>
                        <td>
                            <a href="{{ $video->video_url }}" target="_blank" class="small text-truncate d-inline-block" style="max-width:220px;">
                                <i class="bi bi-box-arrow-up-right"></i> {{ $video->video_url }}
                            </a>
                        </td>
                        <td>
                            <span class="badge {{ $video->status === 'active' ? 'badge-active' : 'badge-inactive' }}">
                                {{ ucfirst($video->status) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.video-gallery.edit', $video) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.video-gallery.destroy', $video) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this video?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No videos found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $videos->links() }}
</div>
@endsection
