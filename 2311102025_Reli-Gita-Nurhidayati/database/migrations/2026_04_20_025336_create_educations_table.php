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
    Schema::create('educations', function (Blueprint $table) {
        $table->id();
        $table->string('school');         // S1 Informatika / MAN / SMP
        $table->string('institution');    // Telkom University / MAN Purbalingga / SMP Boarding Sambas
        $table->string('year_start');     // 2023 / 2020 / 2017
        $table->string('year_end')->nullable(); // null = sekarang
        $table->text('description');
        $table->integer('order')->default(0); // urutan tampil
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};
