<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $profile = Profile::first();

        $data = $request->validate([
            'description' => 'nullable|string',
            'email' => 'nullable|email',
            'github' => 'nullable|url',
            'instagram' => 'nullable|url',
            'dribbble' => 'nullable|url',
            'profile_picture' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->move(public_path('assets'), 'profile.jpeg');
            $data['profile_picture'] = 'assets/profile.jpeg';
        }

        if ($profile) {
            $profile->update($data);
        } else {
            Profile::create($data);
        }

        return back()->with('success', 'Profile updated successfully.');
    }
}
