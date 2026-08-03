@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-3 col-6">
        <div class="card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                    <i class="bi bi-tags fs-5"></i>
                </div>
                <div>
                    <div class="text-muted small">Categories</div>
                    <div class="fs-4 fw-bold">{{ $stats['categories'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                    <i class="bi bi-images fs-5"></i>
                </div>
                <div>
                    <div class="text-muted small">Photos</div>
                    <div class="fs-4 fw-bold">{{ $stats['photos'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                    <i class="bi bi-camera-reels fs-5"></i>
                </div>
                <div>
                    <div class="text-muted small">Videos</div>
                    <div class="fs-4 fw-bold">{{ $stats['videos'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card p-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                    <i class="bi bi-chat-quote fs-5"></i>
                </div>
                <div>
                    <div class="text-muted small">Testimonials</div>
                    <div class="fs-4 fw-bold">{{ $stats['testimonials'] }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-6">
        <div class="card p-3">
            <h6 class="fw-semibold mb-3">Recent Photos</h6>
            @forelse ($recentPhotos as $photo)
                <div class="d-flex align-items-center gap-3 py-2 border-bottom">
                    <img src="{{ $photo->image_url }}" class="thumb" alt="{{ $photo->title }}">
                    <div>
                        <div class="fw-semibold">{{ $photo->title }}</div>
                        <div class="text-muted small">{{ $photo->category->name ?? '—' }}</div>
                    </div>
                </div>
            @empty
                <p class="text-muted small mb-0">No photos uploaded yet.</p>
            @endforelse
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card p-3">
            <h6 class="fw-semibold mb-3">Recent Testimonials</h6>
            @forelse ($recentTestimonials as $t)
                <div class="py-2 border-bottom">
                    <div class="fw-semibold">{{ $t->name }} <span class="badge bg-light text-dark">{{ $t->category->name ?? '—' }}</span></div>
                    <div class="text-muted small">{{ Str::limit($t->comments, 90) }}</div>
                </div>
            @empty
                <p class="text-muted small mb-0">No testimonials yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
