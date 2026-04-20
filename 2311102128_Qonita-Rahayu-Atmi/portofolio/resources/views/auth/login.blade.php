<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Portfolio</title>
    <script>
        const _ow = console.warn;
        console.warn = function() {
            if (arguments[0] && typeof arguments[0] === 'string' && arguments[0].includes('cdn.tailwindcss.com')) return;
            _ow.apply(console, arguments);
        };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cyanBrand: '#00d0eb',
                        darkBg: '#090e17',
                    },
                    fontFamily: { poppins: ['Poppins', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; background: #090e17; }
        .glass { background: rgba(255,255,255,0.05); backdrop-filter: blur(16px); border: 1px solid rgba(255,255,255,0.08); }
        .input-field {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(0,208,235,0.2);
            color: #fff;
            transition: all 0.3s;
        }
        .input-field:focus { border-color: #00d0eb; box-shadow: 0 0 0 3px rgba(0,208,235,0.15); outline: none; }
        .btn-login {
            background: linear-gradient(135deg, #00d0eb, #0099b3);
            transition: all 0.3s;
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,208,235,0.4); }
        .glow-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            pointer-events: none;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden">
    <!-- Background glow effects -->
    <div class="glow-circle w-96 h-96 bg-cyanBrand top-0 left-0 -translate-x-1/2 -translate-y-1/2"></div>
    <div class="glow-circle w-80 h-80 bg-blue-500 bottom-0 right-0 translate-x-1/2 translate-y-1/2"></div>

    <div class="w-full max-w-md px-6 z-10">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="/" class="text-3xl font-bold text-white">Port<span class="text-cyanBrand">folio</span></a>
            <p class="text-gray-400 text-sm mt-2">Admin Dashboard Access</p>
        </div>

        <!-- Card -->
        <div class="glass rounded-2xl p-8 shadow-2xl">
            <h2 class="text-xl font-bold text-white mb-1">Welcome back</h2>
            <p class="text-gray-400 text-sm mb-6">Login untuk mengakses dashboard admin</p>

            @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 mb-5 flex items-center gap-3">
                <i class="fas fa-exclamation-circle text-red-400"></i>
                <p class="text-red-400 text-sm">{{ $errors->first() }}</p>
            </div>
            @endif

            @if(session('status'))
            <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-4 mb-5 flex items-center gap-3">
                <i class="fas fa-check-circle text-green-400"></i>
                <p class="text-green-400 text-sm">{{ session('status') }}</p>
            </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="mb-5">
                    <label class="text-gray-300 text-sm font-medium mb-2 block">
                        <i class="fas fa-envelope text-cyanBrand mr-2"></i>Email
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="input-field w-full px-4 py-3 rounded-xl text-sm placeholder-gray-500"
                        placeholder="admin@portofolio.com" required autofocus>
                </div>
                <div class="mb-6">
                    <label class="text-gray-300 text-sm font-medium mb-2 block">
                        <i class="fas fa-lock text-cyanBrand mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="passwordInput"
                            class="input-field w-full px-4 py-3 rounded-xl text-sm placeholder-gray-500 pr-12"
                            placeholder="••••••••" required>
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-cyanBrand transition">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="btn-login w-full py-3 rounded-xl text-darkBg font-bold text-sm tracking-wide">
                    <i class="fas fa-sign-in-alt mr-2"></i>MASUK KE DASHBOARD
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="/" class="text-gray-500 text-xs hover:text-cyanBrand transition">
                    <i class="fas fa-arrow-left mr-1"></i>Kembali ke Portofolio
                </a>
            </div>
        </div>

        <p class="text-center text-gray-600 text-xs mt-6">© 2026 Qonita Rahayu Atmi · Portfolio Admin</p>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const icon = document.getElementById('eyeIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>
