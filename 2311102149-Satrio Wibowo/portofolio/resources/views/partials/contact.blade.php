<section id="contact" class="mx-auto max-w-3xl px-6 py-24 border-t border-gray-100 dark:border-white/5 transition-colors duration-500">
  <div class="text-left mb-12" data-aos="fade-up">
    <p class="text-[10px] tracking-[0.4em] font-bold text-pinkCreamy dark:text-gold uppercase mb-4">Get in touch</p>

    <h2 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white leading-tight">
      Let's create something <br>
      <span class="text-gray-900 dark:text-white">remarkable</span>
      <span class="text-pinkCreamy dark:text-gold">together.</span>
    </h2>

    <p class="text-gray-500 dark:text-white/40 text-sm mt-6 max-w-lg leading-relaxed">
      Have a project in mind? I'd love to hear about it. Send a message and I'll get back to you within 24 hours.
    </p>
  </div>

  <div class="rounded-[2.5rem] bg-gray-50/50 dark:bg-white/[0.02] border border-gray-100 dark:border-white/5 p-8 md:p-12 shadow-xl dark:shadow-2xl" data-aos="fade-up">

    {{-- SUCCESS --}}
    @if (session('success'))
      <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700 dark:border-green-500/20 dark:bg-green-500/10 dark:text-green-200">
        {{ session('success') }}
      </div>
    @endif

    {{-- GLOBAL ERROR (optional) --}}
    @if ($errors->any())
      <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-200">
        Please fix the highlighted fields.
      </div>
    @endif

    <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
      @csrf

      {{-- Name Field --}}
      <div class="space-y-3">
        <label class="text-[11px] font-bold text-gray-400 dark:text-white/40 uppercase tracking-widest ml-1">Name</label>

        <input
          type="text"
          name="name"
          value="{{ old('name') }}"
          class="w-full rounded-2xl bg-white dark:bg-white/[0.03] px-6 py-4 border text-gray-900 dark:text-white text-sm placeholder:text-gray-300 dark:placeholder:text-white/10 focus:outline-none focus:bg-white transition-all
                 {{ $errors->has('name') ? 'border-red-300 dark:border-red-500/40 focus:border-red-400 dark:focus:border-red-500/60' : 'border-gray-200 dark:border-white/10 focus:border-pinkCreamy/50 dark:focus:border-gold/30' }}"
          placeholder="Your name"
          autocomplete="name"
        >

        @error('name')
          <p class="text-xs text-red-500 dark:text-red-300/90 ml-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Email Field --}}
      <div class="space-y-3">
        <label class="text-[11px] font-bold text-gray-400 dark:text-white/40 uppercase tracking-widest ml-1">Email</label>

        <input
          type="email"
          name="email"
          value="{{ old('email') }}"
          class="w-full rounded-2xl bg-white dark:bg-white/[0.03] px-6 py-4 border text-gray-900 dark:text-white text-sm placeholder:text-gray-300 dark:placeholder:text-white/10 focus:outline-none focus:bg-white transition-all
                 {{ $errors->has('email') ? 'border-red-300 dark:border-red-500/40 focus:border-red-400 dark:focus:border-red-500/60' : 'border-gray-200 dark:border-white/10 focus:border-pinkCreamy/50 dark:focus:border-gold/30' }}"
          placeholder="your@email.com"
          autocomplete="email"
        >

        @error('email')
          <p class="text-xs text-red-500 dark:text-red-300/90 ml-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Project Type (Optional) --}}
      <div class="space-y-3">
        <label class="text-[11px] font-bold text-gray-400 dark:text-white/40 uppercase tracking-widest ml-1">
          Project Type <span class="text-[9px] lowercase opacity-50 font-medium">(optional)</span>
        </label>

        <div class="relative">
          <select
            name="project_type"
            class="w-full rounded-2xl bg-white dark:bg-white/[0.03] px-6 py-4 border text-sm focus:outline-none focus:bg-white transition-all appearance-none cursor-pointer
                   {{ $errors->has('project_type') ? 'border-red-300 dark:border-red-500/40 focus:border-red-400 dark:focus:border-red-500/60' : 'border-gray-200 dark:border-white/10 focus:border-pinkCreamy/50 dark:focus:border-gold/30' }}
                   text-gray-600 dark:text-white/60"
          >
            <option value="" class="bg-white dark:bg-[#121212] text-gray-900 dark:text-white">
              Select a project type
            </option>

            @php
              $types = ['Web Design', 'Photography', 'Video Production', 'Illustration'];
              $selectedType = old('project_type');
            @endphp

            @foreach ($types as $t)
              <option
                value="{{ $t }}"
                @selected($selectedType === $t)
                class="bg-white dark:bg-[#121212] text-gray-900 dark:text-white"
              >
                {{ $t }}
              </option>
            @endforeach
          </select>

          <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-gray-300 dark:text-white/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
        </div>

        @error('project_type')
          <p class="text-xs text-red-500 dark:text-red-300/90 ml-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Message Field --}}
      <div class="space-y-3">
        <label class="text-[11px] font-bold text-gray-400 dark:text-white/40 uppercase tracking-widest ml-1">Message</label>

        <textarea
          name="message"
          rows="4"
          class="w-full rounded-2xl bg-white dark:bg-white/[0.03] px-6 py-4 border text-gray-900 dark:text-white text-sm placeholder:text-gray-300 dark:placeholder:text-white/10 focus:outline-none focus:bg-white transition-all resize-none
                 {{ $errors->has('message') ? 'border-red-300 dark:border-red-500/40 focus:border-red-400 dark:focus:border-red-500/60' : 'border-gray-200 dark:border-white/10 focus:border-pinkCreamy/50 dark:focus:border-gold/30' }}"
          placeholder="Tell me about your project..."
        >{{ old('message') }}</textarea>

        @error('message')
          <p class="text-xs text-red-500 dark:text-red-300/90 ml-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Button --}}
      <div class="relative pt-4 group">
        <button
          type="submit"
          class="relative z-10 w-full py-4 flex items-center justify-center gap-3 rounded-3xl bg-pinkCreamy dark:bg-gold text-white dark:text-black font-black text-sm uppercase tracking-widest transition-all duration-300 hover:scale-[1.02] active:scale-[0.98] overflow-hidden shadow-lg shadow-pinkCreamy/20 dark:shadow-gold/20"
        >
          <svg xmlns="http://www.w3.org/2000/svg"
               class="w-4 h-4 transform rotate-45 transition-transform duration-500 group-hover:translate-x-1 group-hover:-translate-y-1"
               fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
          </svg>

          <span>Send Message</span>

          <div class="absolute inset-0 bg-white/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </button>

        <div class="absolute inset-x-0 bottom-1 h-12 bg-pinkCreamy/40 dark:bg-gold/60 blur-[30px] rounded-full -z-0 pointer-events-none transition-all duration-300 group-hover:blur-[40px] group-hover:bg-pinkCreamy/60 dark:group-hover:bg-gold/80"></div>
        <div class="absolute inset-x-4 bottom-0 h-16 bg-pinkCreamy/10 dark:bg-gold/20 blur-[50px] rounded-full -z-0 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
      </div>
    </form>
  </div>
</section>