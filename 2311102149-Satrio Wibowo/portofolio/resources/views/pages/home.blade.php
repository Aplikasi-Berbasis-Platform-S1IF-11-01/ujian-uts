@extends('layouts.app')

@section('content')
    <section id="home">@include('partials.hero')</section>

    {{-- SECTION WORK DENGAN AJAX DINAMIS --}}
    <section id="work" class="py-24 scroll-mt-20" 
             x-data="{ 
                active: 'all',
                allProjects: [],
                categories: [], // Awalnya kosong, akan diisi via fetch
                loading: true,
                init() {
                    fetch('/api/portfolio-data')
                        .then(res => res.json())
                        .then(data => {
                            this.allProjects = data.projects;
                            this.categories = data.categories; // Mengambil kategori dari database
                            this.loading = false;
                        });
                },
                get columns() {
                    let filtered = this.active === 'all' 
                        ? this.allProjects 
                        : this.allProjects.filter(p => p.category.toLowerCase() === this.active.toLowerCase());
                    
                    let numCols = window.innerWidth >= 1024 ? 5 : (window.innerWidth >= 768 ? 2 : 1);
                    let cols = Array.from({ length: numCols }, () => []);
                    filtered.forEach((p, i) => cols[i % numCols].push(p));
                    return cols;
                }
             }">
        <div class="max-w-[90rem] mx-auto px-6">
            <div class="mb-10" data-aos="fade-up">
                <p class="text-pinkCreamy dark:text-gold text-[10px] tracking-[0.4em] uppercase mb-4 font-bold">Selected Work</p>
                <h2 class="text-4xl md:text-5xl font-bold leading-tight text-gray-900 dark:text-white">Crafted with intent.<br>Built to last.</h2>
            </div>

            {{-- Filter Dinamis: Mengambil data dari 'categories' hasil fetch --}}
            <div class="flex flex-wrap gap-3 mb-16" x-show="!loading">
                <template x-for="cat in categories" :key="cat">
                    <button @click="active = cat.toLowerCase()"
                        :class="active === cat.toLowerCase() 
                            ? 'bg-pinkCreamy dark:bg-gold text-white dark:text-black shadow-lg shadow-pinkCreamy/20 dark:shadow-gold/20' 
                            : 'bg-white dark:bg-white/5 text-gray-400 dark:text-white/50 border-gray-100 dark:border-white/10'"
                        class="px-8 py-2.5 rounded-full border text-sm font-bold transition duration-300"
                        x-text="cat"></button>
                </template>
            </div>

            {{-- Loading State --}}
            <div x-show="loading" class="flex justify-center py-20 text-gray-400">Loading Portfolio...</div>

            {{-- Masonry Grid --}}
            <div x-show="!loading" class="flex flex-wrap -mx-3 items-start">
                <template x-for="(col, index) in columns" :key="index">
                    <div class="px-3 flex flex-col gap-6" :class="window.innerWidth >= 1024 ? 'w-1/5' : (window.innerWidth >= 768 ? 'w-1/2' : 'w-full')">
                        <template x-for="project in col" :key="project.id">
                            <article class="group relative overflow-hidden rounded-[1.5rem] border border-gray-100 dark:border-white/10 bg-white dark:bg-white/5 transition-all hover:shadow-xl dark:hover:border-gold/30">
                                <div class="relative overflow-hidden">
                                    <img :src="'/storage/' + (project.media.find(m => m.role === 'thumbnail')?.path || project.media[0]?.path)" 
                                         class="w-full h-auto object-cover transition duration-700 group-hover:scale-105 group-hover:brightness-[0.4]">
                                    
                                    <div class="absolute inset-0 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all text-center p-6">
                                        <h3 class="text-sm font-bold text-white uppercase tracking-tight" x-text="project.title"></h3>
                                        <p class="text-pinkCreamy dark:text-gold text-[9px] font-bold mt-2 tracking-widest uppercase" x-text="project.category"></p>
                                        <a :href="'/work/' + project.slug" class="absolute inset-0 z-10"></a>
                                    </div>
                                </div>
                            </article>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </section>

    @include('partials.about')
    @include('partials.contact')
@endsection