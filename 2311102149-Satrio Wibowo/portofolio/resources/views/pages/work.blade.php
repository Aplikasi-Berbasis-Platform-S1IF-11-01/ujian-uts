@extends('layouts.app')

@section('title', 'Archive — Satrio Wibowo')

@section('content')
<div x-data="{ 
    active: @js($type ?? 'all'),
    allProjects: @js($projects->items()),
    {{-- Logika pembagi kolom tetap utuh agar baris atas sejajar sempurna --}}
    get columns() {
        let filtered = this.active === 'all' ? this.allProjects : this.allProjects.filter(p => p.category.toLowerCase() === this.active.toLowerCase());
        let numCols = window.innerWidth >= 1024 ? 5 : (window.innerWidth >= 768 ? 2 : 1);
        let cols = Array.from({ length: numCols }, () => []);
        filtered.forEach((p, i) => cols[i % numCols].push(p));
        return cols;
    }
}" class="max-w-[90rem] mx-auto px-6 py-32">
    
    <div class="mb-16" data-aos="fade-right">
        {{-- Aksen PinkCreamy di Light Mode --}}
        <p class="text-pinkCreamy dark:text-gold text-[10px] tracking-[0.4em] uppercase mb-4 font-bold">Portfolio Archive</p>
        <h1 class="text-5xl md:text-7xl font-bold text-gray-900 dark:text-white tracking-tight">The Library.</h1>
    </div>

    {{-- Filter Buttons: Warna PinkCreamy saat aktif di Light Mode --}}
    <div class="flex flex-wrap gap-3 mb-16" data-aos="fade-up">
        <template x-for="category in ['All', 'Design', 'Photo', 'Video', 'Illustration']">
            <button @click="active = category.toLowerCase()"
                :class="active === category.toLowerCase() 
                    ? 'bg-pinkCreamy dark:bg-gold text-white dark:text-black shadow-lg shadow-pinkCreamy/30 dark:shadow-gold/20' 
                    : 'bg-white dark:bg-white/5 text-gray-400 dark:text-white/50 border-gray-100 dark:border-white/10'"
                class="px-8 py-2.5 rounded-full border text-sm font-bold transition duration-300"
                x-text="category"></button>
        </template>
    </div>

    {{-- Flex Masonry Layout --}}
    <div class="flex flex-wrap -mx-3 items-start">
        <template x-for="(col, index) in columns" :key="index">
            <div class="px-3 flex flex-col gap-6" 
                 :class="window.innerWidth >= 1024 ? 'w-1/5' : (window.innerWidth >= 768 ? 'w-1/2' : 'w-full')">
                
                <template x-for="project in col" :key="project.id">
                    <article class="group relative overflow-hidden rounded-[1.5rem] border border-gray-100 dark:border-white/10 bg-white dark:bg-white/5 transition-all duration-500 shadow-sm hover:shadow-xl dark:shadow-lg hover:border-pinkCreamy/50 dark:hover:border-gold/30">
                        <div class="relative overflow-hidden">
                            {{-- Logika pengambilan gambar tetap dipertahankan --}}
                            <img :src="'/storage/' + (project.media.find(m => m.role === 'thumbnail')?.path || project.media[0]?.path)" 
                                 class="w-full h-auto object-cover transition duration-700 group-hover:scale-105 group-hover:blur-[2px] group-hover:brightness-[0.4]">
                            
                            {{-- Hover Overlay --}}
                            <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 text-center p-6">
                                <div class="p-3 rounded-full border border-pinkCreamy dark:border-gold/50 bg-white/20 dark:bg-black/40 mb-3 transition-colors duration-300 group-hover:bg-pinkCreamy dark:group-hover:bg-gold">
                                    <svg class="w-5 h-5 text-pinkCreamy dark:text-gold transition-colors duration-300 group-hover:text-white dark:group-hover:text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <h3 class="text-sm font-bold text-white uppercase px-2" x-text="project.title"></h3>
                                <a :href="'/work/' + project.slug" class="absolute inset-0 z-10"></a>
                            </div>
                        </div>
                        {{-- Info Bawah --}}
                        <div class="p-4 group-hover:opacity-0 transition-opacity">
                            <p class="text-pinkCreamy dark:text-gold text-[7px] tracking-[0.3em] uppercase font-bold mb-1" x-text="project.category"></p>
                            <h4 class="text-[10px] font-bold text-gray-700 dark:text-white/80" x-text="project.title"></h4>
                        </div>
                    </article>
                </template>

            </div>
        </template>
    </div>

    {{-- Pagination --}}
    <div class="mt-20">
        {{ $projects->links() }}
    </div>
</div>
@endsection