<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@porto.com'],
            [
                'name'     => 'Admin',
                'email'    => 'admin@porto.com',
                'password' => Hash::make('123456789'),
            ]
        );

        // Profile
        Profile::create([
            'nama'      => 'Yoga Hogantara',
            'role'      => 'Full Stack Developer',
            'deskripsi' => 'Seorang Full Stack Developer passionate yang berfokus pada pembuatan aplikasi web modern dan skalabel. Berpengalaman dalam ekosistem Laravel dan React, dengan semangat tinggi untuk terus belajar teknologi terbaru.',
            'email'     => 'yogatara40@gmail.com',
            'github'    => 'https://github.com/Law650',
            'linkedin'  => 'https://linkedin.com/in/yogahogantara',
            'path_foto' => null,
        ]);

        // Skills
        $skills = [
            ['nama_skill' => 'Laravel',      'level' => 90, 'kategori' => 'Backend'],
            ['nama_skill' => 'PHP',           'level' => 85, 'kategori' => 'Backend'],
            ['nama_skill' => 'MySQL',         'level' => 80, 'kategori' => 'Backend'],
            ['nama_skill' => 'Vue.js',        'level' => 75, 'kategori' => 'Frontend'],
            ['nama_skill' => 'Tailwind CSS',  'level' => 88, 'kategori' => 'Frontend'],
            ['nama_skill' => 'JavaScript',    'level' => 82, 'kategori' => 'Frontend'],
            ['nama_skill' => 'Git & GitHub',  'level' => 85, 'kategori' => 'Tools'],
            ['nama_skill' => 'REST API',      'level' => 88, 'kategori' => 'Backend'],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}