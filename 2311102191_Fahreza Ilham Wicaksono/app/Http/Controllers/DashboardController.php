<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $page = 'Dashboard';
        $totalProjects = Project::count();
        $totalSkills = Skill::count();

        return view('dashboard.index', compact('page', 'totalProjects', 'totalSkills'));
    }
}
