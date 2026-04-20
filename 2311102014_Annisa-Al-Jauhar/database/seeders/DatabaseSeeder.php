<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Annisa Al Jauhar',
            'email'    => 'jauharannisaal@gmail.com',
            'password' => Hash::make('password'),
        ]);

        Profile::create([
            'name'            => 'Annisa Al Jauhar',
            'tagline'         => 'Mahasiswi Teknik Informatika | Public Speaker & Team Player',
            'bio'             => 'Halo! Saya Annisa Al Jauhar, mahasiswi angkatan 2023 yang penuh semangat dan siap membawa energi positif. Berpengalaman dalam berbicara di depan publik, memiliki kemampuan komunikasi yang baik, dan selalu siap menjadi pendengar yang baik.',
            'email'           => 'jauharannisaal@gmail.com',
            'phone'           => '085601007677',
            'location'        => 'Purwokerto, Jawa Tengah',
            'github_username' => 'annisaaljauhar', // ← GANTI dengan username GitHub kamu
            'linkedin_url'    => null,
            'instagram_url'   => null,
        ]);

        $skills = [
            ['name' => 'Kerja Sama Tim',       'category' => 'Soft Skill', 'level' => 90, 'icon' => '🤝', 'order' => 0],
            ['name' => 'Komunikasi',            'category' => 'Soft Skill', 'level' => 88, 'icon' => '💬', 'order' => 1],
            ['name' => 'Bertanggungjawab',      'category' => 'Soft Skill', 'level' => 92, 'icon' => '✅', 'order' => 2],
            ['name' => 'Public Speaking',       'category' => 'Soft Skill', 'level' => 85, 'icon' => '🎤', 'order' => 3],
            ['name' => 'Manajemen Waktu',       'category' => 'Soft Skill', 'level' => 80, 'icon' => '⏱️', 'order' => 4],
            ['name' => 'Jaringan Komputer',     'category' => 'Teknis',     'level' => 78, 'icon' => '🌐', 'order' => 5],
            ['name' => 'Konfigurasi Jaringan',  'category' => 'Teknis',     'level' => 75, 'icon' => '🔧', 'order' => 6],
            ['name' => 'Administrasi Data',     'category' => 'Teknis',     'level' => 80, 'icon' => '📊', 'order' => 7],
        ];
        foreach ($skills as $skill) {
            Skill::create($skill);
        }

        // Magang terbaru dulu (order 0 = paling atas)
        Experience::create([
            'company'     => 'BPRS Buana Mitra Perwira',
            'role'        => 'Magang',
            'description' => 'Melaksanakan kegiatan magang dan mendukung operasional perbankan syariah di BPRS Buana Mitra Perwira Purwokerto.',
            'start_date'  => '14 Januari 2026',
            'end_date'    => '19 Februari 2026',
            'order'       => 0,
        ]);

        Experience::create([
            'company'     => 'Himpunan Mahasiswa Informatika',
            'role'        => 'Anggota Aktif',
            'description' => 'Aktif mengikuti dan menjalankan program kerja organisasi. Berpartisipasi dalam berbagai kegiatan kampus dan eksternal, mendukung koordinasi lintas divisi, serta mengasah kemampuan komunikasi dan manajemen waktu.',
            'start_date'  => 'Agustus 2024',
            'end_date'    => 'Mei 2025',
            'order'       => 1,
        ]);

        Experience::create([
            'company'     => 'Icon+ (Iconnet) Semarang',
            'role'        => 'Admin Divisi Pemeliharaan — PKL',
            'description' => 'Membantu staf Teknisi terhadap Working Permit dan mendata alat yang keluar dari gudang perusahaan.',
            'start_date'  => 'April 2022',
            'end_date'    => 'September 2022',
            'order'       => 2,
        ]);

        Education::create([
            'institution' => 'Telkom University Purwokerto',
            'degree'      => 'S1',
            'field'       => 'Teknik Informatika',
            'start_year'  => '2023',
            'end_year'    => null,
            'description' => 'Program studi yang mempersiapkan kemampuan pemrograman dan melatih ketelitian dalam pemecahan masalah teknis.',
            'order'       => 0,
        ]);

        Education::create([
            'institution' => 'SMK Telkom Sandy Putra Purwokerto',
            'degree'      => 'SMK',
            'field'       => 'Teknik Komputer dan Jaringan',
            'start_year'  => '2020',
            'end_year'    => '2023',
            'description' => 'Memiliki kemampuan di bidang komputer dan jaringan: membuat kabel RJ45, Kabel OTP, konfigurasi dan instalasi jaringan.',
            'order'       => 1,
        ]);
    }
}
