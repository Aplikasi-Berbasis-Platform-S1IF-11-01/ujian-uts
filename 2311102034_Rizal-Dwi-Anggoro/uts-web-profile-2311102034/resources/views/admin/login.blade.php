<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&family=DM+Mono&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #0a0a08; --bg2: #141412; --bg3: #1c1c1a;
            --ink: #f0ebe3; --ink2: #9a9590; --ink3: #4a4845;
            --gold: #c9a84c; --gold2: #e8c97a;
            --border: rgba(201,168,76,0.15); --border2: rgba(255,255,255,0.06);
            --danger: #d44;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background: var(--bg);
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        body::before {
            content: 'ADMIN';
            position: absolute;
            font-family: 'Playfair Display', serif;
            font-size: 20rem;
            font-weight: 700;
            color: transparent;
            -webkit-text-stroke: 1px rgba(201,168,76,0.04);
            pointer-events: none;
            user-select: none;
        }
        .card {
            background: var(--bg2);
            border: 1px solid var(--border);
            padding: 3rem;
            width: 400px;
            max-width: 95vw;
            position: relative;
            z-index: 1;
        }
        .card::before {
            content: '';
            position: absolute; top: -6px; right: -6px;
            width: 40px; height: 40px;
            border-top: 2px solid var(--gold);
            border-right: 2px solid var(--gold);
        }
        .card::after {
            content: '';
            position: absolute; bottom: -6px; left: -6px;
            width: 40px; height: 40px;
            border-bottom: 2px solid rgba(201,168,76,0.3);
            border-left: 2px solid rgba(201,168,76,0.3);
        }
        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--gold);
            margin-bottom: 0.5rem;
        }
        .subtitle {
            font-family: 'DM Mono', monospace;
            font-size: 0.72rem;
            color: var(--ink3);
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 2.5rem;
        }
        .form-group { margin-bottom: 1.25rem; }
        label {
            display: block;
            font-family: 'DM Mono', monospace;
            font-size: 0.72rem;
            color: var(--ink2);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }
        input {
            width: 100%;
            background: var(--bg3);
            border: 1px solid var(--border2);
            color: var(--ink);
            padding: 0.8rem 1rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s;
        }
        input:focus { border-color: var(--gold); }
        .btn {
            width: 100%;
            background: var(--gold);
            color: #1a1207;
            border: none;
            padding: 0.9rem;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-top: 1.5rem;
            transition: background 0.2s;
        }
        .btn:hover { background: var(--gold2); }
        .error {
            background: rgba(221,68,68,0.1);
            border: 1px solid rgba(221,68,68,0.3);
            color: var(--danger);
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: var(--ink3);
            text-decoration: none;
            font-size: 0.8rem;
            font-family: 'DM Mono', monospace;
            letter-spacing: 0.08em;
            transition: color 0.2s;
        }
        .back-link:hover { color: var(--gold); }
    </style>
</head>
<body>
    <div class="card">
        <div class="logo">Admin Panel</div>
        <div class="subtitle">Portfolio Management System</div>

        @if($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/admin/login">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Masuk →</button>
        </form>

        <a href="/" class="back-link">← Kembali ke Portfolio</a>
    </div>
</body>
</html>