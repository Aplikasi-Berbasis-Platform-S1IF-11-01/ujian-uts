<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Portfolio;
use App\Models\Profile;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    // ═══════════════════════════════════════════════
    //  PROFILE
    // ═══════════════════════════════════════════════

    public function profileEdit()
    {
        $profile = Profile::first();
        if (!$profile) {
            // Kembalikan object kosong agar form tetap bisa dirender
            return response()->json([
                'id' => null,
                'name' => '',
                'tagline' => '',
                'about' => '',
                'email' => '',
                'photo' => null,
                'photo_url' => asset('images/default-avatar.svg'),
                'instagram' => '',
                'linkedin' => '',
                'github' => '',
            ]);
        }
        $data = $profile->toArray();
        $data['photo_url'] = $profile->photo
            ? asset('storage/' . $profile->photo)
            : asset('images/default-avatar.svg');
        return response()->json($data);
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'about' => 'required|string',
            'email' => 'required|email|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // firstOrNew tanpa kondisi = ambil record pertama atau buat baru
        $profile = Profile::first() ?? new Profile();
        $profile->fill($request->only('name', 'tagline', 'about', 'email', 'instagram', 'linkedin', 'github'));

        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }
            $profile->photo = $request->file('photo')->store('photos', 'public');
        }

        $profile->save();
        return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui!']);
    }

    // ═══════════════════════════════════════════════
    //  EDUCATION
    // ═══════════════════════════════════════════════

    public function educationIndex()
    {
        return response()->json(Education::orderBy('order')->orderBy('id')->get());
    }

    public function educationStore(Request $request)
    {
        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'period' => 'required|string|max:100',
            'order' => 'nullable|integer|min:0',
        ]);

        $education = Education::create([
            'institution' => $validated['institution'],
            'major' => $validated['major'],
            'period' => $validated['period'],
            'order' => $validated['order'] ?? 0,
        ]);

        return response()->json([
            'success' => true,
            'data' => $education,
            'message' => 'Pendidikan berhasil ditambahkan!',
        ]);
    }

    public function educationUpdate(Request $request, $id)
    {
        // Cari manual agar error lebih jelas jika tidak ketemu
        $education = Education::findOrFail($id);

        $validated = $request->validate([
            'institution' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'period' => 'required|string|max:100',
            'order' => 'nullable|integer|min:0',
        ]);

        $education->update([
            'institution' => $validated['institution'],
            'major' => $validated['major'],
            'period' => $validated['period'],
            'order' => $validated['order'] ?? $education->order,
        ]);

        return response()->json([
            'success' => true,
            'data' => $education->fresh(),
            'message' => 'Pendidikan berhasil diperbarui!',
        ]);
    }

    public function educationDestroy($id)
    {
        $education = Education::findOrFail($id);
        $education->delete();
        return response()->json(['success' => true, 'message' => 'Pendidikan berhasil dihapus!']);
    }

    // ═══════════════════════════════════════════════
    //  SKILLS
    // ═══════════════════════════════════════════════

    public function skillIndex()
    {
        return response()->json(Skill::orderBy('order')->orderBy('id')->get());
    }

    public function skillStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'color' => 'required|string|max:30',
            'order' => 'nullable|integer|min:0',
        ]);

        $skill = Skill::create([
            'name' => $validated['name'],
            'color' => $validated['color'],
            'order' => $validated['order'] ?? 0,
        ]);

        return response()->json([
            'success' => true,
            'data' => $skill,
            'message' => 'Skill berhasil ditambahkan!',
        ]);
    }

    public function skillUpdate(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'color' => 'required|string|max:30',
            'order' => 'nullable|integer|min:0',
        ]);

        $skill->update([
            'name' => $validated['name'],
            'color' => $validated['color'],
            'order' => $validated['order'] ?? $skill->order,
        ]);

        return response()->json([
            'success' => true,
            'data' => $skill->fresh(),
            'message' => 'Skill berhasil diperbarui!',
        ]);
    }

    public function skillDestroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return response()->json(['success' => true, 'message' => 'Skill berhasil dihapus!']);
    }

    // ═══════════════════════════════════════════════
    //  PORTFOLIO
    // ═══════════════════════════════════════════════

    public function portfolioIndex()
    {
        return response()->json(Portfolio::orderBy('order')->orderBy('id')->get());
    }

    public function portfolioStore(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'order' => $validated['order'] ?? 0,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('portfolios', 'public');
        }

        $portfolio = Portfolio::create($data);
        return response()->json([
            'success' => true,
            'data' => $portfolio,
            'message' => 'Portfolio berhasil ditambahkan!',
        ]);
    }

    public function portfolioUpdate(Request $request, $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'order' => $validated['order'] ?? $portfolio->order,
        ];

        if ($request->hasFile('image')) {
            if ($portfolio->image) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $data['image'] = $request->file('image')->store('portfolios', 'public');
        }

        $portfolio->update($data);
        return response()->json([
            'success' => true,
            'data' => $portfolio->fresh(),
            'message' => 'Portfolio berhasil diperbarui!',
        ]);
    }

    public function portfolioDestroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        if ($portfolio->image) {
            Storage::disk('public')->delete($portfolio->image);
        }
        $portfolio->delete();
        return response()->json(['success' => true, 'message' => 'Portfolio berhasil dihapus!']);
    }
}