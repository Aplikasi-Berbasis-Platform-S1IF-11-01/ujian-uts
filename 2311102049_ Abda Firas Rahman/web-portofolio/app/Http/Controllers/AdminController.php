<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $skills = Skill::all();
        $projects = Project::all();
        $educations = Education::all(); 
        
        return view('dashboard', compact('profile', 'skills', 'projects', 'educations'));
    }

    public function updateProfile(Request $request)
{
    $request->validate([
        'name' => 'required',
        'role' => 'required',
        'description' => 'required',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $profile = Profile::first();
    
    $data = $request->only(['name', 'role', 'description']);

    if ($request->hasFile('profile_image')) {
        // Hapus foto lama jika ada
        if ($profile->profile_image) {
            Storage::delete('public/' . $profile->profile_image);
        }
        
        $path = $request->file('profile_image')->store('profiles', 'public');
        $data['profile_image'] = $path;
    }

    $profile->update($data);
    return back()->with('success', 'Profil dan Foto berhasil diperbarui!');
}

    public function addSkill(Request $request) 
    {
        $request->validate(['skill_name' => 'required', 'percentage' => 'required|numeric']);
        Skill::create($request->all());
        return back()->with('success', 'Skill baru berhasil ditambahkan!');
    }

    public function deleteSkill($id) 
    {
        Skill::destroy($id);
        return back()->with('success', 'Skill berhasil dihapus!');
    }

    public function addProject(Request $request) 
    {
        $request->validate(['category' => 'required', 'title' => 'required', 'description' => 'required']);
        Project::create($request->all());
        return back()->with('success', 'Project baru berhasil ditambahkan!');
    }

    public function deleteProject($id) 
    {
        Project::destroy($id);
        return back()->with('success', 'Project berhasil dihapus!');
    }

    public function addEducation(Request $request) 
    {
        $request->validate(['institution' => 'required', 'degree' => 'required', 'year' => 'required']);
        Education::create($request->all());
        return back()->with('success', 'Pendidikan berhasil ditambahkan!');
    }

    public function deleteEducation($id) 
    {
        Education::destroy($id);
        return back()->with('success', 'Pendidikan berhasil dihapus!');
    }
}