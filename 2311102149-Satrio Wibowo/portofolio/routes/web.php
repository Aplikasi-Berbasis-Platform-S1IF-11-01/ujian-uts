<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use App\Models\Project;

/*
|--------------------------------------------------------------------------
| Web Routes - ARA Portfolio
|--------------------------------------------------------------------------
*/

/**
 * HOME (Landing Page)
 * Menampilkan semua project agar Alpine.js bisa memfilter secara instan di satu halaman.
 */
Route::get('/', function () {
    $projects = Project::with('media')
        ->latest()
        ->get();

    return view('pages.home', compact('projects'));
})->name('home');


/**
 * WORK ARCHIVE (Halaman Khusus Portfolio)
 * Halaman terpisah dengan sistem pagination.
 */
Route::get('/work', function (Request $request) {
    // Whitelist filter kategori sesuai kebutuhan desain
    $allowed = ['all', 'design', 'photo', 'video', 'illustration'];
    $type = strtolower($request->query('type', 'all'));
    
    if (!in_array($type, $allowed, true)) {
        $type = 'all';
    }

    $query = Project::with('media')->latest();

    if ($type !== 'all') {
        $query->where('category', $type);
    }

    // Pagination agar performa tetap ringan
    $projects = $query->paginate(12)->withQueryString();

    return view('pages.work', compact('projects', 'type'));
})->name('work.index');


/**
 * WORK DETAIL
 * Halaman detail per project menggunakan slug.
 */
Route::get('/work/{project:slug}', function (Project $project) {
    $project->load('media');
    return view('pages.work-detail', compact('project'));
})->name('work.show');


/**
 * AUTH & ADMIN CONFIGURATION
 * Jangan gunakan Route::redirect manual ke /admin/login karena akan 
 * menyebabkan infinite loop (ERR_TOO_MANY_REDIRECTS).
 */

// Route login manual tetap dipertahankan jika kamu membuat view custom
Route::get('/login', function () {
    return view('auth.login'); 
})->name('login');

// Route contact form untuk menyimpan pesan dari halaman contact
Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');