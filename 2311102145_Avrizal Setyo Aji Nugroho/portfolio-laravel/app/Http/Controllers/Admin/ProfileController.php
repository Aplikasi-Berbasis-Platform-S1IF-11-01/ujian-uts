<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /*
 * Nama : Avrizal Setyo Aji Nugroho
 * NIM  : 2311102145
 */
    /* ─────────────────────────────────
     *  DASHBOARD
     * ───────────────────────────────── */
    public function dashboard()
    {
        $profile  = Profile::first();
        $skills   = Skill::orderBy('sort_order')->get();
        $projects = Project::orderBy('sort_order')->get();

        return view('admin.dashboard', compact('profile', 'skills', 'projects'));
    }

    /* ─────────────────────────────────
     *  PROFILE CRUD
     * ───────────────────────────────── */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'tagline'  => 'nullable|string|max:255',
            'bio'      => 'nullable|string',
            'email'    => 'nullable|email',
            'phone'    => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'photo'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $profile = Profile::firstOrCreate([]);

        $data = $request->only([
            'name', 'tagline', 'bio', 'email', 'phone',
            'location', 'github', 'linkedin', 'instagram', 'whatsapp',
        ]);

        // typed words: textarea with one word per line
        if ($request->filled('typed_words')) {
            $words = array_filter(array_map('trim', explode("\n", $request->typed_words)));
            $data['typed_words'] = array_values($words);
        }

        // photo upload
        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }
            $path = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $path;
        }

        $profile->update($data);

        return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui!']);
    }

    /* ─────────────────────────────────
     *  SKILL CRUD
     * ───────────────────────────────── */
    public function storeSkill(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'percentage' => 'required|integer|min:0|max:100',
            'category'   => 'required|in:technical,soft,tools',
        ]);

        $skill = Skill::create([
            'name'       => $request->name,
            'percentage' => $request->percentage,
            'category'   => $request->category,
            'sort_order' => Skill::max('sort_order') + 1,
            'is_active'  => true,
        ]);

        return response()->json(['success' => true, 'data' => $skill]);
    }

    public function updateSkill(Request $request, Skill $skill)
    {
        $request->validate([
            'name'       => 'required|string|max:100',
            'percentage' => 'required|integer|min:0|max:100',
            'category'   => 'required|in:technical,soft,tools',
        ]);

        $skill->update($request->only('name', 'percentage', 'category', 'is_active'));

        return response()->json(['success' => true, 'data' => $skill]);
    }

    public function destroySkill(Skill $skill)
    {
        $skill->delete();
        return response()->json(['success' => true]);
    }

    /* ─────────────────────────────────
     *  PROJECT CRUD
     * ───────────────────────────────── */
    public function storeProject(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'description'=> 'nullable|string',
            'tech_stack' => 'nullable|string|max:255',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'github_url' => 'nullable|url',
            'live_url'   => 'nullable|url',
        ]);

        $data = $request->only('title', 'description', 'tech_stack', 'github_url', 'live_url');
        $data['sort_order'] = Project::max('sort_order') + 1;
        $data['is_active']  = true;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project = Project::create($data);

        return response()->json(['success' => true, 'data' => $project]);
    }

    public function updateProject(Request $request, Project $project)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'description'=> 'nullable|string',
            'tech_stack' => 'nullable|string|max:255',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'github_url' => 'nullable|url',
            'live_url'   => 'nullable|url',
        ]);

        $data = $request->only('title', 'description', 'tech_stack', 'github_url', 'live_url', 'is_active');

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);

        return response()->json(['success' => true, 'data' => $project]);
    }

    public function destroyProject(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();
        return response()->json(['success' => true]);
    }
}
