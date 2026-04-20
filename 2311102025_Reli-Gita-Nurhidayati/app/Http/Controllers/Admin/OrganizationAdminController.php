<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationAdminController extends Controller
{
    public function index()
    {
        $organizations = Organization::all();
        return view('admin.organizations.index', compact('organizations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'role' => 'required',
            'year_start' => 'required',
            'description' => 'required',
        ]);
        Organization::create($request->all());
        return redirect()->route('admin.organizations.index')
            ->with('success', 'Organisasi berhasil ditambahkan!');
    }

    public function update(Request $request, Organization $organization)
    {
        $organization->update($request->all());
        return response()->json(['success' => true]);
    }

    public function destroy(Organization $organization)
    {
        $organization->delete();
        return response()->json(['success' => true]);
    }
}