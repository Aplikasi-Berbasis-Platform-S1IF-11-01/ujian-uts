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
            $table->string('name');
            $table->string('nim')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('title');           // e.g. "Full-Stack Developer"
            $table->string('tagline')->nullable(); // short headline
            $table->text('bio');
            $table->text('about')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('github')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('website')->nullable();
            $table->string('photo')->default('images/profile-default.png');
            $table->integer('years_experience')->default(0);
            $table->integer('projects_done')->default(0);
            $table->integer('clients')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
