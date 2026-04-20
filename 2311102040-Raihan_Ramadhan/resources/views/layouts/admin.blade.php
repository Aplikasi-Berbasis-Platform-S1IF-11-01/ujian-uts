<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin Panel — @yield('title', 'Dashboard')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Outfit:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

  <style>
:root {
  --navy:      #0a1628;
  --navy2:     #0f2040;
  --blue:      #1d6cf0;
  --blue-mid:  #2563eb;
  --blue-light:#3b82f6;
  --blue-pale: #eff6ff;
  --blue-soft: #dbeafe;
  --cyan:      #06b6d4;
  --sidebar-w: 260px;
  --font-display:'Syne',sans-serif;
  --font-body:  'Outfit',sans-serif;
  --font-mono:  'JetBrains Mono',monospace;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
body{background:#f8fafc;color:#0f172a;font-family:var(--font-body);display:flex;min-height:100vh;overflow-x:hidden}

/* ── SIDEBAR ── */
.admin-sidebar{
  width:var(--sidebar-w);position:fixed;top:0;left:0;bottom:0;
  background:var(--navy);display:flex;flex-direction:column;z-index:200;
  transition:transform .3s;
}
.sidebar-logo{
  padding:1.5rem;border-bottom:1px solid rgba(255,255,255,.07);
  font-family:var(--font-display);font-size:1.2rem;font-weight:800;
  color:#fff;display:flex;align-items:center;gap:.6rem;
}
.sidebar-logo .dot{color:var(--cyan)}
.sidebar-logo small{font-size:.62rem;font-family:var(--font-mono);color:rgba(255,255,255,.35);letter-spacing:.08em;text-transform:uppercase;display:block;margin-top:.15rem;font-weight:400}
.sidebar-nav{flex:1;padding:1rem 0;overflow-y:auto}
.sidebar-section-label{padding:.5rem 1.5rem;font-size:.62rem;font-family:var(--font-mono);letter-spacing:.15em;text-transform:uppercase;color:rgba(255,255,255,.25);margin-top:.5rem}
.sidebar-link{display:flex;align-items:center;gap:.75rem;padding:.7rem 1.5rem;color:rgba(255,255,255,.55);font-size:.88rem;font-weight:500;transition:all .2s;position:relative;margin:.1rem .75rem;border-radius:8px}
.sidebar-link:hover{color:#fff;background:rgba(255,255,255,.07)}
.sidebar-link.active{color:#fff;background:rgba(29,108,240,.35);box-shadow:inset 2px 0 0 var(--blue)}
.sidebar-link i{font-size:1rem;width:20px;text-align:center}
.sidebar-footer{padding:1rem 1.5rem;border-top:1px solid rgba(255,255,255,.07)}
.sidebar-user{display:flex;align-items:center;gap:.75rem;margin-bottom:.75rem}
.sidebar-avatar{width:36px;height:36px;border-radius:50%;background:var(--blue);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:.9rem;flex-shrink:0}
.sidebar-username{font-size:.85rem;font-weight:600;color:#fff;line-height:1.2}
.sidebar-role{font-size:.7rem;color:rgba(255,255,255,.35);font-family:var(--font-mono)}
.btn-logout{display:flex;align-items:center;gap:.5rem;width:100%;padding:.6rem 1rem;background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.2);color:rgba(239,68,68,.8);border-radius:8px;font-size:.82rem;font-weight:500;cursor:pointer;transition:all .2s}
.btn-logout:hover{background:rgba(239,68,68,.2);color:#ef4444}

/* ── MAIN ── */
.admin-main{margin-left:var(--sidebar-w);flex:1;display:flex;flex-direction:column;min-height:100vh}
.admin-topbar{background:#fff;border-bottom:1px solid #e2e8f0;padding:1rem 2rem;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:100}
.topbar-title{font-family:var(--font-display);font-size:1.1rem;font-weight:700;color:var(--navy)}
.topbar-subtitle{font-size:.78rem;color:#64748b;margin-top:.1rem}
.topbar-actions{display:flex;gap:.75rem;align-items:center}
.btn-view-site{display:inline-flex;align-items:center;gap:.4rem;font-size:.82rem;font-weight:600;padding:.5rem 1.2rem;background:var(--blue-pale);color:var(--blue-mid);border-radius:8px;border:1px solid var(--blue-soft);transition:all .2s}
.btn-view-site:hover{background:var(--blue);color:#fff}
.admin-content{padding:2rem;flex:1}

/* ── CARDS ── */
.stat-card{background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:1.5rem;transition:all .25s}
.stat-card:hover{box-shadow:0 4px 24px rgba(29,108,240,.12);border-color:#93c5fd}
.stat-icon{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;margin-bottom:1rem}
.stat-num{font-family:var(--font-display);font-size:2rem;font-weight:800;color:var(--navy);line-height:1}
.stat-label{font-size:.82rem;color:#64748b;margin-top:.3rem}

/* ── TABLE / LIST ── */
.admin-table{width:100%;border-collapse:collapse}
.admin-table th{font-size:.72rem;font-family:var(--font-mono);letter-spacing:.1em;text-transform:uppercase;color:#64748b;padding:.75rem 1rem;border-bottom:2px solid #e2e8f0;text-align:left;background:#f8fafc}
.admin-table td{padding:.9rem 1rem;border-bottom:1px solid #f1f5f9;font-size:.88rem;color:#0f172a;vertical-align:middle}
.admin-table tr:last-child td{border-bottom:none}
.admin-table tr:hover td{background:#fafbfc}

.admin-card{background:#fff;border:1px solid #e2e8f0;border-radius:16px;overflow:hidden}
.admin-card-header{padding:1.25rem 1.5rem;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between}
.admin-card-title{font-family:var(--font-display);font-size:1rem;font-weight:700;color:var(--navy);display:flex;align-items:center;gap:.5rem}

/* ── FORMS ── */
.form-label{font-size:.82rem;font-weight:600;color:#475569;margin-bottom:.4rem}
.form-control,.form-select{border:1px solid #e2e8f0;border-radius:8px;font-size:.9rem;color:#0f172a;padding:.55rem .9rem;transition:all .2s}
.form-control:focus,.form-select:focus{border-color:var(--blue);box-shadow:0 0 0 3px rgba(29,108,240,.12);outline:none}
textarea.form-control{resize:vertical;min-height:120px}

/* ── BUTTONS ── */
.btn-primary-custom{display:inline-flex;align-items:center;gap:.4rem;padding:.65rem 1.5rem;background:linear-gradient(135deg,var(--blue),var(--blue-light));color:#fff;border:none;border-radius:8px;font-weight:600;font-size:.88rem;cursor:pointer;transition:all .2s}
.btn-primary-custom:hover{transform:translateY(-1px);box-shadow:0 4px 16px rgba(29,108,240,.35)}
.btn-danger-custom{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1rem;background:#fff;color:#ef4444;border:1px solid #fecaca;border-radius:8px;font-weight:500;font-size:.82rem;cursor:pointer;transition:all .2s}
.btn-danger-custom:hover{background:#fef2f2;border-color:#ef4444}
.btn-edit-custom{display:inline-flex;align-items:center;gap:.4rem;padding:.5rem 1rem;background:var(--blue-pale);color:var(--blue-mid);border:1px solid var(--blue-soft);border-radius:8px;font-weight:500;font-size:.82rem;cursor:pointer;transition:all .2s}
.btn-edit-custom:hover{background:var(--blue);color:#fff}

/* ── RANGE SLIDER ── */
.skill-range{width:100%;accent-color:var(--blue)}

/* ── BADGE ── */
.badge-cat{font-size:.65rem;font-family:var(--font-mono);padding:.2rem .65rem;border-radius:99px;font-weight:600}
.badge-cat.frontend{background:#dbeafe;color:#1d4ed8}
.badge-cat.backend{background:#d1fae5;color:#065f46}
.badge-cat.tools{background:#fef3c7;color:#92400e}

/* ── ALERT ── */
.alert-custom{padding:.8rem 1.25rem;border-radius:8px;font-size:.88rem;margin-bottom:1rem;display:none}
.alert-success{background:#d1fae5;color:#065f46;border:1px solid #a7f3d0}
.alert-error{background:#fee2e2;color:#991b1b;border:1px solid #fecaca}

/* ── MODAL ── */
.modal-header{background:var(--navy);color:#fff}
.modal-title{font-family:var(--font-display);font-weight:700}
.modal-header .btn-close{filter:invert(1)}

/* Responsive */
@media(max-width:768px){
  .admin-sidebar{transform:translateX(-100%)}
  .admin-sidebar.open{transform:translateX(0)}
  .admin-main{margin-left:0}
}
  </style>

  @stack('styles')
</head>
<body>

{{-- SIDEBAR --}}
<aside class="admin-sidebar" id="adminSidebar">
  <div class="sidebar-logo">
    <i class="bi bi-grid-3x3-gap-fill" style="color:var(--cyan)"></i>
    <div>
      Porto Admin<span class="dot">.</span>
      <small>Dashboard Panel</small>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="sidebar-section-label">Menu Utama</div>
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="{{ route('admin.profile') }}" class="sidebar-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
      <i class="bi bi-person-circle"></i> Profil
    </a>
    <a href="{{ route('admin.education') }}" class="sidebar-link {{ request()->routeIs('admin.education') ? 'active' : '' }}">
      <i class="bi bi-mortarboard"></i> Pendidikan
    </a>
    <a href="{{ route('admin.skills') }}" class="sidebar-link {{ request()->routeIs('admin.skills') ? 'active' : '' }}">
      <i class="bi bi-lightning-charge"></i> Skills
    </a>
    <a href="{{ route('admin.projects') }}" class="sidebar-link {{ request()->routeIs('admin.projects') ? 'active' : '' }}">
      <i class="bi bi-folder2-open"></i> Proyek
    </a>

    <div class="sidebar-section-label" style="margin-top:1rem">Aksi Cepat</div>
    <a href="{{ url('/') }}" target="_blank" class="sidebar-link">
      <i class="bi bi-box-arrow-up-right"></i> Lihat Portfolio
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="sidebar-user">
      <div class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
      <div>
        <div class="sidebar-username">{{ auth()->user()->name ?? 'Admin' }}</div>
        <div class="sidebar-role">Administrator</div>
      </div>
    </div>
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" class="btn-logout">
        <i class="bi bi-box-arrow-right"></i> Keluar
      </button>
    </form>
  </div>
</aside>

{{-- MAIN --}}
<main class="admin-main">
  <div class="admin-topbar">
    <div>
      <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
      <div class="topbar-subtitle">@yield('page-subtitle', 'Kelola konten portfolio kamu')</div>
    </div>
    <div class="topbar-actions">
      <a href="{{ url('/') }}" target="_blank" class="btn-view-site">
        <i class="bi bi-eye"></i> Lihat Portfolio
      </a>
    </div>
  </div>

  <div class="admin-content">
    @yield('content')
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
var CSRF = document.querySelector('meta[name="csrf-token"]').content;

// AJAX helper
function ajaxJson(method, url, data, cb) {
  var xhr = new XMLHttpRequest();
  xhr.open(method, url, true);
  xhr.setRequestHeader('Accept', 'application/json');
  xhr.setRequestHeader('X-CSRF-TOKEN', CSRF);
  if (!(data instanceof FormData)) xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      try { cb(xhr.status, JSON.parse(xhr.responseText)); }
      catch (e) { cb(xhr.status, { success: false, message: 'Parse error' }); }
    }
  };
  xhr.send(data instanceof FormData ? data : (data ? JSON.stringify(data) : null));
}

function showAlert(id, msg, type) {
  var el = document.getElementById(id);
  if (!el) return;
  el.textContent = msg;
  el.className = 'alert-custom alert-' + type;
  el.style.display = 'block';
  setTimeout(function () { el.style.display = 'none'; }, 4000);
}

function esc(s) {
  if (!s) return '';
  return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}
</script>
@stack('scripts')
</body>
</html>