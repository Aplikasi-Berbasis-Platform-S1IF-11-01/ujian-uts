<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use Illuminate\Http\Request;

// ─── PUBLIC ROUTES ────────────────────────────────────────────────
Route::get('/', function () {
    return view('landing');
});

Route::get('/api/data', function () {
    $profile = Profile::first();
    $skills = Skill::all();
    $projects = Project::orderBy('order')->get();
    return response()->json([
        'profile'  => $profile,
        'skills'   => $skills,
        'projects' => $projects,
    ]);
});

// ─── AUTH ROUTES ──────────────────────────────────────────────────
Route::get('/login', function () {
    if (Auth::check()) return redirect('/admin');
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/admin');
    }
    return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
})->name('login.post');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// ─── ADMIN ROUTES (Protected) ─────────────────────────────────────
Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/', function () {
        $profile  = Profile::first();
        $skills   = Skill::all();
        $projects = Project::orderBy('order')->get();
        return view('admin', compact('profile', 'skills', 'projects'));
    });

    // ── Profile ──────────────────────────────────────────────────
    Route::post('/profile', function (Request $request) {
        $profile = Profile::first() ?? new Profile();
        if ($request->hasFile('photo_file')) {
            $file     = $request->file('photo_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img'), $filename);
            $profile->photo_url = '/assets/img/' . $filename;
        } elseif ($request->photo_url) {
            $profile->photo_url = $request->photo_url;
        }
        $profile->name              = $request->name;
        $profile->role              = $request->role;
        $profile->hero_description  = $request->hero_description;
        $profile->about_description = $request->about_description;
        $profile->save();
        return response()->json(['success' => true, 'profile' => $profile]);
    });

    // ── Skills ────────────────────────────────────────────────────
    Route::post('/skills', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:100',
            'proficiency' => 'required|integer|min:0|max:100'
        ]);
        $iconUrl = null;
        if ($request->hasFile('icon_file')) {
            $file     = $request->file('icon_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img'), $filename);
            $iconUrl = '/assets/img/' . $filename;
        }

        $skill = Skill::create([
            'name'        => $request->name,
            'proficiency' => $request->proficiency,
            'icon_url'    => $iconUrl,
        ]);
        return response()->json(['success' => true, 'skill' => $skill]);
    });

    Route::post('/skills/{id}', function (Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:100',
            'proficiency' => 'required|integer|min:0|max:100'
        ]);
        $skill = Skill::findOrFail($id);

        if ($request->hasFile('icon_file')) {
            $file     = $request->file('icon_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img'), $filename);
            $skill->icon_url = '/assets/img/' . $filename;
        }

        $skill->update([
            'name'        => $request->name,
            'proficiency' => $request->proficiency,
        ]);
        return response()->json(['success' => true, 'skill' => $skill]);
    });

    Route::delete('/skills/{id}', function ($id) {
        Skill::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    });

    // ── Projects ──────────────────────────────────────────────────
    Route::get('/projects', function () {
        return response()->json(Project::orderBy('order')->get());
    });

    Route::post('/projects', function (Request $request) {
        $request->validate(['title' => 'required|string|max:200']);
        $imageUrl = null;
        if ($request->hasFile('image_file')) {
            $file     = $request->file('image_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img'), $filename);
            $imageUrl = '/assets/img/' . $filename;
        }
        $project = Project::create([
            'title'       => $request->title,
            'description' => $request->description,
            'image_url'   => $imageUrl,
            'tech_stack'  => $request->tech_stack,
            'order'       => Project::max('order') + 1,
        ]);
        return response()->json(['success' => true, 'project' => $project]);
    });

    Route::post('/projects/{id}', function (Request $request, $id) {
        $request->validate(['title' => 'required|string|max:200']);
        $project = Project::findOrFail($id);
        if ($request->hasFile('image_file')) {
            $file     = $request->file('image_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img'), $filename);
            $project->image_url = '/assets/img/' . $filename;
        }
        $project->update([
            'title'       => $request->title,
            'description' => $request->description,
            'tech_stack'  => $request->tech_stack,
        ]);
        return response()->json(['success' => true, 'project' => $project]);
    });

    Route::delete('/projects/{id}', function ($id) {
        Project::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    });
});
