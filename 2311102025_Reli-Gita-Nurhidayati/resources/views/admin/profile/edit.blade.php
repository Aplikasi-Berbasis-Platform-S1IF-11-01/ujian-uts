@extends('admin.layout')
@section('title', 'Edit Profile')
@section('content')
<div class="card p-4">
    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $profile->name }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">NIM</label>
                <input type="text" name="nim" class="form-control" value="{{ $profile->nim }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Tagline</label>
                <input type="text" name="tagline" class="form-control" value="{{ $profile->tagline }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Semester</label>
                <input type="text" name="semester" class="form-control" value="{{ $profile->semester }}" required>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">About</label>
                <textarea name="about" class="form-control" rows="3" required>{{ $profile->about }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Universitas</label>
                <input type="text" name="university" class="form-control" value="{{ $profile->university }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Program Studi</label>
                <input type="text" name="major" class="form-control" value="{{ $profile->major }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Lokasi</label>
                <input type="text" name="location" class="form-control" value="{{ $profile->location }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Fokus</label>
                <input type="text" name="focus" class="form-control" value="{{ $profile->focus }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $profile->email }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">LinkedIn</label>
                <input type="text" name="linkedin" class="form-control" value="{{ $profile->linkedin }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">GitHub</label>
                <input type="text" name="github" class="form-control" value="{{ $profile->github }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Instagram</label>
                <input type="text" name="instagram" class="form-control" value="{{ $profile->instagram }}">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">Foto Profile</label>
                @if($profile->photo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$profile->photo) }}" width="100" class="rounded">
                    </div>
                @endif
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>
@endsection