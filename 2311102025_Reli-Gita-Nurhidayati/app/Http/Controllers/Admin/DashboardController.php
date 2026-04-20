<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Education;
use App\Models\Organization;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalSkills' => Skill::count(),
            'totalProjects' => Project::count(),
            'totalEducations' => Education::count(),
            'totalOrganizations' => Organization::count(),
            'profile' => Profile::first(),
        ];
        return view('admin.dashboard', $data);
    }
}