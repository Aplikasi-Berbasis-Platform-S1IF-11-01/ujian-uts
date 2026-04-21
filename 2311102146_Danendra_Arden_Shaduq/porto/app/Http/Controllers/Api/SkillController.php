<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    // GET /api/skills
    public function index()
    {
        return response()->json(Skill::all());
    }

    // POST /api/skills
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'level' => 'required|integer|min:1|max:100'
        ]);

        $skill = Skill::create([
            'name' => $request->name,
            'level' => $request->level
        ]);

        return response()->json([
            'success' => true,
            'data' => $skill
        ]);
    }

    // PUT /api/skills/{id}
    public function update(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);

        $skill->update([
            'name' => $request->name,
            'level' => $request->level
        ]);

        return response()->json(['success' => true]);
    }

    // DELETE /api/skills/{id}
    public function destroy($id)
    {
        Skill::findOrFail($id)->delete();

        return response()->json(['success' => true]);
    }
}