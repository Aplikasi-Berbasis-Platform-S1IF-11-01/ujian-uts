<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    $profile = \App\Models\Profile::first();
    $skills = \App\Models\Skill::all();
    $educations = \App\Models\Education::all();
    $experiences = \App\Models\Experience::all();
    $projects = \App\Models\Project::all();
    return view('welcome', compact('profile', 'skills', 'educations', 'experiences', 'projects'));
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $profile = \App\Models\Profile::first();
        $skills = \App\Models\Skill::all();
        $educations = \App\Models\Education::all();
        $experiences = \App\Models\Experience::all();
        $projects = \App\Models\Project::all();
        return view('dashboard', compact('profile', 'skills', 'educations', 'experiences', 'projects'));
    })->name('dashboard');

    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
    Route::delete('/skills/{skill}', [SkillController::class, 'destroy'])->name('skills.destroy');

    Route::post('/educations', [EducationController::class, 'store'])->name('educations.store');
    Route::delete('/educations/{education}', [EducationController::class, 'destroy'])->name('educations.destroy');

    Route::post('/experiences', [ExperienceController::class, 'store'])->name('experiences.store');
    Route::delete('/experiences/{experience}', [ExperienceController::class, 'destroy'])->name('experiences.destroy');

    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});
