<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;

class PortfolioController extends Controller
{
    // ── Public page ──────────────────────────────────────────────
    public function index()
    {
        return view('portofolio.index');
    }

    // ── AJAX: Profile ─────────────────────────────────────────────
    public function apiProfile(): JsonResponse
    {
        $profile = Profile::getSingle();

        return response()->json([
            'success' => true,
            'data'    => $profile,
        ]);
    }

    // ── AJAX: Skills ──────────────────────────────────────────────
    public function apiSkills(): JsonResponse
    {
        $skills = Skill::orderBy('sort_order')->get()->groupBy('category');

        return response()->json([
            'success' => true,
            'data'    => $skills,
        ]);
    }

    // ── AJAX: Projects ────────────────────────────────────────────
    public function apiProjects(): JsonResponse
{
    $projects = Project::orderBy('sort_order')->get()->map(function ($p) {
        $p->tech_array = explode(',', $p->tech_stack);

        $p->image_url = $p->image
            ? asset('storage/' . $p->image)
            : asset('images/placeholder.jpg');

        return $p;
    });

    return response()->json([
        'success' => true,
        'data' => $projects
    ]);
}

    // ── AJAX: Education ───────────────────────────────────────────
    public function apiEducation(): JsonResponse
    {
        $educations = Education::orderBy('sort_order')->get();

        return response()->json([
            'success' => true,
            'data'    => $educations,
        ]);
    }
}