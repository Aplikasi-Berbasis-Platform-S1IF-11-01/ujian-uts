<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = 'Profile';
        $profile = Profile::first();

        return view('dashboard.profile.index', compact('page', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'title' => 'required|string',
            'bio' => 'required|string',
            'photo' => 'nullable|image|max:3072',
        ]);

        $profile = Profile::first();

        if ($request->hasFile('photo')) {
            if ($profile && $profile->photo) {
                Storage::delete($profile->photo);
            }

            $validatedData['photo'] = $request->file('photo')->store('profile-images', 'public');
        }

        if ($profile) {
            $profile->update($validatedData);
            $message = 'Profile updated successfully';
        } else {
            Profile::create($validatedData);
            $message = 'Profile created successfully';
        }

        return redirect()->route('profile.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
