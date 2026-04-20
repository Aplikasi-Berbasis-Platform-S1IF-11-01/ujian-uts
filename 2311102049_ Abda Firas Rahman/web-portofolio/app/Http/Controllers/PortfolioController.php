<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Education;
use Illuminate\Http\JsonResponse;

class PortfolioController extends Controller
{
    public function getProfile(): JsonResponse {
        return response()->json(['status' => 'success', 'data' => Profile::first()]);
    }
    public function getSkills(): JsonResponse {
        return response()->json(['status' => 'success', 'data' => Skill::all()]);
    }
    public function getProjects(): JsonResponse {
        return response()->json(['status' => 'success', 'data' => Project::all()]);
    }
    public function getEducation(): JsonResponse {
        return response()->json(['status' => 'success', 'data' => Education::all()]);
    }
}