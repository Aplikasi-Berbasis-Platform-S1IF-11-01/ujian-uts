<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .sidebar {
            min-height: 100vh;
            background: #1b4332;
            width: 250px;
            position: fixed;
            top: 0; left: 0;
            padding-top: 20px;
        }
        .sidebar .brand { color: white; font-size: 1.2rem; font-weight: bold; padding: 15px 20px; border-bottom: 1px solid #2d6a4f; margin-bottom: 10px; }
        .sidebar a { color: #b7e4c7; display: block; padding: 10px 20px; text-decoration: none; border-radius: 8px; margin: 2px 10px; }
        .sidebar a:hover, .sidebar a.active { background: #2d6a4f; color: white; }
        .main-content { margin-left: 250px; padding: 30px; }
        .topbar { background: white; padding: 15px 30px; margin: -30px -30px 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); display: flex; justify-content: space-between; align-items: center; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="brand">⚡ Admin Panel</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        <a href="{{ route('admin.profile.edit') }}" class="{{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
            <i class="bi bi-person me-2"></i> Profile
        </a>
        <a href="{{ route('admin.skills.index') }}" class="{{ request()->routeIs('admin.skills.*') ? 'active' : '' }}">
            <i class="bi bi-lightning me-2"></i> Skills
        </a>
        <a href="{{ route('admin.projects.index') }}" class="{{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            <i class="bi bi-folder me-2"></i> Projects
        </a>
        <a href="{{ route('admin.educations.index') }}" class="{{ request()->routeIs('admin.educations.*') ? 'active' : '' }}">
            <i class="bi bi-mortarboard me-2"></i> Education
        </a>
        <a href="{{ route('admin.organizations.index') }}" class="{{ request()->routeIs('admin.organizations.*') ? 'active' : '' }}">
            <i class="bi bi-people me-2"></i> Organisasi
        </a>
        <hr style="border-color:#2d6a4f">
        <a href="{{ url('/') }}" target="_blank">
            <i class="bi bi-eye me-2"></i> Lihat Portfolio
        </a>
    </div>

    <div class="main-content">
        <div class="topbar">
            <h5 class="mb-0 fw-bold">@yield('title')</h5>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>