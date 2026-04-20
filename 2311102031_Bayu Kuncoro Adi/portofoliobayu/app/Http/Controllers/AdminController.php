<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Profile, Skill, Experience, Education, Project};

class AdminController extends Controller
{
    // Tampilkan semua data di Dashboard Admin
    public function index() {
        $profile = Profile::first();
        $skills = Skill::all();
        $experiences = Experience::orderBy('tahun', 'desc')->get();
        $educations = Education::orderBy('tahun', 'desc')->get();
        $projects = Project::latest()->get();
        
        return view('admin.dashboard', compact('profile', 'skills', 'experiences', 'educations', 'projects'));
    }

    // --- UPDATE PROFIL & FOTO ---
    public function updateProfile(Request $request) {
        $profile = Profile::first();
        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('photos', 'public');
            $data['foto'] = $path;
        }
        $profile->update($data);
        return back()->with('success', 'Data Profil & Foto berhasil diperbarui!');
    }

    // --- CRUD SKILL ---
    public function storeSkill(Request $request) { Skill::create($request->all()); return back()->with('success', 'Skill ditambah!'); }
    public function destroySkill($id) { Skill::destroy($id); return back()->with('success', 'Skill dihapus!'); }

    // --- CRUD PENGALAMAN ---
    public function storeExperience(Request $request) { Experience::create($request->all()); return back()->with('success', 'Pengalaman ditambah!'); }
    public function destroyExperience($id) { Experience::destroy($id); return back()->with('success', 'Pengalaman dihapus!'); }

    // --- CRUD PENDIDIKAN ---
    public function storeEducation(Request $request) { Education::create($request->all()); return back()->with('success', 'Pendidikan ditambah!'); }
    public function destroyEducation($id) { Education::destroy($id); return back()->with('success', 'Pendidikan dihapus!'); }

    // --- CRUD PROJECT ---
    public function storeProject(Request $request) { Project::create($request->all()); return back()->with('success', 'Project ditambah!'); }
    public function destroyProject($id) { Project::destroy($id); return back()->with('success', 'Project dihapus!'); }
}