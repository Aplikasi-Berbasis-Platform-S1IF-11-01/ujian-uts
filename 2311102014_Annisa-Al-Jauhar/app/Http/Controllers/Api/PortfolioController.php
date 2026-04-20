<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PortfolioController extends Controller
{
    public function profile(): JsonResponse
    {
        $profile = Profile::first();
        if (!$profile) return response()->json(['error' => 'Not found'], 404);

        return response()->json([
            'name'            => $profile->name,
            'tagline'         => $profile->tagline,
            'bio'             => $profile->bio,
            'email'           => $profile->email,
            'phone'           => $profile->phone,
            'location'        => $profile->location,
            'photo_url'       => $profile->photo ? asset('storage/' . $profile->photo) : null,
            'github_username' => $profile->github_username,
            'linkedin_url'    => $profile->linkedin_url,
            'instagram_url'   => $profile->instagram_url,
            'cv_url'          => $profile->cv_url,
        ]);
    }

    public function skills(): JsonResponse
    {
        return response()->json(
            Skill::orderBy('order')->get()->groupBy('category')
        );
    }

    public function experience(): JsonResponse
    {
        return response()->json(Experience::orderBy('order')->get());
    }

    public function education(): JsonResponse
    {
        return response()->json(Education::orderBy('order')->get());
    }

    public function github(): JsonResponse
    {
        $profile = Profile::first();
        if (!$profile?->github_username) {
            return response()->json(['error' => 'GitHub username belum diset'], 404);
        }

        $username = $profile->github_username;

        $repos = Cache::remember("github_{$username}", 600, function () use ($username) {
            $res = Http::withHeaders([
                'Accept'     => 'application/vnd.github.v3+json',
                'User-Agent' => 'Laravel-Portfolio',
            ])->get("https://api.github.com/users/{$username}/repos", [
                'sort'      => 'updated',
                'direction' => 'desc',
                'per_page'  => 12,
            ]);

            if ($res->failed()) return [];

            return collect($res->json())->filter(fn($r) => !$r['fork'])->map(fn($r) => [
                'id'          => $r['id'],
                'name'        => $r['name'],
                'description' => $r['description'],
                'url'         => $r['html_url'],
                'language'    => $r['language'],
                'stars'       => $r['stargazers_count'],
                'forks'       => $r['forks_count'],
            ])->values();
        });

        return response()->json($repos);
    }
}
