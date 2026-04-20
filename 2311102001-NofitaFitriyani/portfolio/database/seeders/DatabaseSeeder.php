<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Profile::create([
            'name' => 'Nofita Fitriyani / 2311102001',
            'description' => 'I am a passionate software developer specializing in modern web applications. This is my portfolio.',
            'email' => 'nofita@example.com',
            'job_title' => 'Fullstack Developer',
        ]);

        \App\Models\Skill::create(['name' => 'Laravel']);
        \App\Models\Skill::create(['name' => 'Tailwind CSS']);
        \App\Models\Skill::create(['name' => 'JavaScript']);
        \App\Models\Skill::create(['name' => 'PHP']);
    }
}
