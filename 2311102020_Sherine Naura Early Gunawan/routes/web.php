<?php

use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', [ProfileController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/update', [ProfileController::class, 'update'])->name('admin.update');