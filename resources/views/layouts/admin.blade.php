<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | HPI Design Studio Admin</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        :root {
            --hpi-navy: #121f3a;
            --hpi-navy-light: #1b2c52;
            --hpi-accent: #d9a441;
            --hpi-bg: #f4f6fb;
        }
        body { font-family: 'Poppins', sans-serif; background: var(--hpi-bg); }
        .sidebar {
            width: 260px; min-height: 100vh; background: var(--hpi-navy);
            position: fixed; top: 0; left: 0; z-index: 1030;
        }
        .sidebar .brand {
            padding: 1.5rem 1.25rem; border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .sidebar .brand h1 { font-size: 1.15rem; color: #fff; font-weight: 700; margin: 0; }
        .sidebar .brand span { color: var(--hpi-accent); }
        .sidebar .nav-link {
            color: rgba(255,255,255,.75); padding: .7rem 1.25rem; font-size: .93rem;
            border-left: 3px solid transparent; display: flex; align-items: center; gap: .6rem;
        }
        .sidebar .nav-link i { font-size: 1.05rem; }
        .sidebar .nav-link:hover { background: var(--hpi-navy-light); color: #fff; }
        .sidebar .nav-link.active {
            background: var(--hpi-navy-light); color: #fff; border-left-color: var(--hpi-accent);
        }
        .main-wrapper { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column; }
        .topbar {
            background: #fff; padding: .9rem 1.5rem; border-bottom: 1px solid #e7e9ee;
            display: flex; justify-content: space-between; align-items: center;
        }
        .topbar h5 { margin: 0; font-weight: 600; color: var(--hpi-navy); }
        .content { padding: 1.75rem; flex: 1; }
        .card { border: none; border-radius: .8rem; box-shadow: 0 2px 10px rgba(18,31,58,.06); }
        .btn-brand {
            background: var(--hpi-navy); border-color: var(--hpi-navy); color: #fff;
        }
        .btn-brand:hover { background: var(--hpi-navy-light); border-color: var(--hpi-navy-light); color: #fff; }
        .badge-active { background: #e6f6ec; color: #1e8a4c; }
        .badge-inactive { background: #fbe9e9; color: #c23636; }
        table thead th { font-size: .78rem; text-transform: uppercase; letter-spacing: .04em; color: #6b7280; border-bottom-width: 1px; }
        .thumb { width: 56px; height: 56px; object-fit: cover; border-radius: .5rem; }
        @media (max-width: 991.98px) {
            .sidebar { left: -260px; transition: left .2s ease; }
            .sidebar.show { left: 0; }
            .main-wrapper { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <h1>HPI <span>Design Studio</span></h1>
            <small class="text-white-50">Admin Panel</small>
        </div>
        <nav class="nav flex-column py-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Category
            </a>
            <a href="{{ route('admin.photo-gallery.index') }}" class="nav-link {{ request()->routeIs('admin.photo-gallery.*') ? 'active' : '' }}">
                <i class="bi bi-images"></i> Photo Gallery
            </a>
            <a href="{{ route('admin.video-gallery.index') }}" class="nav-link {{ request()->routeIs('admin.video-gallery.*') ? 'active' : '' }}">
                <i class="bi bi-camera-reels"></i> Video Gallery
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                <i class="bi bi-chat-quote"></i> Testimonials
            </a>
            <hr class="text-white-50 mx-3">
            <a href="{{ route('admin.profile.change-password') }}" class="nav-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                <i class="bi bi-key"></i> Change Password
            </a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </nav>
    </aside>

    <div class="main-wrapper">
        <div class="topbar">
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-sm btn-outline-secondary d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="bi bi-list"></i>
                </button>
                <h5>@yield('title', 'Dashboard')</h5>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted small">{{ auth()->user()->name }}</span>
                <i class="bi bi-person-circle fs-4 text-secondary"></i>
            </div>
        </div>

        <div class="content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
