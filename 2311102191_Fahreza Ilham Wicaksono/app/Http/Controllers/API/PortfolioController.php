<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Profile::first();
        $projects = Project::latest()->get();
        $skills = Skill::all();
        $contacts = Contact::all();

        return response()->json([
            'success' => true,
            'data' => [
                'profile' => $profile,
                'projects' => $projects,
                'skills' => $skills,
                'contacts' => $contacts,
            ]
        ]);
    }
}
