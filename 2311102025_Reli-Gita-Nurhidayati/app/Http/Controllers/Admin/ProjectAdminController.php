<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectAdminController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'required',
            'color' => 'required',
            'icon' => 'required',
        ]);
        Project::create($request->all());
        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil ditambahkan!');
    }

    public function update(Request $request, Project $project)
    {
        $project->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['success' => true]);
    }
}