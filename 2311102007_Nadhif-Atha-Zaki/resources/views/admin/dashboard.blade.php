@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Dashboard Admin</h2>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-danger">Logout</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="card card-custom p-4 mb-4">
        <h4 class="mb-3">Edit Profile</h4>
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $profile->full_name ?? '') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-control" value="{{ old('nim', $profile->nim ?? '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Program Studi</label>
                    <input type="text" name="study_program" class="form-control" value="{{ old('study_program', $profile->study_program ?? '') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $profile->title ?? '') }}">
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Short Bio</label>
                    <textarea name="short_bio" class="form-control" rows="3">{{ old('short_bio', $profile->short_bio ?? '') }}</textarea>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">About Me</label>
                    <textarea name="about_me" class="form-control" rows="5">{{ old('about_me', $profile->about_me ?? '') }}</textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $profile->email ?? '') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Instagram</label>
                    <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $profile->instagram ?? '') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">GitHub</label>
                    <input type="text" name="github" class="form-control" value="{{ old('github', $profile->github ?? '') }}">
                </div>

                <div class="col-md-8 mb-3">
                    <label class="form-label">Foto Profile</label>
                    <input type="file" name="photo" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    @if(!empty($profile?->photo))
                        <label class="form-label d-block">Preview</label>
                        <img src="/{{ $profile->photo }}" alt="Profile" style="width:100px;height:100px;object-fit:cover;border-radius:12px;">
                    @endif
                </div>
            </div>

            <button class="btn btn-primary">Simpan Profile</button>
        </form>
    </div>

    <div class="card card-custom p-4 mb-4">
        <h4 class="mb-3">Kelola Skills</h4>

        <form action="{{ route('admin.skills.store') }}" method="POST" class="row g-2 mb-4">
            @csrf
            <div class="col-md-8">
                <input type="text" name="name" class="form-control" placeholder="Nama skill" required>
            </div>
            <div class="col-md-2">
                <input type="number" name="sort_order" class="form-control" placeholder="Urutan">
            </div>
            <div class="col-md-2">
                <button class="btn btn-success w-100">Tambah</button>
            </div>
        </form>

        @foreach($skills as $skill)
            <div class="border rounded p-3 mb-3">
                <form action="{{ route('admin.skills.update', $skill->id) }}" method="POST" class="row g-2 align-items-center">
                    @csrf
                    @method('PUT')
                    <div class="col-md-7">
                        <input type="text" name="name" class="form-control" value="{{ $skill->name }}" required>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="sort_order" class="form-control" value="{{ $skill->sort_order }}">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-warning w-100">Update</button>
                    </div>
                </form>

                <form action="{{ route('admin.skills.destroy', $skill->id) }}" method="POST" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        @endforeach
    </div>

    <div class="card card-custom p-4 mb-4">
        <h4 class="mb-3">Kelola Education</h4>

        <form action="{{ route('admin.educations.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-2">
                    <input type="text" name="institution" class="form-control" placeholder="Institusi" required>
                </div>
                <div class="col-md-3 mb-2">
                    <input type="text" name="period" class="form-control" placeholder="Periode" required>
                </div>
                <div class="col-md-3 mb-2">
                    <input type="number" name="sort_order" class="form-control" placeholder="Urutan">
                </div>
                <div class="col-md-12 mb-2">
                    <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi"></textarea>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-success">Tambah Education</button>
                </div>
            </div>
        </form>

        @foreach($educations as $education)
            <div class="border rounded p-3 mb-3">
                <form action="{{ route('admin.educations.update', $education->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <input type="text" name="institution" class="form-control" value="{{ $education->institution }}" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <input type="text" name="period" class="form-control" value="{{ $education->period }}" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <input type="number" name="sort_order" class="form-control" value="{{ $education->sort_order }}">
                        </div>
                        <div class="col-md-12 mb-2">
                            <textarea name="description" class="form-control" rows="3">{{ $education->description }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-warning">Update</button>
                        </div>
                    </div>
                </form>

                <form action="{{ route('admin.educations.destroy', $education->id) }}" method="POST" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        @endforeach
    </div>

    <div class="card card-custom p-4 mb-4">
        <h4 class="mb-3">Kelola Projects</h4>

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-2">
                    <input type="text" name="title" class="form-control" placeholder="Judul project" required>
                </div>
                <div class="col-md-4 mb-2">
                    <input type="text" name="project_link" class="form-control" placeholder="Link project">
                </div>
                <div class="col-md-2 mb-2">
                    <input type="number" name="sort_order" class="form-control" placeholder="Urutan">
                </div>
                <div class="col-md-12 mb-2">
                    <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi project"></textarea>
                </div>
                <div class="col-md-6 mb-2">
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="col-md-12">
                    <button class="btn btn-success">Tambah Project</button>
                </div>
            </div>
        </form>

        @foreach($projects as $project)
            <div class="border rounded p-3 mb-3">
                <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <input type="text" name="title" class="form-control" value="{{ $project->title }}" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <input type="text" name="project_link" class="form-control" value="{{ $project->project_link }}">
                        </div>
                        <div class="col-md-2 mb-2">
                            <input type="number" name="sort_order" class="form-control" value="{{ $project->sort_order }}">
                        </div>
                        <div class="col-md-12 mb-2">
                            <textarea name="description" class="form-control" rows="3">{{ $project->description }}</textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="col-md-6 mb-2">
                            @if($project->image)
                                <img src="/{{ $project->image }}" alt="{{ $project->title }}" style="width:150px;height:90px;object-fit:cover;border-radius:10px;">
                            @endif
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-warning">Update</button>
                        </div>
                    </div>
                </form>

                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="mt-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection