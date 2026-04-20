<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // ── Dashboard ─────────────────────────────────────────────────
    public function dashboard()
    {
        return view('admin.dashboard', [
            'profileCount'   => Profile::count(),
            'skillCount'     => Skill::count(),
            'projectCount'   => Project::count(),
            'educationCount' => Education::count(),
        ]);
    }

    // ══════════════════════════════════════════════════════════════
    //  PROFILE
    // ══════════════════════════════════════════════════════════════
    public function profilePage()
    {
        return view('admin.profile');
    }

    public function profileGet(): JsonResponse
    {
        return response()->json(['success' => true, 'data' => Profile::getSingle()]);
    }

    public function profileUpdate(Request $request): JsonResponse
    {
        $v = Validator::make($request->all(), [
            'name'           => 'required|string|max:255',
            'nim'            => 'required|string|max:20',
            'class'          => 'required|string|max:20',
            'tagline'        => 'nullable|string|max:255',
            'description'    => 'required|string',
            'email'          => 'nullable|email',
            'github'         => 'nullable|string|max:100',
            'instagram'      => 'nullable|string|max:100',
            'location'       => 'nullable|string|max:255',
            'gpa'            => 'nullable|numeric|min:0|max:4',
            'projects_count' => 'nullable|integer|min:0',
            'tech_count'     => 'nullable|integer|min:0',
            'available'      => 'nullable|boolean',
            'photo'          => 'nullable|image|max:2048',
        ]);

        if ($v->fails()) {
            return response()->json(['success' => false, 'errors' => $v->errors()], 422);
        }

        $profile = Profile::getSingle();
        $data    = $request->except('photo');
        $data['available'] = $request->boolean('available');

        if ($request->hasFile('photo')) {
            if ($profile->photo) Storage::disk('public')->delete($profile->photo);
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $profile->update($data);

        return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui!', 'data' => $profile]);
    }

    // ══════════════════════════════════════════════════════════════
    //  SKILLS
    // ══════════════════════════════════════════════════════════════
    public function skillsPage()
    {
        return view('admin.skills');
    }

    public function skillsGet(): JsonResponse
    {
        return response()->json(['success' => true, 'data' => Skill::orderBy('sort_order')->get()]);
    }

    public function skillStore(Request $request): JsonResponse
    {
        $v = Validator::make($request->all(), [
            'name'       => 'required|string|max:100',
            'category'   => 'required|in:frontend,backend,tools',
            'percentage' => 'required|integer|min:0|max:100',
            'icon'       => 'nullable|string|max:100',
        ]);
        if ($v->fails()) return response()->json(['success' => false, 'errors' => $v->errors()], 422);

        $skill = Skill::create(array_merge($request->all(), ['sort_order' => Skill::max('sort_order') + 1]));
        return response()->json(['success' => true, 'message' => 'Skill ditambahkan!', 'data' => $skill]);
    }

    public function skillUpdate(Request $request, Skill $skill): JsonResponse
    {
        $v = Validator::make($request->all(), [
            'name'       => 'required|string|max:100',
            'category'   => 'required|in:frontend,backend,tools',
            'percentage' => 'required|integer|min:0|max:100',
            'icon'       => 'nullable|string|max:100',
        ]);
        if ($v->fails()) return response()->json(['success' => false, 'errors' => $v->errors()], 422);

        $skill->update($request->all());
        return response()->json(['success' => true, 'message' => 'Skill diperbarui!', 'data' => $skill]);
    }

    public function skillDestroy(Skill $skill): JsonResponse
    {
        $skill->delete();
        return response()->json(['success' => true, 'message' => 'Skill dihapus!']);
    }

    // ══════════════════════════════════════════════════════════════
    //  PROJECTS
    // ══════════════════════════════════════════════════════════════
    public function projectsPage()
    {
        return view('admin.projects');
    }

public function projectsGet(): JsonResponse
{
    $projects = Project::orderBy('sort_order')->get()->map(function ($p) {
        $p->image_url = $p->image
            ? asset('storage/' . $p->image)
            : null;
        return $p;
    });

    return response()->json([
        'success' => true,
        'data' => $projects
    ]);
}

    public function projectStore(Request $request): JsonResponse
    {
        $v = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'type'        => 'nullable|string|max:100',
            'description' => 'required|string',
            'tech_stack'  => 'required|string',
            'github_url'  => 'nullable|url',
            'demo_url'    => 'nullable|url',
            'image'       => 'nullable|image|max:2048',
            'is_featured' => 'nullable|boolean',
        ]);
        if ($v->fails()) return response()->json(['success' => false, 'errors' => $v->errors()], 422);

        $data = $request->except('image');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['sort_order']  = Project::max('sort_order') + 1;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project = Project::create($data);
        return response()->json(['success' => true, 'message' => 'Proyek ditambahkan!', 'data' => $project]);
    }

    public function projectUpdate(Request $request, Project $project): JsonResponse
    {
        $v = Validator::make($request->all(), [
            'title'       => 'required|string|max:255',
            'type'        => 'nullable|string|max:100',
            'description' => 'required|string',
            'tech_stack'  => 'required|string',
            'github_url'  => 'nullable',
            'demo_url'    => 'nullable',
            'image'       => 'nullable|image|max:2048',
            'is_featured' => 'nullable|boolean',
        ]);
        if ($v->fails()) return response()->json(['success' => false, 'errors' => $v->errors()], 422);

        $data = $request->except('image');
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            if ($project->image) Storage::disk('public')->delete($project->image);
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);
        return response()->json(['success' => true, 'message' => 'Proyek diperbarui!', 'data' => $project]);
    }

    public function projectDestroy(Project $project): JsonResponse
    {
        if ($project->image) Storage::disk('public')->delete($project->image);
        $project->delete();
        return response()->json(['success' => true, 'message' => 'Proyek dihapus!']);
    }

    // ══════════════════════════════════════════════════════════════
    //  EDUCATION
    // ══════════════════════════════════════════════════════════════
    public function educationPage()
    {
        return view('admin.education');
    }

    public function educationGet(): JsonResponse
    {
        return response()->json(['success' => true, 'data' => Education::orderBy('sort_order')->get()]);
    }

    public function educationStore(Request $request): JsonResponse
    {
        $v = Validator::make($request->all(), [
            'degree'     => 'required|string|max:255',
            'school'     => 'required|string|max:255',
            'year_start' => 'required|string|max:10',
            'year_end'   => 'nullable|string|max:10',
        ]);
        if ($v->fails()) return response()->json(['success' => false, 'errors' => $v->errors()], 422);

        $edu = Education::create(array_merge($request->all(), ['sort_order' => Education::max('sort_order') + 1]));
        return response()->json(['success' => true, 'message' => 'Pendidikan ditambahkan!', 'data' => $edu]);
    }

    public function educationUpdate(Request $request, Education $education): JsonResponse
    {
        $v = Validator::make($request->all(), [
            'degree'     => 'required|string|max:255',
            'school'     => 'required|string|max:255',
            'year_start' => 'required|string|max:10',
            'year_end'   => 'nullable|string|max:10',
        ]);
        if ($v->fails()) return response()->json(['success' => false, 'errors' => $v->errors()], 422);

        $education->update($request->all());
        return response()->json(['success' => true, 'message' => 'Pendidikan diperbarui!', 'data' => $education]);
    }

    public function educationDestroy(Education $education): JsonResponse
    {
        $education->delete();
        return response()->json(['success' => true, 'message' => 'Pendidikan dihapus!']);
    }
}