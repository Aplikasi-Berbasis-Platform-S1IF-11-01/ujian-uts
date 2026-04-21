<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        return view('admin.skills');
    }

    public function list()
    {
        return response()->json(
            Skill::orderBy('sort_order')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $skill = Skill::create([
            'name' => $request->name,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return response()->json([
            'message' => 'Skill berhasil ditambahkan',
            'data' => $skill
        ]);
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        $skill->update([
            'name' => $request->name,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return response()->json([
            'message' => 'Skill berhasil diupdate',
            'data' => $skill
        ]);
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return response()->json([
            'message' => 'Skill berhasil dihapus'
        ]);
    }
}