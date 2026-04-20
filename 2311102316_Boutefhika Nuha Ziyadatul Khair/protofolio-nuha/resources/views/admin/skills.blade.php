@extends('layouts.admin')
@section('title', 'Keahlian')

@section('content')
<div style="display:grid;grid-template-columns:1fr 340px;gap:20px;align-items:start">

  <!-- Skills List -->
  <div class="card">
    <div class="card-title">💡 Daftar Keahlian ({{ $skills->count() }})</div>
    @if($skills->isEmpty())
      <div style="text-align:center;padding:40px;color:var(--text-soft)">
        <div style="font-size:2.5rem;margin-bottom:12px">💡</div>
        <p>Belum ada skill. Tambahkan dari form di samping!</p>
      </div>
    @else
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Icon</th>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($skills as $skill)
            <tr>
              <td style="font-size:1.3rem">{{ $skill->icon }}</td>
              <td style="font-weight:500;color:var(--text-dark)">{{ $skill->name }}</td>
              <td>
                <span style="font-size:0.68rem;background:var(--blush);color:var(--rose);padding:3px 10px;border-radius:20px;font-weight:600">
                  {{ $skill->category }}
                </span>
              </td>
              <td>
                <span class="badge {{ $skill->is_active ? 'badge-active' : 'badge-inactive' }}">
                  {{ $skill->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
              </td>
              <td>
                <div style="display:flex;gap:6px">
                  <button onclick="openEditSkill({{ $skill->id }}, '{{ addslashes($skill->name) }}', '{{ addslashes($skill->icon) }}', '{{ $skill->category }}', {{ $skill->sort_order }}, {{ $skill->is_active ? 'true' : 'false' }})" class="btn btn-outline btn-sm">Edit</button>
                  <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" onsubmit="return confirm('Hapus skill ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>

  <!-- Add Form -->
  <div>
    <div class="card">
      <div class="card-title">➕ Tambah Skill</div>
      <form method="POST" action="{{ route('admin.skills.store') }}">
        @csrf
        <div class="form-group">
          <label>Nama Skill *</label>
          <input type="text" name="name" required placeholder="Laravel, Python, Figma...">
        </div>
        <div class="form-group">
          <label>Emoji Icon</label>
          <input type="text" name="icon" placeholder="💡" maxlength="10" style="font-size:1.2rem">
          <div style="font-size:0.68rem;color:var(--text-soft);margin-top:4px">
            Contoh: 💻 🐍 ☕ 🌐 🗄 🎨 🔴 🐘 ⚡ 🌿
          </div>
        </div>
        <div class="form-group">
          <label>Kategori</label>
          <select name="category">
            <option value="programming">Programming</option>
            <option value="web">Web Development</option>
            <option value="database">Database</option>
            <option value="design">Desain</option>
            <option value="tools">Tools</option>
            <option value="other">Lainnya</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">➕ Tambah Skill</button>
      </form>
    </div>

    <div class="card" style="background:var(--rose-pale);border-color:var(--rose-light)">
      <div style="font-size:0.75rem;color:var(--text-mid);line-height:1.8">
        <strong>Kategori tersedia:</strong><br>
        🔵 <strong>Programming</strong> — C++, Python, Java<br>
        🔵 <strong>Web</strong> — HTML, PHP, Laravel, JS<br>
        🔵 <strong>Database</strong> — SQL, MongoDB<br>
        🔵 <strong>Design</strong> — Figma, Canva<br>
        🔵 <strong>Tools</strong> — Git, VSCode
      </div>
    </div>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal-overlay" id="modal-edit-skill">
  <div class="modal">
    <div class="modal-title">
      ✏️ Edit Skill
      <button class="modal-close" onclick="closeModal('modal-edit-skill')">✕</button>
    </div>
    <form method="POST" id="edit-skill-form">
      @csrf @method('PUT')
      <div class="form-group">
        <label>Nama Skill *</label>
        <input type="text" name="name" id="edit-skill-name" required>
      </div>
      <div class="form-group">
        <label>Emoji Icon</label>
        <input type="text" name="icon" id="edit-skill-icon" maxlength="10" style="font-size:1.2rem">
      </div>
      <div class="form-group">
        <label>Kategori</label>
        <select name="category" id="edit-skill-category">
          <option value="programming">Programming</option>
          <option value="web">Web Development</option>
          <option value="database">Database</option>
          <option value="design">Desain</option>
          <option value="tools">Tools</option>
          <option value="other">Lainnya</option>
        </select>
      </div>
      <div class="form-group">
        <label>Urutan</label>
        <input type="number" name="sort_order" id="edit-skill-order">
      </div>
      <div class="form-group" style="display:flex;align-items:center;gap:10px">
        <input type="checkbox" name="is_active" id="edit-skill-active" value="1" style="width:auto">
        <label for="edit-skill-active" style="text-transform:none;letter-spacing:0;font-size:0.83rem;cursor:pointer">Skill aktif (tampil di portfolio)</label>
      </div>
      <div style="display:flex;gap:10px;margin-top:8px">
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
        <button type="button" class="btn btn-outline" onclick="closeModal('modal-edit-skill')">Batal</button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
function openEditSkill(id, name, icon, category, order, active) {
  document.getElementById('edit-skill-form').action = `/admin/skills/${id}`;
  document.getElementById('edit-skill-name').value = name;
  document.getElementById('edit-skill-icon').value = icon;
  document.getElementById('edit-skill-category').value = category;
  document.getElementById('edit-skill-order').value = order;
  document.getElementById('edit-skill-active').checked = active;
  document.getElementById('modal-edit-skill').classList.add('open');
}
function closeModal(id) {
  document.getElementById(id).classList.remove('open');
}
// Close on backdrop click
document.querySelectorAll('.modal-overlay').forEach(el => {
  el.addEventListener('click', e => { if (e.target === el) el.classList.remove('open'); });
});
</script>
@endpush
@endsection