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
            $table->string('full_name');
            $table->string('brand_name')->nullable();
            $table->string('headline')->nullable();
            $table->text('about')->nullable();
            $table->string('domicile')->nullable();
            $table->string('email')->nullable();
            $table->string('career_interest')->nullable();
            $table->string('languages')->nullable();
            $table->string('photo')->nullable();
            $table->string('hero_badge')->nullable();
            $table->string('availability')->nullable();
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
