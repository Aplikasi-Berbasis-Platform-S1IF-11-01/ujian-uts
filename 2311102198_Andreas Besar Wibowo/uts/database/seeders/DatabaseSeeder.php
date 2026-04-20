<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user (skip if exists)
        if (!DB::table('users')->where('email', 'admin@portfolio.com')->exists()) {
            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@portfolio.com',
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Profile
        if (!DB::table('profiles')->exists()) {
            DB::table('profiles')->insert([
                'name' => 'Andreas Besar Wibowo',
                'tagline' => 'Mahasiswa Teknik Informatika | Web Developer & Data Analyst',
                'about' => 'Saya adalah Andreas Besar Wibowo, mahasiswa Telkom University Purwokerto angkatan 2023 yang saat ini menempuh pendidikan di semester 6 pada program studi Teknik Informatika. Saya memiliki minat dalam bidang pemrograman web dan analisis data, serta terus mengembangkan kemampuan dalam membangun aplikasi dan mengolah data untuk menghasilkan insight yang bermanfaat. Saya terbiasa menggunakan berbagai tools dan bahasa pemrograman untuk menyelesaikan permasalahan secara logis, sistematis, dan efisien.',
                'email' => 'andreaswibowo903@gmail.com',
                'photo' => null,
                'instagram' => 'https://www.instagram.com/andreaswibowooo/',
                'linkedin' => 'https://www.linkedin.com/in/andreas-besar-wibowo-b282a23b4/',
                'github' => 'https://github.com/AndreasBesar29',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Education
        if (!DB::table('educations')->exists()) {
            DB::table('educations')->insert([
                [
                    'institution' => 'Telkom University Purwokerto',
                    'major' => 'S1 Teknik Informatika',
                    'period' => '2023 - Sekarang',
                    'order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'institution' => 'SMA Yos Sudarso Cilacap',
                    'major' => 'Peminatan MIPA',
                    'period' => '2020 - 2023',
                    'order' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        // Skills
        if (!DB::table('skills')->exists()) {
            DB::table('skills')->insert([
                ['name' => 'HTML', 'color' => '#e34c26', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'CSS', 'color' => '#264de4', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'JavaScript', 'color' => '#f7df1e', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Bootstrap', 'color' => '#7952b3', 'order' => 4, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Python', 'color' => '#3572A5', 'order' => 5, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Laravel', 'color' => '#ff2d20', 'order' => 6, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Java', 'color' => '#b07219', 'order' => 7, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        // Portfolios
        if (!DB::table('portfolios')->exists()) {
            DB::table('portfolios')->insert([
                [
                    'title' => 'Project Membuat Website',
                    'description' => 'Membangun website portfolio responsif menggunakan HTML, CSS, Bootstrap, dan JavaScript dengan fitur animasi modern dan typing effect.',
                    'image' => null,
                    'order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Project Analisis Rute pada Gmaps',
                    'description' => 'Menganalisis dan memvisualisasikan rute menggunakan Google Maps API untuk optimasi perjalanan dan pencarian jalur terpendek.',
                    'image' => null,
                    'order' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}