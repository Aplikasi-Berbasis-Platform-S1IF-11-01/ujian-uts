<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;

class PortfolioController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function data()
    {
        return response()->json([
            'profile' => Profile::first(),
            'educations' => Education::orderBy('sort_order')->get(),
            'skills' => Skill::orderBy('sort_order')->get(),
            'projects' => Project::orderBy('sort_order')->get(),
        ]);
    }
}