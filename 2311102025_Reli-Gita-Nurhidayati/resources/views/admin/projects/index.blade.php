@extends('admin.layout')
@section('title', 'Kelola Projects')
@section('content')
<div class="card p-4 mb-4">
    <h6 class="fw-bold mb-3">➕ Tambah Project Baru</h6>
    <form method="POST" action="{{ route('admin.projects.store') }}">
        @csrf
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="title" class="form-control" placeholder="Judul Project" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="category" class="form-control" placeholder="Kategori (Web App, dll)" required>
            </div>
            <div class="col-md-2">
                <select name="color" class="form-select" required>
                    <option value="green">Hijau</option>
                    <option value="orange">Oranye</option>
                    <option value="blue">Biru</option>
                    <option value="purple">Ungu</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="text" name="icon" class="form-control" placeholder="Icon (bi-alarm)" required>
            </div>
            <div class="col-12">
                <textarea name="description" class="form-control" placeholder="Deskripsi project..." rows="2" required></textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success">Tambah Project</button>
            </div>
        </div>
    </form>
</div>

<div class="card p-4">
    <h6 class="fw-bold mb-3">📋 Daftar Projects</h6>
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr id="row-project-{{ $project->id }}">
                <td><strong>{{ $project->title }}</strong></td>
                <td><span class="badge bg-primary">{{ $project->category }}</span></td>
                <td>{{ Str::limit($project->description, 60) }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="editProject({{ $project->id }}, '{{ addslashes($project->title) }}', '{{ $project->category }}', '{{ addslashes($project->description) }}', '{{ $project->color }}', '{{ $project->icon }}')">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="deleteProject({{ $project->id }})">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editId">
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" id="editTitle" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" id="editCategory" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea id="editDescription" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Warna</label>
                    <select id="editColor" class="form-select">
                        <option value="green">Hijau</option>
                        <option value="orange">Oranye</option>
                        <option value="blue">Biru</option>
                        <option value="purple">Ungu</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Icon</label>
                    <input type="text" id="editIcon" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-success" onclick="updateProject()">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function editProject(id, title, category, description, color, icon) {
    document.getElementById('editId').value = id;
    document.getElementById('editTitle').value = title;
    document.getElementById('editCategory').value = category;
    document.getElementById('editDescription').value = description;
    document.getElementById('editColor').value = color;
    document.getElementById('editIcon').value = icon;
    new bootstrap.Modal(document.getElementById('editModal')).show();
}

function updateProject() {
    const id = document.getElementById('editId').value;
    fetch(`/admin/projects/${id}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({
            _method: 'PUT',
            title: document.getElementById('editTitle').value,
            category: document.getElementById('editCategory').value,
            description: document.getElementById('editDescription').value,
            color: document.getElementById('editColor').value,
            icon: document.getElementById('editIcon').value,
        })
    }).then(r => r.json()).then(data => {
        if(data.success) location.reload();
    });
}

function deleteProject(id) {
    if(!confirm('Hapus project ini?')) return;
    fetch(`/admin/projects/${id}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ _method: 'DELETE' })
    }).then(r => r.json()).then(data => {
        if(data.success) document.getElementById('row-project-'+id).remove();
    });
}
</script>
@endsection