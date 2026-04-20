<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login | Hamid Sabirin</title>
        <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%239333ea%22/><text y=%22.9em%22 x=%2250%%22 text-anchor=%22middle%22 font-family=%22Outfit, sans-serif%22 font-weight=%22800%22 font-size=%2270%22 fill=%22white%22>H</text></svg>">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-white antialiased bg-[#0B0A10] selection:bg-purple-500/30 selection:text-white relative min-h-screen">
        
        <!-- Premium Ambient Glows -->
        <div class="fixed top-0 left-1/2 -translate-x-1/2 w-[600px] h-[400px] bg-purple-600/20 blur-[120px] rounded-full pointer-events-none"></div>
        <div class="fixed bottom-0 right-0 w-[500px] h-[500px] bg-fuchsia-600/10 blur-[120px] rounded-full pointer-events-none"></div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
            <div>
                <a href="/" class="group flex flex-col items-center">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-600 to-fuchsia-500 flex items-center justify-center shadow-lg shadow-purple-500/30 mb-4 transform group-hover:scale-105 transition-all duration-300">
                        <span class="text-3xl font-bold text-white">H</span>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-4 px-10 py-12 bg-white/5 backdrop-blur-xl shadow-2xl border border-white/10 overflow-hidden sm:rounded-[32px]">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-white">Welcome Back</h2>
                    <p class="text-purple-200/60 text-sm mt-1">Please sign in to access dashboard</p>
                </div>
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-sm text-purple-200/40">
                &copy; {{ date('Y') }} Hamid Sabirin. All rights reserved.
            </div>
        </div>
    </body>
</html>
