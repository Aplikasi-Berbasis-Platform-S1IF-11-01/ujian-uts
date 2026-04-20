<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

class PortfolioController extends Controller
{
    /*
 * Nama : Avrizal Setyo Aji Nugroho
 * NIM  : 2311102145
 */
    /**
     * GET /api/profile
     */
    public function profile(): JsonResponse
    {
        $profile = Profile::first();

        if (!$profile) {
            return response()->json(['error' => 'Profile not found'], 404);
        }

        // Build photo URL
        $data = $profile->toArray();
        $data['photo_url'] = $profile->photo
            ? asset('storage/' . $profile->photo)
            : asset('images/default-avatar.png');

        return response()->json(['data' => $data]);
    }

    /**
     * GET /api/skills
     */
    public function skills(): JsonResponse
    {
        $skills = Skill::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return response()->json(['data' => $skills]);
    }

    /**
     * GET /api/projects
     */
    public function projects(): JsonResponse
    {
        $projects = Project::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function ($project) {
                $arr = $project->toArray();
                $arr['image_url'] = $project->image
                    ? asset('storage/' . $project->image)
                    : asset('images/default-project.png');
                return $arr;
            });

        return response()->json(['data' => $projects]);
    }

    /**
     * GET /api/portfolio  — all in one (for landing page)
     */
    public function all(): JsonResponse
    {
        $profile  = Profile::first();
        $skills   = Skill::where('is_active', true)->orderBy('sort_order')->get();
        $projects = Project::where('is_active', true)->orderBy('sort_order')->get();

        return response()->json([
            'profile'  => $profile,
            'skills'   => $skills,
            'projects' => $projects,
        ]);
    }
}
