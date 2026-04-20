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
        DB::table('users')->insert([
            'name' => 'Andika Neviantoro',
            'email' => 'admin@portfolio.com',
            'password' => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Profile
        DB::table('profiles')->insert([
            'name' => 'Andika Neviantoro',
            'title' => 'UI Developer',
            'nim' => '2311102167',
            'university' => 'Telkom University Purwokerto',
            'description' => 'Mahasiswa Informatika yang antusias dengan dunia UI/UX dan pengembangan web. Saya suka merancang antarmuka yang bersih, fungsional, dan menyenangkan untuk digunakan. Selain ngoding, saya juga suka mendaki dan memotret lanskap.',
            'photo' => null,
            'github_username' => 'andikaneviantoro',
            'status_label' => 'Available for work',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Skills
        DB::table('skills')->insert([
            [
                'category' => 'Frontend',
                'icon_color' => '#e8580a',
                'items' => json_encode(['HTML5', 'CSS3', 'JavaScript', 'Vue.js', 'Bootstrap', 'Tailwind CSS']),
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Backend',
                'icon_color' => '#3d8c7a',
                'items' => json_encode(['PHP', 'Laravel', 'MySQL', 'Node.js', 'REST API']),
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Tools & Others',
                'icon_color' => '#b07a10',
                'items' => json_encode(['Git', 'GitHub', 'Figma', 'VS Code', 'Postman', 'Linux']),
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Education
        DB::table('education')->insert([
            [
                'school' => 'Telkom University Purwokerto',
                'major' => 'S1 Informatika',
                'period' => '2023 – Sekarang',
                'status' => 'active',
                'icon_bg' => '#eef4fb',
                'icon_color' => '#0077b5',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'school' => 'SMA Negeri 1 Purwokerto',
                'major' => 'IPA',
                'period' => '2020 – 2023',
                'status' => 'done',
                'icon_bg' => '#f0faf3',
                'icon_color' => '#3d8c7a',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Projects
        DB::table('projects')->insert([
            [
                'title' => 'Portfolio Website',
                'description' => 'Website portofolio personal dengan desain minimalis dan animasi halus.',
                'tag' => 'Front-End Dev',
                'thumb_type' => 'pt-o',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'UI Kit Dashboard',
                'description' => 'Komponen UI dashboard modern untuk aplikasi web enterprise.',
                'tag' => 'UI/UX Design',
                'thumb_type' => 'pt-s',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sistem Koperasi',
                'description' => 'Sistem manajemen koperasi untuk simpan-pinjam anggota.',
                'tag' => 'Full Stack',
                'thumb_type' => 'pt-k',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Contacts
        DB::table('contacts')->insert([
            [
                'type' => 'email',
                'label' => 'Email',
                'value' => 'neviantoroa@gmail.com',
                'url' => 'mailto:neviantoroa@gmail.com',
                'icon_bg' => '#fef2f2',
                'icon_color' => '#e8580a',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'instagram',
                'label' => 'Instagram',
                'value' => '@dikanevtro',
                'url' => 'https://instagram.com/dikanevtro',
                'icon_bg' => '#fdf2fb',
                'icon_color' => '#c13584',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'github',
                'label' => 'GitHub',
                'value' => 'andikaneviantoro',
                'url' => 'https://github.com/andikaneviantoro',
                'icon_bg' => '#f3f3f3',
                'icon_color' => '#24292e',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'linkedin',
                'label' => 'LinkedIn',
                'value' => 'Andika Neviantoro',
                'url' => 'https://www.linkedin.com/in/andika-neviantoro-65b15a390',
                'icon_bg' => '#eef4fb',
                'icon_color' => '#0077b5',
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'whatsapp',
                'label' => 'WhatsApp',
                'value' => '+62 813 1426 3527',
                'url' => 'https://wa.me/6281314263527',
                'icon_bg' => '#f0faf3',
                'icon_color' => '#25d366',
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
