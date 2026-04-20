@extends('dashboard.layout')

@section('title', 'Skills')

@section('content')

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('contacts.update', $contact->id) }}" method="POST" class="row g-2 align-items-center">
                @csrf
                @method('PUT')

                <div class="col-md-4">
                    <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                        <option value="email" {{ old('type', $contact->type ?? '') == 'email' ? 'selected' : '' }}>Email
                        </option>
                        <option value="github" {{ old('type', $contact->type ?? '') == 'github' ? 'selected' : '' }}>GitHub
                        </option>
                        <option value="linkedin" {{ old('type', $contact->type ?? '') == 'linkedin' ? 'selected' : '' }}>
                            LinkedIn</option>
                        <option value="instagram" {{ old('type', $contact->type ?? '') == 'instagram' ? 'selected' : '' }}>
                            Instagram</option>
                    </select>

                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col">
                    <input type="text" name="value" class="form-control @error('value') is-invalid @enderror"
                        placeholder="Isi kontak (email/link)" value="{{ $contact->value ?? old('value') }}" required>

                    @error('value')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col">
                    <input type="text" name="icon" value="{{ $contact->icon ?? old('icon') }}"
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

            <a href="{{ route('contacts.index') }}" class="btn btn-secondary mt-3">
                <i class="ph-bold ph-arrow-fat-left"></i> kembali
            </a>
        </div>
    </div>
@endsection
