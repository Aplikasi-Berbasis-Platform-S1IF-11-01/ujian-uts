<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Experience;
use Illuminate\Http\JsonResponse;

class PortfolioApiController extends Controller
{
    public function profile(): JsonResponse
    {
        $profile = Profile::first();

        if (!$profile) {
            return response()->json(['error' => 'Profile not found'], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => [
                'name'             => $profile->name,
                'nim'              => $profile->nim,
                'jurusan'          => $profile->jurusan,
                'title'            => $profile->title,
                'tagline'          => $profile->tagline,
                'bio'              => $profile->bio,
                'about'            => $profile->about,
                'email'            => $profile->email,
                'phone'            => $profile->phone,
                'location'         => $profile->location,
                'github'           => $profile->github,
                'linkedin'         => $profile->linkedin,
                'instagram'        => $profile->instagram,
                'website'          => $profile->website,
                'photo'            => $profile->photo
                    ? asset('storage/' . $profile->photo)
                    : asset('images/profile-default.png'),
                'years_experience' => $profile->years_experience,
                'projects_done'    => $profile->projects_done,
                'clients'          => $profile->clients,
            ],
        ]);
    }

    public function skills(): JsonResponse
    {
        $skills = Skill::ordered()->get()->groupBy('category');

        $formatted = [];
        foreach ($skills as $category => $items) {
            $formatted[] = [
                'category' => $category,
                'skills'   => $items->map(fn($s) => [
                    'id'          => $s->id,
                    'name'        => $s->name,
                    'level'       => $s->level,
                    'icon'        => $s->icon,
                    'color'       => $s->color,
                    'is_featured' => $s->is_featured,
                ]),
            ];
        }

        return response()->json([
            'success' => true,
            'data'    => $formatted,
        ]);
    }

    public function projects(): JsonResponse
    {
        $projects = Project::orderBy('order')->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data'    => $projects->map(fn($p) => [
                'id'          => $p->id,
                'title'       => $p->title,
                'description' => $p->description,
                'tech_stack'  => $p->tech_stack ?? [],
                'demo_url'    => $p->demo_url,
                'github_url'  => $p->github_url,
                'thumbnail'   => $p->thumbnail
                    ? asset('storage/' . $p->thumbnail)
                    : null,
                'status'      => $p->status,
                'year'        => $p->year ? date('Y', strtotime($p->year)) : null,
                'is_featured' => $p->is_featured,
            ]),
        ]);
    }

    public function experiences(): JsonResponse
    {
        $experiences = Experience::orderBy('order')->orderBy('start_date', 'desc')->get();

        return response()->json([
            'success' => true,
            'data'    => $experiences->map(fn($e) => [
                'id'          => $e->id,
                'company'     => $e->company,
                'position'    => $e->position,
                'description' => $e->description,
                'type'        => $e->type,
                'start_date'  => $e->start_date?->format('M Y'),
                'end_date'    => $e->is_current ? 'Present' : $e->end_date?->format('M Y'),
                'is_current'  => $e->is_current,
                'location'    => $e->location,
                'period'      => $e->period,
            ]),
        ]);
    }
}
