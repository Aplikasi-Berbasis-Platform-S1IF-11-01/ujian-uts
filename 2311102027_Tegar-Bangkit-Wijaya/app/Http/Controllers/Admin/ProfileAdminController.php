<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileAdminController extends Controller
{
    public function edit()
    {
        $profile = Profile::firstOrCreate([], [
            'name'  => 'Your Name',
            'title' => 'Developer',
            'bio'   => 'Your bio here.',
        ]);
        return view('admin.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string|max:100',
            'nim'              => 'nullable|string|max:20',
            'jurusan'          => 'nullable|string|max:100',
            'title'            => 'required|string|max:100',
            'tagline'          => 'nullable|string|max:255',
            'bio'              => 'required|string',
            'about'            => 'nullable|string',
            'email'            => 'nullable|email|max:100',
            'phone'            => 'nullable|string|max:20',
            'location'         => 'nullable|string|max:100',
            'github'           => 'nullable|url|max:255',
            'linkedin'         => 'nullable|url|max:255',
            'instagram'        => 'nullable|url|max:255',
            'website'          => 'nullable|url|max:255',
            'years_experience' => 'nullable|integer|min:0',
            'projects_done'    => 'nullable|integer|min:0',
            'clients'          => 'nullable|integer|min:0',
        ]);

        $profile = Profile::firstOrCreate([]);
        $profile->update($validated);

        return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui.']);
    }

    public function updatePhoto(Request $request)
    {
        $request->validate(['photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048']);

        $profile = Profile::firstOrCreate([]);

        // Delete old photo if it's not the default
        if ($profile->photo && $profile->photo !== 'images/profile-default.png') {
            Storage::disk('public')->delete($profile->photo);
        }

        $path = $request->file('photo')->store('photos', 'public');
        $profile->update(['photo' => $path]);

        return response()->json([
            'success'   => true,
            'message'   => 'Foto profil berhasil diperbarui.',
            'photo_url' => asset('storage/' . $path),
        ]);
    }
}
