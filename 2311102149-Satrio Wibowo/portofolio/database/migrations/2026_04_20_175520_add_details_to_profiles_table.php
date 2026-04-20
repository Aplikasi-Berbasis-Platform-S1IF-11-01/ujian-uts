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
    Schema::table('profiles', function (Blueprint $table) {
        // Menambah kolom tanpa menyentuh tabel lain
        if (!Schema::hasColumn('profiles', 'skills')) {
            $table->json('skills')->nullable()->after('description');
        }
        if (!Schema::hasColumn('profiles', 'photo')) {
            $table->string('photo')->nullable()->after('skills');
        }
    });
}

public function down(): void
{
    Schema::table('profiles', function (Blueprint $table) {
        $table->dropColumn(['skills', 'photo']);
    });
}
};
