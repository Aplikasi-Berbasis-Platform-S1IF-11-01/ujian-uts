<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Profile::create([
            'name' => 'Qonita Rahayu Atmi',
            'role' => 'UI/UX Designer',
            'hero_description' => 'Saya adalah seorang UI/UX Designer merancang antarmuka digital yang intuitif dan berpusat pada pengguna. Saya memiliki keahlian dalam mengubah ide kompleks menjadi desain visual yang estetis (UI) serta memastikan alur pengguna (UX) yang lancar dan fungsional.',
            'about_description' => 'Hallo, saya Qonita Rahayu Atmi seorang UI/UX yang tertarik dalam menciptakan desain antarmuka yang estetis dan pengalaman pengguna yang efektif. Saat ini saya sedang menempuh pendidikan di Telkom University Purwokerto jurusan Teknik Informatika dan terus mengembangkan keterampilan di bidang UI/UX melalui pembelajaran, eksplorasi desain, serta berbagai proyek yang saya kerjakan.',
            'photo_url' => ''
        ]);

        Skill::create(['name' => 'Figma', 'proficiency' => 90]);
        Skill::create(['name' => 'Canva', 'proficiency' => 85]);
        Skill::create(['name' => 'HTML5', 'proficiency' => 95]);
        Skill::create(['name' => 'CSS3', 'proficiency' => 90]);
        Skill::create(['name' => 'JavaScript', 'proficiency' => 85]);
        Skill::create(['name' => 'Bootstrap', 'proficiency' => 85]);
        Skill::create(['name' => 'GitHub', 'proficiency' => 80]);
        Skill::create(['name' => 'Git', 'proficiency' => 80]);
        Skill::create(['name' => 'Python', 'proficiency' => 75]);
        Skill::create(['name' => 'C++', 'proficiency' => 70]);
    }
}
