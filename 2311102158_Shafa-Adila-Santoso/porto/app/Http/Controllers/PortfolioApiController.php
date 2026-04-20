<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProfile;
use App\Models\Skill;
use Illuminate\Http\Request;

class PortfolioApiController extends Controller
{
    // GET /api/profile  — dipakai landing page via AJAX
    public function profile()
    {
        $profile = PortfolioProfile::first();
        return response()->json($profile);
    }

    // GET /api/skills  — dipakai landing page via AJAX
    public function skills()
    {
        $skills = Skill::orderBy('kategori')->orderBy('level', 'desc')->get();
        return response()->json($skills);
    }
}
