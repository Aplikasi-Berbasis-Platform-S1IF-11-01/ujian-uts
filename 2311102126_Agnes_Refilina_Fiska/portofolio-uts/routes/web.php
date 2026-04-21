<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes - Portofolio Agnes Refilina
|--------------------------------------------------------------------------
*/

// --- HALAMAN UTAMA ---
Route::get('/', function () {
    return view('landing');
});

// --- HALAMAN ADMIN ---
Route::get('/admin', function () {
    $data = DB::table('profiles')->first();
    // Mengambil semua proyek untuk ditampilkan di tabel admin
    $projects = DB::table('projects')->get(); 
    return view('admin', compact('data', 'projects'));
});

// --- API UNTUK AJAX (DATA DINAMIS) ---
Route::get('/api/profile', function () {
    $profile = DB::table('profiles')->first();
    return response()->json($profile);
});

Route::get('/api/projects', function () {
    $projects = DB::table('projects')->get();
    return response()->json($projects);
});

// --- LOGIKA UPDATE PROFIL UTAMA ---
Route::post('/update-profile', function (Request $request) {
    DB::table('profiles')->updateOrInsert(
        ['id' => 1],
        [
            'nama' => $request->nama,
            'peran' => $request->peran,
            'deskripsi' => $request->deskripsi,
            'updated_at' => now()
        ]
    );
    return back()->with('success', 'Profil berhasil diperbarui!');
});

// --- LOGIKA CRUD PROYEK (TAMBAH & EDIT) ---
Route::post('/project/save', function (Request $request) {
    // Jika ada ID, maka Update. Jika tidak ada, maka Insert baru.
    DB::table('projects')->updateOrInsert(
        ['id' => $request->id],
        [
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'created_at' => now(),
            'updated_at' => now()
        ]
    );
    return back()->with('success', 'Data proyek berhasil disimpan!');
});

// --- LOGIKA HAPUS PROYEK ---
Route::get('/project/delete/{id}', function ($id) {
    DB::table('projects')->where('id', $id)->delete();
    return back()->with('success', 'Proyek berhasil dihapus!');
});