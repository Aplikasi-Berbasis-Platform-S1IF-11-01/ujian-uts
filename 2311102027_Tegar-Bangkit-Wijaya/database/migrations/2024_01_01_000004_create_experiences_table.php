<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('position');
            $table->text('description')->nullable();
            $table->string('type')->default('work'); // work, education, certificate
            $table->date('start_date');
            $table->date('end_date')->nullable();    // null = present
            $table->boolean('is_current')->default(false);
            $table->string('location')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
