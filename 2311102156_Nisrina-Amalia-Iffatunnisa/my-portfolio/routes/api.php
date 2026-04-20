<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Profile;
use App\Models\Education;
use App\Models\Focus;
use App\Models\Skill;
use App\Models\Inspiration;
use App\Models\Portfolio;

Route::get('/portfolio-data', function () {
    return response()->json([
        'profile' => Profile::first(),
        'education' => Education::orderBy('sort_order')->get(),
        'foci' => Focus::orderBy('sort_order')->get(),
        'skills' => Skill::orderBy('sort_order')->get(),
        'inspirations' => Inspiration::inRandomOrder()->take(4)->get(),
        'portfolios' => Portfolio::orderBy('sort_order')->get()
    ]);
});
