<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    // API untuk landing page
    public function getPortfolioData()
    {
        $portfolio = Portfolio::first();
        $skills = \App\Models\Skill::where('is_active', true)
            ->orderBy('display_order')
            ->get()
            ->groupBy('category');
        
        return response()->json([
            'portfolio' => $portfolio,
            'skills' => $skills
        ]);
    }

    // API untuk admin dashboard
    public function getAdminData()
    {
        $portfolio = Portfolio::first();
        $skills = \App\Models\Skill::orderBy('category')
            ->orderBy('display_order')
            ->get();
        
        return response()->json([
            'portfolio' => $portfolio,
            'skills' => $skills
        ]);
    }

    public function updatePortfolio(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'about_me' => 'required|string',
        ]);

        $portfolio = Portfolio::first();
        
        $data = $request->except('profile_image');
        
        if ($request->hasFile('profile_image')) {
            if ($portfolio && $portfolio->profile_image) {
                Storage::delete('public/' . $portfolio->profile_image);
            }
            $path = $request->file('profile_image')->store('profiles', 'public');
            $data['profile_image'] = $path;
        }

        if ($portfolio) {
            $portfolio->update($data);
        } else {
            $portfolio = Portfolio::create($data);
        }

        return response()->json([
            'success' => true,
            'message' => 'Portfolio updated successfully',
            'data' => $portfolio
        ]);
    }
}