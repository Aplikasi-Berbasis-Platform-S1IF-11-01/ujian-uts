<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{

    public function portfolio(): JsonResponse
    {
        $profile    = Profile::first();
        $skills     = Skill::where('is_active', true)->orderBy('sort_order')->get();
        $educations = Education::where('is_active', true)->orderBy('sort_order')->get();
        $experiences = Experience::where('is_active', true)->orderBy('sort_order')->get();
        $projects   = Project::where('is_active', true)->orderBy('sort_order')->get();

        // Add photo URL if exists
        if ($profile && $profile->photo) {
            $profile->photo_url = asset('storage/' . $profile->photo);
        } elseif ($profile) {
            $profile->photo_url = null;
        }

        // Add image URL for projects
        $projects->transform(function ($project) {
            $project->image_url = $project->image ? asset('storage/' . $project->image) : null;
            return $project;
        });

        return response()->json([
            'success'     => true,
            'profile'     => $profile,
            'skills'      => $skills,
            'educations'  => $educations,
            'experiences' => $experiences,
            'projects'    => $projects,
            'settings'    => [
                'show_github' => SiteSetting::get('show_github', '1') === '1',
                'show_quote'  => SiteSetting::get('show_quote', '1') === '1',
                'github_user' => $profile ? $profile->github : 'nhaazk95',
            ],
        ]);
    }

    public function quote(): JsonResponse
    {
        $apiKey = SiteSetting::get('quote_api_key');
        if (!$apiKey) {
            return response()->json(['success' => false, 'message' => 'API key not set'], 500);
        }

        $ch = curl_init('https://api.api-ninjas.com/v2/quotes?categories=success,wisdom');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-Api-Key: ' . $apiKey]);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        if (!$data || !isset($data[0])) {
            return response()->json(['success' => false, 'message' => 'Failed to fetch quote'], 500);
        }

        return response()->json(['success' => true, 'quote' => $data[0]['quote'], 'author' => $data[0]['author']]);
    }

    public function github(): JsonResponse
    {
        $profile = Profile::first();
        $username = $profile ? $profile->github : null;

        if (!$username) {
            return response()->json(['success' => false, 'message' => 'GitHub username not set'], 400);
        }

        $token = SiteSetting::get('github_token');
        $headers = ['User-Agent: Portfolio-App'];
        if ($token) {
            $headers[] = 'Authorization: Bearer ' . $token;
        }

        $ch = curl_init("https://api.github.com/users/{$username}/repos?per_page=6&sort=updated");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        $repos = json_decode($response, true);

        if (!is_array($repos)) {
            return response()->json(['success' => false, 'message' => 'Failed to fetch repositories'], 500);
        }

        $simplified = array_map(fn($r) => [
            'name'        => $r['name'],
            'description' => $r['description'],
            'html_url'    => $r['html_url'],
            'language'    => $r['language'],
            'stargazers_count' => $r['stargazers_count'],
            'forks_count'      => $r['forks_count'],
        ], $repos);

        return response()->json(['success' => true, 'repos' => $simplified, 'username' => $username]);
    }
}
