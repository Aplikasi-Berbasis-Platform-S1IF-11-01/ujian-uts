<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects');
    }

    public function list()
    {
        return response()->json(
            Project::orderBy('sort_order')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_url' => 'nullable|url',
            'image' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'project_url' => $request->project_url,
            'image' => $request->image,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return response()->json([
            'message' => 'Project berhasil ditambahkan',
            'data' => $project
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_url' => 'nullable|url',
            'image' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'project_url' => $request->project_url,
            'image' => $request->image,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return response()->json([
            'message' => 'Project berhasil diupdate',
            'data' => $project
        ]);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return response()->json([
            'message' => 'Project berhasil dihapus'
        ]);
    }
}