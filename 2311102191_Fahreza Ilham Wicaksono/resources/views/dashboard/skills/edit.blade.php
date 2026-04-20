@extends('dashboard.layout')

@section('title', 'Skills')

@section('content')

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('skills.update', $skill->id) }}" method="POST" class="row g-2 align-items-center">
                @csrf
                @method('PUT')

                <div class="col">
                    <input type="text" name="skill_name" value="{{ $skill->skill_name ?? old('skill_name') }}"
                        class="form-control @error('skill_name') is-invalid @enderror" placeholder="Nama skill"
                        aria-label="Nama skill">

                    @error('skill_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col">
                    <select name="level" id="level" class="form-control @error('level') is-invalid @enderror"
                        placeholder="Level" aria-label="Level">
                        <option value="beginner" {{ old('level', $skill->level ?? '') == 'beginner' ? 'selected' : '' }}>
                            Beginner</option>
                        <option value="intermediate"
                            {{ old('level', $skill->level ?? '') == 'intermediate' ? 'selected' : '' }}>Intermediate
                        </option>
                        <option value="expert" {{ old('level', $skill->level ?? '') == 'expert' ? 'selected' : '' }}>
                            Expert</option>
                    </select>

                    @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col">
                    <input type="text" name="icon" value="{{ $skill->icon ?? old('icon') }}"
                        class="form-control @error('icon') is-invalid @enderror" placeholder="ph-icon" aria-label="Icon">

                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">
                        <i class="ph-bold ph-floppy-disk"></i> Save
                    </button>
                </div>
            </form>

            <a href="{{ route('skills.index') }}" class="btn btn-secondary mt-3">
                <i class="ph-bold ph-arrow-fat-left"></i> kembali
            </a>
        </div>
    </div>
@endsection
