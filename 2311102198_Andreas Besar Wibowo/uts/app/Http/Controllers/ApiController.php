<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Portfolio;
use App\Models\Profile;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    public function profile(): JsonResponse
    {
        $profile = Profile::first();

        // Guard: jika tabel kosong, kembalikan object default agar frontend tidak crash
        if (!$profile) {
            return response()->json([
                'name' => '',
                'tagline' => '',
                'about' => '',
                'email' => '',
                'photo_url' => asset('images/default-avatar.svg'),
                'instagram' => null,
                'linkedin' => null,
                'github' => null,
            ]);
        }

        $data = $profile->toArray();
        $data['photo_url'] = $profile->photo
            ? asset('storage/' . $profile->photo)
            : asset('images/default-avatar.svg');

        return response()->json($data);
    }

    public function educations(): JsonResponse
    {
        return response()->json(Education::orderBy('order')->orderBy('id')->get());
    }

    public function skills(): JsonResponse
    {
        return response()->json(Skill::orderBy('order')->orderBy('id')->get());
    }

    public function portfolios(): JsonResponse
    {
        $portfolios = Portfolio::orderBy('order')->orderBy('id')->get()->map(function ($item) {
            $item->image_url = $item->image
                ? asset('storage/' . $item->image)
                : asset('images/default-project.svg');
            return $item;
        });
        return response()->json($portfolios);
    }
}