<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    // ─── VIEWS ───────────────────────────────────────────────────────────────

    public function index()
    {
        return view('admin.dashboard');
    }

    // ─── PROFILE ─────────────────────────────────────────────────────────────

    public function getProfile(): JsonResponse
    {
        return response()->json(Profile::first());
    }

    public function updateProfile(Request $request): JsonResponse
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'tagline'         => 'nullable|string|max:255',
            'bio'             => 'nullable|string',
            'email'           => 'nullable|email|max:255',
            'phone'           => 'nullable|string|max:20',
            'location'        => 'nullable|string|max:255',
            'github_username' => 'nullable|string|max:100',
            'linkedin_url'    => 'nullable|url|max:255',
            'instagram_url'   => 'nullable|url|max:255',
            'photo'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $profile = Profile::firstOrNew([]);
        $profile->fill($request->except('photo'));

        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }
            $path = $request->file('photo')->store('photos', 'public');
            $profile->photo = $path;
        }

        $profile->save();

        return response()->json([
            'message'   => 'Profil berhasil diperbarui!',
            'photo_url' => $profile->photo_url,
        ]);
    }

    // ─── SKILLS ──────────────────────────────────────────────────────────────

    public function getSkills(): JsonResponse
    {
        return response()->json(Skill::orderBy('order')->get());
    }

    public function storeSkill(Request $request): JsonResponse
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'level'    => 'required|integer|min:0|max:100',
            'icon'     => 'nullable|string|max:10',
        ]);

        $skill = Skill::create([
            'name'     => $request->name,
            'category' => $request->category,
            'level'    => $request->level,
            'icon'     => $request->icon,
            'order'    => Skill::max('order') + 1,
        ]);

        return response()->json(['message' => 'Skill ditambahkan!', 'skill' => $skill], 201);
    }

    public function updateSkill(Request $request, Skill $skill): JsonResponse
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'level'    => 'required|integer|min:0|max:100',
            'icon'     => 'nullable|string|max:10',
        ]);

        $skill->update($request->only('name', 'category', 'level', 'icon'));
        return response()->json(['message' => 'Skill diperbarui!', 'skill' => $skill]);
    }

    public function destroySkill(Skill $skill): JsonResponse
    {
        $skill->delete();
        return response()->json(['message' => 'Skill dihapus!']);
    }

    // ─── EXPERIENCE ──────────────────────────────────────────────────────────

    public function getExperiences(): JsonResponse
    {
        return response()->json(Experience::orderBy('order')->get());
    }

    public function storeExperience(Request $request): JsonResponse
    {
        $request->validate([
            'company'     => 'required|string|max:255',
            'role'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date'  => 'required|string|max:50',
            'end_date'    => 'nullable|string|max:50',
        ]);

        $exp = Experience::create([
            'company'     => $request->company,
            'role'        => $request->role,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'end_date'    => $request->end_date,
            'order'       => Experience::max('order') + 1,
        ]);

        return response()->json(['message' => 'Pengalaman ditambahkan!', 'experience' => $exp], 201);
    }

    public function updateExperience(Request $request, Experience $experience): JsonResponse
    {
        $request->validate([
            'company'     => 'required|string|max:255',
            'role'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date'  => 'required|string|max:50',
            'end_date'    => 'nullable|string|max:50',
        ]);

        $experience->update($request->only('company', 'role', 'description', 'start_date', 'end_date'));
        return response()->json(['message' => 'Pengalaman diperbarui!', 'experience' => $experience]);
    }

    public function destroyExperience(Experience $experience): JsonResponse
    {
        $experience->delete();
        return response()->json(['message' => 'Pengalaman dihapus!']);
    }

    // ─── EDUCATION ───────────────────────────────────────────────────────────

    public function getEducations(): JsonResponse
    {
        return response()->json(Education::orderBy('order')->get());
    }

    public function storeEducation(Request $request): JsonResponse
    {
        $request->validate([
            'institution' => 'required|string|max:255',
            'degree'      => 'required|string|max:100',
            'field'       => 'nullable|string|max:255',
            'start_year'  => 'required|string|max:10',
            'end_year'    => 'nullable|string|max:10',
            'description' => 'nullable|string',
        ]);

        $edu = Education::create([
            'institution' => $request->institution,
            'degree'      => $request->degree,
            'field'       => $request->field,
            'start_year'  => $request->start_year,
            'end_year'    => $request->end_year,
            'description' => $request->description,
            'order'       => Education::max('order') + 1,
        ]);

        return response()->json(['message' => 'Pendidikan ditambahkan!', 'education' => $edu], 201);
    }

    public function updateEducation(Request $request, Education $education): JsonResponse
    {
        $request->validate([
            'institution' => 'required|string|max:255',
            'degree'      => 'required|string|max:100',
            'field'       => 'nullable|string|max:255',
            'start_year'  => 'required|string|max:10',
            'end_year'    => 'nullable|string|max:10',
            'description' => 'nullable|string',
        ]);

        $education->update($request->only('institution', 'degree', 'field', 'start_year', 'end_year', 'description'));
        return response()->json(['message' => 'Pendidikan diperbarui!', 'education' => $education]);
    }

    public function destroyEducation(Education $education): JsonResponse
    {
        $education->delete();
        return response()->json(['message' => 'Pendidikan dihapus!']);
    }
}