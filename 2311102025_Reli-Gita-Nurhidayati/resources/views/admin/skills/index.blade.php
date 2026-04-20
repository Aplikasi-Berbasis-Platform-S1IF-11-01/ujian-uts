@extends('admin.layout')
@section('title', 'Kelola Skills')
@section('content')
<div class="card p-4 mb-4">
    <h6 class="fw-bold mb-3">➕ Tambah Skill Baru</h6>
    <form method="POST" action="{{ route('admin.skills.store') }}">
        @csrf
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="name" class="form-control" placeholder="Nama Skill" required>
            </div>
            <div class="col-md-4">
                <select name="category" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <option value="Data Analyst">Data Analyst</option>
                    <option value="UI/UX Design">UI/UX Design</option>
                    <option value="Tools">Tools</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="percentage" class="form-control" placeholder="%" min="0" max="100" required>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success w-100">Tambah</button>
            </div>
        </div>
    </form>
</div>

<div class="card p-4">
    <h6 class="fw-bold mb-3">📋 Daftar Skills</h6>
    <table class="table table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Persentase</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($skills as $skill)
            <tr id="row-skill-{{ $skill->id }}">
                <td>{{ $skill->name }}</td>
                <td><span class="badge bg-success">{{ $skill->category }}</span></td>
                <td>
                    <div class="progress" style="height:20px">
                        <div class="progress-bar bg-success" style="width:{{ $skill->percentage }}%">
                            {{ $skill->percentage }}%
                        </div>
                    </div>
                </td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="editSkill({{ $skill->id }}, '{{ $skill->name }}', '{{ $skill->category }}', {{ $skill->percentage }})">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="deleteSkill({{ $skill->id }})">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editSkillId">
                <div class="mb-3">
                    <label class="form-label">Nama Skill</label>
                    <input type="text" id="editSkillName" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select id="editSkillCategory" class="form-select">
                        <option value="Data Analyst">Data Analyst</option>
                        <option value="UI/UX Design">UI/UX Design</option>
                        <option value="Tools">Tools</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Persentase</label>
                    <input type="number" id="editSkillPercentage" class="form-control" min="0" max="100">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" onclick="updateSkill()">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
const token = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').content : '{{ csrf_token() }}';

function editSkill(id, name, category, percentage) {
    document.getElementById('editSkillId').value = id;
    document.getElementById('editSkillName').value = name;
    document.getElementById('editSkillCategory').value = category;
    document.getElementById('editSkillPercentage').value = percentage;
    new bootstrap.Modal(document.getElementById('editModal')).show();
}

function updateSkill() {
    const id = document.getElementById('editSkillId').value;
    fetch(`/admin/skills/${id}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({
            _method: 'PUT',
            name: document.getElementById('editSkillName').value,
            category: document.getElementById('editSkillCategory').value,
            percentage: document.getElementById('editSkillPercentage').value,
        })
    }).then(r => r.json()).then(data => {
        if(data.success) { location.reload(); }
    });
}

function deleteSkill(id) {
    if(!confirm('Hapus skill ini?')) return;
    fetch(`/admin/skills/${id}`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ _method: 'DELETE' })
    }).then(r => r.json()).then(data => {
        if(data.success) { document.getElementById('row-skill-'+id).remove(); }
    });
}
</script>
@endsection