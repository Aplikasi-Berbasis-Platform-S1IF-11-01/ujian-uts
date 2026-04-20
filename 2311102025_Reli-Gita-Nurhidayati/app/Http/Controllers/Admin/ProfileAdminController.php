<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileAdminController extends Controller
{
    public function edit()
    {
        $profile = Profile::first();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = Profile::first();
        $data = $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'tagline' => 'required',
            'about' => 'required',
            'university' => 'required',
            'major' => 'required',
            'location' => 'required',
            'focus' => 'required',
            'email' => 'required|email',
            'linkedin' => 'nullable',
            'github' => 'nullable',
            'instagram' => 'nullable',
            'semester' => 'required',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $path;
        }

        $profile->update($data);
        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profil berhasil diupdate!');
    }
}