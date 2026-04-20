<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Portfo.io</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0f172a] min-h-screen flex items-center justify-center p-6">
    <div class="w-full max-w-md bg-[#1e293b] rounded-3xl p-8 border border-slate-700 shadow-2xl">
        <h2 class="text-3xl font-black text-blue-500 mb-2 italic tracking-tighter text-center">ADMIN_AUTH</h2>
        <p class="text-slate-400 text-center mb-8 text-sm">Silakan masuk untuk mengelola portofolio</p>

        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500 text-red-500 p-3 rounded-xl mb-6 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form action="/login" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase mb-2 block">Email Address</label>
                <input type="email" name="email" required class="w-full p-4 bg-[#0f172a] border border-slate-700 rounded-2xl text-white outline-none focus:border-blue-500 transition">
            </div>
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase mb-2 block">Password</label>
                <input type="password" name="password" required class="w-full p-4 bg-[#0f172a] border border-slate-700 rounded-2xl text-white outline-none focus:border-blue-500 transition">
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 py-4 rounded-2xl text-white font-bold transition shadow-lg shadow-blue-900/20">
                Login ke Dashboard
            </button>
        </form>
    </div>
</body>
</html>