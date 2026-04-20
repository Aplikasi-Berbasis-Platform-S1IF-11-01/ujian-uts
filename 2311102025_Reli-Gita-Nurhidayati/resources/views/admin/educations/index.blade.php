@extends('admin.layout')
@section('title', 'Kelola Education')
@section('content')
<div class="card p-4 mb-4">
    <h6 class="fw-bold mb-3">➕ Tambah Pendidikan</h6>
    <form method="POST" action="{{ route('admin.educations.store') }}">
        @csrf
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="school" class="form-control" placeholder="Jenjang (S1 Informatika)" required>
            </div>
            <div class="col-md-4">
                <input type="text" name="institution" class="form-control" placeholder="Nama Institusi" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="year_start" class="form-control" placeholder="Tahun Mulai" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="year_end" class="form-control" placeholder="Tahun Selesai (kosong=sekarang)">
            </div>
            <div class="col-md-10">
                <textarea name="description" class="form-control" placeholder="Deskripsi..." rows="2" required></textarea>
            </div>
            <div class="col-md-2">
                <input type="number" name="order" class="form-control" placeholder="Urutan" value="1">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
        </div>
    </form>
</div>

<div class="card p-4">
    <h6 class="fw-bold mb-3">📋 Daftar Pendidikan</h6>
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Jenjang</th>
                <th>Institusi</th>
                <th>Tahun</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($educations as $edu)
            <tr id="row-edu-{{ $edu->id }}">
                <td><strong>{{ $edu->school }}</strong></td>
                <td>{{ $edu->institution }}</td>
                <td>{{ $edu->year_start }} - {{ $edu->year_end ?? 'Sekarang' }}</td>
                <td>{{ Str::limit($edu->description, 50) }}</td>
                <td>
                    <button class="btn btn-sm btn-danger" onclick="deleteEdu({{ $edu->id }})">
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
function deleteEdu(id) {
    if(!confirm('Hapus data pendidikan ini?')) return;
    fetch(`/admin/educations/${id}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ _method: 'DELETE' })
    }).then(r => r.json()).then(data => {
        if(data.success) document.getElementById('row-edu-'+id).remove();
    });
}
</script>
@endsection