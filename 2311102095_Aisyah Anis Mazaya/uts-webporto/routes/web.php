<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

// Rute web
Route::get('/', [PortfolioController::class, 'index']);

// Rute AJAX 
Route::get('/api/profile', [PortfolioController::class, 'getProfile']);
Route::get('/api/skills', [PortfolioController::class, 'getSkills']);
Route::get('/api/projects', [\App\Http\Controllers\PortfolioController::class, 'getProjects']);

Route::get('/admin', [PortfolioController::class, 'adminDashboard']);
Route::post('/admin/profile/update', [PortfolioController::class, 'updateProfile'])->name('profile.update');
Route::post('/admin/skill/update/{id}', [PortfolioController::class, 'updateSkill'])->name('skill.update');
Route::post('/admin/profile/delete-photo', [PortfolioController::class, 'deletePhoto'])->name('profile.delete-photo');
Route::post('/admin/project/update/{id}', [\App\Http\Controllers\PortfolioController::class, 'updateProject'])->name('project.update');