@php
    $thumb = $project->media->firstWhere('role','thumbnail') ?? $project->media->first();
    $thumbUrl = ($thumb && $thumb->path) ? asset('storage/' . $thumb->path) : null;
@endphp

<article data-aos="fade-up" 
         class="group relative overflow-hidden rounded-[1.5rem] border border-gray-100 dark:border-white/10 bg-white dark:bg-white/5 transition-all duration-500 mb-6 break-inside-avoid shadow-sm hover:shadow-xl dark:shadow-lg hover:border-pinkCreamy/50 dark:hover:border-gold/30">
    
    {{-- Container Gambar --}}
    <div class="relative overflow-hidden">
        <img src="{{ $thumbUrl }}" 
             class="w-full h-auto object-cover transition duration-700 group-hover:scale-110 group-hover:blur-[2px] group-hover:brightness-[0.4]"
             loading="lazy">
        
        {{-- Efek Hover Ikon Tengah --}}
        <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 translate-y-4 group-hover:translate-y-0 text-center p-6">
            {{-- Lingkaran tombol: Pink Creamy di Light, Gold di Dark --}}
            <div class="p-4 rounded-full border border-pinkCreamy dark:border-gold/50 bg-white/20 dark:bg-black/40 mb-4 transition-colors duration-300 group-hover:bg-pinkCreamy dark:group-hover:bg-gold group-hover:border-pinkCreamy dark:group-hover:border-gold">
                {{-- Ikon SVG --}}
                <svg class="w-6 h-6 text-pinkCreamy dark:text-gold transition-colors duration-300 group-hover:text-white dark:group-hover:text-black" 
                     fill="none" 
                     stroke="currentColor" 
                     viewBox="0 0 24 24">
                    <path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" 
                          stroke-width="2" 
                          stroke-linecap="round" 
                          stroke-linejoin="round"/>
                </svg>
            </div>

            <h3 class="text-xl font-bold text-white uppercase tracking-tight">{{ $project->title }}</h3>
            <p class="text-pinkCreamy dark:text-gold text-[10px] font-bold mt-2 tracking-[0.3em] uppercase">{{ $project->year ?? '2026' }}</p>
            
            {{-- Link transparan --}}
            <a href="{{ route('work.show', $project->slug) }}" class="absolute inset-0 z-10"></a>
        </div>
    </div>

    {{-- Info Bawah (Pinterest Style) --}}
    <div class="p-5 group-hover:opacity-0 transition-opacity duration-300">
        <p class="text-pinkCreamy dark:text-gold text-[8px] tracking-[0.3em] uppercase font-bold mb-1">{{ $project->category }}</p>
        <h4 class="text-sm font-bold text-gray-800 dark:text-white/90">{{ $project->title }}</h4>
    </div>
</article>