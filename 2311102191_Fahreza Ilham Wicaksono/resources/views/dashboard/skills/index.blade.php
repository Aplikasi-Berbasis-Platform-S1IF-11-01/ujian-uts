@extends('dashboard.layout')

@section('title', 'Skills')

@section('content')

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('skills.store') }}" method="POST" class="row g-2 align-items-center">
                @csrf

                <div class="col">
                    <input type="text" name="skill_name" value="{{ old('skill_name') }}"
                        class="form-control @error('skill_name') is-invalid @enderror" placeholder="Nama skill"
                        aria-label="Nama skill">
                    @error('skill_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col">
                    <select name="level" id="level" class="form-control @error('level') is-invalid @enderror"
                        placeholder="Level" aria-label="Level">
                        <option value="beginner">Beginner</option>
                        <option value="intermediate">Intermediate</option>
                        <option value="expert">Expert</option>
                    </select>

                    @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col">
                    <input type="text" name="icon" value="{{ old('icon') }}"
                        class="form-control @error('icon') is-invalid @enderror" placeholder="ph-icon" aria-label="Icon">

                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">
                        <i class="ph-bold ph-plus-square"></i> Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>

    <table id="skillsTable" class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Skill</th>
                <th>Level</th>
                <th class="text-center">Icon</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($skills as $skill)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $skill->skill_name }}</td>
                    <td>{{ ucwords($skill->level) }}</td>
                    <td class="text-center align-middle"><i class="ph-bold {{ $skill->icon }}"></i></td>

                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <a href="{{ route('skills.edit', $skill->id) }}" class="btn btn-sm btn-warning"><i
                                    class="ph-bold ph-pencil-simple-line"></i> Edit</a>

                            <form action="{{ route('skills.destroy', $skill->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                    <i class="ph-bold ph-trash-simple"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#skillsTable').DataTable();
        });
    </script>
@endsection
