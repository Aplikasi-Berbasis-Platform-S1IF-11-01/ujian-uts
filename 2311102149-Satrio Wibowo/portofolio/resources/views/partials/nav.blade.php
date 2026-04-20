<header class="fixed inset-x-0 top-0 z-50 backdrop-blur-md bg-white/70 dark:bg-black/20 border-b border-gray-100 dark:border-white/5 transition-colors duration-500">
  <nav class="mx-auto flex max-w-7xl items-center px-6 py-4 lg:px-8 font-semibold">

    {{-- LEFT: LOGO --}}
    <div class="flex flex-1 items-center">
      <a href="/" class="inline-flex items-center">
        <span class="sr-only">OXY Project</span>

        {{-- SVG LOGO: light=pink, dark=gold --}}
        <span class="text-pinkCreamy dark:text-gold transition-colors
                     [&>svg]:block [&>svg]:h-6 [&>svg]:w-auto
                     [&_path]:!fill-current [&_path]:!stroke-current
                     [&_circle]:!fill-current [&_circle]:!stroke-current
                     [&_rect]:!fill-current [&_rect]:!stroke-current
                     [&_line]:!stroke-current [&_polyline]:!stroke-current [&_polygon]:!stroke-current">
          {!! file_get_contents(public_path('icons/oxy-logo.svg')) !!}
        </span>
      </a>
    </div>

    {{-- CENTER: NAV LINKS --}}
    <div class="hidden lg:flex flex-1 justify-center gap-x-12">
      @php
        $isHome = Request::is('/');
        $isWork = Request::is('work*');
      @endphp

      <a href="{{ $isHome ? '#work' : route('work.index') }}"
         class="relative py-2 text-sm transition-all duration-300 {{ $isWork ? 'text-pinkCreamy dark:text-gold' : 'text-gray-500 dark:text-white/70 hover:text-pinkCreamy dark:hover:text-white' }}">
        Work
        @if($isWork)
          <span class="absolute bottom-0 left-0 w-full h-0.5 bg-pinkCreamy dark:bg-gold"></span>
        @endif
      </a>

      <a href="{{ $isHome ? '#about' : '/#about' }}"
         class="relative py-2 text-sm text-gray-500 dark:text-white/70 hover:text-pinkCreamy dark:hover:text-white transition-all">
        About
      </a>

      <a href="{{ $isHome ? '#contact' : '/#contact' }}"
         class="relative py-2 text-sm text-gray-500 dark:text-white/70 hover:text-pinkCreamy dark:hover:text-white transition-all">
        Contact
      </a>
    </div>

    {{-- RIGHT: THEME TOGGLE --}}
    <div class="flex flex-1 justify-end">
      <button
        type="button"
        id="themeToggle"
        class="relative z-[60] pointer-events-auto p-2 rounded-md
               text-gray-400 dark:text-white/70
               hover:text-pinkCreamy dark:hover:text-gold
               transition cursor-pointer"
        aria-label="Toggle theme"
      >
        {{-- 🌙 DARK MODE ICON --}}
        <svg class="w-5 h-5 hidden dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path d="M21 12.8A8.5 8.5 0 1 1 11.2 3a6.8 6.8 0 1 0 9.8 9.8Z"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        {{-- ☀️ LIGHT MODE ICON --}}
        <svg class="w-5 h-5 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <circle cx="12" cy="12" r="5" stroke-width="2"/>
          <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41
                   M17.66 17.66l1.41 1.41
                   M2 12h2M20 12h2
                   M6.34 17.66l-1.41 1.41
                   M19.07 4.93l-1.41 1.41"
                stroke-width="2" stroke-linecap="round"/>
        </svg>
      </button>
    </div>

  </nav>
</header>