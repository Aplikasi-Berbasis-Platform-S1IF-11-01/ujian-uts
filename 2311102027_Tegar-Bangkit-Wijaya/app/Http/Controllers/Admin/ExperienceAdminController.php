<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceAdminController extends Controller
{
    public function index()
    {
        $experiences = Experience::orderBy('order')->orderBy('start_date', 'desc')->get();
        return view('admin.experiences.index', compact('experiences'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company'     => 'required|string|max:150',
            'position'    => 'required|string|max:150',
            'description' => 'nullable|string',
            'type'        => 'required|in:work,education,certificate',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'is_current'  => 'nullable|boolean',
            'location'    => 'nullable|string|max:100',
            'order'       => 'nullable|integer',
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        if ($validated['is_current']) $validated['end_date'] = null;

        $experience = Experience::create($validated);
        return response()->json(['success' => true, 'message' => 'Experience berhasil ditambahkan.', 'data' => $experience]);
    }

    public function update(Request $request, Experience $experience)
    {
        $validated = $request->validate([
            'company'     => 'required|string|max:150',
            'position'    => 'required|string|max:150',
            'description' => 'nullable|string',
            'type'        => 'required|in:work,education,certificate',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date',
            'is_current'  => 'nullable|boolean',
            'location'    => 'nullable|string|max:100',
            'order'       => 'nullable|integer',
        ]);

        $validated['is_current'] = $request->boolean('is_current');
        if ($validated['is_current']) $validated['end_date'] = null;

        $experience->update($validated);
        return response()->json(['success' => true, 'message' => 'Experience berhasil diperbarui.', 'data' => $experience->fresh()]);
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return response()->json(['success' => true, 'message' => 'Experience berhasil dihapus.']);
    }
}
