<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// AJAX Data Fetching
Route::get('/api/portfolio-data', [PortfolioController::class, 'index']);

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        $projectCount = \App\Models\Project::count();
        $skillCount = \App\Models\Skill::count();
        $latestProjects = \App\Models\Project::latest()->take(5)->get();
        $latestSkills = \App\Models\Skill::latest()->take(5)->get();
        return view('dashboard', compact('projectCount', 'skillCount', 'latestProjects', 'latestSkills'));
    })->name('dashboard');

    // Portfolio Management
    Route::get('/portfolio', [AdminPortfolioController::class, 'edit'])->name('admin.portfolio.edit');
    Route::put('/portfolio', [AdminPortfolioController::class, 'update'])->name('admin.portfolio.update');

    // Skills Management
    Route::resource('skills', AdminSkillController::class);

    // Projects Management
    Route::resource('projects', \App\Http\Controllers\Admin\ProjectController::class)->names([
        'index' => 'admin.projects.index',
        'create' => 'admin.projects.create',
        'store' => 'admin.projects.store',
        'edit' => 'admin.projects.edit',
        'update' => 'admin.projects.update',
        'destroy' => 'admin.projects.destroy',
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
