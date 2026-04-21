<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Portfolio;
use App\Models\Skill;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create initial portfolio
        Portfolio::create([
            'full_name' => 'Irshad Benaya Fardeca',
            'title' => 'Full Stack Developer',
            'description' => 'Mahasiswa S1 Informatika yang senang belajar pengembangan web.',
            'email' => 'irsyadeiger@gmail.com',
            'phone' => '+62-895381285313',
            'address' => 'CIlacap, Jawa Tengah, Indonesia',
            'github_url' => 'https://github.com/Cryoschr',
            'linkedin_url' => 'https://www.linkedin.com/in/irshad-benaya-fardeca-b85935295/',
            'twitter_url' => 'https://x.com/Icadbf_',
            'about_me' => 'Halo! Saya Irshad Benaya Fardeca, mahasiswa S1 Teknik Informatika
            yang memiliki ketertarikan besar di bidang pengembangan web. Saya
            menikmati proses belajar, baik framework baru, tools, maupun
            konsep pemrograman. Saya percaya konsistensi adalah kunci menjadi
            developer yang baik.'
        ]);

        // Create sample skills
        $skills = [
            ['name' => 'HTML5', 'percentage' => 70, 'category' => 'Frontend', 'icon_class' => 'bi bi-filetype-html'],
            ['name' => 'CSS3', 'percentage' => 50, 'category' => 'Frontend', 'icon_class' => 'bi bi-filetype-css'],
            ['name' => 'JavaScript', 'percentage' => 30, 'category' => 'Frontend', 'icon_class' => 'bi bi-filetype-js'],
            ['name' => 'PHP', 'percentage' => 77, 'category' => 'Backend', 'icon_class' => 'bi bi-filetype-php'],
            ['name' => 'Laravel', 'percentage' => 70, 'category' => 'Backend', 'icon_class' => 'bi bi-code-slash'],
            ['name' => 'MySQL', 'percentage' => 60, 'category' => 'Database', 'icon_class' => 'bi bi-database'],
            ['name' => 'Git', 'percentage' => 78, 'category' => 'Tools', 'icon_class' => 'bi bi-git'],
        ];

        foreach ($skills as $index => $skill) {
            $skill['display_order'] = $index;
            $skill['is_active'] = true;
            Skill::create($skill);
        }
    }
}
