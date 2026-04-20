<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Experience;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index() { return view('welcome'); }

    public function getApiData() {
        return response()->json([
            'success' => true,
            'profile' => Profile::first(),
            'skills'  => Skill::all(),
            'projects' => Project::orderBy('created_at', 'desc')->get(),
            'experiences' => Experience::orderBy('tahun', 'desc')->get()
        ]);
    }

    public function adminDashboard() {
        $profile = Profile::first() ?? Profile::create([
            'nama' => 'User Baru', 
            'email' => 'admin@email.com', 
            'deskripsi' => 'Bio baru'
        ]);
        $skills = Skill::all();
        $projects = Project::all();
        $experiences = Experience::all();
        return view('admin.dashboard', compact('profile', 'skills', 'projects', 'experiences'));
    }

    public function updateProfile(Request $request, $id) {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $profile = Profile::findOrFail($id);
        if ($request->hasFile('foto')) {
            if ($profile->foto) Storage::delete('public/' . $profile->foto);
            $profile->foto = $request->file('foto')->store('profile_photos', 'public');
        }
        $profile->update($request->except('foto') + ['foto' => $profile->foto]);
        return redirect()->back()->with('success', 'Informasi profil berhasil diperbarui!');
    }

    // SKILL
    public function addSkill(Request $request) { Skill::create($request->all()); return redirect()->back()->with('success', 'Skill ditambah!'); }
    public function updateSkill(Request $request, $id) { Skill::findOrFail($id)->update($request->all()); return redirect()->back()->with('success', 'Skill diupdate!'); }
    public function deleteSkill($id) { Skill::findOrFail($id)->delete(); return redirect()->back()->with('success', 'Skill dihapus!'); }

    // PROJECT
    public function addProject(Request $request) { Project::create($request->all()); return redirect()->back()->with('success', 'Proyek ditambah!'); }
    public function updateProject(Request $request, $id) { Project::findOrFail($id)->update($request->all()); return redirect()->back()->with('success', 'Proyek diupdate!'); }
    public function deleteProject($id) { Project::findOrFail($id)->delete(); return redirect()->back()->with('success', 'Proyek dihapus!'); }

    // EXPERIENCE
    public function addExperience(Request $request) { Experience::create($request->all()); return redirect()->back()->with('success', 'Pengalaman ditambah!'); }
    public function updateExperience(Request $request, $id)
        {
            $request->validate([
                'perusahaan' => 'required',
                'posisi'     => 'required',
                'tahun'      => 'required',
            ]);

            $exp = Experience::findOrFail($id);
            $exp->update($request->all());

            return redirect()->back()->with('success', 'Pengalaman berhasil diperbarui!');
        }
    public function deleteExperience($id) { Experience::findOrFail($id)->delete(); return redirect()->back()->with('success', 'Pengalaman dihapus!'); }
}