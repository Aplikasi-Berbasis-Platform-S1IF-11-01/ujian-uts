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
    Schema::create('organizations', function (Blueprint $table) {
        $table->id();
        $table->string('name');           // BEM KEMA Telkom University Purwokerto
        $table->string('role');           // Staff Divisi Ekonomi Kreatif
        $table->string('year_start');     // 2024
        $table->string('year_end')->nullable(); // 2025
        $table->text('description');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
