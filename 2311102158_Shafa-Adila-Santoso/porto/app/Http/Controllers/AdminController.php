<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProfile;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // ── AUTH ─────────────────────────────────────────
    public function showLogin()
    {
        if (Session::has('admin')) return redirect()->route('admin.dashboard');
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('admin', ['id' => $user->id, 'name' => $user->name]);
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout()
    {
        Session::forget('admin');
        return redirect()->route('admin.login');
    }

    // ── DASHBOARD ─────────────────────────────────────
    public function dashboard()
    {
        $profile = PortfolioProfile::first();
        $skills  = Skill::orderBy('kategori')->get();
        return view('admin.dashboard', compact('profile', 'skills'));
    }

    // ── PROFILE ───────────────────────────────────────
    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:100',
            'tagline'   => 'required|string|max:150',
            'deskripsi' => 'required|string|max:1000',
            'email'     => 'required|email',
            'github'    => 'nullable|url',
            'instagram' => 'nullable|url',
        ]);

        $profile = PortfolioProfile::first();

        $data = $request->only(['nama', 'tagline', 'deskripsi', 'email', 'github', 'instagram']);

        // Handle foto (base64 upload)
        if ($request->filled('foto_base64')) {
            $data['foto'] = $request->foto_base64;
        }

        $profile->update($data);

        return response()->json(['message' => 'Profil berhasil diperbarui!']);
    }

    // ── SKILLS ────────────────────────────────────────
    public function storeSkill(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:50',
            'level'    => 'required|integer|min:1|max:100',
            'kategori' => 'required|string|max:50',
        ]);

        $skill = Skill::create($request->only(['nama', 'level', 'kategori']));
        return response()->json(['message' => 'Skill ditambahkan!', 'skill' => $skill]);
    }

    public function updateSkill(Request $request, Skill $skill)
    {
        $request->validate([
            'nama'     => 'required|string|max:50',
            'level'    => 'required|integer|min:1|max:100',
            'kategori' => 'required|string|max:50',
        ]);

        $skill->update($request->only(['nama', 'level', 'kategori']));
        return response()->json(['message' => 'Skill diperbarui!', 'skill' => $skill]);
    }

    public function destroySkill(Skill $skill)
    {
        $skill->delete();
        return response()->json(['message' => 'Skill dihapus!']);
    }
}
