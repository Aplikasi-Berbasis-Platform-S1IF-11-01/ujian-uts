@extends('dashboard.layout')

@section('title', 'Contacts')

@section('content')

    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('contacts.store') }}" method="POST">
                @csrf

                <div class="row g-2">
                    <div class="col-md-4">
                        <select name="type" class="form-control @error('type') is-invalid @enderror" required>
                            <option value="email">Email</option>
                            <option value="github">GitHub</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="instagram">Instagram</option>
                        </select>

                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <input type="text" name="value" class="form-control @error('value') is-invalid @enderror"
                            placeholder="Isi kontak (email/link)" value="{{ old('value') }}" required>

                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <input type="text" name="icon" value="{{ old('icon') }}"
                            class="form-control @error('icon') is-invalid @enderror" placeholder="ph-icon"
                            aria-label="Icon">

                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">
                            <i class="ph-bold ph-plus-square"></i> Tambah
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table id="contactsTable" class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Value</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ ucfirst($contact->type) }}</td>
                    <td>
                        <a href="{{ $contact->value }}" target="_blank">
                            {{ $contact->value }}
                        </a>
                    </td>

                    <td class="text-center align-middle">
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-sm btn-warning">
                                <i class="ph-pencil-simple-line"></i> Edit</a>

                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus kontak ini?')">
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
            $('#contactsTable').DataTable();
        });
    </script>
@endsection
