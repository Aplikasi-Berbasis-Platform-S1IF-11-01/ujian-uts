<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectAdminController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:150',
            'description' => 'required|string',
            'tech_stack'  => 'nullable|string',
            'demo_url'    => 'nullable|url|max:255',
            'github_url'  => 'nullable|url|max:255',
            'status'      => 'required|in:completed,in-progress,archived',
            'year'        => 'nullable|string',
            'order'       => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['slug']        = Str::slug($validated['title']) . '-' . Str::random(4);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['tech_stack']  = $request->tech_stack
            ? json_encode(array_map('trim', explode(',', $request->tech_stack)))
            : null;

        if ($request->year) {
            $validated['year'] = $request->year . '-01-01';
        }

        $project = Project::create($validated);

        return response()->json(['success' => true, 'message' => 'Project berhasil ditambahkan.', 'data' => $project]);
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:150',
            'description' => 'required|string',
            'tech_stack'  => 'nullable|string',
            'demo_url'    => 'nullable|url|max:255',
            'github_url'  => 'nullable|url|max:255',
            'status'      => 'required|in:completed,in-progress,archived',
            'year'        => 'nullable|string',
            'order'       => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['tech_stack']  = $request->tech_stack
            ? json_encode(array_map('trim', explode(',', $request->tech_stack)))
            : null;

        if ($request->year) {
            $validated['year'] = $request->year . '-01-01';
        }

        $project->update($validated);

        return response()->json(['success' => true, 'message' => 'Project berhasil diperbarui.', 'data' => $project->fresh()]);
    }

    public function updateThumbnail(Request $request, Project $project)
    {
        $request->validate(['thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072']);

        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }

        $path = $request->file('thumbnail')->store('projects', 'public');
        $project->update(['thumbnail' => $path]);

        return response()->json([
            'success'       => true,
            'message'       => 'Thumbnail berhasil diperbarui.',
            'thumbnail_url' => asset('storage/' . $path),
        ]);
    }

    public function destroy(Project $project)
    {
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }
        $project->delete();
        return response()->json(['success' => true, 'message' => 'Project berhasil dihapus.']);
    }
}
