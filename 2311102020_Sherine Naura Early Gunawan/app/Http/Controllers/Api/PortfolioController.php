<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Education; 
use App\Models\Project;   
class PortfolioController extends Controller
{
    public function index()
    {
        $profile = Profile::first(); 
        $skills = Skill::all();
        $education = Education::all(); 
        $projects = Project::all();   

        return response()->json([
            'profile'   => $profile,
            'skills'    => $skills,
            'education' => $education, 
            'projects'  => $projects    
        ]);
    }
}