<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(): JsonResponse
    {
        $profile = $this->resolveProfile();

        return response()->json([
            'data' => $profile,
        ]);
    }

    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $profile = $this->resolveProfile();

        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }

            $validated['photo'] = $request->file('photo')->store('profiles', 'public');
        }

        $profile->update($validated);

        return response()->json([
            'message' => 'Profile berhasil diperbarui.',
            'data' => $profile,
        ]);
    }

    private function resolveProfile(): Profile
    {
        $profile = Profile::query()->orderBy('id')->first();

        if ($profile) {
            return $profile;
        }

        return Profile::create([
            'name' => 'Nama Anda',
            'bio' => 'Silakan update bio dari dashboard admin.',
            'photo' => null,
        ]);
    }
}
