<section id="about" class="mx-auto max-w-7xl px-6 py-24 scroll-mt-20 border-t border-gray-100 dark:border-white/5"
         x-data="{ profile: {}, loading: true }"
         x-init="fetch('/api/portfolio-data').then(res => res.json()).then(data => { profile = data.profile; loading = false; })">
  
  <p class="text-[10px] tracking-[0.4em] font-bold text-pinkCreamy dark:text-gold uppercase mb-12">About</p>

  <div class="grid grid-cols-1 gap-16 lg:grid-cols-2 lg:items-center">
    {{-- Foto Profil AJAX --}}
    <div class="aspect-[4/5] overflow-hidden rounded-[2.5rem] bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10">
        <img :src="profile.photo_url" class="w-full h-full object-cover grayscale hover:grayscale-0 transition duration-700">
    </div>

    <div>
      {{-- Heading AJAX --}}
      <h2 class="text-4xl md:text-6xl font-bold tracking-tight text-gray-900 dark:text-white leading-[1.1]" x-text="profile.heading"></h2>
      
      {{-- Deskripsi AJAX --}}
      <p class="mt-8 text-gray-600 dark:text-white/60 text-lg leading-relaxed" x-text="profile.description"></p>

      {{-- Skills AJAX --}}
      <div class="mt-12">
        <p class="text-[10px] tracking-[0.3em] font-bold text-pinkCreamy dark:text-gold uppercase mb-6">Skills & Services</p>
        <div class="flex flex-wrap gap-2">
            <template x-for="skill in profile.skills" :key="skill">
                <span class="rounded-full px-5 py-2 border border-gray-100 dark:border-white/5 bg-white dark:bg-white/[0.03] text-gray-500 dark:text-white/50 text-xs font-bold uppercase" x-text="skill"></span>
            </template>
        </div>
      </div>
    </div>
  </div>
</section>