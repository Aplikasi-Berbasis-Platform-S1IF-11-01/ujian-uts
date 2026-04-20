@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card text-center p-3">
            <div style="font-size:2rem">⚡</div>
            <h3 class="fw-bold text-success">{{ $totalSkills }}</h3>
            <p class="text-muted mb-0">Total Skills</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3">
            <div style="font-size:2rem">📁</div>
            <h3 class="fw-bold text-primary">{{ $totalProjects }}</h3>
            <p class="text-muted mb-0">Total Projects</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3">
            <div style="font-size:2rem">🎓</div>
            <h3 class="fw-bold text-warning">{{ $totalEducations }}</h3>
            <p class="text-muted mb-0">Total Pendidikan</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3">
            <div style="font-size:2rem">🏛️</div>
            <h3 class="fw-bold text-danger">{{ $totalOrganizations }}</h3>
            <p class="text-muted mb-0">Total Organisasi</p>
        </div>
    </div>
</div>
<div class="card p-4">
    <h6 class="fw-bold mb-3">👤 Info Profile Aktif</h6>
    <table class="table table-borderless">
        <tr><td width="150"><strong>Nama</strong></td><td>{{ $profile->name }}</td></tr>
        <tr><td><strong>NIM</strong></td><td>{{ $profile->nim }}</td></tr>
        <tr><td><strong>Email</strong></td><td>{{ $profile->email }}</td></tr>
        <tr><td><strong>Fokus</strong></td><td>{{ $profile->focus }}</td></tr>
        <tr><td><strong>Lokasi</strong></td><td>{{ $profile->location }}</td></tr>
    </table>
</div>
@endsection