@extends('layouts.admin')
@section('title', 'Kelola Proyek')
@section('page-title', 'Kelola Proyek')
@section('page-subtitle', 'Tambah, edit, dan hapus proyek portfolio')

@section('content')
<div id="alert-msg" class="alert-custom"></div>

<!-- Tombol Tambah -->
<div class="mb-4">
  <button class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#projectModal" onclick="openAddModal()">
    <i class="bi bi-plus-lg"></i> Tambah Proyek Baru
  </button>
</div>

<!-- Tabel Proyek -->
<div class="admin-card">
  <div class="admin-card-header">
    <div class="admin-card-title"><i class="bi bi-folder2-open" style="color:#1d6cf0"></i> Daftar Proyek</div>
    <small class="text-muted" style="font-family:'JetBrains Mono',monospace;font-size:.65rem">Data via AJAX</small>
  </div>
  <div style="overflow-x:auto">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Thumbnail</th>
          <th>Judul</th>
          <th>Tipe</th>
          <th>Tech Stack</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody id="projects-tbody">
        <tr><td colspan="5" style="text-align:center;color:#94a3b8;padding:2rem"><i class="bi bi-hourglass-split me-2"></i>Memuat...</td></tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Form Proyek -->
<div class="modal fade" id="projectModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-title">Tambah Proyek</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="project-form" enctype="multipart/form-data">
          <input type="hidden" id="edit-id">
          <div class="row g-3">
            <div class="col-md-8">
              <label class="form-label">Judul Proyek *</label>
              <input type="text" class="form-control" id="f-title" placeholder="Nama Proyek">
            </div>
            <div class="col-md-4">
              <label class="form-label">Tipe</label>
              <input type="text" class="form-control" id="f-type" placeholder="Web Application" value="Web Application">
            </div>
            <div class="col-12">
              <label class="form-label">Deskripsi *</label>
              <textarea class="form-control" id="f-description" rows="3"></textarea>
            </div>
            <div class="col-12">
              <label class="form-label">Tech Stack * <small class="text-muted">(pisahkan dengan koma)</small></label>
              <input type="text" class="form-control" id="f-tech" placeholder="Laravel, MySQL, Bootstrap, Vue.js">
            </div>
            <div class="col-md-6">
              <label class="form-label">URL GitHub</label>
              <input type="text" class="form-control" id="f-github" placeholder="https://github.com/...">
            </div>
            <div class="col-md-6">
              <label class="form-label">URL Demo</label>
              <input type="text" class="form-control" id="f-demo" placeholder="https://...">
            </div>
            <div class="col-12">
              <label class="form-label">Gambar Proyek</label>
              <input type="file" class="form-control" id="f-image" accept="image/*">
              <div id="current-img-wrap" style="display:none;margin-top:.5rem">
                <small class="text-muted">Gambar saat ini:</small><br>
                <img id="current-img" src="" alt="" style="height:80px;border-radius:8px;margin-top:.3rem;border:1px solid #e2e8f0">
              </div>
            </div>
            <div class="col-12">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="f-featured" checked>
                <label class="form-check-label" for="f-featured" style="font-size:.88rem">Tampilkan sebagai proyek unggulan</label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn-primary-custom" id="btn-save" onclick="saveProject()">
          <i class="bi bi-check-lg"></i> Simpan
        </button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
var editingId = null;

function loadProjects() {
  ajaxJson('GET', '{{ route("admin.api.projects") }}', null, function (status, res) {
    var tbody = document.getElementById('projects-tbody');
    if (!res.success) { tbody.innerHTML = '<tr><td colspan="5" class="text-center text-muted">Gagal memuat data.</td></tr>'; return; }
    if (!res.data.length) { tbody.innerHTML = '<tr><td colspan="5" class="text-center text-muted">Belum ada proyek. Tambahkan sekarang!</td></tr>'; return; }
    tbody.innerHTML = '';
    res.data.forEach(function (p) {
      var tech = (p.tech_stack || '').split(',').map(function (t) {
        return '<span style="font-size:.62rem;padding:.15rem .5rem;background:#eff6ff;color:#2563eb;border-radius:99px;border:1px solid #dbeafe">' + esc(t.trim()) + '</span>';
      }).join(' ');
      var tr = document.createElement('tr');
      tr.innerHTML =
        '<td><img src="' + esc(p.image_url || '') + '" alt="" style="width:60px;height:45px;object-fit:cover;border-radius:6px;background:#f1f5f9" onerror="this.src=\'https://placehold.co/60x45/f1f5f9/94a3b8?text=No+Img\'"></td>' +
        '<td><div style="font-weight:700;color:#0a1628">' + esc(p.title) + '</div>' + (p.is_featured ? '<span style="font-size:.62rem;background:#d1fae5;color:#065f46;padding:.1rem .5rem;border-radius:99px">✨ Featured</span>' : '') + '</td>' +
        '<td style="color:#64748b;font-size:.82rem">' + esc(p.type) + '</td>' +
        '<td><div style="display:flex;flex-wrap:wrap;gap:.25rem">' + tech + '</div></td>' +
        '<td><div style="display:flex;gap:.4rem">' +
          '<button class="btn-edit-custom" onclick="editProject(' + JSON.stringify(p).replace(/"/g, '&quot;') + ')"><i class="bi bi-pencil"></i></button>' +
          '<button class="btn-danger-custom" onclick="deleteProject(' + p.id + ', \'' + esc(p.title) + '\')"><i class="bi bi-trash"></i></button>' +
        '</div></td>';
      tbody.appendChild(tr);
    });
  });
}
loadProjects();

function openAddModal() {
  editingId = null;
  document.getElementById('modal-title').textContent = 'Tambah Proyek Baru';
  document.getElementById('edit-id').value = '';
  document.getElementById('f-title').value = '';
  document.getElementById('f-type').value = 'Web Application';
  document.getElementById('f-description').value = '';
  document.getElementById('f-tech').value = '';
  document.getElementById('f-github').value = '';
  document.getElementById('f-demo').value = '';
  document.getElementById('f-image').value = '';
  document.getElementById('f-featured').checked = true;
  document.getElementById('current-img-wrap').style.display = 'none';
}

function editProject(p) {
  editingId = p.id;
  document.getElementById('modal-title').textContent = 'Edit Proyek';
  document.getElementById('edit-id').value = p.id;
  document.getElementById('f-title').value = p.title || '';
  document.getElementById('f-type').value = p.type || 'Web Application';
  document.getElementById('f-description').value = p.description || '';
  document.getElementById('f-tech').value = p.tech_stack || '';
  document.getElementById('f-github').value = p.github_url || '';
  document.getElementById('f-demo').value = p.demo_url || '';
  document.getElementById('f-featured').checked = !!p.is_featured;
  if (p.image_url) {
    document.getElementById('current-img').src = p.image_url;
    document.getElementById('current-img-wrap').style.display = 'block';
  } else {
    document.getElementById('current-img-wrap').style.display = 'none';
  }
  new bootstrap.Modal(document.getElementById('projectModal')).show();
}

function saveProject() {
  var title = document.getElementById('f-title').value.trim();
  var desc  = document.getElementById('f-description').value.trim();
  var tech  = document.getElementById('f-tech').value.trim();
  if (!title || !desc || !tech) { showAlert('alert-msg', '❌ Judul, deskripsi, dan tech stack wajib diisi.', 'error'); return; }

  var btn = document.getElementById('btn-save');
  btn.disabled = true; btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyimpan...';

  var fd = new FormData();
  fd.append('title',       title);
  fd.append('type',        document.getElementById('f-type').value.trim() || 'Web Application');
  fd.append('description', desc);
  fd.append('tech_stack',  tech);
  fd.append('github_url',  document.getElementById('f-github').value.trim());
  fd.append('demo_url',    document.getElementById('f-demo').value.trim());
  fd.append('is_featured', document.getElementById('f-featured').checked ? '1' : '0');
  var imageFile = document.getElementById('f-image').files[0];
  if (imageFile) fd.append('image', imageFile);

  var url = editingId ? '/admin/api/projects/' + editingId : '{{ route("admin.api.projects.store") }}';
  fd.append('_method', 'POST');

  var xhr = new XMLHttpRequest();
  xhr.open('POST', url, true);
  xhr.setRequestHeader('Accept', 'application/json');
  xhr.setRequestHeader('X-CSRF-TOKEN', CSRF);
  xhr.onreadystatechange = function () {
    if (xhr.readyState !== 4) return;
    btn.disabled = false; btn.innerHTML = '<i class="bi bi-check-lg"></i> Simpan';
    try {
      var res = JSON.parse(xhr.responseText);
      if (res.success) {
        showAlert('alert-msg', '✅ ' + res.message, 'success');
        bootstrap.Modal.getInstance(document.getElementById('projectModal')).hide();
        loadProjects();
      } else {
        var errMsg = '❌ ';
        if (res.errors) { Object.values(res.errors).forEach(function (e) { errMsg += e[0] + ' '; }); }
        else { errMsg += res.message || 'Gagal menyimpan.'; }
        showAlert('alert-msg', errMsg, 'error');
      }
    } catch (ex) { showAlert('alert-msg', '❌ Error server.', 'error'); }
  };
  xhr.send(fd);
}

function deleteProject(id, title) {
  if (!confirm('Hapus proyek "' + title + '"?')) return;
  ajaxJson('DELETE', '/admin/api/projects/' + id, null, function (status, res) {
    if (res.success) { showAlert('alert-msg', '✅ ' + res.message, 'success'); loadProjects(); }
    else { showAlert('alert-msg', '❌ Gagal menghapus.', 'error'); }
  });
}
</script>
@endpush
@endsection