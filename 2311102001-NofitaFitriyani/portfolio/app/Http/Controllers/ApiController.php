<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Skill;

class ApiController extends Controller
{
    public function getPortfolioData()
    {
        $profile = Profile::first();
        $skills = Skill::all();

        return response()->json([
            'profile' => $profile,
            'skills' => $skills
        ]);
    }
}
