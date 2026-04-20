<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = 'Projects';
        $projects = Project::get();

        return view('dashboard.projects.index', compact('page', 'projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page = 'Projects';

        return view('dashboard.projects.form', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'tech_stack' => 'required|string'
        ]);

        $validatedData['tech_stack'] = array_map('trim', explode(',', $request->tech_stack));

        Project::create($validatedData);

        return redirect()->route('projects.index')->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $page = 'Projects';

        return view('dashboard.projects.form', compact('page', 'project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'tech_stack' => 'required|string'
        ]);

        $validatedData['tech_stack'] = array_map('trim', explode(',', $request->tech_stack));

        $project->update($validatedData);

        return redirect()->route('projects.index')->with('success', 'Project edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }
}
