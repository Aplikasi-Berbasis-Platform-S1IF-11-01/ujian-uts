@extends('admin.layout')
@section('title', 'Kelola Organisasi')
@section('content')
<div class="card p-4 mb-4">
    <h6 class="fw-bold mb-3">➕ Tambah Organisasi</h6>
    <form method="POST" action="{{ route('admin.organizations.store') }}">
        @csrf
        <div class="row g-2">
            <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Nama Organisasi" required>
            </div>
            <div class="col-md-6">
                <input type="text" name="role" class="form-control" placeholder="Jabatan/Role" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="year_start" class="form-control" placeholder="Tahun Mulai" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="year_end" class="form-control" placeholder="Tahun Selesai (kosong=sekarang)">
            </div>
            <div class="col-md-6">
                <textarea name="description" class="form-control" placeholder="Deskripsi..." rows="2" required></textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
        </div>
    </form>
</div>

<div class="card p-4">
    <h6 class="fw-bold mb-3">📋 Daftar Organisasi</h6>
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nama Organisasi</th>
                <th>Jabatan</th>
                <th>Periode</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($organizations as $org)
            <tr id="row-org-{{ $org->id }}">
                <td><strong>{{ $org->name }}</strong></td>
                <td>{{ $org->role }}</td>
                <td>{{ $org->year_start }} - {{ $org->year_end ?? 'Sekarang' }}</td>
                <td>{{ Str::limit($org->description, 50) }}</td>
                <td>
                    <button class="btn btn-sm btn-danger" onclick="deleteOrg({{ $org->id }})">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
function deleteOrg(id) {
    if(!confirm('Hapus organisasi ini?')) return;
    fetch(`/admin/organizations/${id}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ _method: 'DELETE' })
    }).then(r => r.json()).then(data => {
        if(data.success) document.getElementById('row-org-'+id).remove();
    });
}
</script>
@endsection