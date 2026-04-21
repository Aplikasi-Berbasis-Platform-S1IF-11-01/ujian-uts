<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        return response()->json(Profile::first());
    }

    public function update(Request $request)
    {
        $profile = Profile::first() ?? new Profile();

        $profile->name = $request->name;
        $profile->description = $request->description;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profiles', 'public');
            $profile->photo = $path;
        }

        $profile->save();

        return response()->json(['success' => true]);
    }
}