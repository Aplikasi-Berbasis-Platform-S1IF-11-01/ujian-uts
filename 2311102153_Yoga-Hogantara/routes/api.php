<?php

use App\Http\Controllers\Api\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/profile', [PortfolioController::class, 'profile']);
Route::get('/skills',  [PortfolioController::class, 'skills']);