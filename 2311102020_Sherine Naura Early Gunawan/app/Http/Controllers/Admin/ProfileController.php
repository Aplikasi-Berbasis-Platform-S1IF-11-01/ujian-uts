<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Education;
use App\Models\Project;
use App\Models\Experience; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index() {
        $profile = Profile::first();
        $education = Education::all(); 
        $projects = Project::all();  
        $experiences = Experience::all();  
        
        return view('admin.dashboard', compact('profile', 'education', 'projects', 'experiences'));
    }

    public function update(Request $request) {
        $profile = Profile::first();
        
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'email' => 'required|email',
            'github_link' => 'nullable|url',
            'linkedin_link' => 'nullable|url',
            
            'edu.*.institution_name' => 'required',
            'edu.*.year_period' => 'required',
            
            'proj.*.project_name' => 'required',
            'proj.*.description' => 'required',

            'exp.*.company_name' => 'required',
            'exp.*.position' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            if ($profile->photo) Storage::disk('public')->delete($profile->photo);
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $profileData = collect($validated)->only(['name', 'description', 'photo', 'email', 'github_link', 'linkedin_link'])->toArray();
        $profile->update($profileData);

        Education::query()->delete(); 
        if($request->edu) {
            foreach ($request->edu as $eduData) {
                Education::create($eduData);
            }
        }

        Project::query()->delete(); 
        if($request->proj) {
            foreach ($request->proj as $projData) {
                Project::create($projData);
            }
        }

        Experience::query()->delete();
        if($request->exp) {
            foreach ($request->exp as $expData) {
                Experience::create($expData);
            }
        }

        return back()->with('success', 'Semua konten portfolio berhasil diupdate!');
    }
}