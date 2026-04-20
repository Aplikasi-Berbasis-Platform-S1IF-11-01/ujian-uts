<!doctype html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OXY-PROJECT — Portfolio</title>
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" type="image/svg+xml" href="/oxy-logo.svg">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  {{-- INIT THEME (DEFAULT DARK) --}}
  <script>
    (function () {
      try {
        const stored = localStorage.getItem('theme');
        const isDark = stored ? (stored === 'dark') : true;
        document.documentElement.classList.toggle('dark', isDark);
      } catch (e) {
        document.documentElement.classList.add('dark');
      }
    })();
  </script>

  @vite(['resources/css/app.css','resources/js/app.js'])
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-creamyBg text-gray-900 dark:bg-[#0a0a0a] dark:text-white transition-colors duration-500 antialiased">

  {{-- BACKGROUND GLOW --}}
  <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
    <div class="absolute -top-[20%] -left-[10%] w-[70%] h-[70%]
                bg-pinkCreamy/20 dark:bg-gold/15 blur-[120px] rounded-full
                transition-colors duration-1000 ease-in-out"></div>

    <div class="absolute -bottom-[20%] -right-[10%] w-[50%] h-[50%]
                bg-pinkCreamy/10 dark:bg-purple-500/5 blur-[150px] rounded-full
                transition-colors duration-1000 ease-in-out"></div>
  </div>

  @include('partials.nav')

  <main>
    @yield('content')
  </main>

  {{-- ============================= --}}
  {{-- SINGLE THEME TOGGLE SCRIPT --}}
  {{-- ============================= --}}
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const btn = document.getElementById('themeToggle');
      if (!btn) return;

      // pastikan theme sesuai storage
      const stored = localStorage.getItem('theme');
      if (!stored) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
      } else {
        document.documentElement.classList.toggle('dark', stored === 'dark');
      }

      btn.addEventListener('click', () => {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
      });
    });
  </script>

  {{-- AOS --}}
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 800, once: true });
  </script>

  <footer class="mt-32 border-t border-gray-200 dark:border-white/5
               bg-white dark:bg-[#0a0a0a]
               transition-colors duration-500">

  <div class="mx-auto max-w-7xl px-6 py-10
              flex flex-col sm:flex-row
              items-center justify-between
              gap-4 text-xs tracking-[0.25em] uppercase">

    {{-- LEFT --}}
    <div class="text-pinkCreamy dark:text-gold font-medium">
      O X Y - P R O J E C T — MULTIDISCIPLINARY CREATIVE CREATOR
    </div>

    {{-- RIGHT --}}
    <div class="text-gray-500 dark:text-white/40 tracking-normal uppercase">
      © {{ date('Y') }} Satrio. All rights reserved.
    </div>

  </div>
</footer>

</body>
</html>