<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin Deshan',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        \App\Models\Profile::create([
            'description' => 'Mahasiswa Teknik Informatika Telkom University Purwokerto. Saya memiliki passion mendalam dalam merancang antarmuka yang intuitif (UI/UX) sekaligus merealisasikannya dalam bentuk kode (Frontend Development) untuk menciptakan pengalaman digital yang seamless, elegan, dan berdampak.',
            'profile_picture' => 'assets/profile.jpeg',
            'email' => '2311102326@ittelkom-pwt.ac.id',
            'github' => 'https://github.com/deshanreal',
            'instagram' => 'https://www.instagram.com/deshanrafif/',
            'dribbble' => '#'
        ]);

        $skills = [
            ['name' => 'Figma / UI Design', 'category' => 'technical'],
            ['name' => 'UX Research', 'category' => 'technical'],
            ['name' => 'HTML & CSS', 'category' => 'technical'],
            ['name' => 'JavaScript', 'category' => 'technical'],
            ['name' => 'Bootstrap', 'category' => 'technical'],
            ['name' => 'PHP & MySQL', 'category' => 'technical'],
            ['name' => 'Kerja Tim', 'category' => 'soft_skills'],
            ['name' => 'Komunikasi Visual', 'category' => 'soft_skills'],
            ['name' => 'Kepemimpinan', 'category' => 'soft_skills'],
            ['name' => 'Manajemen Waktu', 'category' => 'soft_skills'],
            ['name' => 'Empati Pengguna (UX)', 'category' => 'soft_skills'],
            ['name' => 'Analisis Kuesioner', 'category' => 'scientific'],
            ['name' => 'Problem Solving', 'category' => 'scientific'],
            ['name' => 'Logika Algoritma', 'category' => 'scientific'],
            ['name' => 'Pemikiran Kritis', 'category' => 'scientific'],
            ['name' => 'Riset Kompetitor', 'category' => 'scientific'],
        ];

        foreach ($skills as $skill) {
            \App\Models\Skill::create($skill);
        }

        $educations = [
            ['institution' => 'Telkom University Purwokerto', 'degree' => 'S1 Informatika | Sekarang', 'description' => 'Fokus mempelajari pengembangan piranti lunak, UI/UX Research, analisis data, algoritma, serta mempraktikkannya ke dalam pengembangan aplikasi web modern.'],
            ['institution' => 'SMA N 1 Karanganyar', 'degree' => 'Jurusan MIPA', 'description' => 'Mendalami ilmu matematika dan sains, aktif membangun fondasi logika yang kuat dan *critical thinking* untuk memecahkan masalah sistem komputasional.'],
        ];

        foreach ($educations as $edu) {
            \App\Models\Education::create($edu);
        }

        $experiences = [
            ['title' => 'MPK (Majelis Perwakilan Kelas)', 'category' => 'Organisasi', 'description' => 'Membangun keterampilan kepemimpinan, public speaking, serta menjadi jembatan diplomasi dan penyalur aspirasi antara siswa dan sekolah.', 'image' => null],
            ['title' => 'GDSC (Google Developer Student Clubs)', 'category' => 'Organisasi', 'description' => 'Aktif di dalam komunitas teknologi dengan mengeksplorasi ekosistem Google, melatih kolaborasi tim, serta mendesain prototipe solusi digital.', 'image' => null],
            ['title' => 'Magang Industri', 'category' => 'Magang', 'description' => 'Menerapkan keterampilan ke dalam skenario dunia nyata, bekerja berdampingan dengan pro fesional dan memahami siklus pengembangan desain serta produk digital secara menyeluruh.', 'image' => 'assets/magang.jpg'],
        ];

        foreach ($experiences as $exp) {
            \App\Models\Experience::create($exp);
        }

        $projects = [
            ['title' => 'Sistem Inventaris Indocement', 'category' => 'Dashboard UI', 'description' => 'Sistem Manajemen Inventaris Aset Elektronik untuk Koperasi Karyawan Indocement. Dirancang dengan dashboard analitik modern yang rapi dan visualisasi data yang informatif melalui chart interaktif.', 'image' => 'assets/porto1.png'],
            ['title' => 'COCSLEBEW Top Up Game', 'category' => 'Web Design', 'description' => 'Website Platform Top Up Voucher Game Clash of Clans. Dibangun sebagai antarmuka yang tematik, dinamis, dan responsif dengan integrasi daftar layanan top-up untuk kebutuhan tugas kelompok.', 'image' => 'assets/porto2.png'],
            ['title' => 'Pixora Studio Landing Page', 'category' => 'Landing Page', 'description' => 'Situs Company Profile dan Landing Page untuk Pixora Studio. Mengkampanyekan jasa promo fotografi produk/UMKM termurah se-Purwokerto yang dikemas dalam desain UI yang clean, bright, dan elegan.', 'image' => 'assets/porto3.png'],
        ];

        foreach ($projects as $proj) {
            \App\Models\Project::create($proj);
        }
    }
}
