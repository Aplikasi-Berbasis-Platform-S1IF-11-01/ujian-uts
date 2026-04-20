<?php

namespace App\Http\Controllers;

// Daftarkan semua model di sini biar rapi
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;

class LandingController extends Controller
{
    // Nampilin halaman web depan (HTML-nya aja, datanya nyusul pake AJAX)
    public function index() {
        return view('landing'); 
    }

    // INI DIA KUNCI UTS-NYA: Endpoint API untuk di-fetch sama AJAX
    public function getPortfolioData() {
        return response()->json([
            'profile'     => Profile::first(),
            'skills'      => Skill::all(),
            'experiences' => Experience::orderBy('tahun', 'desc')->get(),
            'educations'  => Education::orderBy('tahun', 'desc')->get(),
            'projects'    => Project::latest()->get()
        ]);
    }
}