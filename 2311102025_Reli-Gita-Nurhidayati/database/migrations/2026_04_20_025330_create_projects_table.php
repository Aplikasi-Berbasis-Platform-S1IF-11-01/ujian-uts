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
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('title');          // Aplikasi Reminder Jadwal
        $table->string('category');       // Web App / E-Commerce
        $table->text('description');      // deskripsi proyek
        $table->string('color')->default('green');   // warna thumbnail kartu
        $table->string('icon')->default('bi-alarm'); // icon bootstrap
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
