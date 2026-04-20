<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{User, Profile, Skill, Experience, Education, Project};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name' => 'Bayu Kuncoro', 'email' => 'bayukuncoroadi542@gmail.com', 'password' => Hash::make('password123')]);

        Profile::create([
            'nama' => 'Bayu Kuncoro Adi',
            'profesi' => 'Full-Stack Web Developer',
            'deskripsi' => 'Mahasiswa Informatika yang berfokus pada pengembangan sistem web berbasis Laravel dan analisis data. Memiliki ketertarikan kuat dalam merancang arsitektur database dan optimasi algoritma.',
            'github_link' => 'https://github.com/baykncr',
            'linkedin_link' => 'www.linkedin.com/in/bayu-kuncoro-7584002b0/'
        ]);

        Skill::create(['nama_skill' => 'Laravel & PHP', 'persentase' => 90]);
        Skill::create(['nama_skill' => 'MySQL & Database Mgmt', 'persentase' => 88]);
        Skill::create(['nama_skill' => 'Tailwind & Bootstrap', 'persentase' => 85]);
        Skill::create(['nama_skill' => 'Machine Learning (K-Means)', 'persentase' => 80]);

        Experience::create(['kategori' => 'Organisasi', 'posisi' => 'Staff Departemen PSDM', 'instansi' => 'Himpunan Mahasiswa Teknik Informatika', 'tahun' => '2024 - 2025']);
        Experience::create(['kategori' => 'Kerja', 'posisi' => 'Network Engineer', 'instansi' => 'PT. CALL=YSTA TOTAL SOLUSINDO', 'tahun' => '2023 - Sekarang']);

        Education::create(['institusi' => 'Telkom University Purwokerto', 'jurusan' => 'S1 Informatika (Semester 6)', 'tahun' => '2023 - Sekarang']);

        Project::create(['judul' => 'Sistem Inventori Toko Aimar', 'deskripsi' => 'Aplikasi web manajemen gudang dan kasir menggunakan Laravel 13 dengan fitur CRUD, AJAX, dan autentikasi.', 'link_project' => '#']);
        Project::create(['judul' => 'KlikKantin', 'deskripsi' => 'Katalog digital berbasis web untuk mempermudah pemesanan menu kantin kampus yang terintegrasi dengan WhatsApp.', 'link_project' => '#']);
        Project::create(['judul' => 'Segmentasi Trafik Jaringan K-Means Clustering pada ISP PT. Callysta Total Solusindo', 'deskripsi' => 'Riset optimasi monitoring ISP menggunakan algoritma K-Means Clustering berbasis Machine Learning.', 'link_project' => '#']);
    }
}