<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->orderBy('name')->get()->map(function ($p) {
            $p->tech_stack = $p->tech_stack ? json_decode($p->tech_stack, true) : [];
            return $p;
        });
        return response()->json(['data' => $projects]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'url'         => 'nullable|string|max:500',
            'tech_stack'  => 'nullable|array',
            'order'       => 'nullable|integer',
        ]);
        $data['tech_stack'] = isset($data['tech_stack']) ? json_encode($data['tech_stack']) : null;
        $project = Project::create($data);
        $project->tech_stack = $project->tech_stack ? json_decode($project->tech_stack, true) : [];
        return response()->json(['data' => $project, 'message' => 'Project created'], 201);
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'url'         => 'nullable|string|max:500',
            'tech_stack'  => 'nullable|array',
            'order'       => 'nullable|integer',
        ]);
        $data['tech_stack'] = isset($data['tech_stack']) ? json_encode($data['tech_stack']) : null;
        $project->update($data);
        $project->tech_stack = $project->tech_stack ? json_decode($project->tech_stack, true) : [];
        return response()->json(['data' => $project, 'message' => 'Project updated']);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['message' => 'Project deleted']);
    }
}