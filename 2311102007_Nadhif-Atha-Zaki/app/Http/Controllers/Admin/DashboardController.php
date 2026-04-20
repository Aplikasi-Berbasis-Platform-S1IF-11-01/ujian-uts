<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'profile' => Profile::first(),
            'educations' => Education::orderBy('sort_order')->get(),
            'skills' => Skill::orderBy('sort_order')->get(),
            'projects' => Project::orderBy('sort_order')->get(),
        ]);
    }
}