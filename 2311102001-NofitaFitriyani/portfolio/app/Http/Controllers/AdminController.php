<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Skill;

class AdminController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $skills = Skill::all();
        return view('admin', compact('profile', 'skills'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'email' => 'required|email',
            'job_title' => 'required'
        ]);

        $profile = Profile::first();
        if (!$profile) {
            $profile = new Profile();
        }

        $profile->name = $request->name;
        $profile->description = $request->description;
        $profile->email = $request->email;
        $profile->job_title = $request->job_title;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $profile->photo = $path;
        }

        $profile->save();
        return back()->with('success', 'Profile updated successfully.');
    }

    public function addSkill(Request $request)
    {
        $request->validate(['name' => 'required']);
        Skill::create(['name' => $request->name]);
        return back()->with('success', 'Skill added successfully.');
    }

    public function deleteSkill($id)
    {
        Skill::destroy($id);
        return back()->with('success', 'Skill deleted successfully.');
    }
}
