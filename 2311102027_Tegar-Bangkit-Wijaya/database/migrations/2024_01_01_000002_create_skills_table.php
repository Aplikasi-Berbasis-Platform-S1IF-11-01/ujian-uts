<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');   // e.g. Frontend, Backend, Database, Tools
            $table->integer('level');     // 0-100
            $table->string('icon')->nullable();  // devicon class or emoji
            $table->string('color')->nullable(); // hex color for badge
            $table->integer('order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
