@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="card p-3 p-md-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div class="btn-group">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-sm {{ request('module') ? 'btn-outline-secondary' : 'btn-brand text-white' }}">All</a>
            @foreach ($moduleLabels as $key => $label)
                <a href="{{ route('admin.categories.index', ['module' => $key]) }}" class="btn btn-sm {{ request('module') === $key ? 'btn-brand text-white' : 'btn-outline-secondary' }}">{{ $label }}</a>
            @endforeach
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-brand text-white btn-sm">
            <i class="bi bi-plus-lg"></i> Add Category
        </a>
    </div>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Module</th>
                    <th>Items</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td class="fw-semibold">{{ $category->name }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $category->module_label }}</span></td>
                        <td class="text-muted small">
                            {{ $category->photo_galleries_count + $category->video_galleries_count + $category->testimonials_count }}
                        </td>
                        <td>
                            <span class="badge {{ $category->status === 'active' ? 'badge-active' : 'badge-inactive' }}">
                                {{ ucfirst($category->status) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category and all its related items?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No categories found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $categories->links() }}
</div>
@endsection
