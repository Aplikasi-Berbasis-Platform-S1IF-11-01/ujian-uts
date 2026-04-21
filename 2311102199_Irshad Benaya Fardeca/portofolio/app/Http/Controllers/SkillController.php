<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = Skill::orderBy('category')
            ->orderBy('display_order')
            ->get();
        
        return response()->json($skills);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
            'category' => 'required|string',
            'icon_class' => 'nullable|string',
        ]);

        $skill = Skill::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Skill added successfully',
            'data' => $skill
        ]);
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
            'category' => 'required|string',
            'icon_class' => 'nullable|string',
        ]);

        $skill->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Skill updated successfully',
            'data' => $skill
        ]);
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return response()->json([
            'success' => true,
            'message' => 'Skill deleted successfully'
        ]);
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'skills' => 'required|array',
            'skills.*.id' => 'required|exists:skills,id',
            'skills.*.display_order' => 'required|integer'
        ]);

        foreach ($request->skills as $skillData) {
            Skill::where('id', $skillData['id'])
                ->update(['display_order' => $skillData['display_order']]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Skill order updated successfully'
        ]);
    }

    public function toggleActive(Skill $skill)
    {
        $skill->is_active = !$skill->is_active;
        $skill->save();

        return response()->json([
            'success' => true,
            'message' => 'Skill status updated',
            'data' => $skill
        ]);
    }
}