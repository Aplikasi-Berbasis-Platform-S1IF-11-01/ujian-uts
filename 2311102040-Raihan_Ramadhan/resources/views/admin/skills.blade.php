@extends('layouts.admin')
@section('title', 'Kelola Skills')
@section('page-title', 'Kelola Skills')
@section('page-subtitle', 'Tambah, edit, dan hapus skill yang tampil di portfolio')

@section('content')
<div id="alert-msg" class="alert-custom"></div>

<div class="row g-4">
  <!-- Form Tambah -->
  <div class="col-lg-4">
    <div class="admin-card">
      <div class="admin-card-header">
        <div class="admin-card-title"><i class="bi bi-plus-circle" style="color:#1d6cf0"></i> <span id="form-title">Tambah Skill</span></div>
      </div>
      <div class="p-4">
        <input type="hidden" id="edit-id">
        <div class="mb-3">
          <label class="form-label">Nama Skill *</label>
          <input type="text" class="form-control" id="f-name" placeholder="Cth: JavaScript, Laravel">
        </div>
        <div class="mb-3">
          <label class="form-label">Kategori *</label>
          <select class="form-select" id="f-category">
            <option value="frontend">Frontend</option>
            <option value="backend">Backend</option>
            <option value="tools">Tools</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Persentase Kemahiran: <strong id="pct-display">80</strong>%</label>
          <input type="range" class="skill-range form-range" id="f-percentage" min="0" max="100" value="80"
            oninput="document.getElementById('pct-display').textContent=this.value">
        </div>
        <div class="mb-4">
          <label class="form-label">Icon Bootstrap</label>
          <input type="text" class="form-control" id="f-icon" placeholder="bi-code-slash">
          <small class="text-muted">Cek: <a href="https://icons.getbootstrap.com" target="_blank">icons.getbootstrap.com</a></small>
        </div>
        <div class="d-flex gap-2">
          <button class="btn-primary-custom" id="btn-save" onclick="saveSkill()">
            <i class="bi bi-check-lg"></i> Simpan
          </button>
          <button class="btn-edit-custom" id="btn-cancel" onclick="resetForm()" style="display:none">
            <i class="bi bi-x"></i> Batal
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabel Skill -->
  <div class="col-lg-8">
    <div class="admin-card">
      <div class="admin-card-header">
        <div class="admin-card-title"><i class="bi bi-lightning-charge" style="color:#1d6cf0"></i> Daftar Skills</div>
        <small class="text-muted" style="font-family:'JetBrains Mono',monospace;font-size:.65rem">Data via AJAX</small>
      </div>
      <div style="overflow-x:auto">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Skill</th>
              <th>Kategori</th>
              <th>Level</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="skills-tbody">
            <tr><td colspan="4" style="text-align:center;color:#94a3b8;padding:2rem"><i class="bi bi-hourglass-split me-2"></i>Memuat...</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
function loadSkills() {
  ajaxJson('GET', '{{ route("admin.api.skills") }}', null, function (status, res) {
    var tbody = document.getElementById('skills-tbody');
    if (!res.success) { tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted">Gagal memuat data.</td></tr>'; return; }
    if (!res.data.length) { tbody.innerHTML = '<tr><td colspan="4" class="text-center text-muted">Belum ada skill. Tambahkan sekarang!</td></tr>'; return; }
    tbody.innerHTML = '';
    res.data.forEach(function (s) {
      var catClass = s.category === 'frontend' ? 'frontend' : s.category === 'backend' ? 'backend' : 'tools';
      var tr = document.createElement('tr');
      tr.innerHTML =
        '<td><div style="display:flex;align-items:center;gap:.6rem"><i class="bi ' + esc(s.icon || 'bi-gear') + '" style="color:#1d6cf0;font-size:1.1rem"></i><span style="font-weight:600">' + esc(s.name) + '</span></div></td>' +
        '<td><span class="badge-cat ' + catClass + '">' + esc(s.category) + '</span></td>' +
        '<td style="min-width:150px"><div style="display:flex;align-items:center;gap:.6rem"><div style="flex:1;height:5px;background:#f1f5f9;border-radius:99px;overflow:hidden"><div style="width:' + s.percentage + '%;height:100%;background:linear-gradient(90deg,#1d6cf0,#06b6d4);border-radius:99px"></div></div><span style="font-family:monospace;font-size:.75rem;color:#1d6cf0;font-weight:600;min-width:30px">' + s.percentage + '%</span></div></td>' +
        '<td><div style="display:flex;gap:.4rem">' +
          '<button class="btn-edit-custom" onclick="editSkill(' + JSON.stringify(s).replace(/"/g, '&quot;') + ')"><i class="bi bi-pencil"></i></button>' +
          '<button class="btn-danger-custom" onclick="deleteSkill(' + s.id + ', \'' + esc(s.name) + '\')"><i class="bi bi-trash"></i></button>' +
        '</div></td>';
      tbody.appendChild(tr);
    });
  });
}
loadSkills();

function saveSkill() {
  var id = document.getElementById('edit-id').value;
  var data = {
    name:       document.getElementById('f-name').value.trim(),
    category:   document.getElementById('f-category').value,
    percentage: parseInt(document.getElementById('f-percentage').value),
    icon:       document.getElementById('f-icon').value.trim(),
  };
  if (!data.name) { showAlert('alert-msg', '❌ Nama skill wajib diisi.', 'error'); return; }

  var btn = document.getElementById('btn-save');
  btn.disabled = true; btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyimpan...';

  if (id) {
    ajaxJson('PUT', '/admin/api/skills/' + id, data, function (status, res) {
      btn.disabled = false; btn.innerHTML = '<i class="bi bi-check-lg"></i> Simpan';
      if (res.success) { showAlert('alert-msg', '✅ ' + res.message, 'success'); resetForm(); loadSkills(); }
      else { showAlert('alert-msg', '❌ Gagal: ' + (res.message || 'error'), 'error'); }
    });
  } else {
    ajaxJson('POST', '{{ route("admin.api.skills.store") }}', data, function (status, res) {
      btn.disabled = false; btn.innerHTML = '<i class="bi bi-check-lg"></i> Simpan';
      if (res.success) { showAlert('alert-msg', '✅ ' + res.message, 'success'); resetForm(); loadSkills(); }
      else { showAlert('alert-msg', '❌ Gagal: ' + (res.message || 'error'), 'error'); }
    });
  }
}

function editSkill(s) {
  document.getElementById('edit-id').value          = s.id;
  document.getElementById('f-name').value           = s.name;
  document.getElementById('f-category').value       = s.category;
  document.getElementById('f-percentage').value     = s.percentage;
  document.getElementById('pct-display').textContent = s.percentage;
  document.getElementById('f-icon').value           = s.icon || '';
  document.getElementById('form-title').textContent = 'Edit Skill';
  document.getElementById('btn-cancel').style.display = 'inline-flex';
  document.getElementById('f-name').focus();
}

function deleteSkill(id, name) {
  if (!confirm('Hapus skill "' + name + '"?')) return;
  ajaxJson('DELETE', '/admin/api/skills/' + id, null, function (status, res) {
    if (res.success) { showAlert('alert-msg', '✅ ' + res.message, 'success'); loadSkills(); }
    else { showAlert('alert-msg', '❌ Gagal menghapus.', 'error'); }
  });
}

function resetForm() {
  document.getElementById('edit-id').value = '';
  document.getElementById('f-name').value = '';
  document.getElementById('f-percentage').value = 80;
  document.getElementById('pct-display').textContent = '80';
  document.getElementById('f-icon').value = '';
  document.getElementById('form-title').textContent = 'Tambah Skill';
  document.getElementById('btn-cancel').style.display = 'none';
}
</script>
@endpush
@endsection