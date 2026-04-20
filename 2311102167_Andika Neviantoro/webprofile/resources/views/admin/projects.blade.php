@extends('layouts.admin')
@section('title', 'Kelola Project')
@section('page-title', 'Kelola Project')

@section('content')
<div class="admin-card">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
        <div class="admin-card-title" style="margin-bottom:0">📁 Daftar Project</div>
        <button class="btn-accent" onclick="openModal()">+ Tambah Project</button>
    </div>
    <table class="admin-table">
        <thead>
            <tr><th>#</th><th>Judul</th><th>Deskripsi</th><th>Tag</th><th>Thumb</th><th>Aksi</th></tr>
        </thead>
        <tbody id="projects-tbody">
            @foreach($projects as $i => $project)
            <tr id="project-row-{{ $project->id }}">
                <td style="color:var(--muted);font-size:12px">{{ $i+1 }}</td>
                <td><strong style="color:var(--ink)">{{ $project->title }}</strong></td>
                <td style="max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $project->description }}</td>
                <td><span style="font-size:11px;background:rgba(232,88,10,.08);color:var(--accent);border:1px solid rgba(232,88,10,.2);border-radius:100px;padding:3px 10px;font-weight:700">{{ $project->tag }}</span></td>
                <td><code style="font-size:11px;color:var(--muted)">{{ $project->thumb_type }}</code></td>
                <td>
                    <div style="display:flex;gap:6px">
                        <button class="btn-outline-accent" onclick="openModal({{ $project->id }},'{{ addslashes($project->title) }}','{{ addslashes($project->description) }}','{{ $project->tag }}','{{ $project->thumb_type }}',{{ $project->sort_order }})">Edit</button>
                        <button class="btn-danger-sm" onclick="deleteProject({{ $project->id }})">Hapus</button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if($projects->isEmpty())
    <div style="text-align:center;padding:40px;color:var(--muted);font-size:13px">Belum ada project.</div>
    @endif
</div>

<!-- MODAL -->
<div class="modal fade" id="projectModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Tambah Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="project-id">
                <div style="display:flex;flex-direction:column;gap:14px">
                    <div>
                        <label class="form-label-admin">Judul Project</label>
                        <input class="form-ctrl" type="text" id="project-title" placeholder="Portfolio Website" required>
                    </div>
                    <div>
                        <label class="form-label-admin">Deskripsi</label>
                        <textarea class="form-ctrl" id="project-desc" rows="3" placeholder="Deskripsi singkat project..."></textarea>
                    </div>
                    <div>
                        <label class="form-label-admin">Tag / Kategori</label>
                        <input class="form-ctrl" type="text" id="project-tag" placeholder="Front-End Dev, Full Stack, UI/UX Design">
                    </div>
                    <div>
                        <label class="form-label-admin">Thumbnail Style</label>
                        <select class="form-ctrl" id="project-thumb">
                            <option value="pt-o">Orange (pt-o)</option>
                            <option value="pt-s">Sage/Green (pt-s)</option>
                            <option value="pt-k">Khaki/Brown (pt-k)</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label-admin">Urutan</label>
                        <input class="form-ctrl" type="number" id="project-order" value="0">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-outline-accent" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn-accent" id="btn-save-project" onclick="saveProject()">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let projectModal = new bootstrap.Modal(document.getElementById('projectModal'));

function openModal(id='',title='',desc='',tag='',thumb='pt-o',order=0){
    document.getElementById('project-id').value = id;
    document.getElementById('project-title').value = title;
    document.getElementById('project-desc').value = desc;
    document.getElementById('project-tag').value = tag;
    document.getElementById('project-thumb').value = thumb;
    document.getElementById('project-order').value = order;
    document.getElementById('modal-title').textContent = id ? 'Edit Project' : 'Tambah Project';
    projectModal.show();
}

async function saveProject() {
    const id = document.getElementById('project-id').value;
    const data = {
        title: document.getElementById('project-title').value,
        description: document.getElementById('project-desc').value,
        tag: document.getElementById('project-tag').value,
        thumb_type: document.getElementById('project-thumb').value,
        sort_order: document.getElementById('project-order').value,
    };
    const url = id ? `/admin/projects/${id}` : '{{ route("admin.projects.store") }}';
    const method = id ? 'PUT' : 'POST';
    const btn = document.getElementById('btn-save-project');
    btn.textContent = 'Menyimpan...'; btn.disabled = true;
    try {
        const res = await ajaxRequest(url, method, data);
        if (res.success) { showToast(res.message); projectModal.hide(); setTimeout(() => location.reload(), 700); }
        else showToast(res.message || 'Gagal', 'error');
    } catch(e) { showToast('Terjadi kesalahan', 'error'); }
    btn.textContent = 'Simpan'; btn.disabled = false;
}

async function deleteProject(id) {
    if (!confirm('Yakin ingin menghapus project ini?')) return;
    try {
        const res = await ajaxRequest(`/admin/projects/${id}`, 'DELETE');
        if (res.success) { showToast(res.message); document.getElementById(`project-row-${id}`)?.remove(); }
        else showToast(res.message || 'Gagal', 'error');
    } catch(e) { showToast('Terjadi kesalahan', 'error'); }
}
</script>
@endpush
