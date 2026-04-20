<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project; 
use Illuminate\Support\Facades\Storage; 

class PortfolioController extends Controller
{
    // Landing Page
    public function index()
    {
        return view('welcome');
    }

    // API untuk AJAX mengambil data Profil
    public function getProfile()
    {
        $profile = Profile::first();
        return response()->json($profile);
    }

    // API untuk AJAX mengambil data Skill
    public function getSkills()
    {
        $skills = Skill::all();
        return response()->json($skills);
    }

    // API untuk AJAX mengambil data Project
    public function getProjects()
    {
        return response()->json(Project::all());
    }

    // Halaman Dashboard Admin
    public function adminDashboard()
    {
        $profile = Profile::first();
        $skills = Skill::all();
        $projects = Project::all(); 
        
        return view('admin', compact('profile', 'skills', 'projects')); 
    }

    // Update Profil & Foto
    public function updateProfile(Request $request)
    {
        $profile = Profile::first();
        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::delete('public/' . $profile->photo);
            }
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }

        $profile->update($data);
        return back()->with('success', 'Data berhasil diperbarui!');
    }

    // Hapus Foto
    public function deletePhoto()
    {
        $profile = Profile::first();
        if ($profile->photo) {
            Storage::delete('public/' . $profile->photo);
            $profile->update(['photo' => null]);
        }
        return back()->with('success', 'Foto profil berhasil dihapus!');
    }

    // Update Skill
    public function updateSkill(Request $request, $id)
    {
        $skill = Skill::find($id);
        $skill->update([
            'percentage' => $request->percentage
        ]);
        return back()->with('success', 'Skill berhasil diperbarui!');
    }

    // Update Project
    public function updateProject(Request $request, $id)
    {
        $project = Project::find($id);
        $project->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return back()->with('success', 'Project berhasil diperbarui!');
    }
}