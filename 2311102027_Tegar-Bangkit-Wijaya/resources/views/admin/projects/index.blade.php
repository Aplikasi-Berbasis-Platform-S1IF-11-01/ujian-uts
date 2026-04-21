@extends('layouts.admin')

@section('title', 'Projects')
@section('page-title', '// Manage Projects')
@section('breadcrumb', 'Projects')

@section('content')
<div style="display:flex;justify-content:flex-end;margin-bottom:1.5rem;">
    <button class="btn btn-accent" onclick="resetProjectForm();openModal('modal-project')">+ Tambah Project</button>
</div>

<div class="card">
    <div class="card-title">// All Projects <span style="color:var(--muted);font-weight:400;">({{ $projects->count() }})</span></div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Project</th>
                <th>Tech Stack</th>
                <th>Status</th>
                <th>Year</th>
                <th>Featured</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody id="projects-tbody">
        @forelse($projects as $project)
        @php
            $techs = $project->tech_stack;
            if (is_string($techs)) {
                $techs = json_decode($techs, true) ?? [];
            }
            if (!is_array($techs)) {
                $techs = [];
            }
        @endphp
        <tr data-id="{{ $project->id }}">
            <td>
                <div style="font-weight:500;margin-bottom:.2rem;">{{ $project->title }}</div>
                <div style="font-size:.8rem;color:var(--muted);max-width:280px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $project->description }}</div>
            </td>
            <td>
                <div style="display:flex;gap:.3rem;flex-wrap:wrap;max-width:200px;">
                    @foreach($techs as $tech)
                    <span style="font-family:var(--ff-mono);font-size:.6rem;background:var(--bg);border:1px solid var(--border);padding:.15rem .4rem;color:var(--muted);">{{ $tech }}</span>
                    @endforeach
                </div>
            </td>
            <td>
                @if($project->status === 'completed')
                    <span class="badge badge-green">Completed</span>
                @elseif($project->status === 'in-progress')
                    <span class="badge badge-amber">In Progress</span>
                @else
                    <span class="badge badge-gray">Archived</span>
                @endif
            </td>
            <td style="font-family:var(--ff-mono);font-size:.8rem;">{{ $project->year ? date('Y', strtotime($project->year)) : '—' }}</td>
            <td>
                @if($project->is_featured)
                    <span class="badge badge-amber">Yes</span>
                @else
                    <span class="badge badge-gray">No</span>
                @endif
            </td>
            <td style="text-align:right;">
                <button class="btn btn-ghost btn-sm" onclick='editProject({{ $project->toJson() }})'>Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteProject({{ $project->id }}, this)">Hapus</button>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:2rem;font-family:var(--ff-mono);font-size:.8rem;">Belum ada project.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal-overlay" id="modal-project">
    <div class="modal" style="max-width:640px;">
        <div class="modal-header">
            <div class="modal-title" id="modal-project-title">// Tambah Project</div>
            <button class="modal-close" onclick="closeModal('modal-project')">✕</button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="project-id">
            <div class="form-group">
                <label class="form-label">Judul Project *</label>
                <input type="text" class="form-input" id="project-title">
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi *</label>
                <textarea class="form-textarea" id="project-desc" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Tech Stack (pisahkan dengan koma)</label>
                <input type="text" class="form-input" id="project-tech" placeholder="Laravel, Vue.js, MySQL">
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Demo URL</label>
                    <input type="url" class="form-input" id="project-demo">
                </div>
                <div class="form-group">
                    <label class="form-label">GitHub URL</label>
                    <input type="url" class="form-input" id="project-github">
                </div>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Status *</label>
                    <select class="form-select" id="project-status">
                        <option value="completed">Completed</option>
                        <option value="in-progress">In Progress</option>
                        <option value="archived">Archived</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Tahun</label>
                    <input type="number" class="form-input" id="project-year" placeholder="2024" min="2000" max="2099">
                </div>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Order</label>
                    <input type="number" class="form-input" id="project-order" value="0">
                </div>
                <div class="form-group" style="padding-top:1.5rem;">
                    <div class="form-check">
                        <input type="checkbox" id="project-featured">
                        <label for="project-featured">Featured Project</label>
                    </div>
                </div>
            </div>
            <!-- Thumbnail upload (only shown on edit) -->
            <div id="thumbnail-section" style="display:none;">
                <div style="border-top:1px solid var(--border);padding-top:1rem;margin-top:.5rem;">
                    <label class="form-label">Thumbnail</label>
                    <div id="thumb-preview" style="margin-bottom:.75rem;"></div>
                    <input type="file" id="project-thumb-file" accept="image/*" style="width:100%;font-size:.8rem;padding:.5rem;border:1px solid var(--border);background:var(--bg);">
                    <button class="btn btn-ghost btn-sm" style="margin-top:.5rem;" onclick="uploadThumbnail()">Upload Thumbnail</button>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-ghost" onclick="closeModal('modal-project')">Batal</button>
            <button class="btn btn-accent" onclick="saveProject()">Simpan</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function resetProjectForm() {
    document.getElementById('modal-project-title').textContent = '// Tambah Project';
    document.getElementById('project-id').value      = '';
    document.getElementById('project-title').value   = '';
    document.getElementById('project-desc').value    = '';
    document.getElementById('project-tech').value    = '';
    document.getElementById('project-demo').value    = '';
    document.getElementById('project-github').value  = '';
    document.getElementById('project-status').value  = 'completed';
    document.getElementById('project-year').value    = new Date().getFullYear();
    document.getElementById('project-order').value   = 0;
    document.getElementById('project-featured').checked = false;
    document.getElementById('thumbnail-section').style.display = 'none';
}

function editProject(p) {
    document.getElementById('modal-project-title').textContent = '// Edit Project';
    document.getElementById('project-id').value      = p.id;
    document.getElementById('project-title').value   = p.title;
    document.getElementById('project-desc').value    = p.description;
    document.getElementById('project-tech').value    = (p.tech_stack || []).join(', ');
    document.getElementById('project-demo').value    = p.demo_url || '';
    document.getElementById('project-github').value  = p.github_url || '';
    document.getElementById('project-status').value  = p.status;
    document.getElementById('project-year').value    = p.year ? p.year.split('-')[0] : '';
    document.getElementById('project-order').value   = p.order;
    document.getElementById('project-featured').checked = p.is_featured;
    document.getElementById('thumbnail-section').style.display = 'block';
    const tp = document.getElementById('thumb-preview');
    tp.innerHTML = p.thumbnail
        ? `<img src="${p.thumbnail}" style="width:120px;height:70px;object-fit:cover;border:1px solid var(--border);">`
        : '<span style="font-size:.75rem;color:var(--muted);">Belum ada thumbnail</span>';
    openModal('modal-project');
}

async function saveProject() {
    const id   = document.getElementById('project-id').value;
    const data = {
        title:       document.getElementById('project-title').value,
        description: document.getElementById('project-desc').value,
        tech_stack:  document.getElementById('project-tech').value,
        demo_url:    document.getElementById('project-demo').value || null,
        github_url:  document.getElementById('project-github').value || null,
        status:      document.getElementById('project-status').value,
        year:        document.getElementById('project-year').value,
        order:       document.getElementById('project-order').value,
        is_featured: document.getElementById('project-featured').checked ? 1 : 0,
    };

    try {
        let res;
        if (id) {
            const body = new URLSearchParams({ ...data, _method: 'PUT' });
            res = await fetch(`/admin/projects/${id}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json', 'Content-Type': 'application/x-www-form-urlencoded' },
                body,
            });
        } else {
            res = await fetch('/admin/projects', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify(data),
            });
        }
        const json = await res.json();
        if (json.success) {
            toast(json.message, 'success');
            closeModal('modal-project');
            setTimeout(() => location.reload(), 800);
        } else {
            const errors = json.errors ? Object.values(json.errors).flat().join(', ') : json.message;
            toast(errors || 'Terjadi kesalahan.', 'error');
        }
    } catch (e) { toast('Gagal menyimpan.', 'error'); }
}

async function uploadThumbnail() {
    const id   = document.getElementById('project-id').value;
    const file = document.getElementById('project-thumb-file').files[0];
    if (!file || !id) { toast('Simpan project dulu, lalu upload thumbnail.', 'error'); return; }

    const fd = new FormData();
    fd.append('thumbnail', file);
    try {
        const res  = await fetch(`/admin/projects/${id}/thumbnail`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            body: fd,
        });
        const json = await res.json();
        if (json.success) {
            document.getElementById('thumb-preview').innerHTML = `<img src="${json.thumbnail_url}?t=${Date.now()}" style="width:120px;height:70px;object-fit:cover;border:1px solid var(--border);">`;
            toast(json.message, 'success');
        } else { toast(json.message || 'Gagal upload.', 'error'); }
    } catch (e) { toast('Gagal upload.', 'error'); }
}

async function deleteProject(id, btn) {
    if (!confirm('Yakin ingin menghapus project ini?')) return;
    try {
        const json = await ajaxDelete(`/admin/projects/${id}`);
        if (json.success) {
            toast(json.message, 'success');
            btn.closest('tr').remove();
        } else { toast(json.message || 'Gagal menghapus.', 'error'); }
    } catch (e) { toast('Terjadi kesalahan.', 'error'); }
}
</script>
@endpush