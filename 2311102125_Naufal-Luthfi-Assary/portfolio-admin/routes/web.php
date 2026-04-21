<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ProjectController;

Route::view('/', 'portfolio');

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::view('/', 'admin.dashboard')->name('admin.dashboard');

    Route::get('/projects', [ProjectController::class, 'index'])->name('admin.projects');
    Route::get('/projects/list', [ProjectController::class, 'list'])->name('admin.projects.list');
    Route::post('/projects', [ProjectController::class, 'store'])->name('admin.projects.store');
    Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('admin.projects.update');
    Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

    Route::get('/skills', [SkillController::class, 'index'])->name('admin.skills');
    Route::get('/skills/list', [SkillController::class, 'list'])->name('admin.skills.list');
    Route::post('/skills', [SkillController::class, 'store'])->name('admin.skills.store');
    Route::put('/skills/{skill}', [SkillController::class, 'update'])->name('admin.skills.update');
    Route::delete('/skills/{skill}', [SkillController::class, 'destroy'])->name('admin.skills.destroy');
});

Route::get('/profile', function () {
    return redirect()->route('admin.profile');
})->middleware(['auth'])->name('profile.edit');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';