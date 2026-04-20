<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin – @yield('title', 'Dashboard') | Portfolio Nuha</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --rose:       #c8728a;
      --rose-mid:   #d98ca0;
      --rose-light: #f0c8d4;
      --rose-pale:  #fdf0f4;
      --blush:      #f7e8ed;
      --cream:      #fdf9f7;
      --text-dark:  #2d1a22;
      --text-mid:   #6b4050;
      --text-soft:  #9e7080;
      --border:     #edd8e0;
      --white:      #ffffff;
      --sidebar-w:  240px;
      --danger:     #e05555;
      --success:    #5daa7a;
    }
    body { font-family: 'DM Sans', sans-serif; background: var(--cream); display: flex; min-height: 100vh; color: var(--text-dark); }

    /* ─── Sidebar ─── */
    .sidebar {
      width: var(--sidebar-w); background: var(--text-dark);
      min-height: 100vh; position: fixed; left: 0; top: 0; bottom: 0;
      display: flex; flex-direction: column; z-index: 50;
    }
    .sidebar-brand {
      padding: 28px 24px 20px;
      border-bottom: 1px solid rgba(255,255,255,0.08);
    }
    .brand-logo {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.4rem; font-weight: 600;
      color: var(--rose-mid); letter-spacing: 0.05em;
    }
    .brand-sub {
      font-size: 0.6rem; letter-spacing: 0.2em;
      text-transform: uppercase; color: rgba(255,255,255,0.3);
      margin-top: 3px;
    }
    .sidebar-nav { flex: 1; padding: 16px 12px; }
    .nav-group-label {
      font-size: 0.55rem; letter-spacing: 0.25em;
      text-transform: uppercase; color: rgba(255,255,255,0.25);
      padding: 8px 12px 4px; margin-top: 12px;
    }
    .nav-link {
      display: flex; align-items: center; gap: 10px;
      padding: 10px 12px; border-radius: 10px;
      color: rgba(255,255,255,0.6); text-decoration: none;
      font-size: 0.82rem; font-weight: 500;
      transition: all 0.2s; margin-bottom: 2px;
    }
    .nav-link:hover { background: rgba(255,255,255,0.06); color: var(--rose-light); }
    .nav-link.active { background: rgba(200,114,138,0.2); color: var(--rose-mid); }
    .nav-link .icon { font-size: 1rem; width: 20px; text-align: center; }

    .sidebar-footer {
      padding: 16px 12px 20px;
      border-top: 1px solid rgba(255,255,255,0.08);
    }
    .sidebar-user {
      display: flex; align-items: center; gap: 10px;
      padding: 10px 12px; border-radius: 10px; margin-bottom: 8px;
    }
    .user-avatar {
      width: 32px; height: 32px; border-radius: 50%;
      background: var(--rose); display: flex; align-items: center;
      justify-content: center; font-size: 0.9rem; color: white; font-weight: 600;
      flex-shrink: 0;
    }
    .user-name { font-size: 0.78rem; color: rgba(255,255,255,0.7); font-weight: 500; }
    .btn-logout {
      display: flex; align-items: center; gap: 8px;
      width: 100%; padding: 9px 12px; border-radius: 8px;
      background: rgba(224,85,85,0.12); border: 1px solid rgba(224,85,85,0.25);
      color: #ff8080; font-size: 0.78rem; cursor: pointer;
      transition: all 0.2s; text-decoration: none;
    }
    .btn-logout:hover { background: rgba(224,85,85,0.2); }

    /* ─── Main ─── */
    .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
    .topbar {
      background: var(--white); border-bottom: 1px solid var(--border);
      padding: 0 36px; height: 64px;
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 40;
    }
    .topbar-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.4rem; font-weight: 600; color: var(--text-dark);
    }
    .topbar-actions { display: flex; gap: 10px; align-items: center; }
    .btn-preview {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 8px 18px; border-radius: 30px;
      background: var(--rose-pale); border: 1px solid var(--rose-light);
      color: var(--rose); font-size: 0.75rem; font-weight: 600;
      text-decoration: none; transition: all 0.2s;
    }
    .btn-preview:hover { background: var(--rose); color: white; border-color: var(--rose); }

    .content { flex: 1; padding: 36px; }

    /* ─── Alerts ─── */
    .alert {
      padding: 12px 18px; border-radius: 10px; margin-bottom: 20px;
      font-size: 0.82rem; display: flex; align-items: center; gap: 8px;
    }
    .alert-success { background: #edf7f1; border: 1px solid #b8e2c8; color: #2d7a4e; }
    .alert-error   { background: #fef0f0; border: 1px solid #f0c0c0; color: #8b2020; }

    /* ─── Cards ─── */
    .card {
      background: var(--white); border: 1px solid var(--border);
      border-radius: 16px; padding: 28px; margin-bottom: 20px;
    }
    .card-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.2rem; font-weight: 600; color: var(--text-dark);
      margin-bottom: 20px; padding-bottom: 14px;
      border-bottom: 1px solid var(--border);
    }

    /* ─── Forms ─── */
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    .form-group { margin-bottom: 16px; }
    .form-group.full { grid-column: 1 / -1; }
    label { display: block; font-size: 0.72rem; font-weight: 600; color: var(--text-mid); margin-bottom: 5px; letter-spacing: 0.05em; text-transform: uppercase; }
    input[type=text], input[type=email], input[type=password], input[type=number],
    select, textarea {
      width: 100%; padding: 10px 14px;
      border: 1px solid var(--border); border-radius: 10px;
      font-family: 'DM Sans', sans-serif; font-size: 0.85rem;
      color: var(--text-dark); background: var(--cream);
      transition: border-color 0.2s, box-shadow 0.2s;
      outline: none;
    }
    input:focus, select:focus, textarea:focus {
      border-color: var(--rose-mid);
      box-shadow: 0 0 0 3px rgba(200,114,138,0.1);
    }
    textarea { resize: vertical; min-height: 100px; }

    /* ─── Buttons ─── */
    .btn {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 10px 22px; border-radius: 30px;
      font-size: 0.8rem; font-weight: 600; cursor: pointer;
      border: none; transition: all 0.2s; text-decoration: none;
      letter-spacing: 0.02em;
    }
    .btn-primary { background: var(--rose); color: white; }
    .btn-primary:hover { background: #b06078; }
    .btn-outline { background: transparent; border: 1px solid var(--border); color: var(--text-mid); }
    .btn-outline:hover { border-color: var(--rose-mid); color: var(--rose); }
    .btn-danger { background: #fef0f0; border: 1px solid #f0c0c0; color: var(--danger); }
    .btn-danger:hover { background: var(--danger); color: white; border-color: var(--danger); }
    .btn-sm { padding: 6px 14px; font-size: 0.72rem; }

    /* ─── Table ─── */
    .table-wrap { overflow-x: auto; }
    table { width: 100%; border-collapse: collapse; }
    th {
      text-align: left; font-size: 0.65rem; font-weight: 700;
      letter-spacing: 0.15em; text-transform: uppercase;
      color: var(--text-soft); padding: 12px 16px;
      border-bottom: 1px solid var(--border);
    }
    td {
      padding: 14px 16px; font-size: 0.82rem;
      color: var(--text-mid); border-bottom: 1px solid var(--border);
      vertical-align: middle;
    }
    tr:last-child td { border-bottom: none; }
    tr:hover td { background: var(--rose-pale); }

    /* ─── Toggle / Badge ─── */
    .badge {
      display: inline-block; padding: 3px 10px; border-radius: 20px;
      font-size: 0.65rem; font-weight: 600; letter-spacing: 0.05em;
    }
    .badge-active { background: #edf7f1; color: #2d7a4e; }
    .badge-inactive { background: #f5f5f5; color: #999; }

    /* ─── Stats (dashboard) ─── */
    .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 28px; }
    .stat-card {
      background: var(--white); border: 1px solid var(--border);
      border-radius: 14px; padding: 22px 24px; position: relative; overflow: hidden;
    }
    .stat-card::after {
      content: ''; position: absolute;
      bottom: 0; left: 0; right: 0; height: 3px;
      background: linear-gradient(90deg, var(--rose), var(--rose-mid));
    }
    .stat-num {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.5rem; font-weight: 600; color: var(--text-dark); line-height: 1;
    }
    .stat-label { font-size: 0.72rem; color: var(--text-soft); margin-top: 4px; text-transform: uppercase; letter-spacing: 0.1em; }
    .stat-icon { font-size: 1.8rem; position: absolute; right: 20px; top: 20px; opacity: 0.15; }

    /* ─── Modal ─── */
    .modal-overlay {
      position: fixed; inset: 0; z-index: 200;
      background: rgba(45,26,34,0.5); backdrop-filter: blur(4px);
      display: none; align-items: center; justify-content: center;
    }
    .modal-overlay.open { display: flex; }
    .modal {
      background: var(--white); border-radius: 20px;
      width: 100%; max-width: 560px; max-height: 90vh;
      overflow-y: auto; padding: 32px;
      box-shadow: 0 30px 80px rgba(0,0,0,0.2);
      animation: modalIn 0.25s ease;
    }
    @keyframes modalIn {
      from { opacity: 0; transform: scale(0.96) translateY(10px); }
      to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .modal-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.4rem; font-weight: 600; margin-bottom: 24px;
      padding-bottom: 14px; border-bottom: 1px solid var(--border);
      display: flex; justify-content: space-between; align-items: center;
    }
    .modal-close {
      cursor: pointer; color: var(--text-soft); font-size: 1.2rem;
      transition: color 0.2s; background: none; border: none;
    }
    .modal-close:hover { color: var(--text-dark); }

    /* ─── Responsive ─── */
    @media (max-width: 900px) {
      .sidebar { display: none; }
      .main { margin-left: 0; }
      .stats-grid { grid-template-columns: repeat(2, 1fr); }
      .form-grid { grid-template-columns: 1fr; }
    }
  </style>
  @stack('styles')
</head>
<body>
<!-- Sidebar -->
<aside class="sidebar">
  <div class="sidebar-brand">
    <div class="brand-logo">B · N · Z · K</div>
    <div class="brand-sub">Admin Panel</div>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-group-label">Menu</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <span class="icon">🏠</span> Dashboard
    </a>
    <a href="{{ route('admin.profile') }}" class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
      <span class="icon">👤</span> Profil & Foto
    </a>
    <a href="{{ route('admin.skills') }}" class="nav-link {{ request()->routeIs('admin.skills') ? 'active' : '' }}">
      <span class="icon">💡</span> Keahlian
    </a>
    <a href="{{ route('admin.education') }}" class="nav-link {{ request()->routeIs('admin.education') ? 'active' : '' }}">
      <span class="icon">🎓</span> Pendidikan
    </a>
    <a href="{{ route('admin.experience') }}" class="nav-link {{ request()->routeIs('admin.experience') ? 'active' : '' }}">
      <span class="icon">💼</span> Pengalaman
    </a>
    <a href="{{ route('admin.projects') }}" class="nav-link {{ request()->routeIs('admin.projects') ? 'active' : '' }}">
      <span class="icon">🚀</span> Proyek
    </a>
    <div class="nav-group-label">Sistem</div>
    <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
      <span class="icon">⚙</span> Pengaturan
    </a>
  </nav>
  <div class="sidebar-footer">
    <div class="sidebar-user">
      <div class="user-avatar">N</div>
      <div class="user-name">{{ session('admin_username', 'Admin') }}</div>
    </div>
    <form action="{{ route('admin.logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn-logout">⎋ Logout</button>
    </form>
  </div>
</aside>

<!-- Main Content -->
<div class="main">
  <div class="topbar">
    <div class="topbar-title">@yield('title', 'Dashboard')</div>
    <div class="topbar-actions">
      <a href="{{ route('home') }}" target="_blank" class="btn-preview">↗ Lihat Portfolio</a>
    </div>
  </div>
  <div class="content">
    @if(session('success'))
      <div class="alert alert-success">✓ {{ session('success') }}</div>
    @endif
    @if(session('error') || $errors->has('login'))
      <div class="alert alert-error">✗ {{ session('error') ?? $errors->first('login') }}</div>
    @endif
    @yield('content')
  </div>
</div>

<script>
/* ── Global helpers tersedia di semua halaman admin ── */
function openModal(id) {
  const el = document.getElementById(id);
  if (el) { el.style.display = 'flex'; requestAnimationFrame(() => el.classList.add('open')); }
}
function closeModal(id) {
  const el = document.getElementById(id);
  if (el) { el.classList.remove('open'); setTimeout(() => { if (!el.classList.contains('open')) el.style.display = 'none'; }, 200); }
}
function submitDelete(action) {
  if (!confirm('Yakin ingin menghapus data ini? Tindakan tidak bisa dibatalkan.')) return;
  const f = document.createElement('form');
  f.method = 'POST'; f.action = action;
  f.innerHTML = `<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="DELETE">`;
  document.body.appendChild(f); f.submit();
}
// Tutup modal saat klik overlay
document.addEventListener('click', function(e) {
  if (e.target.classList.contains('modal-overlay')) closeModal(e.target.id);
});
</script>
@stack('scripts')
</body>
</html>