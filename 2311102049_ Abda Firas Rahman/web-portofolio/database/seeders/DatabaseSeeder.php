<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Education;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bikin Akun Admin 
        User::create([
            'name' => 'Admin Abda',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password123'),
        ]);

        // 2. Data Profil Bawaan
        Profile::create([
            'name' => 'Abda Firas Rahman',
            'role' => 'Informatics Student & Web Developer',
            'description' => 'Halo! Saya mahasiswa Teknik Informatika dari IT Telkom Purwokerto yang sedang belajar Full-stack Development.',
        ]);

        // 3. Data Tech Stack Bawaan
        Skill::create(['skill_name' => 'Laravel', 'percentage' => 85]);
        Skill::create(['skill_name' => 'PHP', 'percentage' => 80]);
        Skill::create(['skill_name' => 'MySQL', 'percentage' => 75]);

        // 4. Data Portfolio 
        Project::create([
            'category' => 'Web Development',
            'title' => 'Sistem Magang (SIMGANG)',
            'description' => 'Pengembangan beberapa fitur seperti tampilan jumlah siswa magang untuk Web SIMGANG Dinkominfo Cilacap menggunakan Laravel.'
        ]);
        Project::create([
            'category' => 'Personal Project',
            'title' => 'SIGAJI',
            'description' => 'Membangun sistem penggajian karyawan sederhana menggunakan HTML, CSS, PHP native.'
        ]);
        Project::create([
            'category' => 'Team Project',
            'title' => 'Website Univent',
            'description' => 'Membangun website tentang informasi-informasi event kampus.'
        ]);

        // 5. Data Education 
        Education::create([
            'institution' => 'Telkom University Purwokerto',
            'degree' => 'S1 Teknik Informatika',
            'year' => '2023 - Sekarang'
        ]);
        Education::create([
            'institution' => 'MAN 1 Kota Pekalongan',
            'degree' => 'Jurusan IPA',
            'year' => '2020 - 2023'
        ]);
        Education::create([
            'institution' => 'MTs Negeri 2 Brebes',
            'degree' => 'Umum',
            'year' => '2017 - 2020'
        ]);
    }
}