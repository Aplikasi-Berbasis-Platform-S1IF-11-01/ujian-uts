<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        DB::table('admins')->insert([
            'name'       => 'Admin',
            'email'      => 'admin@portfolio.com',
            'password'   => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Profile
        DB::table('profiles')->insert([
            'name'        => 'Avrizal Setyo Aji Nugroho',
            'tagline'     => 'IT Student & Developer',
            'bio'         => 'Mahasiswa S1 Informatika di Telkom University Purwokerto. Passionate di bidang web development, UI/UX design, dan open to freelance projects.',
            'email'       => 'rizalnugroho174@gmail.com',
            'phone'       => '+62 896-6635-0560',
            'location'    => 'Purbalingga, Jawa Tengah',
            'github'      => 'https://github.com/avrizal',
            'linkedin'    => 'https://linkedin.com/in/avrizal',
            'instagram'   => 'https://instagram.com/avrizal',
            'whatsapp'    => 'https://wa.me/6289666350560',
            'photo'       => null,
            'typed_words' => json_encode(['IT Student', 'Web Developer', 'UI/UX Designer', 'Freelancer', 'Gamer']),
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        // Skills
        $skills = [
            ['name' => 'HTML & CSS',    'percentage' => 90, 'category' => 'technical', 'sort_order' => 1],
            ['name' => 'JavaScript',    'percentage' => 75, 'category' => 'technical', 'sort_order' => 2],
            ['name' => 'PHP & Laravel', 'percentage' => 70, 'category' => 'technical', 'sort_order' => 3],
            ['name' => 'MySQL',         'percentage' => 72, 'category' => 'technical', 'sort_order' => 4],
            ['name' => 'Figma / UI Design', 'percentage' => 65, 'category' => 'tools',  'sort_order' => 5],
            ['name' => 'Git & GitHub',  'percentage' => 68, 'category' => 'tools',     'sort_order' => 6],
            ['name' => 'Teamwork',      'percentage' => 85, 'category' => 'soft',      'sort_order' => 7],
            ['name' => 'Problem Solving','percentage' => 80, 'category' => 'soft',     'sort_order' => 8],
        ];

        foreach ($skills as $skill) {
            DB::table('skills')->insert(array_merge($skill, [
                'is_active'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Projects
        DB::table('projects')->insert([
            [
                'title'       => 'Univent - Campus Event Platform',
                'description' => 'Platform manajemen event kampus untuk Telkom University Purwokerto. Menampilkan event seminar, workshop, dan kompetisi dari berbagai organisasi mahasiswa.',
                'tech_stack'  => 'Laravel, MySQL, Bootstrap, AJAX',
                'image'       => null,
                'github_url'  => 'https://github.com/avrizal/univent',
                'live_url'    => null,
                'sort_order'  => 1,
                'is_active'   => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
