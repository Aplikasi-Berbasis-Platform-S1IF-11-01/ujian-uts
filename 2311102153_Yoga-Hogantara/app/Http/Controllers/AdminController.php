<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $profile = Profile::first();
        $skills  = Skill::orderBy('kategori')->orderBy('level', 'desc')->get();
        return view('admin.dashboard', compact('profile', 'skills'));
    }

    // ── Profile ──────────────────────────────────────────────
    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'role'      => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'email'     => 'nullable|email',
            'github'    => 'nullable|url',
            'linkedin'  => 'nullable|url',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $profile = Profile::firstOrNew([]);
        $profile->fill($request->only(['nama', 'role', 'deskripsi', 'email', 'github', 'linkedin']));

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($profile->path_foto) {
                Storage::disk('public')->delete($profile->path_foto);
            }
            $profile->path_foto = $request->file('foto')->store('profile', 'public');
        }

        $profile->save();

        return redirect()->route('admin.dashboard')->with('success', 'Profil berhasil diperbarui!');
    }

    // ── Skills ────────────────────────────────────────────────
    public function storeSkill(Request $request)
    {
        $request->validate([
            'nama_skill' => 'required|string|max:100',
            'level'      => 'required|integer|min:1|max:100',
            'kategori'   => 'required|string|max:50',
        ]);

        Skill::create($request->only(['nama_skill', 'level', 'kategori']));

        return redirect()->route('admin.dashboard')->with('success', 'Skill berhasil ditambahkan!');
    }

    public function editSkill(Skill $skill)
    {
        $profile = Profile::first();
        $skills  = Skill::orderBy('kategori')->orderBy('level', 'desc')->get();
        return view('admin.dashboard', compact('profile', 'skills', 'skill'));
    }

    public function updateSkill(Request $request, Skill $skill)
    {
        $request->validate([
            'nama_skill' => 'required|string|max:100',
            'level'      => 'required|integer|min:1|max:100',
            'kategori'   => 'required|string|max:50',
        ]);

        $skill->update($request->only(['nama_skill', 'level', 'kategori']));

        return redirect()->route('admin.dashboard')->with('success', 'Skill berhasil diperbarui!');
    }

    public function destroySkill(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Skill berhasil dihapus!');
    }
}