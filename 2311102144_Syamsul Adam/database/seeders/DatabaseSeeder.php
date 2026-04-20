<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Daftarkan ProfileSeeder di sini
        $this->call([
            ProfileSeeder::class,
        ]);
    }
}