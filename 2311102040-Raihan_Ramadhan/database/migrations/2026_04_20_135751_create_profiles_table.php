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
            $table->string('nim');
            $table->string('class');
            $table->string('tagline')->nullable();
            $table->text('description');
            $table->string('photo')->nullable();
            $table->string('email')->nullable();
            $table->string('github')->nullable();
            $table->string('instagram')->nullable();
            $table->string('location')->nullable();
            $table->decimal('gpa', 4, 2)->default(0);
            $table->integer('projects_count')->default(0);
            $table->integer('tech_count')->default(0);
            $table->boolean('available')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};