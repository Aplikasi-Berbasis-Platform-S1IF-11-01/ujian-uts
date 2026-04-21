@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', '// Dashboard')
@section('breadcrumb', 'Home')

@section('content')
<div style="margin-bottom:2rem;">
    <h2 style="font-family:var(--ff-mono);font-size:.7rem;color:var(--muted);letter-spacing:.2em;text-transform:uppercase;margin-bottom:.3rem;">Welcome back,</h2>
    <p style="font-size:1.5rem;font-weight:600;color:var(--text);">{{ $profile->name ?? 'Admin' }}</p>
</div>

<!-- Stats -->
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.25rem;margin-bottom:2.5rem;">
    <div class="stat-card">
        <div>
            <div class="stat-card-num">{{ $stats['skills'] }}</div>
            <div class="stat-card-label">Total Skills</div>
        </div>
        <div class="stat-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
        </div>
    </div>
    <div class="stat-card">
        <div>
            <div class="stat-card-num">{{ $stats['projects'] }}</div>
            <div class="stat-card-label">Total Projects</div>
        </div>
        <div class="stat-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
        </div>
    </div>
    <div class="stat-card">
        <div>
            <div class="stat-card-num">{{ $stats['experiences'] }}</div>
            <div class="stat-card-label">Experiences</div>
        </div>
        <div class="stat-card-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card" style="margin-bottom:2rem;">
    <div class="card-title">// Quick Actions</div>
    <div style="display:flex;gap:1rem;flex-wrap:wrap;">
        <a href="{{ route('admin.profile.edit') }}" class="btn btn-accent">Edit Profil</a>
        <a href="{{ route('admin.skills.index') }}" class="btn btn-ghost">Manage Skills</a>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-ghost">Manage Projects</a>
        <a href="{{ route('admin.experiences.index') }}" class="btn btn-ghost">Manage Experiences</a>
    </div>
</div>

<!-- API Status -->
<div class="card">
    <div class="card-title">// API Endpoints</div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Endpoint</th>
                <th>Method</th>
                <th>Deskripsi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="font-family:var(--ff-mono);font-size:.8rem;">/api/v1/profile</td>
                <td><span class="badge badge-green">GET</span></td>
                <td>Data profil & info diri</td>
                <td><span class="badge badge-green">Active</span></td>
            </tr>
            <tr>
                <td style="font-family:var(--ff-mono);font-size:.8rem;">/api/v1/skills</td>
                <td><span class="badge badge-green">GET</span></td>
                <td>Daftar skill per kategori</td>
                <td><span class="badge badge-green">Active</span></td>
            </tr>
            <tr>
                <td style="font-family:var(--ff-mono);font-size:.8rem;">/api/v1/projects</td>
                <td><span class="badge badge-green">GET</span></td>
                <td>Daftar project portofolio</td>
                <td><span class="badge badge-green">Active</span></td>
            </tr>
            <tr>
                <td style="font-family:var(--ff-mono);font-size:.8rem;">/api/v1/experiences</td>
                <td><span class="badge badge-green">GET</span></td>
                <td>Riwayat pengalaman kerja & pendidikan</td>
                <td><span class="badge badge-green">Active</span></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
