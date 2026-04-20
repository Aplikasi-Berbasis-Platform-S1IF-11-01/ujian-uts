<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#050505] text-gray-200 min-h-screen flex items-center justify-center relative overflow-hidden">

    <div class="absolute -top-[10%] -left-[10%] w-[400px] h-[400px] rounded-full bg-indigo-600/20 blur-[100px]"></div>
    <div class="absolute -bottom-[10%] -right-[10%] w-[400px] h-[400px] rounded-full bg-purple-600/20 blur-[100px]"></div>

    <div class="relative z-10 w-full max-w-md px-6">
        <div class="text-center mb-8">
            <div class="inline-block p-4 bg-white/5 border border-white/10 rounded-2xl backdrop-blur-xl mb-4">
                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-white tracking-tight">Admin Authentication</h2>
            <p class="text-gray-500 text-sm mt-2">Silahkan masuk untuk mengelola portofolio</p>
        </div>

        <div class="bg-white/[0.03] border border-white/10 backdrop-blur-2xl rounded-[2.5rem] p-8 shadow-2xl">
            
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-500/10 border border-red-500/20 rounded-xl text-red-400 text-xs">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Email Address</label>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-all">
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2 ml-1">Password</label>
                    <input id="password" type="password" name="password" required 
                        class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition-all">
                </div>

                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded bg-white/5 border-white/10 text-purple-600 focus:ring-purple-500" name="remember">
                        <span class="ml-2 text-sm text-gray-500">Ingat saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-purple-400 hover:text-purple-300 transition-colors" href="{{ route('password.request') }}">
                            Lupa sandi?
                        </a>
                    @endif
                </div>

                <div class="pt-2">
                    <button type="submit" 
                        class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold py-3 rounded-xl shadow-[0_0_20px_rgba(147,51,234,0.3)] hover:shadow-[0_0_25px_rgba(147,51,234,0.5)] transition-all transform active:scale-[0.98]">
                        L O G I N
                    </button>
                </div>
            </form>
        </div>

        <div class="text-center mt-8">
            <a href="/" class="text-gray-500 hover:text-gray-300 text-sm transition-colors flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Landing Page
            </a>
        </div>
    </div>

</body>
</html>