<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationAdminController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('order')->get();
        return view('admin.educations.index', compact('educations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'school' => 'required',
            'institution' => 'required',
            'year_start' => 'required',
            'description' => 'required',
        ]);
        Education::create($request->all());
        return redirect()->route('admin.educations.index')
            ->with('success', 'Pendidikan berhasil ditambahkan!');
    }

    public function update(Request $request, Education $education)
    {
        $education->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return response()->json(['success' => true]);
    }
}