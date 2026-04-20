<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->default('UI Developer');
            $table->string('nim')->nullable();
            $table->string('university')->nullable();
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->string('github_username')->nullable();
            $table->string('status_label')->default('Available for work');
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('category'); // Frontend, Backend, Tools
            $table->string('icon_color')->default('#e8580a');
            $table->json('items'); // array of skill names
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('education', function (Blueprint $table) {
            $table->id();
            $table->string('school');
            $table->string('major');
            $table->string('period');
            $table->string('status')->default('active'); // active | done
            $table->string('icon_bg')->default('#f0f0ff');
            $table->string('icon_color')->default('#1a1a2e');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('tag')->default('Web');
            $table->string('thumb_type')->default('default'); // css class for thumb color
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // email, instagram, github, linkedin, whatsapp
            $table->string('label');
            $table->string('value'); // display value
            $table->string('url');
            $table->string('icon_bg')->default('#fef2f2');
            $table->string('icon_color')->default('#e8580a');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('education');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('users');
    }
};
