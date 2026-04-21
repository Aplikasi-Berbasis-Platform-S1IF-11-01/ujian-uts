<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Contact;

class PortfolioController extends Controller
{
    public function index()
    {
        return view('portfolio.index');
    }

    public function profile()
    {
        $profile = Profile::first();
        return response()->json([
            'data' => $profile ?: (object)[],
        ]);
    }

    public function skills()
    {
        $skills = Skill::orderBy('order')->orderBy('name')->get();
        return response()->json(['data' => $skills]);
    }

    public function projects()
    {
        $projects = Project::orderBy('order')->orderBy('name')->get()->map(function ($p) {
            $p->tech_stack = $p->tech_stack ? json_decode($p->tech_stack, true) : [];
            return $p;
        });
        return response()->json(['data' => $projects]);
    }

    public function contact()
    {
        $contact = Contact::first();
        return response()->json([
            'data' => $contact ?: (object)[],
        ]);
    }
}