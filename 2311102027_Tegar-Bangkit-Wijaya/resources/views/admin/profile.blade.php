@extends('layouts.admin')

@section('title', 'Edit Profil')
@section('page-title', '// Edit Profil')
@section('breadcrumb', 'Profil')

@section('content')
<div style="display:grid;grid-template-columns:300px 1fr;gap:1.5rem;align-items:start;">

    <!-- Photo Card -->
    <div>
        <div class="card">
            <div class="card-title">// Foto Profil</div>
            <div style="text-align:center;margin-bottom:1.5rem;">
                <img id="photo-preview"
                     src="{{ $profile->photo && !str_starts_with($profile->photo,'http') ? asset('storage/'.$profile->photo) : asset('images/profile-default.png') }}"
                     alt="Profile Photo"
                     style="width:160px;height:160px;object-fit:cover;border:2px solid var(--border);">
            </div>
            <div class="form-group">
                <label class="form-label">Upload Foto Baru</label>
                <input type="file" id="photo-input" accept="image/*" style="width:100%;font-size:.8rem;padding:.5rem;border:1px solid var(--border);background:var(--bg);">
            </div>
            <button class="btn btn-accent" style="width:100%;" onclick="uploadPhoto()">Upload Foto</button>
        </div>

        <div class="card" style="margin-top:1.25rem;">
            <div class="card-title">// Info Akademik</div>
            <div class="form-group">
                <label class="form-label">NIM</label>
                <input type="text" class="form-input" id="f-nim" value="{{ $profile->nim }}">
            </div>
            <div class="form-group">
                <label class="form-label">Jurusan</label>
                <input type="text" class="form-input" id="f-jurusan" value="{{ $profile->jurusan }}">
            </div>
        </div>
    </div>

    <!-- Main Form -->
    <div class="card">
        <div class="card-title">// Informasi Profil</div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Nama Lengkap *</label>
                <input type="text" class="form-input" id="f-name" value="{{ $profile->name }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Title / Jabatan *</label>
                <input type="text" class="form-input" id="f-title" value="{{ $profile->title }}" placeholder="e.g. Full-Stack Developer">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Tagline</label>
            <input type="text" class="form-input" id="f-tagline" value="{{ $profile->tagline }}" placeholder="Short headline yang menarik">
        </div>

        <div class="form-group">
            <label class="form-label">Bio (Hero Section) *</label>
            <textarea class="form-textarea" id="f-bio" rows="3">{{ $profile->bio }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label">About (Deskripsi Panjang)</label>
            <textarea class="form-textarea" id="f-about" rows="5">{{ $profile->about }}</textarea>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input" id="f-email" value="{{ $profile->email }}">
            </div>
            <div class="form-group">
                <label class="form-label">Phone</label>
                <input type="text" class="form-input" id="f-phone" value="{{ $profile->phone }}">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Lokasi</label>
            <input type="text" class="form-input" id="f-location" value="{{ $profile->location }}" placeholder="e.g. Bandung, Jawa Barat">
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">GitHub URL</label>
                <input type="url" class="form-input" id="f-github" value="{{ $profile->github }}">
            </div>
            <div class="form-group">
                <label class="form-label">LinkedIn URL</label>
                <input type="url" class="form-input" id="f-linkedin" value="{{ $profile->linkedin }}">
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Instagram URL</label>
                <input type="url" class="form-input" id="f-instagram" value="{{ $profile->instagram }}">
            </div>
            <div class="form-group">
                <label class="form-label">Website URL</label>
                <input type="url" class="form-input" id="f-website" value="{{ $profile->website }}">
            </div>
        </div>

        <div class="form-grid-3">
            <div class="form-group">
                <label class="form-label">Years Experience</label>
                <input type="number" class="form-input" id="f-years" value="{{ $profile->years_experience }}" min="0">
            </div>
            <div class="form-group">
                <label class="form-label">Projects Done</label>
                <input type="number" class="form-input" id="f-projects" value="{{ $profile->projects_done }}" min="0">
            </div>
            <div class="form-group">
                <label class="form-label">Clients</label>
                <input type="number" class="form-input" id="f-clients" value="{{ $profile->clients }}" min="0">
            </div>
        </div>

        <div style="display:flex;justify-content:flex-end;margin-top:1rem;">
            <button class="btn btn-accent" onclick="saveProfile()">Simpan Perubahan</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
async function saveProfile() {
    const data = {
        name:             document.getElementById('f-name').value,
        nim:              document.getElementById('f-nim').value,
        jurusan:          document.getElementById('f-jurusan').value,
        title:            document.getElementById('f-title').value,
        tagline:          document.getElementById('f-tagline').value,
        bio:              document.getElementById('f-bio').value,
        about:            document.getElementById('f-about').value,
        email:            document.getElementById('f-email').value,
        phone:            document.getElementById('f-phone').value,
        location:         document.getElementById('f-location').value,
        github:           document.getElementById('f-github').value,
        linkedin:         document.getElementById('f-linkedin').value,
        instagram:        document.getElementById('f-instagram').value,
        website:          document.getElementById('f-website').value,
        years_experience: document.getElementById('f-years').value,
        projects_done:    document.getElementById('f-projects').value,
        clients:          document.getElementById('f-clients').value,
        _method:          'PUT',
    };

    try {
        const res  = await fetch('{{ route("admin.profile.update") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(data),
        });
        const json = await res.json();
        if (json.success) toast(json.message, 'success');
        else toast(json.message || 'Terjadi kesalahan.', 'error');
    } catch (e) {
        toast('Gagal menyimpan. Cek koneksi.', 'error');
    }
}

async function uploadPhoto() {
    const file = document.getElementById('photo-input').files[0];
    if (!file) { toast('Pilih file foto terlebih dahulu.', 'error'); return; }

    const fd = new FormData();
    fd.append('photo', file);

    try {
        const res  = await fetch('{{ route("admin.profile.photo") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
            body: fd,
        });
        const json = await res.json();
        if (json.success) {
            document.getElementById('photo-preview').src = json.photo_url + '?t=' + Date.now();
            toast(json.message, 'success');
        } else {
            toast(json.message || 'Gagal upload foto.', 'error');
        }
    } catch (e) {
        toast('Gagal upload. Cek koneksi.', 'error');
    }
}

// Preview before upload
document.getElementById('photo-input').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => { document.getElementById('photo-preview').src = e.target.result; };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
