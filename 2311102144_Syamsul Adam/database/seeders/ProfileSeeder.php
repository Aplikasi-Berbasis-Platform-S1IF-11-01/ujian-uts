<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
 
    \App\Models\Profile::create([
        'nama'      => 'Syamsul Adam',
        'nim'       => '2311102144',
        'about'     => 'Saya adalah mahasiswa Informatika di Telkom University Purwokerto yang berfokus pada analisis data dan implementasi teknologi cerdas.',
        'skills'    => 'Laravel, PHP, Python, IoT, Data Science',
    ]);
}
}
