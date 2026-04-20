<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_profile', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tagline');
            $table->text('deskripsi');
            $table->string('email');
            $table->string('github')->nullable();
            $table->string('instagram')->nullable();
            $table->string('foto')->nullable(); // base64 atau url
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_profile');
    }
};
