<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'skills' => DB::table('skills')->count(),
            'education' => DB::table('education')->count(),
            'projects' => DB::table('projects')->count(),
            'contacts' => DB::table('contacts')->count(),
        ];
        $profile = DB::table('profiles')->first();
        return view('admin.dashboard', compact('stats', 'profile'));
    }

    // ==================== PROFILE ====================
    public function profile()
    {
        $profile = DB::table('profiles')->first();
        return view('admin.profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'title' => 'required|string|max:100',
            'nim' => 'nullable|string|max:20',
            'university' => 'nullable|string|max:200',
            'description' => 'nullable|string',
            'github_username' => 'nullable|string|max:100',
            'status_label' => 'nullable|string|max:100',
        ]);

        DB::table('profiles')->where('id', 1)->update([
            'name' => $request->name,
            'title' => $request->title,
            'nim' => $request->nim,
            'university' => $request->university,
            'description' => $request->description,
            'github_username' => $request->github_username,
            'status_label' => $request->status_label,
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Profil berhasil diperbarui']);
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $profile = DB::table('profiles')->where('id', 1)->first();

        // Delete old photo
        if ($profile && $profile->photo) {
            Storage::disk('public')->delete($profile->photo);
        }

        $path = $request->file('photo')->store('photos', 'public');

        DB::table('profiles')->where('id', 1)->update([
            'photo' => $path,
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diperbarui',
            'photo_url' => asset('storage/' . $path)
        ]);
    }

    // ==================== SKILLS ====================
    public function skills()
    {
        $skills = DB::table('skills')->orderBy('sort_order')->get();
        $skills = $skills->map(function ($s) {
            $s->items = json_decode($s->items);
            return $s;
        });
        return view('admin.skills', compact('skills'));
    }

    public function storeSkill(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:100',
            'icon_color' => 'required|string|max:20',
            'items' => 'required|string',
            'sort_order' => 'nullable|integer',
        ]);

        $items = array_filter(array_map('trim', explode(',', $request->items)));

        $id = DB::table('skills')->insertGetId([
            'category' => $request->category,
            'icon_color' => $request->icon_color,
            'items' => json_encode(array_values($items)),
            'sort_order' => $request->sort_order ?? 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $skill = DB::table('skills')->find($id);
        $skill->items = json_decode($skill->items);

        return response()->json(['success' => true, 'message' => 'Skill berhasil ditambahkan', 'data' => $skill]);
    }

    public function updateSkill(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string|max:100',
            'icon_color' => 'required|string|max:20',
            'items' => 'required|string',
        ]);

        $items = array_filter(array_map('trim', explode(',', $request->items)));

        DB::table('skills')->where('id', $id)->update([
            'category' => $request->category,
            'icon_color' => $request->icon_color,
            'items' => json_encode(array_values($items)),
            'sort_order' => $request->sort_order ?? 0,
            'updated_at' => now(),
        ]);

        $skill = DB::table('skills')->find($id);
        $skill->items = json_decode($skill->items);

        return response()->json(['success' => true, 'message' => 'Skill berhasil diperbarui', 'data' => $skill]);
    }

    public function destroySkill($id)
    {
        DB::table('skills')->delete($id);
        return response()->json(['success' => true, 'message' => 'Skill berhasil dihapus']);
    }

    // ==================== EDUCATION ====================
    public function education()
    {
        $education = DB::table('education')->orderBy('sort_order')->get();
        return view('admin.education', compact('education'));
    }

    public function storeEducation(Request $request)
    {
        $request->validate([
            'school' => 'required|string|max:200',
            'major' => 'required|string|max:200',
            'period' => 'required|string|max:50',
            'status' => 'required|in:active,done',
            'icon_bg' => 'nullable|string|max:20',
            'icon_color' => 'nullable|string|max:20',
        ]);

        $id = DB::table('education')->insertGetId([
            'school' => $request->school,
            'major' => $request->major,
            'period' => $request->period,
            'status' => $request->status,
            'icon_bg' => $request->icon_bg ?? '#f0f0ff',
            'icon_color' => $request->icon_color ?? '#1a1a2e',
            'sort_order' => $request->sort_order ?? 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Pendidikan berhasil ditambahkan', 'data' => DB::table('education')->find($id)]);
    }

    public function updateEducation(Request $request, $id)
    {
        $request->validate([
            'school' => 'required|string|max:200',
            'major' => 'required|string|max:200',
            'period' => 'required|string|max:50',
            'status' => 'required|in:active,done',
        ]);

        DB::table('education')->where('id', $id)->update([
            'school' => $request->school,
            'major' => $request->major,
            'period' => $request->period,
            'status' => $request->status,
            'icon_bg' => $request->icon_bg ?? '#f0f0ff',
            'icon_color' => $request->icon_color ?? '#1a1a2e',
            'sort_order' => $request->sort_order ?? 0,
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Pendidikan berhasil diperbarui', 'data' => DB::table('education')->find($id)]);
    }

    public function destroyEducation($id)
    {
        DB::table('education')->delete($id);
        return response()->json(['success' => true, 'message' => 'Pendidikan berhasil dihapus']);
    }

    // ==================== PROJECTS ====================
    public function projects()
    {
        $projects = DB::table('projects')->orderBy('sort_order')->get();
        return view('admin.projects', compact('projects'));
    }

    public function storeProject(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'tag' => 'required|string|max:100',
            'thumb_type' => 'nullable|string|max:20',
        ]);

        $id = DB::table('projects')->insertGetId([
            'title' => $request->title,
            'description' => $request->description,
            'tag' => $request->tag,
            'thumb_type' => $request->thumb_type ?? 'pt-o',
            'sort_order' => $request->sort_order ?? 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Project berhasil ditambahkan', 'data' => DB::table('projects')->find($id)]);
    }

    public function updateProject(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'tag' => 'required|string|max:100',
        ]);

        DB::table('projects')->where('id', $id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'tag' => $request->tag,
            'thumb_type' => $request->thumb_type ?? 'pt-o',
            'sort_order' => $request->sort_order ?? 0,
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Project berhasil diperbarui', 'data' => DB::table('projects')->find($id)]);
    }

    public function destroyProject($id)
    {
        DB::table('projects')->delete($id);
        return response()->json(['success' => true, 'message' => 'Project berhasil dihapus']);
    }

    // ==================== CONTACTS ====================
    public function contacts()
    {
        $contacts = DB::table('contacts')->orderBy('sort_order')->get();
        return view('admin.contacts', compact('contacts'));
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:50',
            'label' => 'required|string|max:100',
            'value' => 'required|string|max:200',
            'url' => 'required|string|max:500',
            'icon_bg' => 'nullable|string|max:20',
            'icon_color' => 'nullable|string|max:20',
        ]);

        $id = DB::table('contacts')->insertGetId([
            'type' => $request->type,
            'label' => $request->label,
            'value' => $request->value,
            'url' => $request->url,
            'icon_bg' => $request->icon_bg ?? '#fef2f2',
            'icon_color' => $request->icon_color ?? '#e8580a',
            'sort_order' => $request->sort_order ?? 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Kontak berhasil ditambahkan', 'data' => DB::table('contacts')->find($id)]);
    }

    public function updateContact(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|max:50',
            'label' => 'required|string|max:100',
            'value' => 'required|string|max:200',
            'url' => 'required|string|max:500',
        ]);

        DB::table('contacts')->where('id', $id)->update([
            'type' => $request->type,
            'label' => $request->label,
            'value' => $request->value,
            'url' => $request->url,
            'icon_bg' => $request->icon_bg ?? '#fef2f2',
            'icon_color' => $request->icon_color ?? '#e8580a',
            'sort_order' => $request->sort_order ?? 0,
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Kontak berhasil diperbarui', 'data' => DB::table('contacts')->find($id)]);
    }

    public function destroyContact($id)
    {
        DB::table('contacts')->delete($id);
        return response()->json(['success' => true, 'message' => 'Kontak berhasil dihapus']);
    }
}
