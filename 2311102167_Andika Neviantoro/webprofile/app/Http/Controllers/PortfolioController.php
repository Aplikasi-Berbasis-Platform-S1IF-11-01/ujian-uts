<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    public function index()
    {
        return view('portfolio.index');
    }

    public function getProfile()
    {
        $profile = DB::table('profiles')->first();
        if ($profile && $profile->photo) {
            $profile->photo_url = asset('storage/' . $profile->photo);
        } else {
            $profile->photo_url = null;
        }
        return response()->json(['success' => true, 'data' => $profile]);
    }

    public function getSkills()
    {
        $skills = DB::table('skills')->orderBy('sort_order')->get();
        $skills = $skills->map(function ($skill) {
            $skill->items = json_decode($skill->items);
            return $skill;
        });
        return response()->json(['success' => true, 'data' => $skills]);
    }

    public function getEducation()
    {
        $education = DB::table('education')->orderBy('sort_order')->get();
        return response()->json(['success' => true, 'data' => $education]);
    }

    public function getProjects()
    {
        $projects = DB::table('projects')->orderBy('sort_order')->get();
        return response()->json(['success' => true, 'data' => $projects]);
    }

    public function getContacts()
    {
        $contacts = DB::table('contacts')->orderBy('sort_order')->get();
        return response()->json(['success' => true, 'data' => $contacts]);
    }
}
