<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Organization;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class PortofolioController extends Controller
{
    public function home(): View
    {
        return view('welcome');
    }

    public function getPortofolioData(): JsonResponse
    {
        $profile = Profile::query()->first();
        $skills = Skill::query()->latest()->get();
        $educations = Education::query()->latest()->get();
        $experiences = Experience::query()->latest()->get();
        $organizations = Organization::query()->latest()->get();
        $projects = Project::query()->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data portofolio berhasil diambil.',
            'profile' => $profile,
            'skills' => $skills,
            'educations' => $educations,
            'experiences' => $experiences,
            'organizations' => $organizations,
            'projects' => $projects,
        ]);
    }
}