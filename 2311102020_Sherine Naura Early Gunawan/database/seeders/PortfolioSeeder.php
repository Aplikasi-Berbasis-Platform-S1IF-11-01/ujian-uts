<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Skill;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        Profile::truncate();
        Skill::truncate();

        Profile::create([
            'name' => 'Sherine Naura Early Gunawan',
            'description' => 'Mahasiswa S1 Informatika di Universitas Telkom Purwokerto.',
            'email' => 'sheringunawan777@gmail.com',
        ]);

        Skill::create(['skill_name' => 'MySQL', 'level' => 90]);
        Skill::create(['skill_name' => 'HTML', 'level' => 85]);
        Skill::create(['skill_name' => 'Microsoft Power BI', 'level' => 95]);
        Skill::create(['skill_name' => 'Laravel', 'level' => 85]);
    }
}