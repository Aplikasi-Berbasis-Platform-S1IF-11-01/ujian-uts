@extends('layouts.admin')

@section('title', 'Pengalaman')
@section('page-title', '// Manage Experiences')
@section('breadcrumb', 'Experiences')

@section('content')
<div style="display:flex;justify-content:flex-end;margin-bottom:1.5rem;">
    <button class="btn btn-accent" onclick="resetExpForm();openModal('modal-exp')">+ Tambah Pengalaman</button>
</div>

<div class="card">
    <div class="card-title">// All Experiences <span style="color:var(--muted);font-weight:400;">({{ $experiences->count() }})</span></div>
    <table class="data-table">
        <thead>
            <tr>
                <th>Posisi / Perusahaan</th>
                <th>Tipe</th>
                <th>Periode</th>
                <th>Lokasi</th>
                <th style="text-align:right;">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($experiences as $exp)
        <tr>
            <td>
                <div style="font-weight:500;margin-bottom:.2rem;">{{ $exp->position }}</div>
                <div style="font-size:.85rem;color:var(--muted);">{{ $exp->company }}</div>
            </td>
            <td>
                @if($exp->type === 'work')
                    <span class="badge badge-green">Work</span>
                @elseif($exp->type === 'education')
                    <span class="badge badge-amber">Education</span>
                @else
                    <span class="badge badge-gray">Certificate</span>
                @endif
                @if($exp->is_current)
                    <span class="badge badge-green" style="margin-left:.3rem;">Current</span>
                @endif
            </td>
            <td style="font-family:var(--ff-mono);font-size:.75rem;color:var(--muted);">{{ $exp->period }}</td>
            <td style="font-size:.85rem;color:var(--muted);">{{ $exp->location ?? '—' }}</td>
            <td style="text-align:right;">
                <button class="btn btn-ghost btn-sm" onclick='editExp({{ $exp->toJson() }})'>Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteExp({{ $exp->id }}, this)">Hapus</button>
            </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:2rem;font-family:var(--ff-mono);font-size:.8rem;">Belum ada pengalaman.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal-overlay" id="modal-exp">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-title" id="modal-exp-title">// Tambah Pengalaman</div>
            <button class="modal-close" onclick="closeModal('modal-exp')">✕</button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="exp-id">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Perusahaan / Institusi *</label>
                    <input type="text" class="form-input" id="exp-company">
                </div>
                <div class="form-group">
                    <label class="form-label">Posisi / Jabatan *</label>
                    <input type="text" class="form-input" id="exp-position">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-textarea" id="exp-desc" rows="3"></textarea>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Tipe *</label>
                    <select class="form-select" id="exp-type">
                        <option value="work">Work</option>
                        <option value="education">Education</option>
                        <option value="certificate">Certificate</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi</label>
                    <input type="text" class="form-input" id="exp-location" placeholder="e.g. Bandung, Indonesia">
                </div>
            </div>
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Tanggal Mulai *</label>
                    <input type="date" class="form-input" id="exp-start">
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-input" id="exp-end">
                </div>
            </div>
            <div class="form-grid">
                <div class="form-group" style="padding-top:.5rem;">
                    <div class="form-check">
                        <input type="checkbox" id="exp-current" onchange="toggleEndDate(this)">
                        <label for="exp-current">Masih berlangsung (Present)</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Order</label>
                    <input type="number" class="form-input" id="exp-order" value="0">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-ghost" onclick="closeModal('modal-exp')">Batal</button>
            <button class="btn btn-accent" onclick="saveExp()">Simpan</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleEndDate(cb) {
    document.getElementById('exp-end').disabled = cb.checked;
    if (cb.checked) document.getElementById('exp-end').value = '';
}

function resetExpForm() {
    document.getElementById('modal-exp-title').textContent = '// Tambah Pengalaman';
    ['exp-id','exp-company','exp-position','exp-desc','exp-location','exp-start','exp-end'].forEach(id => {
        document.getElementById(id).value = '';
    });
    document.getElementById('exp-type').value    = 'work';
    document.getElementById('exp-order').value   = 0;
    document.getElementById('exp-current').checked = false;
    document.getElementById('exp-end').disabled  = false;
}

function editExp(e) {
    document.getElementById('modal-exp-title').textContent = '// Edit Pengalaman';
    document.getElementById('exp-id').value       = e.id;
    document.getElementById('exp-company').value  = e.company;
    document.getElementById('exp-position').value = e.position;
    document.getElementById('exp-desc').value     = e.description || '';
    document.getElementById('exp-type').value     = e.type;
    document.getElementById('exp-location').value = e.location || '';
    document.getElementById('exp-order').value    = e.order;
    document.getElementById('exp-current').checked = e.is_current;

    // Format dates for input[type=date]
    if (e.start_date) {
        const sd = new Date(e.start_date + ' 00:00:00');
        document.getElementById('exp-start').value = sd.toISOString().split('T')[0];
    }
    if (!e.is_current && e.end_date) {
        const ed = new Date(e.end_date + ' 00:00:00');
        document.getElementById('exp-end').value = ed.toISOString().split('T')[0];
    }
    document.getElementById('exp-end').disabled = e.is_current;
    openModal('modal-exp');
}

async function saveExp() {
    const id   = document.getElementById('exp-id').value;
    const data = {
        company:    document.getElementById('exp-company').value,
        position:   document.getElementById('exp-position').value,
        description:document.getElementById('exp-desc').value,
        type:       document.getElementById('exp-type').value,
        location:   document.getElementById('exp-location').value,
        start_date: document.getElementById('exp-start').value,
        end_date:   document.getElementById('exp-end').value || null,
        is_current: document.getElementById('exp-current').checked ? 1 : 0,
        order:      document.getElementById('exp-order').value,
    };

    try {
        let res;
        if (id) {
            const body = new URLSearchParams({ ...data, _method: 'PUT' });
            res = await fetch(`/admin/experiences/${id}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json', 'Content-Type': 'application/x-www-form-urlencoded' },
                body,
            });
        } else {
            res = await fetch('/admin/experiences', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify(data),
            });
        }
        const json = await res.json();
        if (json.success) {
            toast(json.message, 'success');
            closeModal('modal-exp');
            setTimeout(() => location.reload(), 800);
        } else {
            const errors = json.errors ? Object.values(json.errors).flat().join(', ') : json.message;
            toast(errors || 'Terjadi kesalahan.', 'error');
        }
    } catch (e) { toast('Gagal menyimpan.', 'error'); }
}

async function deleteExp(id, btn) {
    if (!confirm('Yakin ingin menghapus pengalaman ini?')) return;
    try {
        const json = await ajaxDelete(`/admin/experiences/${id}`);
        if (json.success) {
            toast(json.message, 'success');
            btn.closest('tr').remove();
        } else { toast(json.message || 'Gagal menghapus.', 'error'); }
    } catch (e) { toast('Terjadi kesalahan.', 'error'); }
}
</script>
@endpush
