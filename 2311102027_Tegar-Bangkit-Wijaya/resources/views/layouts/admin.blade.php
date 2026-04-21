<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Admin Panel</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --sidebar-w: 240px;
            --bg:     #f8f7f5;
            --bg2:    #ffffff;
            --sidebar: #0e0e0e;
            --border: #e8e5e0;
            --text:   #1a1a1a;
            --muted:  #888880;
            --accent: #c8a96e;
            --accent2:#e0bf86;
            --red:    #e05a4e;
            --green:  #4caf74;
            --ff-mono:'Space Mono', monospace;
            --ff-body:'Inter', sans-serif;
        }
        body { background: var(--bg); color: var(--text); font-family: var(--ff-body); display: flex; min-height: 100vh; }

        /* ── Sidebar ─────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w); background: var(--sidebar); position: fixed;
            top: 0; left: 0; bottom: 0; z-index: 100;
            display: flex; flex-direction: column; padding: 0;
            border-right: 1px solid rgba(255,255,255,.05);
        }
        .sidebar-logo {
            padding: 1.75rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,.05);
        }
        .sidebar-logo-mark {
            font-family: var(--ff-mono); font-size: 1rem; color: var(--accent);
            letter-spacing: .05em; display: block;
        }
        .sidebar-logo-sub {
            font-family: var(--ff-mono); font-size: .6rem; color: rgba(255,255,255,.25);
            letter-spacing: .2em; text-transform: uppercase; margin-top: .2rem;
        }
        .sidebar-nav { flex: 1; padding: 1.5rem 0; }
        .nav-section-label {
            font-family: var(--ff-mono); font-size: .6rem; color: rgba(255,255,255,.2);
            letter-spacing: .25em; text-transform: uppercase;
            padding: 0 1.5rem; margin-bottom: .5rem; margin-top: 1rem;
        }
        .nav-section-label:first-child { margin-top: 0; }
        .sidebar-link {
            display: flex; align-items: center; gap: .75rem;
            padding: .65rem 1.5rem; color: rgba(255,255,255,.45);
            text-decoration: none; font-size: .85rem;
            transition: all .15s; position: relative;
        }
        .sidebar-link:hover { color: rgba(255,255,255,.85); background: rgba(255,255,255,.04); }
        .sidebar-link.active { color: var(--accent); background: rgba(200,169,110,.08); }
        .sidebar-link.active::before {
            content: ''; position: absolute; left: 0; top: 0; bottom: 0;
            width: 2px; background: var(--accent);
        }
        .sidebar-link svg { width: 16px; height: 16px; flex-shrink: 0; }
        .sidebar-footer {
            padding: 1.25rem 1.5rem; border-top: 1px solid rgba(255,255,255,.05);
        }
        .admin-badge {
            font-family: var(--ff-mono); font-size: .7rem; color: rgba(255,255,255,.3);
            margin-bottom: .75rem; letter-spacing: .05em;
        }
        .admin-badge span { color: rgba(255,255,255,.6); display: block; font-size: .8rem; }
        .logout-form button {
            width: 100%; padding: .5rem; background: none;
            border: 1px solid rgba(255,255,255,.1); color: rgba(255,255,255,.35);
            font-family: var(--ff-mono); font-size: .65rem; letter-spacing: .1em;
            text-transform: uppercase; cursor: pointer; transition: all .2s;
        }
        .logout-form button:hover { border-color: var(--red); color: var(--red); }

        /* ── Main content ────────────────────────── */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }
        .topbar {
            background: var(--bg2); border-bottom: 1px solid var(--border);
            padding: 1rem 2rem; display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }
        .topbar-title {
            font-family: var(--ff-mono); font-size: .85rem; color: var(--text);
            font-weight: 700; letter-spacing: .02em;
        }
        .topbar-breadcrumb {
            font-family: var(--ff-mono); font-size: .7rem; color: var(--muted);
            letter-spacing: .05em;
        }
        .topbar-breadcrumb a { color: var(--accent); text-decoration: none; }
        .view-site-btn {
            display: flex; align-items: center; gap: .5rem;
            font-family: var(--ff-mono); font-size: .7rem; color: var(--muted);
            text-decoration: none; letter-spacing: .05em; padding: .4rem .8rem;
            border: 1px solid var(--border); transition: all .2s;
        }
        .view-site-btn:hover { color: var(--accent); border-color: var(--accent); }
        .content { padding: 2rem; flex: 1; }

        /* ── Toast ───────────────────────────────── */
        #admin-toast {
            position: fixed; bottom: 2rem; right: 2rem; z-index: 9999;
            padding: .875rem 1.5rem; font-family: var(--ff-mono); font-size: .8rem;
            border-left: 3px solid var(--green); background: white;
            box-shadow: 0 8px 30px rgba(0,0,0,.12);
            transform: translateY(100px); opacity: 0;
            transition: all .3s ease; max-width: 320px;
        }
        #admin-toast.show { transform: translateY(0); opacity: 1; }
        #admin-toast.error { border-color: var(--red); color: var(--red); }
        #admin-toast.success { color: var(--green); }

        /* ── Cards ───────────────────────────────── */
        .card {
            background: var(--bg2); border: 1px solid var(--border); padding: 1.5rem;
        }
        .card-title {
            font-family: var(--ff-mono); font-size: .8rem; font-weight: 700;
            color: var(--text); letter-spacing: .05em; margin-bottom: 1.5rem;
            padding-bottom: 1rem; border-bottom: 1px solid var(--border);
        }

        /* ── Forms ───────────────────────────────── */
        .form-label {
            display: block; font-family: var(--ff-mono); font-size: .65rem;
            color: var(--muted); letter-spacing: .15em; text-transform: uppercase;
            margin-bottom: .4rem;
        }
        .form-input, .form-textarea, .form-select {
            width: 100%; padding: .65rem .875rem; border: 1px solid var(--border);
            background: var(--bg); color: var(--text); font-family: var(--ff-body);
            font-size: .9rem; outline: none; transition: border-color .2s;
            border-radius: 0;
        }
        .form-input:focus, .form-textarea:focus, .form-select:focus { border-color: var(--accent); }
        .form-textarea { resize: vertical; min-height: 100px; }
        .form-group { margin-bottom: 1.25rem; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; }

        /* ── Buttons ─────────────────────────────── */
        .btn {
            display: inline-flex; align-items: center; gap: .4rem;
            padding: .6rem 1.25rem; font-family: var(--ff-mono); font-size: .75rem;
            font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
            cursor: pointer; border: none; transition: all .15s; text-decoration: none;
        }
        .btn-accent { background: var(--accent); color: #0e0e0e; }
        .btn-accent:hover { background: var(--accent2); }
        .btn-danger { background: transparent; color: var(--red); border: 1px solid var(--red); }
        .btn-danger:hover { background: var(--red); color: white; }
        .btn-ghost { background: transparent; color: var(--muted); border: 1px solid var(--border); }
        .btn-ghost:hover { border-color: var(--muted); color: var(--text); }
        .btn-sm { padding: .35rem .75rem; font-size: .65rem; }

        /* ── Table ───────────────────────────────── */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th {
            font-family: var(--ff-mono); font-size: .65rem; color: var(--muted);
            letter-spacing: .15em; text-transform: uppercase; font-weight: 400;
            text-align: left; padding: .75rem 1rem; border-bottom: 1px solid var(--border);
        }
        .data-table td { padding: .875rem 1rem; border-bottom: 1px solid var(--border); font-size: .875rem; }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: var(--bg); }

        /* ── Modal ───────────────────────────────── */
        .modal-overlay {
            position: fixed; inset: 0; background: rgba(0,0,0,.5);
            z-index: 200; display: none; align-items: center; justify-content: center;
            padding: 2rem;
        }
        .modal-overlay.open { display: flex; }
        .modal {
            background: var(--bg2); border: 1px solid var(--border);
            width: 100%; max-width: 560px; max-height: 90vh; overflow-y: auto;
        }
        .modal-header {
            padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .modal-title { font-family: var(--ff-mono); font-size: .85rem; font-weight: 700; }
        .modal-close {
            background: none; border: none; color: var(--muted); cursor: pointer;
            font-size: 1.2rem; line-height: 1; padding: .25rem;
            transition: color .2s;
        }
        .modal-close:hover { color: var(--text); }
        .modal-body { padding: 1.5rem; }
        .modal-footer {
            padding: 1rem 1.5rem; border-top: 1px solid var(--border);
            display: flex; justify-content: flex-end; gap: .75rem;
        }

        /* ── Badges ──────────────────────────────── */
        .badge {
            display: inline-block; padding: .2rem .5rem;
            font-family: var(--ff-mono); font-size: .6rem;
            letter-spacing: .08em; text-transform: uppercase;
            border: 1px solid;
        }
        .badge-green { color: var(--green); border-color: var(--green); background: rgba(76,175,116,.08); }
        .badge-amber { color: var(--accent); border-color: var(--accent); background: rgba(200,169,110,.08); }
        .badge-gray  { color: var(--muted); border-color: var(--border); }

        /* ── Skill level bar ─────────────────────── */
        .level-bar {
            height: 4px; background: var(--border); width: 100px; display: inline-block; vertical-align: middle;
        }
        .level-fill { height: 100%; background: var(--accent); }

        /* ── Range input ─────────────────────────── */
        input[type="range"] {
            -webkit-appearance: none; width: 100%; height: 4px;
            background: var(--border); outline: none;
        }
        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none; width: 16px; height: 16px;
            background: var(--accent); cursor: pointer; border-radius: 50%;
        }
        .range-value {
            font-family: var(--ff-mono); font-size: .8rem; color: var(--accent);
            margin-left: .5rem;
        }

        /* ── Stat card ───────────────────────────── */
        .stat-card {
            background: var(--bg2); border: 1px solid var(--border);
            padding: 1.5rem; display: flex; align-items: flex-end; justify-content: space-between;
        }
        .stat-card-num {
            font-family: var(--ff-mono); font-size: 2.5rem; font-weight: 700;
            color: var(--accent); line-height: 1;
        }
        .stat-card-label {
            font-family: var(--ff-mono); font-size: .65rem; color: var(--muted);
            letter-spacing: .15em; text-transform: uppercase; margin-top: .3rem;
        }
        .stat-card-icon { color: var(--border); }
        .stat-card-icon svg { width: 2rem; height: 2rem; }

        /* ── Checkbox ───────────────────────────── */
        .form-check { display: flex; align-items: center; gap: .5rem; }
        .form-check input[type="checkbox"] { width: 16px; height: 16px; accent-color: var(--accent); }
        .form-check label { margin: 0; font-size: .85rem; color: var(--text); font-family: var(--ff-body); }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main { margin-left: 0; }
            .form-grid, .form-grid-3 { grid-template-columns: 1fr; }
        }
    </style>
    @stack('styles')
</head>
<body>
<!-- Sidebar -->
<aside class="sidebar">
    <div class="sidebar-logo">
        <span class="sidebar-logo-mark">TBW.</span>
        <span class="sidebar-logo-sub">Admin Panel</span>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section-label">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Dashboard
        </a>
        <div class="nav-section-label">Content</div>
        <a href="{{ route('admin.profile.edit') }}" class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            Profil
        </a>
        <a href="{{ route('admin.skills.index') }}" class="sidebar-link {{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
            Skills
        </a>
        <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
            Projects
        </a>
        <a href="{{ route('admin.experiences.index') }}" class="sidebar-link {{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
            Pengalaman
        </a>
        <div class="nav-section-label">Site</div>
        <a href="{{ route('portfolio') }}" target="_blank" class="sidebar-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            Lihat Portfolio
        </a>
    </nav>
    <div class="sidebar-footer">
        <div class="admin-badge">
            Logged in as<span>{{ Auth::guard('admin')->user()->name }}</span>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}" class="logout-form">
            @csrf
            <button type="submit">Logout →</button>
        </form>
    </div>
</aside>

<!-- Main -->
<div class="main">
    <div class="topbar">
        <div>
            <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
            <div class="topbar-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Admin</a> / @yield('breadcrumb', 'Dashboard')
            </div>
        </div>
        <a href="{{ route('portfolio') }}" target="_blank" class="view-site-btn">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            View Site
        </a>
    </div>

    <div class="content">
        @yield('content')
    </div>
</div>

<div id="admin-toast"></div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

function toast(msg, type = 'success') {
    const el = document.getElementById('admin-toast');
    el.textContent = msg;
    el.className   = `show ${type}`;
    setTimeout(() => el.className = '', 3500);
}

async function ajaxPost(url, data, isForm = false) {
    const opts = {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
    };
    if (isForm) {
        opts.body = data;
    } else {
        opts.headers['Content-Type'] = 'application/json';
        opts.body = JSON.stringify(data);
    }
    const res  = await fetch(url, opts);
    return res.json();
}

async function ajaxPut(url, data) {
    const body = new URLSearchParams(data);
    body.append('_method', 'PUT');
    const res = await fetch(url, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json', 'Content-Type': 'application/x-www-form-urlencoded' },
        body,
    });
    return res.json();
}

async function ajaxDelete(url) {
    const res = await fetch(url, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
    });
    return res.json();
}

function openModal(id) { document.getElementById(id).classList.add('open'); }
function closeModal(id) { document.getElementById(id).classList.remove('open'); }

document.addEventListener('click', e => {
    if (e.target.matches('.modal-overlay')) {
        e.target.classList.remove('open');
    }
});
</script>

@stack('scripts')
</body>
</html>
