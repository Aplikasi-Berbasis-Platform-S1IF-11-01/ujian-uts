<?php

namespace App\Http\Controllers; // Pastikan namespace-nya benar

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function getProfile() {
        $profile = Profile::first();
        return response()->json($profile);
    }

    public function adminDashboard() {
        $profile = Profile::first();
        return view('admin', compact('profile'));
    }

    public function update(Request $request) {
        $profile = Profile::first();
        $data = $request->only(['nama', 'alamat', 'email', 'instagram', 'deskripsi']);
        
        // Simpan skills sebagai JSON string
        $data['skills'] = json_encode(explode(',', $request->skills));

        if ($request->hasFile('foto')) {
            if ($profile->foto) Storage::delete('public/'.$profile->foto);
            $path = $request->file('foto')->store('uploads', 'public');
            $data['foto'] = $path;
        }

        $profile->update($data);
        return response()->json(['message' => 'Profile updated successfully!']);
    }
}