<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Profile::create([
            'name' => 'Aisyah Anis Mazaya',
            'headline' => 'Menggabungkan Logika dan Kepemimpinan untuk Solusi Teknologi',
            'description' => 'Dengan IPK 3.68, saya adalah mahasiswi S1 Teknik Informatika di Telkom University Purwokerto...',
            'achieve_1_title' => 'Peringkat 7 Tingkat Nasional',
            'achieve_1_desc' => 'Penyusunan Proposal P2MW.',
            'achieve_2_title' => 'Certified Junior Network Administrator',
            'achieve_2_desc' => 'Sertifikasi BNSP.',
            'edu_1_major' => 'S1 Teknik Informatika',
            'edu_1_year' => '2023 - Sekarang | IPK: 3.68',
            'edu_1_campus' => 'Telkom University Purwokerto',
            'edu_1_desc' => 'Fokus pada pengembangan Web dan IoT., Aktif berorganisasi di KSR PMI.',
            'edu_2_major' => 'Teknik Komputer & Jaringan',
            'edu_2_year' => '2020 - 2023 | Rata-rata: 89.05',
            'edu_2_campus' => 'SMK Telkom Banjarbaru',
            'edu_2_desc' => 'Top 10 Student., Penerima Beasiswa OPES., Eligible Ke-14 SNBP.',
            'hard_skills' => 'HTML / CSS, Laravel / PHP, Java & Python, UI/UX Design',
            'soft_skills' => 'Leadership, Public Speaking, Problem Solving, Teamwork'
        ]);
    }
}