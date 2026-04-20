<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'institution' => 'required|string|max:255',
            'period' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        Education::create([
            'institution' => $request->institution,
            'period' => $request->period,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Education berhasil ditambahkan.');
    }

    public function update(Request $request, Education $education)
    {
        $request->validate([
            'institution' => 'required|string|max:255',
            'period' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        $education->update([
            'institution' => $request->institution,
            'period' => $request->period,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Education berhasil diupdate.');
    }

    public function destroy(Education $education)
    {
        $education->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Education berhasil dihapus.');
    }
}