<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json(Project::latest()->get());
    }

    public function store(Request $request)
    {
        $project = new Project();

        $project->title = $request->title;
        $project->description = $request->description;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $project->image = $path;
        }

        $project->save();

        return response()->json(['success' => true]);
    }
}