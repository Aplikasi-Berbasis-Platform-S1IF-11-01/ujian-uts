<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillAdminController extends Controller
{
    public function index()
    {
        $skills = Skill::ordered()->get()->groupBy('category');
        return view('admin.skills.index', compact('skills'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'category'    => 'required|string|max:50',
            'level'       => 'required|integer|min:0|max:100',
            'icon'        => 'nullable|string|max:100',
            'color'       => 'nullable|string|max:20',
            'order'       => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $skill = Skill::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Skill berhasil ditambahkan.',
            'data'    => $skill,
        ]);
    }

    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'category'    => 'required|string|max:50',
            'level'       => 'required|integer|min:0|max:100',
            'icon'        => 'nullable|string|max:100',
            'color'       => 'nullable|string|max:20',
            'order'       => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');
        $skill->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Skill berhasil diperbarui.',
            'data'    => $skill->fresh(),
        ]);
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return response()->json(['success' => true, 'message' => 'Skill berhasil dihapus.']);
    }
}
