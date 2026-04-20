<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillAdminController extends Controller
{
    public function index()
    {
        $skills = Skill::all();
        return view('admin.skills.index', compact('skills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'percentage' => 'required|integer|min:0|max:100',
        ]);
        Skill::create($request->all());
        return redirect()->route('admin.skills.index')
            ->with('success', 'Skill berhasil ditambahkan!');
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'percentage' => 'required|integer|min:0|max:100',
        ]);
        $skill->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return response()->json(['success' => true]);
    }
}