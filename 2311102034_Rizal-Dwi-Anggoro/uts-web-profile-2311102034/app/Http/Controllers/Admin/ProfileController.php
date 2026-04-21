<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function show()
    {
        try {
            $profile = Profile::first();

            if ($profile && $profile->stats) {
                $profile->stats = json_decode($profile->stats, true);
            }

            return response()->json([
                'data' => $profile ?? (object)[]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'data'    => null,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'      => 'required|string|max:100',
                'initials'  => 'nullable|string|max:4',
                'role'      => 'nullable|string|max:100',
                'tagline'   => 'nullable|string|max:255',
                'bio'       => 'nullable|string',
                'location'  => 'nullable|string|max:100',
                'available' => 'nullable',
                'photo'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'stats'     => 'nullable|array',
            ]);

            $profile  = Profile::first();
            $photoUrl = $profile?->photo_url;

            // ── Upload foto baru ──────────────────────────
            if ($request->hasFile('photo')) {
                // Hapus foto lama kalau ada
                if ($profile?->photo_url) {
                    $oldPath = ltrim(
                        str_replace(asset('storage'), '', $profile->photo_url),
                        '/'
                    );
                    Storage::disk('public')->delete($oldPath);
                }

                $path     = $request->file('photo')->store('photos', 'public');
                $photoUrl = asset('storage/' . $path);
            }

            $data = [
                'name'      => $validated['name'],
                'initials'  => $validated['initials'] ?? null,
                'role'      => $validated['role']      ?? null,
                'tagline'   => $validated['tagline']   ?? null,
                'bio'       => $validated['bio']       ?? null,
                'location'  => $validated['location']  ?? null,
                // filter_var karena FormData kirim "1"/"0" bukan boolean
                'available' => filter_var(
                    $request->input('available', true),
                    FILTER_VALIDATE_BOOLEAN
                ),
                'photo_url' => $photoUrl,
                'stats'     => isset($validated['stats'])
                    ? json_encode($validated['stats'])
                    : null,
            ];

            if ($profile) {
                $profile->update($data);
                $profile->refresh();
            } else {
                $profile = Profile::create($data);
            }

            if ($profile->stats) {
                $profile->stats = json_decode($profile->stats, true);
            }

            return response()->json([
                'data'    => $profile,
                'message' => 'Profile saved successfully'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => implode(', ', $e->validator->errors()->all())
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}