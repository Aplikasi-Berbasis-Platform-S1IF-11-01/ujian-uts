<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Profile
        Profile::create([
            'full_name' => 'Boutefhika Nuha Ziyadatul Khair',
            'nim' => '2311102316',
            'title' => 'Mahasiswi Informatika',
            'about' => 'Halo! Saya Nuha, mahasiswi Teknik Informatika yang passionate di bidang pengembangan web dan desain UI/UX. Saya senang mengeksplorasi teknologi baru dan menciptakan solusi digital yang elegan dan fungsional. Di waktu luang, saya juga aktif berkontribusi pada proyek-proyek kreatif bersama komunitas kampus.',
            'email' => 'bnzk09@gmail.com',
            'phone' => '089620385711',
            'location' => 'Cilacap, Jawa Tengah, Indonesia',
            'github' => 'nhaazk95',
            'instagram' => 'nhaazk',
            'photo' => null,
        ]);

        // Skills
        $skills = [
            ['name' => 'C++', 'icon' => '💻', 'category' => 'programming', 'sort_order' => 1],
            ['name' => 'Python', 'icon' => '🐍', 'category' => 'programming', 'sort_order' => 2],
            ['name' => 'Java', 'icon' => '☕', 'category' => 'programming', 'sort_order' => 3],
            ['name' => 'HTML/CSS', 'icon' => '🌐', 'category' => 'web', 'sort_order' => 4],
            ['name' => 'PHP', 'icon' => '🐘', 'category' => 'web', 'sort_order' => 5],
            ['name' => 'Laravel', 'icon' => '🔴', 'category' => 'web', 'sort_order' => 6],
            ['name' => 'SQL', 'icon' => '🗄', 'category' => 'database', 'sort_order' => 7],
            ['name' => 'Figma', 'icon' => '🎨', 'category' => 'design', 'sort_order' => 8],
            ['name' => 'Git', 'icon' => '🌿', 'category' => 'tools', 'sort_order' => 9],
            ['name' => 'JavaScript', 'icon' => '⚡', 'category' => 'web', 'sort_order' => 10],
        ];
        foreach ($skills as $s) {
            Skill::create(array_merge($s, ['is_active' => true]));
        }

        // Education
        Education::create([
            'institution' => 'SMK Telkom purwokerto',
            'major' => 'Teknik Komputer dan Jaringan',
            'degree' => 'SMK',
            'year_start' => '2020',
            'year_end' => '2023',
            'sort_order' => 2,
            'is_active' => true,
        ]);
        Education::create([
            'institution' => 'Universitas Telkom Purwokerto',
            'major' => 'Teknik Informatika',
            'degree' => 'S1',
            'year_start' => '2023',
            'year_end' => 'Sekarang',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        // Experiences
        Experience::create([
            'company' => 'PT SIMS',
            'position' => 'Admin Cleon & Teknisi Jaringan WiFi',
            'location' => 'Yogyakarta',
            'year' => '2022',
            'duration' => '3 bulan',
            'responsibilities' => [
                'Melakukan pengecekan dan monitoring jaringan WiFi',
                'Menangani laporan gangguan dari pelanggan',
                'Troubleshooting lapangan',
                'Menjawab pesan pelanggan terkait gangguan jaringan',
                'Mengatur pembayaran bulanan pelanggan',
                'Menyusun dan memperbarui data pelanggan',
                'Instalasi perangkat WiFi di lokasi pelanggan',
                'Membuat laporan harian aktivitas teknisi',
                'Berkoordinasi dengan tim teknisi'
            ],
            'sort_order' => 1,
            'is_active' => true
        ]);

        Experience::create([
            'company' => 'Life Media',
            'position' => 'Admin Sales',
            'location' => 'Yogyakarta',
            'year' => '2022',
            'duration' => '3 bulan',
            'responsibilities' => [
                'Mendata aktivitas harian sales',
                'Mencatat wilayah distribusi',
                'Mengelompokkan data pelanggan',
                'Membuat rekap mingguan',
                'Koordinasi tim sales dan teknisi'
            ],
            'sort_order' => 2,
            'is_active' => true
        ]);

        // Projects
        Project::create([
            'title' => 'Membuat Web Skribee',
            'description' => 'Platform bimbingan skripsi antara dosen dan mahasiswa dengan fitur pengajuan bimbingan, jadwal bimbingan, dll. Dibangun menggunakan Laravel dan Bootstrap.',
            'tech_stack' => 'Laravel, Bootstrap, MySQL',
            'url' => '#',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        Project::create([
            'title' => 'Perancangan Web Pemesanan Makanan',
            'description' => 'Sistem pemesanan makanan restoran online dengan fitur keranjang belanja, manajemen menu admin, dan notifikasi real-time.',
            'tech_stack' => 'Laravel, Bootstrap, MySQL',
            'url' => '#',
            'sort_order' => 2,
            'is_active' => true,
        ]);
        Project::create([
            'title' => 'Analisis Sentimen Komentar',
            'description' => 'Aplikasi machine learning untuk menganalisis sentimen komentar media sosial menggunakan Python dan library NLTK.',
            'tech_stack' => 'Python, NLTK, Pandas, Flask',
            'url' => '#',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        // Site Settings
        SiteSetting::set('admin_username', 'admin');
        SiteSetting::set('admin_password', Hash::make('admin123'));
        SiteSetting::set('show_github', '1');
        SiteSetting::set('show_quote', '1');
        SiteSetting::set('github_token', '');
        SiteSetting::set('quote_api_key', 'gxT6ZTjXSn0s5WeV5RZP9iRAPS6eTX4HKkczHB3j');
    }
}