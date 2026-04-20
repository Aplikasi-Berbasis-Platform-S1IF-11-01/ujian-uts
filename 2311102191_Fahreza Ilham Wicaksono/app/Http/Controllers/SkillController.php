<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = 'Skills';
        $skills = Skill::get();

        return view('dashboard.skills.index', compact('page', 'skills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'skill_name' => 'required|string',
            'level' => 'required|string|in:beginner,intermediate,expert',
            'icon' => 'required|string'
        ]);

        Skill::create($validatedData);

        return redirect()->route('skills.index')->with('success', 'Skill created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        $page = 'Skills';

        return view('dashboard.skills.edit', compact('page', 'skill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        $validatedData = $request->validate([
            'skill_name' => 'required|string',
            'level' => 'required|string|in:beginner,intermediate,expert',
            'icon' => 'required|string'
        ]);

        $skill->update($validatedData);

        return redirect()->route('skills.index')->with('success', 'Skill edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('skills.index')->with('success', 'Skill deleted successfully');
    }
}
