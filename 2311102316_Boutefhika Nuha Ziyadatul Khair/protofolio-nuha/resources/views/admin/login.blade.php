<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login – Portfolio Nuha</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,600;1,400&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --rose: #c8728a; --rose-mid: #d98ca0; --rose-light: #f0c8d4;
      --rose-pale: #fdf0f4; --blush: #f7e8ed; --cream: #fdf9f7;
      --text-dark: #2d1a22; --text-mid: #6b4050; --border: #edd8e0;
    }
    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--cream); min-height: 100vh;
      display: flex; align-items: center; justify-content: center;
      padding: 20px;
    }
    .login-wrap {
      display: grid; grid-template-columns: 1fr 1fr;
      max-width: 860px; width: 100%;
      background: white; border-radius: 24px; overflow: hidden;
      box-shadow: 0 30px 80px rgba(45,26,34,0.12);
    }
    .login-art {
      background: linear-gradient(145deg, #2d1a22 0%, #5a2a38 100%);
      padding: 60px 48px;
      display: flex; flex-direction: column; justify-content: center;
      position: relative; overflow: hidden;
    }
    .login-art::before {
      content: ''; position: absolute; inset: 0;
      background: radial-gradient(ellipse at 80% 20%, rgba(200,114,138,0.3), transparent 60%);
    }
    .art-content { position: relative; z-index: 1; }
    .art-logo {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.2rem; font-weight: 300;
      color: var(--rose-light); letter-spacing: 0.1em;
      margin-bottom: 12px;
    }
    .art-logo em { font-style: italic; color: var(--rose-mid); }
    .art-tagline {
      font-size: 0.75rem; letter-spacing: 0.2em;
      text-transform: uppercase; color: rgba(255,255,255,0.35);
      margin-bottom: 40px;
    }
    .art-decoration {
      font-family: 'Cormorant Garamond', serif;
      font-size: 5rem; font-weight: 300;
      color: rgba(200,114,138,0.12);
      line-height: 1; position: absolute; bottom: 40px; right: 40px;
    }
    .login-form-wrap { padding: 60px 48px; }
    .form-brand {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.8rem; font-weight: 600; color: var(--text-dark);
      margin-bottom: 6px;
    }
    .form-sub { font-size: 0.8rem; color: #9e7080; margin-bottom: 36px; }
    .alert {
      padding: 12px 16px; border-radius: 10px; margin-bottom: 20px;
      font-size: 0.8rem;
    }
    .alert-error { background: #fef0f0; border: 1px solid #f0c0c0; color: #8b2020; }
    .form-group { margin-bottom: 18px; }
    label { display: block; font-size: 0.7rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: var(--text-mid); margin-bottom: 6px; }
    input {
      width: 100%; padding: 12px 16px;
      border: 1px solid var(--border); border-radius: 12px;
      font-family: 'DM Sans', sans-serif; font-size: 0.88rem;
      background: var(--cream); color: var(--text-dark);
      outline: none; transition: all 0.2s;
    }
    input:focus { border-color: var(--rose-mid); box-shadow: 0 0 0 3px rgba(200,114,138,0.1); }
    .btn-login {
      width: 100%; padding: 13px;
      background: var(--rose); color: white;
      border: none; border-radius: 30px;
      font-family: 'DM Sans', sans-serif;
      font-size: 0.85rem; font-weight: 600;
      cursor: pointer; transition: all 0.2s;
      margin-top: 8px; letter-spacing: 0.05em;
    }
    .btn-login:hover { background: #b06078; transform: translateY(-1px); }
    .back-link {
      display: block; text-align: center; margin-top: 18px;
      font-size: 0.76rem; color: #9e7080; text-decoration: none;
      transition: color 0.2s;
    }
    .back-link:hover { color: var(--rose); }
    .hint {
      margin-top: 20px; padding: 12px 16px;
      background: var(--rose-pale); border-radius: 10px;
      font-size: 0.72rem; color: #9e7080; line-height: 1.6;
    }
    @media (max-width: 640px) {
      .login-wrap { grid-template-columns: 1fr; }
      .login-art { display: none; }
      .login-form-wrap { padding: 40px 28px; }
    }
  </style>
</head>
<body>
<div class="login-wrap">
  <div class="login-art">
    <div class="art-content">
      <div class="art-logo">N · <em>Z</em> · K</div>
      <div class="art-tagline">Portfolio Admin Panel</div>
      <p style="font-size:0.83rem;color:rgba(255,255,255,0.4);line-height:1.7">
        Masuk untuk mengelola konten portofolio.<br>
        Ubah profil, skill, proyek, dan lebih banyak lagi.
      </p>
    </div>
    <div class="art-decoration">✦</div>
  </div>
  <div class="login-form-wrap">
    <div class="form-brand">Selamat Datang</div>
    <div class="form-sub">Masuk ke panel admin portofolio</div>

    @if($errors->has('login'))
      <div class="alert alert-error">✗ {{ $errors->first('login') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
      @csrf
      <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" value="{{ old('username') }}" placeholder="admin" autocomplete="username" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="••••••••" autocomplete="current-password" required>
      </div>
      <button type="submit" class="btn-login">Masuk ke Dashboard →</button>
    </form>
    <a href="{{ route('home') }}" class="back-link">← Kembali ke Portofolio</a>
    <div class="hint">
      Default login: <strong>admin</strong> / <strong>admin123</strong><br>
      Ganti password setelah pertama login di menu Pengaturan.
    </div>
  </div>
</div>
</body>
</html>