@extends('layouts.admin')

@section('title', 'Skills')
@section('page-title', '// Manage Skills')
@section('breadcrumb', 'Skills')

@section('content')
<div style="display:flex;justify-content:flex-end;margin-bottom:1.5rem;">
    <button class="btn btn-accent" onclick="openModal('modal-skill')">+ Tambah Skill</button>
</div>

@forelse($skills as $category => $items)
<div class="card" style="margin-bottom:1.5rem;">
    <div class="card-title">// {{ $category }} <span style="color:var(--muted);font-weight:400;">({{ $items->count() }})</span></div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Skill</th>
                <th>Level</th>
                <th>Featured</th>
                <th>Order</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $skill)
            <tr>
                <td>
                    <div style="display:flex;align-items:center;gap:.75rem;">
                        <i class="{{ $skill->icon }}" style="font-size:1.25rem;color:{{ $skill->color ?? 'var(--accent)' }};"></i>
                        <span style="font-weight:500;">{{ $skill->name }}</span>
                    </div>
                </td>
                <td>
                    <div style="display:flex;align-items:center;gap:.75rem;">
                        <div class="level-bar"><div class="level-fill" style="width:{{ $skill->level }}%"></div></div>
                        <span style="font-family:var(--ff-mono);font-size:.75rem;color:var(--accent);">{{ $skill->level }}%</span>
                    </div>
                </td>
                <td>
                    @if($skill->is_featured)
                        <span class="badge badge-amber">Yes</span>
                    @else
                        <span class="badge badge-gray">No</span>
                    @endif
                </td>
                <td style="font-family:var(--ff-mono);font-size:.8rem;color:var(--muted);">{{ $skill->order }}</td>
                <td style="text-align:right;">
                    <button class="btn btn-ghost btn-sm" onclick='editSkill({{ $skill->toJson() }})'>Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteSkill({{ $skill->id }}, this)">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@empty
<div class="card">
    <p style="text-align:center;color:var(--muted);font-family:var(--ff-mono);font-size:.8rem;padding:2rem;">Belum ada skill. Tambahkan skill pertama!</p>
</div>
@endforelse

<!-- Modal Add/Edit -->
<div class="modal-overlay" id="modal-skill">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title" id="modal-skill-title">// Tambah Skill</div>
            <button class="modal-close" onclick="closeModal('modal-skill')">✕</button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="skill-id">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nama Skill *</label>
                    <input type="text" class="form-input" id="skill-name" placeholder="e.g. Laravel">
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori *</label>
                    <select class="form-select" id="skill-category">
                        <option value="Frontend">Frontend</option>
                        <option value="Backend">Backend</option>
                        <option value="Database">Database</option>
                        <option value="Tools">Tools</option>
                        <option value="Mobile">Mobile</option>
                        <option value="DevOps">DevOps</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Level: <span id="level-display" class="range-value">80%</span></label>
                <input type="range" id="skill-level" min="0" max="100" value="80"
                       oninput="document.getElementById('level-display').textContent=this.value+'%'">
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Icon Class (Devicon)</label>
                    <input type="text" class="form-input" id="skill-icon" placeholder="e.g. devicon-laravel-plain">
                </div>
                <div class="form-group">
                    <label class="form-label">Warna (Hex)</label>
                    <input type="text" class="form-input" id="skill-color" placeholder="#FF2D20">
                </div>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Order</label>
                    <input type="number" class="form-input" id="skill-order" value="0" min="0">
                </div>
                <div class="form-group" style="padding-top:1.5rem;">
                    <div class="form-check">
                        <input type="checkbox" id="skill-featured">
                        <label for="skill-featured">Tampilkan sebagai Featured</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-ghost" onclick="closeModal('modal-skill')">Batal</button>
            <button class="btn btn-accent" onclick="saveSkill()">Simpan</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function editSkill(skill) {
    document.getElementById('modal-skill-title').textContent = '// Edit Skill';
    document.getElementById('skill-id').value       = skill.id;
    document.getElementById('skill-name').value     = skill.name;
    document.getElementById('skill-category').value = skill.category;
    document.getElementById('skill-level').value    = skill.level;
    document.getElementById('level-display').textContent = skill.level + '%';
    document.getElementById('skill-icon').value     = skill.icon || '';
    document.getElementById('skill-color').value    = skill.color || '';
    document.getElementById('skill-order').value    = skill.order;
    document.getElementById('skill-featured').checked = skill.is_featured;
    openModal('modal-skill');
}

function resetSkillForm() {
    document.getElementById('modal-skill-title').textContent = '// Tambah Skill';
    document.getElementById('skill-id').value       = '';
    document.getElementById('skill-name').value     = '';
    document.getElementById('skill-level').value    = 80;
    document.getElementById('level-display').textContent = '80%';
    document.getElementById('skill-icon').value     = '';
    document.getElementById('skill-color').value    = '';
    document.getElementById('skill-order').value    = 0;
    document.getElementById('skill-featured').checked = false;
}

document.querySelector('[onclick="openModal(\'modal-skill\')"]').addEventListener('click', resetSkillForm);

async function saveSkill() {
    const id   = document.getElementById('skill-id').value;
    const data = {
        name:        document.getElementById('skill-name').value,
        category:    document.getElementById('skill-category').value,
        level:       document.getElementById('skill-level').value,
        icon:        document.getElementById('skill-icon').value,
        color:       document.getElementById('skill-color').value,
        order:       document.getElementById('skill-order').value,
        is_featured: document.getElementById('skill-featured').checked ? 1 : 0,
    };

    try {
        let res, json;
        if (id) {
            const body = new URLSearchParams({ ...data, _method: 'PUT' });
            res  = await fetch(`/admin/skills/${id}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json', 'Content-Type': 'application/x-www-form-urlencoded' },
                body,
            });
        } else {
            res = await fetch('/admin/skills', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify(data),
            });
        }
        json = await res.json();
        if (json.success) {
            toast(json.message, 'success');
            closeModal('modal-skill');
            setTimeout(() => location.reload(), 800);
        } else {
            toast(json.message || 'Terjadi kesalahan.', 'error');
        }
    } catch (e) {
        toast('Gagal menyimpan.', 'error');
    }
}

async function deleteSkill(id, btn) {
    if (!confirm('Yakin ingin menghapus skill ini?')) return;
    try {
        const json = await ajaxDelete(`/admin/skills/${id}`);
        if (json.success) {
            toast(json.message, 'success');
            btn.closest('tr').remove();
        } else {
            toast(json.message || 'Gagal menghapus.', 'error');
        }
    } catch (e) {
        toast('Terjadi kesalahan.', 'error');
    }
}
</script>
@endpush
