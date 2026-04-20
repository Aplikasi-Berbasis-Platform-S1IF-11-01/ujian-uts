<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data'    => $projects
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'demo_url'    => 'nullable|url',
            'github_url'  => 'nullable|url',
            'tech_stack'  => 'nullable|array',
            'is_featured' => 'nullable|boolean',
            'order'       => 'nullable|integer',
        ]);

        $project = Project::create($validated);

        return response()->json([
            'success' => true,
            'data'    => $project
        ], 201);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'demo_url'    => 'nullable|url',
            'github_url'  => 'nullable|url',
            'tech_stack'  => 'nullable|array',
            'is_featured' => 'nullable|boolean',
            'order'       => 'nullable|integer',
        ]);

        $project->update($validated);

        return response()->json([
            'success' => true,
            'data'    => $project
        ]);
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            Storage::delete($project->image);
        }

        $project->delete();

        return response()->json([
            'success' => true,
            'message' => 'Project berhasil dihapus'
        ]);
    }
}