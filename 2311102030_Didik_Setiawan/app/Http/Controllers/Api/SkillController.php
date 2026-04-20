<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index(): JsonResponse
    {
        $skills = Skill::orderBy('display_order')->orderBy('id')->get();

        return response()->json([
            'data' => $skills,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'max:255'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $skill = Skill::create([
            'name' => $validated['name'],
            'level' => $validated['level'] ?? null,
            'display_order' => $validated['display_order'] ?? 0,
        ]);

        return response()->json([
            'message' => 'Skill berhasil ditambahkan.',
            'data' => $skill,
        ], 201);
    }

    public function update(Request $request, Skill $skill): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'level' => ['nullable', 'string', 'max:255'],
            'display_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $skill->update([
            'name' => $validated['name'],
            'level' => $validated['level'] ?? null,
            'display_order' => $validated['display_order'] ?? 0,
        ]);

        return response()->json([
            'message' => 'Skill berhasil diperbarui.',
            'data' => $skill,
        ]);
    }

    public function destroy(Skill $skill): JsonResponse
    {
        $skill->delete();

        return response()->json([
            'message' => 'Skill berhasil dihapus.',
        ]);
    }
}
