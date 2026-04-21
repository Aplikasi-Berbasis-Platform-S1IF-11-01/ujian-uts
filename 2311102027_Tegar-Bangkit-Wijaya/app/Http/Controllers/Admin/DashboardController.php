<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Experience;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'skills'      => Skill::count(),
            'projects'    => Project::count(),
            'experiences' => Experience::count(),
        ];
        $profile = Profile::first();
        return view('admin.dashboard', compact('stats', 'profile'));
    }
}
