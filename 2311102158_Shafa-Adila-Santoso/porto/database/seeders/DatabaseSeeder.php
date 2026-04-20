<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\PortfolioProfile;
use App\Models\Skill;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@porto.com',
            'password' => Hash::make('password123'),
        ]);

        // Profile data
        PortfolioProfile::create([
            'nama'        => 'Nama Kamu',
            'tagline'     => 'Full Stack Developer & UI Enthusiast',
            'deskripsi'   => 'Mahasiswa yang passionate di bidang web development. Suka ngoding, suka ngopi, dan selalu semangat belajar hal baru. Open to work dan collaboration!',
            'email'       => 'kamu@email.com',
            'github'      => 'https://github.com/username',
            'instagram'   => 'https://instagram.com/username',
            'foto'        => null,
        ]);

        // Skills
        $skills = [
            ['nama' => 'Laravel',    'level' => 80, 'kategori' => 'Backend'],
            ['nama' => 'PHP',        'level' => 75, 'kategori' => 'Backend'],
            ['nama' => 'MySQL',      'level' => 70, 'kategori' => 'Backend'],
            ['nama' => 'JavaScript', 'level' => 72, 'kategori' => 'Frontend'],
            ['nama' => 'HTML & CSS', 'level' => 90, 'kategori' => 'Frontend'],
            ['nama' => 'Bootstrap',  'level' => 85, 'kategori' => 'Frontend'],
            ['nama' => 'Git',        'level' => 75, 'kategori' => 'Tools'],
            ['nama' => 'VS Code',    'level' => 95, 'kategori' => 'Tools'],
        ];

        foreach ($skills as $s) {
            Skill::create($s);
        }
    }
}
