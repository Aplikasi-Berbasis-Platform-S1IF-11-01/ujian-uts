<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\SocialLink;

class PortfolioController extends Controller
{
    public function index()
    {
        return response()->json([
            'profile' => Profile::first(),
            'skills' => Skill::orderBy('sort_order')->get(),
            'projects' => Project::orderBy('sort_order')->get(),
            'socials' => SocialLink::latest()->get(),
        ]);
    }
}