@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Projects</h5>
                <h2>{{ $totalProjects }}</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3">
                <h5>Total Skills</h5>
                <h2>{{ $totalSkills }}</h2>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('projects.create') }}" class="btn btn-primary"><i class="ph-bold ph-folder-plus"></i> Tambah
            Project</a>
        <a href="{{ route('profile.index') }}" class="btn btn-secondary"><i class="ph-bold ph-pencil-simple-line"></i> Edit Profile</a>
    </div>
@endsection
