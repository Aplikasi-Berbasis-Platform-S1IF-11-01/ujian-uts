<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileAdminController;
use App\Http\Controllers\Admin\SkillAdminController;
use App\Http\Controllers\Admin\ProjectAdminController;
use App\Http\Controllers\Admin\EducationAdminController;
use App\Http\Controllers\Admin\OrganizationAdminController;

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Auth Routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    $credentials = request()->only('email', 'password');
    if (auth()->attempt($credentials)) {
        return redirect()->route('admin.dashboard');
    }
    return back()->with('error', 'Email atau password salah!');
})->name('login.post');

Route::post('/logout', function () {
    auth()->logout();
    return redirect()->route('login');
})->name('logout');

// Admin Routes (protected)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileAdminController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileAdminController::class, 'update'])->name('profile.update');

    // Skills
    Route::get('/skills', [SkillAdminController::class, 'index'])->name('skills.index');
    Route::post('/skills', [SkillAdminController::class, 'store'])->name('skills.store');
    Route::put('/skills/{skill}', [SkillAdminController::class, 'update'])->name('skills.update');
    Route::delete('/skills/{skill}', [SkillAdminController::class, 'destroy'])->name('skills.destroy');

    // Projects
    Route::get('/projects', [ProjectAdminController::class, 'index'])->name('projects.index');
    Route::post('/projects', [ProjectAdminController::class, 'store'])->name('projects.store');
    Route::put('/projects/{project}', [ProjectAdminController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{project}', [ProjectAdminController::class, 'destroy'])->name('projects.destroy');

    // Educations
    Route::get('/educations', [EducationAdminController::class, 'index'])->name('educations.index');
    Route::post('/educations', [EducationAdminController::class, 'store'])->name('educations.store');
    Route::put('/educations/{education}', [EducationAdminController::class, 'update'])->name('educations.update');
    Route::delete('/educations/{education}', [EducationAdminController::class, 'destroy'])->name('educations.destroy');

    // Organizations
    Route::get('/organizations', [OrganizationAdminController::class, 'index'])->name('organizations.index');
    Route::post('/organizations', [OrganizationAdminController::class, 'store'])->name('organizations.store');
    Route::put('/organizations/{organization}', [OrganizationAdminController::class, 'update'])->name('organizations.update');
    Route::delete('/organizations/{organization}', [OrganizationAdminController::class, 'destroy'])->name('organizations.destroy');
});