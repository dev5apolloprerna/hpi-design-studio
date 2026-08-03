@extends('layouts.admin')

@section('title', 'Testimonials')

@section('content')
<div class="card p-3 p-md-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold mb-0">Testimonials</h6>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-brand text-white btn-sm">
            <i class="bi bi-plus-lg"></i> Add Testimonial
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Comments</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($testimonials as $t)
                    <tr>
                        <td class="fw-semibold">{{ $t->name }}</td>
                        <td>{{ $t->category->name ?? '—' }}</td>
                        <td class="text-muted small">{{ Str::limit($t->comments, 70) }}</td>
                        <td>
                            <span class="badge {{ $t->status === 'active' ? 'badge-active' : 'badge-inactive' }}">
                                {{ ucfirst($t->status) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this testimonial?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No testimonials found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $testimonials->links() }}
</div>
@endsection
