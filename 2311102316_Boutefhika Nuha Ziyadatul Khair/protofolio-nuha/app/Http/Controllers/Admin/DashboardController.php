<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    // ─── Dashboard ────────────────────────────────────────────
    public function index()
    {
        return view('admin.dashboard', [
            'profile'          => Profile::first(),
            'skillsCount'      => Skill::count(),
            'educationCount'   => Education::count(),
            'experienceCount'  => Experience::count(),
            'projectsCount'    => Project::count(),
        ]);
    }

    // ─── Profile ──────────────────────────────────────────────
    public function profile()
    {
        return view('admin.profile', ['profile' => Profile::first()]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'nim'       => 'nullable|string|max:20',
            'title'     => 'nullable|string|max:255',
            'about'     => 'nullable|string',
            'email'     => 'nullable|email',
            'phone'     => 'nullable|string|max:20',
            'location'  => 'nullable|string|max:255',
            'github'    => 'nullable|string|max:100',
            'instagram' => 'nullable|string|max:100',
            'linkedin'  => 'nullable|string|max:255',
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $profile = Profile::firstOrCreate([]);
        $data = $request->only(['full_name', 'nim', 'title', 'about', 'email', 'phone', 'location', 'github', 'instagram', 'linkedin']);

        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }
            $path = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $path;
        }

        $profile->update($data);

        return redirect()->route('admin.profile')->with('success', 'Profil berhasil diperbarui! ✨');
    }

    // ─── Skills ───────────────────────────────────────────────
    public function skills()
    {
        return view('admin.skills', ['skills' => Skill::orderBy('sort_order')->get()]);
    }

    public function storeSkill(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100', 'icon' => 'nullable|string|max:10', 'category' => 'nullable|string|max:50']);
        Skill::create([
            'name'       => $request->name,
            'icon'       => $request->icon ?? '💡',
            'category'   => $request->category ?? 'technical',
            'sort_order' => Skill::max('sort_order') + 1,
            'is_active'  => true,
        ]);
        return redirect()->route('admin.skills')->with('success', 'Skill berhasil ditambahkan!');
    }

    public function updateSkill(Request $request, Skill $skill)
    {
        $request->validate(['name' => 'required|string|max:100']);
        $skill->update($request->only(['name', 'icon', 'category', 'sort_order', 'is_active']));
        return redirect()->route('admin.skills')->with('success', 'Skill berhasil diperbarui!');
    }

    public function destroySkill(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skills')->with('success', 'Skill berhasil dihapus.');
    }

    // ─── Education ────────────────────────────────────────────
    public function education()
    {
        return view('admin.education', ['educations' => Education::orderBy('sort_order')->get()]);
    }

    public function storeEducation(Request $request)
    {
        $request->validate([
            'institution' => 'required|string|max:255',
            'major'       => 'nullable|string|max:255',
            'year_start'  => 'required|string|max:10',
        ]);
        Education::create([
            'institution' => $request->institution,
            'major'       => $request->major,
            'degree'      => $request->degree,
            'year_start'  => $request->year_start,
            'year_end'    => $request->year_end,
            'description' => $request->description,
            'sort_order'  => Education::max('sort_order') + 1,
            'is_active'   => true,
        ]);
        return redirect()->route('admin.education')->with('success', 'Data pendidikan ditambahkan!');
    }

    public function updateEducation(Request $request, Education $education)
    {
        $request->validate(['institution' => 'required|string|max:255']);
        $education->update($request->only(['institution', 'major', 'degree', 'year_start', 'year_end', 'description', 'sort_order', 'is_active']));
        return redirect()->route('admin.education')->with('success', 'Data pendidikan diperbarui!');
    }

    public function destroyEducation(Education $education)
    {
        $education->delete();
        return redirect()->route('admin.education')->with('success', 'Data pendidikan dihapus.');
    }

    // ─── Experience ───────────────────────────────────────────
    public function experience()
    {
        return view('admin.experience', ['experiences' => Experience::orderBy('sort_order')->get()]);
    }

    public function storeExperience(Request $request)
    {
        $request->validate([
            'company'  => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'year'     => 'required|string|max:10',
        ]);

        // Parse responsibilities from textarea (one per line)
        $responsibilities = array_filter(
            array_map('trim', explode("\n", $request->responsibilities ?? ''))
        );

        Experience::create([
            'company'          => $request->company,
            'position'         => $request->position,
            'location'         => $request->location,
            'year'             => $request->year,
            'duration'         => $request->duration,
            'responsibilities' => array_values($responsibilities),
            'sort_order'       => Experience::max('sort_order') + 1,
            'is_active'        => true,
        ]);
        return redirect()->route('admin.experience')->with('success', 'Pengalaman berhasil ditambahkan!');
    }

    public function updateExperience(Request $request, Experience $experience)
    {
        $request->validate(['company' => 'required|string|max:255']);

        $responsibilities = array_filter(
            array_map('trim', explode("\n", $request->responsibilities ?? ''))
        );

        $experience->update([
            'company'          => $request->company,
            'position'         => $request->position,
            'location'         => $request->location,
            'year'             => $request->year,
            'duration'         => $request->duration,
            'responsibilities' => array_values($responsibilities),
            'sort_order'       => $request->sort_order,
            'is_active'        => $request->boolean('is_active'),
        ]);
        return redirect()->route('admin.experience')->with('success', 'Pengalaman berhasil diperbarui!');
    }

    public function destroyExperience(Experience $experience)
    {
        $experience->delete();
        return redirect()->route('admin.experience')->with('success', 'Pengalaman dihapus.');
    }

    // ─── Projects ─────────────────────────────────────────────
    public function projects()
    {
        return view('admin.projects', ['projects' => Project::orderBy('sort_order')->get()]);
    }

    public function storeProject(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'tech_stack', 'url']);
        $data['sort_order'] = Project::max('sort_order') + 1;
        $data['is_active']  = true;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($data);
        return redirect()->route('admin.projects')->with('success', 'Project berhasil ditambahkan!');
    }

    public function updateProject(Request $request, Project $project)
    {
        $request->validate(['title' => 'required|string|max:255']);

        $data = $request->only(['title', 'description', 'tech_stack', 'url', 'sort_order']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            if ($project->image) Storage::disk('public')->delete($project->image);
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);
        return redirect()->route('admin.projects')->with('success', 'Project berhasil diperbarui!');
    }

    public function destroyProject(Project $project)
    {
        if ($project->image) Storage::disk('public')->delete($project->image);
        $project->delete();
        return redirect()->route('admin.projects')->with('success', 'Project dihapus.');
    }

    // ─── Settings ─────────────────────────────────────────────
    public function settings()
    {
        return view('admin.settings', [
            'github_token'  => SiteSetting::get('github_token', ''),
            'quote_api_key' => SiteSetting::get('quote_api_key', ''),
            'show_github'   => SiteSetting::get('show_github', '1'),
            'show_quote'    => SiteSetting::get('show_quote', '1'),
            'admin_username' => SiteSetting::get('admin_username', 'admin'),
        ]);
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'github_token'   => 'nullable|string',
            'quote_api_key'  => 'nullable|string',
            'admin_username' => 'required|string|min:3',
        ]);

        SiteSetting::set('github_token', $request->github_token);
        SiteSetting::set('quote_api_key', $request->quote_api_key);
        SiteSetting::set('show_github', $request->has('show_github') ? '1' : '0');
        SiteSetting::set('show_quote', $request->has('show_quote') ? '1' : '0');
        SiteSetting::set('admin_username', $request->admin_username);

        // Update password only if provided
        if ($request->filled('new_password')) {
            $request->validate([
                'new_password'              => 'min:6',
                'new_password_confirmation' => 'same:new_password',
            ]);
            SiteSetting::set('admin_password', Hash::make($request->new_password));
        }

        return redirect()->route('admin.settings')->with('success', 'Pengaturan berhasil disimpan!');
    }
}
