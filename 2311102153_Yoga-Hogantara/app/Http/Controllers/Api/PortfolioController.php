<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;

class PortfolioController extends Controller
{
    public function profile(): JsonResponse
    {
        $profile = Profile::first();

        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], 404);
        }

        $data = $profile->toArray();
        $data['foto_url'] = $profile->path_foto
            ? asset('storage/' . $profile->path_foto)
            : null;

        return response()->json($data);
    }

    public function skills(): JsonResponse
    {
        $skills = Skill::orderBy('level', 'desc')->get();
        return response()->json($skills);
    }
}