<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $skills = \App\Models\Skill::all();
        return view('admin.skills.index', compact('skills'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        \App\Models\Skill::create($request->all());
        return redirect()->back()->with('success', 'Skill added successfully!');
    }

    public function edit($id)
    {
        $skill = \App\Models\Skill::findOrFail($id);
        return view('admin.skills.edit', compact('skill'));
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $skill = \App\Models\Skill::findOrFail($id);
        $skill->update($request->all());
        return redirect()->route('skills.index')->with('success', 'Skill updated successfully!');
    }

    public function destroy($id)
    {
        \App\Models\Skill::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Skill deleted successfully!');
    }
}
