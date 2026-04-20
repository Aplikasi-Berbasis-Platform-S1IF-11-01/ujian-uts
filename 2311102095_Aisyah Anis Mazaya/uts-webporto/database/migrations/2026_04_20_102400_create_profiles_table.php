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
            $table->string('name')->nullable();
            $table->string('headline')->nullable();
            $table->string('photo')->nullable(); 
            $table->text('description')->nullable();
            
            // Pencapaian
            $table->string('achieve_1_title')->nullable();
            $table->string('achieve_1_desc')->nullable();
            $table->string('achieve_2_title')->nullable();
            $table->string('achieve_2_desc')->nullable();

            // Pendidikan 1 
            $table->string('edu_1_major')->nullable();
            $table->string('edu_1_year')->nullable();
            $table->string('edu_1_campus')->nullable();
            $table->text('edu_1_desc')->nullable();

            // Pendidikan 2 
            $table->string('edu_2_major')->nullable();
            $table->string('edu_2_year')->nullable();
            $table->string('edu_2_campus')->nullable();
            $table->text('edu_2_desc')->nullable();

            // Kompetensi 
            $table->text('hard_skills')->nullable();
            $table->text('soft_skills')->nullable();

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