<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::first();

        return view('admin.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'brand_name' => 'nullable|string|max:255',
            'headline' => 'required|string|max:255',
            'about' => 'required|string',
            'domicile' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'career_interest' => 'nullable|string|max:255',
            'languages' => 'nullable|string|max:255',
            'hero_badge' => 'nullable|string|max:255',
            'availability' => 'nullable|string|max:255',
        ]);

        $profile = Profile::first();

        if (!$profile) {
            $profile = Profile::create($request->all());
        } else {
            $profile->update($request->all());
        }

        return response()->json([
            'message' => 'Profile berhasil diupdate',
            'data' => $profile
        ]);
    }
}