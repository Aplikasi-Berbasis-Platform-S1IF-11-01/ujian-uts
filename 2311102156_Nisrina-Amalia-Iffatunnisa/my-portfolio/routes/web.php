<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Models\Profile;
use App\Models\Portfolio;
use App\Models\Education;
use App\Models\Skill;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $profile = Profile::first();
        $portfolios = Portfolio::all();
        $education = Education::all();
        $skills = Skill::all();
        return view('dashboard', compact('profile', 'portfolios', 'education', 'skills'));
    })->name('dashboard');

    Route::post('/dashboard/profile', function (Request $request) {
        $validated = $request->validate([
            'name' => 'required|string',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'about_description' => 'nullable|string',
            'image_url' => 'nullable|image|max:2048'
        ]);
        
        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('profile', 'public');
            $validated['image_url'] = '/storage/' . $path;
        } else {
            unset($validated['image_url']);
        }

        $profile = Profile::first();
        $profile->update($validated);
        return back()->with('success', 'Profile updated successfully.');
    })->name('profile.update-data');

    // Portfolio Routes
    Route::post('/dashboard/portfolio', function (Request $request) {
        $validated = $request->validate([
            'title' => 'required|string',
            'category' => 'nullable|string',
            'date_range' => 'nullable|string',
            'description' => 'nullable|string',
            'image_url' => 'nullable|image|max:2048',
            'link' => 'nullable|string'
        ]);
        
        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('portfolios', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        Portfolio::create($validated);
        return back()->with('success', 'Portfolio created successfully.');
    })->name('portfolio.store');

    Route::get('/dashboard/portfolio/{id}/edit', function ($id) {
        $portfolio = Portfolio::findOrFail($id);
        return view('portfolio.edit', compact('portfolio'));
    })->name('portfolio.edit');

    Route::put('/dashboard/portfolio/{id}', function (Request $request, $id) {
        $validated = $request->validate([
            'title' => 'required|string',
            'category' => 'nullable|string',
            'date_range' => 'nullable|string',
            'description' => 'nullable|string',
            'image_url' => 'nullable|image|max:2048',
            'link' => 'nullable|string'
        ]);

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('portfolios', 'public');
            $validated['image_url'] = '/storage/' . $path;
        } else {
            unset($validated['image_url']);
        }

        Portfolio::findOrFail($id)->update($validated);
        return redirect()->route('dashboard')->with('success', 'Portfolio updated successfully.');
    })->name('portfolio.update');

    Route::delete('/dashboard/portfolio/{id}', function ($id) {
        Portfolio::findOrFail($id)->delete();
        return back()->with('success', 'Portfolio deleted successfully.');
    })->name('portfolio.destroy');

    // Education Routes
    Route::post('/dashboard/education', function (Request $request) {
        $validated = $request->validate([
            'period' => 'required|string',
            'institution' => 'required|string',
            'major' => 'required|string',
            'description' => 'nullable|string'
        ]);
        Education::create($validated);
        return back()->with('success', 'Education created successfully.');
    })->name('education.store');

    Route::get('/dashboard/education/{id}/edit', function ($id) {
        $education = Education::findOrFail($id);
        return view('education.edit', compact('education'));
    })->name('education.edit');

    Route::put('/dashboard/education/{id}', function (Request $request, $id) {
        $validated = $request->validate([
            'period' => 'required|string',
            'institution' => 'required|string',
            'major' => 'required|string',
            'description' => 'nullable|string'
        ]);
        Education::findOrFail($id)->update($validated);
        return redirect()->route('dashboard')->with('success', 'Education updated successfully.');
    })->name('education.update');

    Route::delete('/dashboard/education/{id}', function ($id) {
        Education::findOrFail($id)->delete();
        return back()->with('success', 'Education deleted successfully.');
    })->name('education.destroy');

    // Skill Routes
    Route::post('/dashboard/skill', function (Request $request) {
        $validated = $request->validate([
            'name' => 'required|string'
        ]);
        Skill::create($validated);
        return back()->with('success', 'Skill created successfully.');
    })->name('skill.store');

    Route::get('/dashboard/skill/{id}/edit', function ($id) {
        $skill = Skill::findOrFail($id);
        return view('skill.edit', compact('skill'));
    })->name('skill.edit');

    Route::put('/dashboard/skill/{id}', function (Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required|string'
        ]);
        Skill::findOrFail($id)->update($validated);
        return redirect()->route('dashboard')->with('success', 'Skill updated successfully.');
    })->name('skill.update');

    Route::delete('/dashboard/skill/{id}', function ($id) {
        Skill::findOrFail($id)->delete();
        return back()->with('success', 'Skill deleted successfully.');
    })->name('skill.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
