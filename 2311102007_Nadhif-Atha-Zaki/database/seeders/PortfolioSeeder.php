<?php

namespace Database\Seeders;

use App\Models\Education;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@portfolio.com'],
            [
                'name' => 'Admin Portfolio',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );

        Profile::updateOrCreate(
            ['id' => 1],
            [
                'full_name' => 'Nadhif Atha Zaki',
                'nim' => '2311102007',
                'study_program' => 'S1 Teknik Informatika',
                'title' => 'Mahasiswa Informatika & Web Developer',
                'short_bio' => 'Saya adalah mahasiswa S1 Teknik Informatika Telkom University Purwokerto yang memiliki minat pada pengembangan website, pemrograman, dan pembuatan aplikasi.',
                'about_me' => 'Saya merupakan pribadi yang senang mempelajari hal baru, terutama dalam bidang teknologi, pengembangan web, dan pemrograman. Saya memiliki ketertarikan untuk membuat aplikasi yang tidak hanya berjalan dengan baik, tetapi juga mampu memberi manfaat bagi pengguna.',
                'photo' => null,
                'email' => 'nadhifzaki2005@gmail.com',
                'instagram' => 'https://instagram.com/nadhifathaz',
                'github' => 'https://github.com/nath4el',
            ]
        );

        $educations = [
            [
                'institution' => 'SMK Telkom Purwokerto',
                'period' => '2021 - 2023',
                'description' => 'Menempuh pendidikan menengah kejuruan dengan lingkungan belajar yang berfokus pada teknologi informasi dan pengembangan kemampuan digital.',
                'sort_order' => 1,
            ],
            [
                'institution' => 'S1 Teknik Informatika - Telkom University Purwokerto',
                'period' => '2023 - Sekarang',
                'description' => 'Sedang menempuh pendidikan sarjana dan mempelajari pemrograman, pengembangan website, struktur data, basis data, serta rekayasa perangkat lunak.',
                'sort_order' => 2,
            ],
        ];

        foreach ($educations as $education) {
            Education::updateOrCreate(
                ['institution' => $education['institution']],
                $education
            );
        }

        $skills = ['HTML', 'CSS', 'Bootstrap', 'JavaScript', 'AJAX', 'C++', 'Go', 'Laravel', 'UI Layout', 'Responsive Design'];

        foreach ($skills as $index => $skill) {
            Skill::updateOrCreate(
                ['name' => $skill],
                ['sort_order' => $index + 1]
            );
        }

        $projects = [
            [
                'title' => 'KlikKantin',
                'description' => 'KlikKantin merupakan aplikasi katalog dan informasi kantin yang dibuat untuk membantu mahasiswa mencari pilihan makanan di area kampus.',
                'project_link' => null,
                'image' => null,
                'sort_order' => 1,
            ],
            [
                'title' => 'SIAPABAJA',
                'description' => 'SIAPABAJA adalah sistem informasi arsip pengadaan barang dan jasa yang dirancang untuk membantu pengelolaan dokumen menjadi lebih terstruktur.',
                'project_link' => null,
                'image' => null,
                'sort_order' => 2,
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['title' => $project['title']],
                $project
            );
        }
    }
}