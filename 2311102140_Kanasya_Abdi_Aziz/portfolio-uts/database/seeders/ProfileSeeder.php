<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Menghapus data lama jika ada agar tidak double
        Profile::truncate();

        Profile::create([
            'nama' => 'Kanasya Abdi Aziz',
            'alamat' => 'Purwokerto, Jawa Tengah',
            'email' => 'kanasyaabdiaziz@gmail.com',
            'instagram' => '@k.asyaaa_',
            'deskripsi' => 'Halo! Saya Kanasya Abdi Aziz, mahasiswa Informatika Telkom University angkatan 23. Saya memiliki passion kuat di bidang Front-end Development, menciptakan antarmuka web yang interaktif, bersih, dan fungsional. Selain coding, saya juga mendalami dunia Cyber Security.',
            'skills' => json_encode([
                'HTML5', 
                'CSS3', 
                'JavaScript', 
                'PHP', 
                'Laravel', 
                'Tailwind CSS', 
                'Bootstrap', 
                'Cyber Security'
            ]),
            'foto' => null, // Biarkan null dulu, nanti upload lewat Dashboard Admin
        ]);
    }
}