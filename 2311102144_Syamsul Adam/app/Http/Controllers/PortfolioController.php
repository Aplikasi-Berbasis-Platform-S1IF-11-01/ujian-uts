<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class PortfolioController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function getProfile() {
        $data = Profile::first();
        // Fallback jika data di database belum lengkap
        return response()->json($data);
    }

    public function edit() {
        $profile = Profile::first();
        return view('dashboard', compact('profile'));
    }

    public function update(Request $request) {
        $profile = Profile::first();
        $profile->update($request->all());

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = 'adam_profile_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img'), $namaFile);
            $profile->foto = $namaFile;
            $profile->save();
        }

        return back()->with('success', 'CV Anda berhasil diperbarui!');
    }
}