<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Deshan Portofolio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --grad-1: #6366f1;
            --grad-2: #8b5cf6;
            --grad-3: #d946ef;
        }

        body {
            background-color: #f8fafc;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            position: relative;
            overflow: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
        }

        /* Ambient Glow Backgrounds */
        .ambient-glow-1, .ambient-glow-2 {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            filter: blur(100px);
            z-index: -1;
            opacity: 0.4;
        }

        .ambient-glow-1 {
            top: -10%;
            left: -10%;
            background: var(--grad-1);
        }

        .ambient-glow-2 {
            bottom: -10%;
            right: -10%;
            background: var(--grad-3);
        }

        .login-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
        }

        .text-gradient {
            background: linear-gradient(90deg, var(--grad-1), var(--grad-2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            background-color: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--grad-2);
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.15);
            background-color: #fff;
        }

        .form-label {
            font-weight: 500;
            color: #475569;
            margin-bottom: 8px;
        }

        .btn-gradient {
            background: linear-gradient(90deg, var(--grad-1), var(--grad-2));
            color: white;
            border: none;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
            color: white;
        }
    </style>
</head>
<body>
    <div class="ambient-glow-1"></div>
    <div class="ambient-glow-2"></div>

    <div class="login-card">
        <h3 class="text-center mb-1 text-gradient">Welcome Back</h3>
        <p class="text-center text-secondary mb-4" style="font-size: 0.9rem;">Sign in to your admin dashboard</p>

        @if($errors->any())
            <div class="alert alert-danger" style="border-radius: 12px; font-size: 0.9rem;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="admin@admin.com" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-gradient w-100">Log In</button>
        </form>
    </div>
</body>
</html>
