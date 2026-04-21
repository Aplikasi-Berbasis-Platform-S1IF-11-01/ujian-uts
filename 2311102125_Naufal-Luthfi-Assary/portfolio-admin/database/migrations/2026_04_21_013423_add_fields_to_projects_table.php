<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            if (!Schema::hasColumn('projects', 'project_url')) {
                $table->string('project_url')->nullable()->after('description');
            }

            if (!Schema::hasColumn('projects', 'image')) {
                $table->string('image')->nullable()->after('project_url');
            }

            if (!Schema::hasColumn('projects', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $columns = [];

            if (Schema::hasColumn('projects', 'project_url')) {
                $columns[] = 'project_url';
            }

            if (Schema::hasColumn('projects', 'image')) {
                $columns[] = 'image';
            }

            if (Schema::hasColumn('projects', 'sort_order')) {
                $columns[] = 'sort_order';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};