<?php

use App\Models\Profile;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;

Route::get('/portfolio-data', function () {
    $profile = Profile::first(); 
    $projects = Project::with('media')->latest()->get();

    // Mengambil kategori unik dari database secara dinamis
    $categories = $projects->pluck('category')
        ->unique()
        ->map(fn($cat) => ucfirst(strtolower($cat))) // Menyeragamkan format (Contoh: DESIGN -> Design)
        ->prepend('All') // Menambahkan opsi 'All' di awal daftar
        ->values();

    return response()->json([
        'projects' => $projects,
        'categories' => $categories, // Mengirim daftar kategori dinamis
        'profile' => [
            'heading' => $profile->heading ?? 'Crafting meaning from visual chaos.',
            'description' => $profile->description ?? 'Halo, aku Satrio Wibowo! Mahasiswa Teknik Informatika yang fokus di industri kreatif.',
            'skills' => $profile->skills ?? ['Branding', 'UI/UX', 'Photography'],
            'photo_url' => $profile->photo ? Storage::url($profile->photo) : asset('storage/Satrio.jpeg'),
        ]
    ]);
});