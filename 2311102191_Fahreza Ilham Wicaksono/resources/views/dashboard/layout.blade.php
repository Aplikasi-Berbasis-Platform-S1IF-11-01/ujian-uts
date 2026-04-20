<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>MyPorto | {{ $page }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='80'>👨‍🎓</text></svg>">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- phospor --}}
    <script src="https://cdn.jsdelivr.net/npm/phosphor-icons@1.4.2/src/index.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/phosphor-icons@1.4.2/src/css/icons.min.css" rel="stylesheet">

    {{-- datatable and jquery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Custom Style --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="sidebar">
        <h4 class="p-3">My Dashboard</h4>

        <a href="{{ route('dashboard') }}" class="{{ $page === 'Dashboard' ? 'is-active text-primary' : '' }}"><i
                class="ph-bold ph-house-line"></i> Dashboard</a>
        <a href="{{ route('profile.index') }}" class="{{ $page === 'Profile' ? 'is-active text-primary' : '' }}"><i
                class="ph-bold ph-user-focus"></i> Profile</a>
        <a href="{{ route('projects.index') }}" class="{{ $page === 'Projects' ? 'is-active text-primary' : '' }}"><i
                class="ph-bold ph-folder-simple-user"></i> Projects</a>
        <a href="{{ route('skills.index') }}" class="{{ $page === 'Skills' ? 'is-active text-primary' : '' }}"><i
                class="ph-bold ph-code"></i> Skills</a>
        <a href="{{ route('contacts.index') }}" class="{{ $page === 'Contacts' ? 'is-active text-primary' : '' }}"><i
                class="ph-bold ph-headphones"></i> Contacts</a>

        <hr>

        <form action="{{ route('logout') }}" method="POST" class="px-3">
            @csrf
            <button class="btn btn-danger w-100"><i class="ph-bold ph-sign-out"></i> Logout</button>
        </form>
    </div>

    <div class="content">
        {{-- Topbar --}}
        <div class="d-flex justify-content-between mb-4">
            <h3>@yield('title')</h3>
            <a href="{{ route('portofolio') }}" target="_blank" class="btn btn-outline-primary">View Portfolio</a>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
