<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $data = $request->except('image_url');
        
        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('projects', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        Project::create($data);
        return redirect()->back()->with('success', 'Project added successfully!');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $data = $request->except('image_url');

        if ($request->hasFile('image_url')) {
            // Delete old file if exists
            if ($project->image_url && file_exists(public_path($project->image_url))) {
                @unlink(public_path($project->image_url));
            }
            $path = $request->file('image_url')->store('projects', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        // Delete associated image
        if ($project->image_url && file_exists(public_path($project->image_url))) {
            @unlink(public_path($project->image_url));
        }
        $project->delete();
        return redirect()->back()->with('success', 'Project deleted successfully!');
    }
}
