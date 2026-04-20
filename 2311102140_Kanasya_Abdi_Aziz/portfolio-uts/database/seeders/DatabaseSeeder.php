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
        // User admin
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@portfolio.com',
            'password' => Hash::make('password123'),
        ]);

        // Data diri (ganti dengan data kamu)
        Profile::create([
            'name'     => 'Kanasya Abdi Aziz',
            'title'    => 'Fronted End Developer',
            'bio'      => 'Mahasiswa yang passionate di bidang web development.',
            'email'    => 'kanasyaabdiaziz@gmail.com',
            'location' => 'Purwokerto, Indonesia',
            'github'   => 'https://github.com/asya665',
        ]);

        // Skills awal
        $skills = [
            ['name' => 'Laravel',    'category' => 'Backend',  'level' => 70, 'order' => 1],
            ['name' => 'PHP',        'category' => 'Backend',  'level' => 70, 'order' => 2],
            ['name' => 'JavaScript', 'category' => 'Frontend', 'level' => 75, 'order' => 3],
            ['name' => 'Tailwind',   'category' => 'Frontend', 'level' => 80, 'order' => 4],
            ['name' => 'MySQL',      'category' => 'Database', 'level' => 70, 'order' => 5],
            ['name' => 'Git',        'category' => 'Tools',    'level' => 75, 'order' => 6],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}