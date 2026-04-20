<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/projects'), $filename);
            $data['image'] = 'uploads/projects/' . $filename;
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;

        Project::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Project berhasil ditambahkan.');
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_link' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $filename = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/projects'), $filename);
            $data['image'] = 'uploads/projects/' . $filename;
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;

        $project->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Project berhasil diupdate.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Project berhasil dihapus.');
    }
}