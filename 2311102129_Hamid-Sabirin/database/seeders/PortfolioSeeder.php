<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]
        );

        \App\Models\Portfolio::create([
            'name' => 'John Arisaka',
            'subtitle' => 'Fullstack Web Developer & Designer',
            'about_me' => 'I am a passionate web developer with experience in building modern and responsive web applications. I love clean code and premium aesthetics.',
            'photo_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=1000&auto=format&fit=crop',
            'email' => 'john@example.com',
            'phone' => '+62 812 3456 7890',
            'address' => 'Semarang, Indonesia',
            'github_url' => 'https://github.com',
            'linkedin_url' => 'https://linkedin.com',
        ]);

        $skills = [
            ['name' => 'Laravel', 'level' => 90, 'category' => 'Backend'],
            ['name' => 'Tailwind CSS', 'level' => 95, 'category' => 'Frontend'],
            ['name' => 'Vue.js', 'level' => 85, 'category' => 'Frontend'],
            ['name' => 'PostgreSQL', 'level' => 80, 'category' => 'Database'],
            ['name' => 'Figma', 'level' => 75, 'category' => 'Design'],
        ];

        foreach ($skills as $skill) {
            \App\Models\Skill::create($skill);
        }
        $projects = [
            [
                'title' => 'Linktree Clone',
                'tag' => 'Profile',
                'description' => 'Berisi informasi sosial media dan informasi saya portfolio.',
                'image_url' => 'https://images.unsplash.com/photo-1611162617213-7d7a39e9b1d7?q=80&w=600&auto=format&fit=crop',
            ],
            [
                'title' => 'Lost & Found System',
                'tag' => 'Web App',
                'description' => 'Platform pelaporan barang hilang dan ditemukan untuk sistem internal kampus.',
                'image_url' => 'https://images.unsplash.com/photo-1544027993-37dbfe43562a?q=80&w=600&auto=format&fit=crop',
            ],
            [
                'title' => 'My Plant Mobile',
                'tag' => 'Flutter App',
                'description' => 'Aplikasi pengingat jadwal penyiraman tanaman pribadi berbasis mobile cross-platform.',
                'image_url' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?q=80&w=600&auto=format&fit=crop',
            ],
        ];

        foreach ($projects as $proj) {
            \App\Models\Project::create($proj);
        }
    }
}
