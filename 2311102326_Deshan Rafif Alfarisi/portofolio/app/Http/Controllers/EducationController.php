<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'institution' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Education::create($data);

        return back()->with('success', 'Education added successfully.');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return back()->with('success', 'Education deleted successfully.');
    }
}
