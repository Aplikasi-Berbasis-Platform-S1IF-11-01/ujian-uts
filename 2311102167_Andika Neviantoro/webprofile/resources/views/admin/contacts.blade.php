@extends('layouts.admin')
@section('title', 'Kelola Kontak')
@section('page-title', 'Kelola Kontak')

@section('content')
<div class="admin-card">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
        <div class="admin-card-title" style="margin-bottom:0">📬 Daftar Kontak</div>
        <button class="btn-accent" onclick="openModal()">+ Tambah Kontak</button>
    </div>
    <table class="admin-table">
        <thead>
            <tr><th>Tipe</th><th>Label</th><th>Value</th><th>URL</th><th>Warna</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr id="contact-row-{{ $contact->id }}">
                <td><code style="font-size:12px;background:var(--bg);padding:2px 8px;border-radius:6px">{{ $contact->type }}</code></td>
                <td><strong style="color:var(--ink)">{{ $contact->label }}</strong></td>
                <td style="color:var(--muted)">{{ $contact->value }}</td>
                <td style="max-width:150px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><a href="{{ $contact->url }}" target="_blank" style="color:var(--accent);font-size:12px">{{ $contact->url }}</a></td>
                <td>
                    <span style="display:inline-block;width:14px;height:14px;border-radius:50%;background:{{ $contact->icon_bg }};border:2px solid {{ $contact->icon_color }};vertical-align:middle"></span>
                </td>
                <td>
                    <div style="display:flex;gap:6px">
                        <button class="btn-outline-accent" onclick="openModal({{ $contact->id }},'{{ $contact->type }}','{{ $contact->label }}','{{ addslashes($contact->value) }}','{{ addslashes($contact->url) }}','{{ $contact->icon_bg }}','{{ $contact->icon_color }}',{{ $contact->sort_order }})">Edit</button>
                        <button class="btn-danger-sm" onclick="deleteContact({{ $contact->id }})">Hapus</button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if($contacts->isEmpty())
    <div style="text-align:center;padding:40px;color:var(--muted);font-size:13px">Belum ada kontak.</div>
    @endif
</div>

<!-- MODAL -->
<div class="modal fade" id="contactModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Tambah Kontak</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="contact-id">
                <div style="display:flex;flex-direction:column;gap:14px">
                    <div>
                        <label class="form-label-admin">Tipe</label>
                        <select class="form-ctrl" id="contact-type">
                            <option value="email">Email</option>
                            <option value="instagram">Instagram</option>
                            <option value="github">GitHub</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="whatsapp">WhatsApp</option>
                            <option value="twitter">Twitter/X</option>
                            <option value="website">Website</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label-admin">Label</label>
                        <input class="form-ctrl" type="text" id="contact-label" placeholder="Email, Instagram, dll">
                    </div>
                    <div>
                        <label class="form-label-admin">Value (yang ditampilkan)</label>
                        <input class="form-ctrl" type="text" id="contact-value" placeholder="neviantoroa@gmail.com">
                    </div>
                    <div>
                        <label class="form-label-admin">URL / Link</label>
                        <input class="form-ctrl" type="text" id="contact-url" placeholder="mailto:... atau https://...">
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                        <div>
                            <label class="form-label-admin">Warna BG Icon</label>
                            <input class="form-ctrl" type="text" id="contact-icon-bg" placeholder="#fef2f2">
                        </div>
                        <div>
                            <label class="form-label-admin">Warna Icon</label>
                            <input class="form-ctrl" type="text" id="contact-icon-color" placeholder="#e8580a">
                        </div>
                    </div>
                    <div>
                        <label class="form-label-admin">Urutan</label>
                        <input class="form-ctrl" type="number" id="contact-order" value="0">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-outline-accent" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn-accent" id="btn-save-contact" onclick="saveContact()">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let contactModal = new bootstrap.Modal(document.getElementById('contactModal'));

function openModal(id='',type='email',label='',value='',url='',iconBg='#fef2f2',iconColor='#e8580a',order=0){
    document.getElementById('contact-id').value = id;
    document.getElementById('contact-type').value = type;
    document.getElementById('contact-label').value = label;
    document.getElementById('contact-value').value = value;
    document.getElementById('contact-url').value = url;
    document.getElementById('contact-icon-bg').value = iconBg;
    document.getElementById('contact-icon-color').value = iconColor;
    document.getElementById('contact-order').value = order;
    document.getElementById('modal-title').textContent = id ? 'Edit Kontak' : 'Tambah Kontak';
    contactModal.show();
}

async function saveContact() {
    const id = document.getElementById('contact-id').value;
    const data = {
        type: document.getElementById('contact-type').value,
        label: document.getElementById('contact-label').value,
        value: document.getElementById('contact-value').value,
        url: document.getElementById('contact-url').value,
        icon_bg: document.getElementById('contact-icon-bg').value,
        icon_color: document.getElementById('contact-icon-color').value,
        sort_order: document.getElementById('contact-order').value,
    };
    const apiUrl = id ? `/admin/contacts/${id}` : '{{ route("admin.contacts.store") }}';
    const method = id ? 'PUT' : 'POST';
    const btn = document.getElementById('btn-save-contact');
    btn.textContent = 'Menyimpan...'; btn.disabled = true;
    try {
        const res = await ajaxRequest(apiUrl, method, data);
        if (res.success) { showToast(res.message); contactModal.hide(); setTimeout(() => location.reload(), 700); }
        else showToast(res.message || 'Gagal', 'error');
    } catch(e) { showToast('Terjadi kesalahan', 'error'); }
    btn.textContent = 'Simpan'; btn.disabled = false;
}

async function deleteContact(id) {
    if (!confirm('Yakin ingin menghapus kontak ini?')) return;
    try {
        const res = await ajaxRequest(`/admin/contacts/${id}`, 'DELETE');
        if (res.success) { showToast(res.message); document.getElementById(`contact-row-${id}`)?.remove(); }
        else showToast(res.message || 'Gagal', 'error');
    } catch(e) { showToast('Terjadi kesalahan', 'error'); }
}
</script>
@endpush
