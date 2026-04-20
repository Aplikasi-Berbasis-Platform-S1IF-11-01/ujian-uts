@extends('layouts.app')

@section('title', $project->title . ' — Satrio Wibowo')

@section('content')
<article class="max-w-4xl mx-auto px-6 py-24 min-h-screen" data-aos="fade-up">
    
    {{-- Header Section --}}
    <div class="flex justify-between items-end mb-10">
        <div>
            {{-- Aksen PinkCreamy di Light, Gold di Dark --}}
            <p class="text-pinkCreamy dark:text-gold text-[9px] tracking-[0.4em] uppercase font-bold mb-2">
                {{ $project->category }}
            </p>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white tracking-tight">
                {{ $project->title }}
            </h1>
        </div>

        {{-- Tombol Kembali --}}
        <a href="javascript:history.back()" 
           class="group p-1.5 rounded-full bg-gray-100 dark:bg-white/5 border border-gray-200 dark:border-white/10 hover:bg-pinkCreamy/10 dark:hover:bg-white/10 transition duration-300">
            <svg class="w-5 h-5 text-gray-400 dark:text-white/50 group-hover:text-pinkCreamy dark:group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>

    {{-- Main Showcase (Thumbnail) --}}
    <div class="relative w-full overflow-hidden rounded-[1.5rem] border border-gray-100 dark:border-white/10 bg-white dark:bg-white/5 shadow-2xl mb-12">
        @php 
            $main = $project->media->firstWhere('role', 'thumbnail') ?? $project->media->first(); 
        @endphp
        @if($main)
            <img src="{{ asset('storage/' . $main->path) }}" 
                 alt="{{ $project->title }}" 
                 class="w-full h-auto object-cover">
        @endif
    </div>

    {{-- Deskripsi & Tags --}}
    <div class="flex flex-col md:flex-row justify-between items-start gap-8 mt-12">
        <div class="max-w-xl">
            <p class="text-gray-600 dark:text-white/60 text-base leading-relaxed font-medium italic">
                {{ $project->description }}
            </p>
        </div>

        <div class="flex flex-wrap gap-2 md:justify-end">
            @if($project->tags && is_array($project->tags))
                @foreach($project->tags as $tag)
                    <span class="rounded-full px-3 py-1 text-[8px] font-bold border border-gray-100 dark:border-white/5 bg-gray-50 dark:bg-white/[0.03] text-gray-500 dark:text-white/40 uppercase tracking-widest">
                        {{ $tag }}
                    </span>
                @endforeach
            @endif
        </div>
    </div>

    {{-- Gallery Section --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-20">
        @foreach($project->media->where('role', '!=', 'thumbnail') as $media)
            <div data-aos="fade-up" class="rounded-[1rem] overflow-hidden border border-gray-100 dark:border-white/5 bg-white dark:bg-white/5 shadow-lg">
                <img src="{{ asset('storage/' . $media->path) }}" class="w-full h-auto">
            </div>
        @endforeach
    </div>
</article>
@endsection