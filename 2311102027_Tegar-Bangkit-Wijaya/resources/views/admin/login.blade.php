<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #0e0e0e; --bg2: #141414; --border: rgba(255,255,255,.08);
            --text: #f0ece4; --muted: #888880; --accent: #c8a96e;
            --red: #e05a4e; --green: #6bcb77;
            --ff-mono: 'Space Mono', monospace; --ff-body: 'Inter', sans-serif;
        }
        body {
            background: var(--bg); color: var(--text); font-family: var(--ff-body);
            min-height: 100vh; display: flex; align-items: center; justify-content: center;
        }
        .login-wrapper {
            width: 100%; max-width: 420px; padding: 2rem;
        }
        .login-logo {
            font-family: var(--ff-mono); font-size: 1.1rem; color: var(--accent);
            letter-spacing: .1em; margin-bottom: .5rem;
        }
        .login-sub {
            font-family: var(--ff-mono); font-size: .7rem; color: var(--muted);
            letter-spacing: .2em; text-transform: uppercase; margin-bottom: 3rem;
        }
        .login-card {
            background: var(--bg2); border: 1px solid var(--border); padding: 2.5rem;
        }
        h1 {
            font-family: var(--ff-mono); font-size: 1rem; font-weight: 700;
            color: var(--text); letter-spacing: .05em; margin-bottom: 2rem;
        }
        .form-group { margin-bottom: 1.5rem; }
        label {
            display: block; font-family: var(--ff-mono); font-size: .65rem;
            color: var(--muted); letter-spacing: .2em; text-transform: uppercase;
            margin-bottom: .5rem;
        }
        input[type="email"], input[type="password"] {
            width: 100%; padding: .75rem 1rem; background: var(--bg);
            border: 1px solid var(--border); color: var(--text);
            font-family: var(--ff-mono); font-size: .85rem;
            outline: none; transition: border-color .2s;
        }
        input:focus { border-color: var(--accent); }
        .error-msg {
            font-family: var(--ff-mono); font-size: .7rem; color: var(--red);
            margin-top: .4rem; display: block;
        }
        .form-remember {
            display: flex; align-items: center; gap: .5rem; margin-bottom: 2rem;
        }
        .form-remember input { width: auto; }
        .form-remember label { margin: 0; font-size: .7rem; }
        .btn-login {
            width: 100%; padding: .875rem; background: var(--accent);
            color: var(--bg); border: none; font-family: var(--ff-mono);
            font-size: .8rem; font-weight: 700; letter-spacing: .15em;
            text-transform: uppercase; cursor: pointer; transition: background .2s;
        }
        .btn-login:hover { background: #e0bf86; }
        .back-link {
            display: block; text-align: center; margin-top: 1.5rem;
            font-family: var(--ff-mono); font-size: .7rem; color: var(--muted);
            text-decoration: none; letter-spacing: .1em;
            transition: color .2s;
        }
        .back-link:hover { color: var(--accent); }
        .alert-error {
            background: rgba(224,90,78,.1); border: 1px solid rgba(224,90,78,.3);
            padding: .75rem 1rem; margin-bottom: 1.5rem;
            font-family: var(--ff-mono); font-size: .75rem; color: var(--red);
        }
    </style>
</head>
<body>
<div class="login-wrapper">
    <div class="login-logo">TBW.</div>
    <div class="login-sub">Admin Panel</div>

    <div class="login-card">
        <h1>// Sign In</h1>

        @if($errors->any())
        <div class="alert-error">{{ $errors->first() }}</div>
        @endif

        @if(session('success'))
        <div style="background:rgba(107,203,119,.1);border:1px solid rgba(107,203,119,.3);padding:.75rem 1rem;margin-bottom:1.5rem;font-family:var(--ff-mono);font-size:.75rem;color:var(--green);">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email') <span class="error-msg">{{ $message }}</span> @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required autocomplete="current-password">
                @error('password') <span class="error-msg">{{ $message }}</span> @enderror
            </div>
            <div class="form-remember">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
            </div>
            <button type="submit" class="btn-login">Login →</button>
        </form>

        <a href="{{ route('portfolio') }}" class="back-link">← Kembali ke Portfolio</a>
    </div>
</div>
</body>
</html>
