<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Portfolio UTS' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fb;
            color: #1f2937;
        }

        .navbar-custom {
            background: #0f172a;
        }

        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
            color: white;
            padding: 120px 0 80px;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: #0f172a;
        }

        .card-custom {
            border: none;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        }

        .skill-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 12px;
        }

        .skill-badge {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 999px;
            background: #e2e8f0;
            color: #0f172a;
            font-weight: 500;
            white-space: nowrap;
        }

        .profile-img {
            width: 280px;
            height: 280px;
            object-fit: cover;
            border-radius: 50%;
            border: 6px solid rgba(255,255,255,.2);
        }

        .project-img {
            width: 100%;
            height: 240px;
            object-fit: cover;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
            background: #e5e7eb;
        }

        footer {
            background: #0f172a;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>