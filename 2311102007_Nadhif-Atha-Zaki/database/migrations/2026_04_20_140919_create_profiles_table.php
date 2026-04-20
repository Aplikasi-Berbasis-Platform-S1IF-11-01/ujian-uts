<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('nim')->nullable();
            $table->string('study_program')->nullable();
            $table->string('title')->nullable();
            $table->text('short_bio')->nullable();
            $table->text('about_me')->nullable();
            $table->string('photo')->nullable();
            $table->string('email')->nullable();
            $table->string('instagram')->nullable();
            $table->string('github')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};