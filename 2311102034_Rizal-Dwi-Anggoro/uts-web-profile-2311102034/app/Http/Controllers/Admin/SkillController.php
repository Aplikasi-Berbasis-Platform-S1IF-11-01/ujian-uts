<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Skill::orderBy('order')->orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'category'    => 'nullable|string|max:60',
            'description' => 'nullable|string',
            'level'       => 'nullable|integer|min:0|max:100',
            'order'       => 'nullable|integer',
        ]);
        $skill = Skill::create($data);
        return response()->json(['data' => $skill, 'message' => 'Skill created'], 201);
    }

    public function update(Request $request, Skill $skill)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'category'    => 'nullable|string|max:60',
            'description' => 'nullable|string',
            'level'       => 'nullable|integer|min:0|max:100',
            'order'       => 'nullable|integer',
        ]);
        $skill->update($data);
        return response()->json(['data' => $skill, 'message' => 'Skill updated']);
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return response()->json(['message' => 'Skill deleted']);
    }
}