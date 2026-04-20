<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::insert([
            ['title' => 'IoT: Smart Garden', 'description' => 'Sistem penyiraman tanaman otomatis berbasis Arduino.'],
            ['title' => 'Happy Time Café', 'description' => 'Website development statis menggunakan native HTML.'],
            ['title' => 'Arduino Security', 'description' => 'Pengaman pintu menggunakan sandi via Tinkercad.'],
            ['title' => 'Digital Art: Tameng Dayak', 'description' => 'Desain grafis bertema budaya menggunakan PicsArt.'],
            ['title' => 'Network Topology', 'description' => 'Perancangan jaringan LAN menggunakan Cisco Packet Tracer.'],
        ]);
    }
}