<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'nim' => 'nullable|string|max:255',
            'study_program' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255',
            'short_bio' => 'nullable|string',
            'about_me' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'instagram' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $profile = Profile::first() ?? new Profile();

        if ($request->hasFile('photo')) {
            $filename = time() . '_' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move(public_path('uploads/profile'), $filename);
            $data['photo'] = 'uploads/profile/' . $filename;
        }

        $profile->fill($data);
        $profile->save();

        return redirect()->route('admin.dashboard')->with('success', 'Profile berhasil diperbarui.');
    }
}