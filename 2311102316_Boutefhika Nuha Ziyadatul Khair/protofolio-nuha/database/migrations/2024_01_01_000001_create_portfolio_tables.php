<?php
// database/migrations/2024_01_01_000001_create_portfolio_tables.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Profiles table
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('nim')->nullable();
            $table->string('title')->nullable();
            $table->text('about')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('github')->nullable();
            $table->string('instagram')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
        });

        // Skills table
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')->default('💡');
            $table->string('category')->default('technical');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Educations table
        Schema::create('educations', function (Blueprint $table) {
            $table->id();
            $table->string('institution');
            $table->string('major')->nullable();
            $table->string('degree')->nullable();
            $table->string('year_start');
            $table->string('year_end')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Experiences table
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('position');
            $table->string('location')->nullable();
            $table->string('year');
            $table->string('duration')->nullable();
            $table->json('responsibilities')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Projects table
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('tech_stack')->nullable();
            $table->string('url')->nullable();
            $table->string('image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Site settings table
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('educations');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('profiles');
    }
};