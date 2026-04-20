<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::ordered()->get()->groupBy('category');

        return response()->json([
            'success' => true,
            'data'    => $skills
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'category' => 'required|string',
            'level'    => 'required|integer|min:1|max:100',
            'icon'     => 'nullable|string',
            'order'    => 'nullable|integer',
        ]);

        $skill = Skill::create($validated);

        return response()->json([
            'success' => true,
            'data'    => $skill
        ], 201);
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'category' => 'required|string',
            'level'    => 'required|integer|min:1|max:100',
            'icon'     => 'nullable|string',
            'order'    => 'nullable|integer',
        ]);

        $skill->update($validated);

        return response()->json([
            'success' => true,
            'data'    => $skill
        ]);
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return response()->json([
            'success' => true,
            'message' => 'Skill berhasil dihapus'
        ]);
    }
}