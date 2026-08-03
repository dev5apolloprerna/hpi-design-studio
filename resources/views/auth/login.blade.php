<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | HPI Design Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, #121f3a 0%, #1b2c52 60%, #2a3e6b 100%);
        }
        .login-card {
            width: 100%; max-width: 400px; border: none; border-radius: 1rem;
            box-shadow: 0 15px 40px rgba(0,0,0,.25);
        }
        .login-card .brand-icon {
            width: 56px; height: 56px; border-radius: 50%;
            background: #d9a441; color: #121f3a; display: flex;
            align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 1rem;
        }
        .btn-brand { background: #121f3a; border-color: #121f3a; }
        .btn-brand:hover { background: #1b2c52; border-color: #1b2c52; }
    </style>
</head>
<body>
    <div class="card login-card p-4 p-md-5">
        <div class="brand-icon"><i class="bi bi-buildings"></i></div>
        <h4 class="text-center fw-bold mb-1">HPI Design Studio</h4>
        <p class="text-center text-muted mb-4">Sign in to the admin panel</p>

        @if ($errors->any())
            <div class="alert alert-danger py-2 small">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-semibold">Email address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="admin@hpidesignstudio.com" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label small fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label small" for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn btn-brand w-100 text-white fw-semibold">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>
        </form>
    </div>
</body>
</html>
