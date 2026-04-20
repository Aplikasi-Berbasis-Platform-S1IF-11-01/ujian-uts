@extends('dashboard.layout')

@section('title', isset($project) ? 'Edit Project' : 'Tambah Project')

@section('content')

    <form action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf

        @if (isset($project))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ $project->title ?? '' }}" required>

            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="5">{{ $project->description ?? '' }}</textarea>

            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Tech Stack</label>
            <input type="text" name="tech_stack" class="form-control" placeholder="Laravel, Vue, MySQL"
                value="{{ old('tech_stack', isset($project) && is_array($project->tech_stack) ? implode(', ', $project->tech_stack) : $project->tech_stack ?? '') }}">

            @error('tech_stack')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <a href="{{ route('projects.index') }}" class="btn btn-secondary">
            <i class="ph-bold ph-arrow-fat-left"></i> kembali
        </a>

        <button type="submit" class="btn btn-success"><i class="ph-bold ph-floppy-disk"></i> Save</button>
    </form>
@endsection
