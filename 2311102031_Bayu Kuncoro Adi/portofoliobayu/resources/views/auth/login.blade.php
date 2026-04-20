<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin Portfolio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen font-sans selection:bg-amber-300 relative overflow-hidden">
    
    <div class="absolute -top-20 -left-20 w-96 h-96 bg-amber-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>
    <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-green-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30"></div>

    <div class="relative z-10 w-full max-w-md p-10 bg-white rounded-[2rem] shadow-2xl border border-gray-100 mx-4">
        
        <div class="text-center mb-10">
            <div class="w-16 h-16 bg-amber-400 rounded-[1rem] mx-auto mb-4 flex items-center justify-center shadow-lg transform rotate-12">
                <span class="text-3xl">🔐</span>
            </div>
            <h2 class="text-3xl font-black text-green-900">Welcome Back!</h2>
            <p class="text-gray-500 text-sm mt-2">Login ke Control Panel</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:border-amber-400 focus:ring-0 transition">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:border-amber-400 focus:ring-0 transition">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
            </div>

            <button type="submit" class="w-full py-4 bg-green-900 hover:bg-green-800 text-white font-black rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                MASUK SEKARANG
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('landing') }}" class="text-sm font-bold text-amber-500 hover:text-amber-600 transition">← Kembali ke Halaman Depan</a>
        </div>
    </div>
</body>
</html>