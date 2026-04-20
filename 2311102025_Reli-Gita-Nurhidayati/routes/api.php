<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\OrganizationController;

Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/skills', [SkillController::class, 'index']);
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/educations', [EducationController::class, 'index']);
Route::get('/organizations', [OrganizationController::class, 'index']);