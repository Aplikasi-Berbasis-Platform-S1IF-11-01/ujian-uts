<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Education;
use App\Models\Focus;
use App\Models\Skill;
use App\Models\Inspiration;
use App\Models\Portfolio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Model::unguard();

        User::factory()->create([
            'name' => 'Admin Nisrina',
            'email' => 'admin@nisrina.com',
            'password' => Hash::make('password'),
        ]);

        Profile::create([
            'name' => 'Nisrina Amalia',
            'title' => 'AI Enthusiast',
            'description' => 'Mahasiswa aktif Informatika tahun ketiga yang berfokus pada Data Science dan Kecerdasan Buatan. Student ID 2311102156.',
            'about_title' => 'Membangun Masa Depan Dengan Data',
            'about_description' => 'Saya mahasiswa Teknik Informatika yang aktif memimpin inisiatif adopsi teknologi AI. Sebagai Google Student Ambassador, saya percaya teknologi harus inklusif.',
            'achievement_title' => 'Pencapaian Utama',
            'achievement_description' => 'Top 20 Gemini Achiever dari 800 Google Student Ambassadors seluruh Indonesia.',
            'image_url' => 'https://via.placeholder.com/400', // placeholder for now
            'cv_url' => '#',
            'email' => 'contact@nisrina.com',
        ]);

        Education::create([
            'period' => '2023 - Sekarang',
            'institution' => 'Universitas Telkom (Kampus Purwokerto)',
            'major' => 'S1 Teknik Informatika',
            'description' => 'Fokus pada analisis data, Kecerdasan Buatan (AI), Basis Data & SQL, serta Struktur Data.',
            'sort_order' => 1
        ]);

        Education::create([
            'period' => '2020 - 2023',
            'institution' => 'SMK Telkom Purwokerto',
            'major' => 'Rekayasa Perangkat Lunak',
            'description' => 'Mempelajari fundamental pengembangan perangkat lunak, pemrograman web, dan mobile.',
            'sort_order' => 2
        ]);

        Focus::create([
            'title' => 'Data Science & AI',
            'description' => 'Analisis data, visualisasi, dan penerapan konsep Machine Learning dengan Python.',
            'icon' => '<svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>',
            'sort_order' => 1
        ]);

        Focus::create([
            'title' => 'UI/UX Design',
            'description' => 'Merancang antarmuka yang intuitif dan estetik menggunakan Figma dan Adobe XD.',
            'icon' => '<svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>',
            'sort_order' => 2
        ]);

        Focus::create([
            'title' => 'Web Development',
            'description' => 'Membangun aplikasi web kustom menggunakan React, Node.js, dan SQL.',
            'icon' => '<svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>',
            'sort_order' => 3
        ]);

        $skills = ['Python (Data Science)', 'SQL & PHP', 'Java & Kotlin', 'Machine Learning', 'UI/UX Design (Figma)', 'Bootstrap 5', 'Git Version Control'];
        foreach($skills as $i => $skill) {
            Skill::create(['name' => $skill, 'sort_order' => $i]);
        }

        $quotes = [
            '"Do Not Be Embarrassed By Your Failures, Learn From Them And Start Again."',
            '"If I Were Not A Physicist, I Would Probably Be A Musician. I Often Think In Music. I Live My Daydreams In Music. I See My Life In Terms Of Music."',
            '"Courtesy costs nothing, but buys everything."',
            '"This place is a dream. Only a sleeper considers it real. Then death comes like dawn, and you wake up laughing at what you thought was your grief."'
        ];
        foreach($quotes as $quote) {
            Inspiration::create(['quote' => $quote]);
        }
        
        Portfolio::create([
            'title' => 'Project Data Analysis',
            'description' => 'Analisis data sentimen menggunakan Python.',
            'image_url' => 'https://via.placeholder.com/300x200',
            'link' => '#',
            'sort_order' => 1
        ]);
    }
}
