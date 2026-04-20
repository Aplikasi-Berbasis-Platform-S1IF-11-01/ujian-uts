<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Admin Login — Portfolio</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
* { margin:0; padding:0; box-sizing:border-box; }
body {
    font-family:'Plus Jakarta Sans',sans-serif;
    min-height:100vh;
    background:linear-gradient(135deg, #FFF0F5 0%, #F5F0FF 50%, #F0FFFA 100%);
    display:flex; align-items:center; justify-content:center;
}
.card {
    background:rgba(255,255,255,0.85);
    backdrop-filter:blur(12px);
    border-radius:24px; padding:48px 40px;
    box-shadow:0 16px 48px rgba(155,126,200,0.18);
    width:100%; max-width:420px;
    border:1px solid rgba(232,142,168,0.2);
}
.card-logo {
    font-family:'Playfair Display',serif;
    font-size:1.8rem; color:#E88EA8; text-align:center;
    margin-bottom:6px;
}
.card-sub { text-align:center; font-size:0.875rem; color:#8C7FA0; margin-bottom:32px; }
.form-label { font-size:0.82rem; font-weight:600; color:#5A4E6A; margin-bottom:6px; display:block; }
.form-input {
    width:100%; padding:12px 16px; border-radius:12px;
    border:2px solid rgba(232,142,168,0.25);
    background:rgba(255,255,255,0.8);
    font-family:inherit; font-size:0.9rem; color:#2D2438;
    transition:border-color 0.2s; margin-bottom:18px; outline:none;
}
.form-input:focus { border-color:#E88EA8; }
.btn {
    width:100%; padding:13px;
    background:linear-gradient(135deg,#E88EA8,#9B7EC8);
    color:white; border:none; border-radius:12px;
    font-size:0.95rem; font-weight:600; cursor:pointer;
    font-family:inherit; transition:opacity 0.2s;
}
.btn:hover { opacity:0.9; }
.error {
    background:#FFEEF2; color:#C0516B;
    border-radius:10px; padding:10px 14px;
    font-size:0.85rem; margin-bottom:18px;
    border:1px solid rgba(192,81,107,0.2);
}
.back-link {
    display:block; text-align:center; margin-top:20px;
    font-size:0.83rem; color:#9B7EC8; text-decoration:none;
}
.back-link:hover { text-decoration:underline; }
</style>
</head>
<body>
<div class="card">
    <div class="card-logo">✦ Admin</div>
    <p class="card-sub">Masuk ke dashboard portfolio kamu</p>

    @if($errors->any())
    <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <label class="form-label">Email</label>
        <input class="form-input" type="email" name="email" value="{{ old('email') }}" placeholder="admin@portfolio.com" required autofocus>

        <label class="form-label">Password</label>
        <input class="form-input" type="password" name="password" placeholder="••••••••" required>

        <button class="btn" type="submit">Masuk 🌸</button>
    </form>

    <a href="/" class="back-link">← Kembali ke portfolio</a>
</div>
</body>
</html>
