<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Profile
        DB::table('profiles')->insert([
            'name'           => 'Raihan Ramadhan',
            'nim'            => '2311102040',
            'class'          => 'IF-11-01',
            'tagline'        => 'Frontend Developer & UI Enthusiast',
            'description'    => 'Halo! Saya Raihan Ramadhan, Mahasiswa Teknik Informatika Telkom University Purwokerto angkatan 2023. Saya memiliki passion yang kuat di bidang pengembangan web dan rekayasa perangkat lunak modern. Saya memiliki ketertarikan dalam bidang Web Development, khususnya pada pengembangan antarmuka pengguna (Front-End Development). Saya fokus pada pembuatan tampilan yang responsif, intuitif, dan nyaman digunakan.',
            'photo'          => null,
            'email'          => 'rraihanr9@gmail.com',
            'github'         => 'raicd',
            'instagram'      => 'raihanrrmdhn',
            'location'       => 'Purwokerto, Jawa Tengah',
            'gpa'            => 3.68,
            'projects_count' => 2,
            'tech_count'     => 10,
            'available'      => true,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        // Skills
        $skills = [
            ['name' => 'HTML & CSS',         'category' => 'frontend', 'percentage' => 90, 'icon' => 'bi-filetype-html', 'sort_order' => 1],
            ['name' => 'JavaScript (Native)', 'category' => 'frontend', 'percentage' => 85, 'icon' => 'bi-filetype-js',   'sort_order' => 2],
            ['name' => 'Bootstrap 5',         'category' => 'frontend', 'percentage' => 88, 'icon' => 'bi-bootstrap',     'sort_order' => 3],
            ['name' => 'PHP / Laravel',       'category' => 'backend',  'percentage' => 80, 'icon' => 'bi-code-slash',    'sort_order' => 4],
            ['name' => 'MySQL / PostgreSQL',  'category' => 'backend',  'percentage' => 30, 'icon' => 'bi-database',      'sort_order' => 5],
            ['name' => 'Git & GitHub',        'category' => 'tools',    'percentage' => 75, 'icon' => 'bi-git',           'sort_order' => 6],
            ['name' => 'VS Code',             'category' => 'tools',    'percentage' => 90, 'icon' => 'bi-code-slash',    'sort_order' => 7],
            ['name' => 'Figma',               'category' => 'tools',    'percentage' => 65, 'icon' => 'bi-vector-pen',    'sort_order' => 8],
            ['name' => 'Python',              'category' => 'tools',    'percentage' => 50, 'icon' => 'bi-filetype-py',   'sort_order' => 9],
            ['name' => 'Tailwind CSS',        'category' => 'frontend', 'percentage' => 70, 'icon' => 'bi-wind',          'sort_order' => 10],
        ];
        foreach ($skills as $s) {
            DB::table('skills')->insert(array_merge($s, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Projects
        $projects = [
            [
                'title'       => 'Sistem Arsip Pengadaan Barang dan Jasa',
                'type'        => 'Web Application',
                'description' => 'Aplikasi web untuk mengarsipkan dokumen pengadaan barang dan jasa Universitas Jenderal Soedirman.',
                'image'       => 'siapabaja.jpeg',
                'github_url'  => '#',
                'demo_url'    => '#',
                'tech_stack'  => 'Laravel,PostgreSQL,Bootstrap,Chart.js',
                'sort_order'  => 1,
                'is_featured' => true,
            ],
            [
                'title'       => 'GoedangKita',
                'type'        => 'Web Application',
                'description' => 'GoedangKita adalah website untuk pengelolaan manajemen gudang.',
                'image'       => 'goedangkita.JPG',
                'github_url'  => '#',
                'demo_url'    => '#',
                'tech_stack'  => 'Laravel,MySQL,Bootstrap,PHP,CSS',
                'sort_order'  => 2,
                'is_featured' => true,
            ],
        ];
        foreach ($projects as $p) {
            DB::table('projects')->insert(array_merge($p, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Education
        $educations = [
            ['degree' => 'S1 Teknik Informatika', 'school' => 'Telkom University Purwokerto', 'year_start' => '2023', 'year_end' => 'Sekarang', 'sort_order' => 1],
            ['degree' => 'TKJ (Teknik Komputer dan Jaringan)', 'school' => 'SMK Telkom Purwokerto', 'year_start' => '2020', 'year_end' => '2023', 'sort_order' => 2],
            ['degree' => 'Sekolah Menengah Pertama', 'school' => 'SMP Negeri 1 Kalibagor', 'year_start' => '2017', 'year_end' => '2020', 'sort_order' => 3],
        ];
        foreach ($educations as $e) {
            DB::table('educations')->insert(array_merge($e, ['created_at' => now(), 'updated_at' => now()]));
        }

        // Admin user
        DB::table('users')->insert([
            'name'       => 'Admin Raihan',
            'email'      => 'admin@portfolio.com',
            'password'   => Hash::make('admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}