@extends('dashboard.layout')

@section('title', 'Projects')

@section('content')
    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">
        <i class="ph-bold ph-folder-plus"></i> Tambah Project
    </a>

    <div class="row">
        @forelse ($projects as $project)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>{{ $project->title }}</h5>
                        <p>{{ Str::limit($project->description, 100) }}</p>

                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning"><i class="ph-bold ph-pencil-simple-line"></i> Edit</a>

                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                <i class="ph-bold ph-trash-simple"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-4">
                <p class="text-muted">Tidak ada data</p>
            </div>
        @endforelse
    </div>
@endsection
