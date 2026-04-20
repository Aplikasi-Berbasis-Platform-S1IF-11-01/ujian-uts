@extends('layouts.admin')
@section('title', 'Edit Profil')
@section('page-title', 'Edit Profil')
@section('page-subtitle', 'Ubah informasi diri yang tampil di portfolio')

@section('content')
<div id="alert-msg" class="alert-custom"></div>

<div class="row g-4">
  <!-- Form -->
  <div class="col-lg-8">
    <div class="admin-card">
      <div class="admin-card-header">
        <div class="admin-card-title"><i class="bi bi-person-circle" style="color:#1d6cf0"></i> Data Profil</div>
      </div>
      <div class="p-4">
        <form id="profile-form" enctype="multipart/form-data">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nama Lengkap *</label>
              <input type="text" class="form-control" name="name" id="f-name" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">NIM *</label>
              <input type="text" class="form-control" name="nim" id="f-nim" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">Kelas *</label>
              <input type="text" class="form-control" name="class" id="f-class" placeholder="IF-11-01" required>
            </div>
            <div class="col-12">
              <label class="form-label">Tagline / Badge Hero</label>
              <input type="text" class="form-control" name="tagline" id="f-tagline" placeholder="Frontend Developer & UI Enthusiast">
            </div>
            <div class="col-12">
              <label class="form-label">Deskripsi Tentang Saya *</label>
              <textarea class="form-control" name="description" id="f-description" rows="5" required></textarea>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="f-email">
            </div>
            <div class="col-md-6">
              <label class="form-label">Lokasi</label>
              <input type="text" class="form-control" name="location" id="f-location" placeholder="Purwokerto, Jawa Tengah">
            </div>
            <div class="col-md-6">
              <label class="form-label">Username GitHub</label>
              <div class="input-group">
                <span class="input-group-text" style="font-size:.82rem;color:#64748b">github.com/</span>
                <input type="text" class="form-control" name="github" id="f-github">
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label">Username Instagram</label>
              <div class="input-group">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" name="instagram" id="f-instagram">
              </div>
            </div>
            <div class="col-md-3">
              <label class="form-label">IPK (GPA)</label>
              <input type="number" class="form-control" name="gpa" id="f-gpa" step="0.01" min="0" max="4">
            </div>
            <div class="col-md-3">
              <label class="form-label">Jumlah Proyek</label>
              <input type="number" class="form-control" name="projects_count" id="f-projects" min="0">
            </div>
            <div class="col-md-3">
              <label class="form-label">Jumlah Teknologi</label>
              <input type="number" class="form-control" name="tech_count" id="f-tech" min="0">
            </div>
            <div class="col-md-3">
              <label class="form-label">Status</label>
              <select class="form-select" name="available" id="f-available">
                <option value="1">Available ✅</option>
                <option value="0">Not Available ❌</option>
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Foto Profil</label>
              <input type="file" class="form-control" name="photo" id="f-photo" accept="image/*">
              <div class="mt-2" id="current-photo-wrap" style="display:none">
                <small class="text-muted">Foto saat ini:</small><br>
                <img id="current-photo" src="" alt="Current" style="width:80px;height:80px;object-fit:cover;border-radius:8px;margin-top:.4rem;border:2px solid #e2e8f0">
              </div>
            </div>
          </div>

          <div class="mt-4 d-flex gap-3">
            <button type="submit" class="btn-primary-custom" id="btn-save">
              <i class="bi bi-check-lg"></i> Simpan Perubahan
            </button>
            <div style="font-size:.78rem;color:#94a3b8;align-self:center">
              <i class="bi bi-info-circle"></i> Data langsung update via AJAX
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Preview Card -->
  <div class="col-lg-4">
    <div class="admin-card">
      <div class="admin-card-header">
        <div class="admin-card-title"><i class="bi bi-eye" style="color:#1d6cf0"></i> Preview</div>
      </div>
      <div class="p-4 text-center">
        <div style="width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,#1d6cf0,#06b6d4);display:flex;align-items:center;justify-content:center;font-size:2.5rem;font-weight:800;color:#fff;margin:0 auto 1rem;font-family:'Syne',sans-serif" id="preview-avatar">R</div>
        <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:1.1rem;color:#0a1628" id="preview-name">Nama Kamu</div>
        <div style="font-size:.78rem;color:#94a3b8;font-family:'JetBrains Mono',monospace;margin:.3rem 0" id="preview-nim">NIM / Kelas</div>
        <div style="font-size:.82rem;color:#64748b;margin-top:.5rem" id="preview-tagline">Tagline</div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
// ── Load profile data via AJAX
function loadProfile() {
  ajaxJson('GET', '{{ route("admin.api.profile") }}', null, function (status, res) {
    if (!res.success) return;
    var p = res.data;
    document.getElementById('f-name').value        = p.name || '';
    document.getElementById('f-nim').value         = p.nim || '';
    document.getElementById('f-class').value       = p['class'] || '';
    document.getElementById('f-tagline').value     = p.tagline || '';
    document.getElementById('f-description').value = p.description || '';
    document.getElementById('f-email').value       = p.email || '';
    document.getElementById('f-location').value   = p.location || '';
    document.getElementById('f-github').value      = p.github || '';
    document.getElementById('f-instagram').value  = p.instagram || '';
    document.getElementById('f-gpa').value         = p.gpa || '';
    document.getElementById('f-projects').value   = p.projects_count || '';
    document.getElementById('f-tech').value        = p.tech_count || '';
    document.getElementById('f-available').value  = p.available ? '1' : '0';

    if (p.photo) {
      document.getElementById('current-photo').src = '/storage/' + p.photo;
      document.getElementById('current-photo-wrap').style.display = 'block';
    }
    updatePreview(p);
  });
}
loadProfile();

// Live preview update
['f-name','f-nim','f-class','f-tagline'].forEach(function (id) {
  document.getElementById(id).addEventListener('input', function () {
    updatePreview({
      name: document.getElementById('f-name').value,
      nim:  document.getElementById('f-nim').value,
      class: document.getElementById('f-class').value,
      tagline: document.getElementById('f-tagline').value,
    });
  });
});
function updatePreview(p) {
  var name = p.name || 'Nama Kamu';
  document.getElementById('preview-name').textContent    = name;
  document.getElementById('preview-nim').textContent     = (p.nim || 'NIM') + ' / ' + (p['class'] || 'Kelas');
  document.getElementById('preview-tagline').textContent = p.tagline || 'Tagline';
  document.getElementById('preview-avatar').textContent  = name.charAt(0).toUpperCase();
}

// ── Submit via AJAX (FormData untuk file upload)
document.getElementById('profile-form').addEventListener('submit', function (e) {
  e.preventDefault();
  var btn = document.getElementById('btn-save');
  btn.disabled = true; btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyimpan...';

  var fd = new FormData(this);
  fd.append('_method', 'POST'); // profile update always POST with FormData

  var xhr = new XMLHttpRequest();
  xhr.open('POST', '{{ route("admin.api.profile.update") }}', true);
  xhr.setRequestHeader('Accept', 'application/json');
  xhr.setRequestHeader('X-CSRF-TOKEN', CSRF);
  xhr.onreadystatechange = function () {
    if (xhr.readyState !== 4) return;
    btn.disabled = false; btn.innerHTML = '<i class="bi bi-check-lg"></i> Simpan Perubahan';
    try {
      var res = JSON.parse(xhr.responseText);
      if (res.success) {
        showAlert('alert-msg', '✅ ' + res.message, 'success');
        if (res.data && res.data.photo) {
          document.getElementById('current-photo').src = '/storage/' + res.data.photo;
          document.getElementById('current-photo-wrap').style.display = 'block';
        }
      } else {
        var errMsg = '❌ Gagal menyimpan. ';
        if (res.errors) { Object.values(res.errors).forEach(function (e) { errMsg += e[0] + ' '; }); }
        showAlert('alert-msg', errMsg, 'error');
      }
    } catch (ex) { showAlert('alert-msg', '❌ Terjadi kesalahan server.', 'error'); }
  };
  xhr.send(fd);
});
</script>
@endpush
@endsection