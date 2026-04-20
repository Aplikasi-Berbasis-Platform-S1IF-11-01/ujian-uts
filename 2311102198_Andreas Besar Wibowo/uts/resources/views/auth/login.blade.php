<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bg: #0a0f1e;
            --card: #131929;
            --border: rgba(99, 179, 237, 0.15);
            --accent: #38bdf8;
            --text: #e2e8f0;
            --muted: #64748b;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .bg-glow {
            position: fixed;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.10) 0%, transparent 70%);
            top: -100px;
            right: -100px;
            pointer-events: none;
        }

        .login-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            width: 100%;
            max-width: 400px;
            position: relative;
            z-index: 1;
        }

        .login-brand {
            font-family: 'Syne', sans-serif;
            font-size: 1.6rem;
            font-weight: 800;
            color: #fff;
            text-align: center;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .brand-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--accent);
            display: inline-block;
        }

        .login-sub {
            text-align: center;
            color: var(--muted);
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        .form-label {
            color: var(--muted);
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 0.4rem;
        }

        .form-ctrl {
            background: #0a0f1e !important;
            border: 1px solid var(--border) !important;
            color: var(--text) !important;
            border-radius: 10px !important;
            padding: 0.65rem 1rem !important;
            font-size: 0.9rem !important;
            transition: border-color 0.2s !important;
        }

        .form-ctrl:focus {
            border-color: var(--accent) !important;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.1) !important;
            outline: none !important;
        }

        .form-ctrl::placeholder {
            color: var(--muted) !important;
        }

        .btn-login {
            width: 100%;
            background: var(--accent);
            border: none;
            color: #0a0f1e;
            font-weight: 700;
            font-family: 'Syne', sans-serif;
            border-radius: 10px;
            padding: 0.75rem;
            font-size: 1rem;
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(56, 189, 248, 0.3);
        }

        .alert-err {
            background: rgba(248, 113, 113, 0.1);
            border: 1px solid rgba(248, 113, 113, 0.3);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            color: #f87171;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .back-link {
            text-align: center;
            margin-top: 1.2rem;
        }

        .back-link a {
            color: var(--muted);
            font-size: 0.875rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-link a:hover {
            color: var(--accent);
        }
    </style>
</head>

<body>
    <div class="bg-glow"></div>
    <div class="login-card">
        <div class="login-brand">
            <span class="brand-dot"></span> Admin Login
        </div>
        <p class="login-sub">Masuk ke dashboard pengelola portfolio</p>

        @if ($errors->any())
            <div class="alert-err">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control form-ctrl" placeholder="admin@portfolio.com"
                    value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control form-ctrl" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-login">
                Masuk &rarr;
            </button>
        </form>

        <div class="back-link">
            <a href="{{ url('/') }}">← Kembali ke Portfolio</a>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</body>

</html>