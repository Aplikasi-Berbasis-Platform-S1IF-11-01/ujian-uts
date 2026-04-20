<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        Skill::create([
            'name' => $request->name,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Skill berhasil ditambahkan.');
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

        return redirect()->route('admin.dashboard')->with('success', 'Skill berhasil diupdate.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Skill berhasil dihapus.');
    }
}