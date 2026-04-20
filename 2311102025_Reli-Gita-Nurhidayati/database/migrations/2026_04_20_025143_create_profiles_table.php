<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('profiles', function (Blueprint $table) {
        $table->id();
        $table->string('name');           // Reli Gita Nurhidayati
        $table->string('nim');            // 2311102025
        $table->string('tagline');        // Mahasiswa Informatika
        $table->text('about');            // deskripsi hero
        $table->string('university');     // Telkom University Purwokerto
        $table->string('major');          // S1 Informatika, Semester 6
        $table->string('location');       // Purwokerto, Jawa Tengah
        $table->string('focus');          // Data Analyst & UI/UX
        $table->string('email');          // religitan@gmail.com
        $table->string('linkedin')->nullable();
        $table->string('github')->nullable();
        $table->string('instagram')->nullable();
        $table->string('photo')->nullable();
        $table->string('semester');       // 6 Aktif
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
