<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Experience;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Mengisi Data Profil (Hanya 1 baris)
        Profile::create([
            'nama' => 'Rico Ade Pratama',
            'email' => 'rico.ade@example.com',
            'no_hp' => '081234567890',
            'sekolah' => 'Telkom University Purwokerto',
            'alamat' => 'Purwokerto, Jawa Tengah',
            'deskripsi' => 'Saya adalah seorang mahasiswa S1 Teknik Informatika. Saya menyadari bahwa saya bukanlah orang yang sangat mahir, tetapi saya adalah seseorang yang rajin, mau belajar, dan profesional dalam setiap tanggung jawab. Fokus utama saya saat ini adalah pengembangan Back-End, pembuatan API, dan merancang antarmuka UI/UX yang interaktif.',
            'foto' => null // Bisa diupdate nanti via dashboard
        ]);

        // 2. Mengisi Data Skill
        $skills = [
            'Laravel', 'Node.js', 'Python', 'MySQL', 'ExpressJS', 'UI/UX Design', 'Tailwind CSS', 'AJAX'
        ];

        foreach ($skills as $skill) {
            Skill::create(['nama_skill' => $skill]);
        }

        // 3. Mengisi Data Karya/Project
        Project::create([
            'nama_proyek' => 'Sistem Informasi Lost & Found',
            'link_github' => 'https://github.com/rico-ade-pratama/lost-and-found-tup',
            'deskripsi' => 'Aplikasi web berbasis framework Laravel yang dikembangkan menggunakan metode Rapid Application Development (RAD) untuk menangani barang hilang dan ditemukan di area kampus.'
        ]);

        Project::create([
            'nama_proyek' => 'YNWA-Inventory App',
            'link_github' => 'https://github.com/rico-ade-pratama/ynwa-inventory',
            'deskripsi' => 'Sistem manajemen inventaris web yang dibangun menggunakan NodeJS dan ExpressJS. Memiliki fitur CRUD lengkap dan struktur direktori yang rapi untuk skalabilitas.'
        ]);

        Project::create([
            'nama_proyek' => 'Carehub / Sintas App API',
            'link_github' => 'https://github.com/rico-ade-pratama/carehub-api',
            'deskripsi' => 'Pengembangan antarmuka pemrograman aplikasi (API) untuk manajemen sistem backend. Diintegrasikan dengan autentikasi yang aman.'
        ]);

        // 4. Mengisi Data Latar Belakang (Menggunakan tabel Experience)
        Experience::create([
            'perusahaan' => 'Telkom University Purwokerto',
            'posisi' => 'S1 Teknik Informatika',
            'tahun' => '2023 - Sekarang'
        ]);

        Experience::create([
            'perusahaan' => 'SMA Negeri 1 Jatilawang',
            'posisi' => 'Jurusan MIPA',
            'tahun' => '2020 - 2023'
        ]);
    }
}