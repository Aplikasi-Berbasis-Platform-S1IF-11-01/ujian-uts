<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function edit()
    {
        $portfolio = \App\Models\Portfolio::first();
        return view('admin.portfolio.edit', compact('portfolio'));
    }

    public function update(\Illuminate\Http\Request $request)
    {
        $portfolio = \App\Models\Portfolio::first();
        $data = $request->except('photo_url');

        if ($request->hasFile('photo_url')) {
            // Delete old file if exists
            if ($portfolio->photo_url && file_exists(public_path($portfolio->photo_url))) {
                @unlink(public_path($portfolio->photo_url));
            }
            $path = $request->file('photo_url')->store('portfolio', 'public');
            $data['photo_url'] = '/storage/' . $path;
        }

        $portfolio->update($data);

        return redirect()->back()->with('success', 'Portfolio updated successfully!');
    }
}
