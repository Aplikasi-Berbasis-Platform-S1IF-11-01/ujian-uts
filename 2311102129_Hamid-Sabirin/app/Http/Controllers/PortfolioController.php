<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolio = \App\Models\Portfolio::first();
        $skills = \App\Models\Skill::all();
        $projects = \App\Models\Project::all();

        return response()->json([
            'portfolio' => $portfolio,
            'skills' => $skills,
            'projects' => $projects,
        ]);
    }
}
