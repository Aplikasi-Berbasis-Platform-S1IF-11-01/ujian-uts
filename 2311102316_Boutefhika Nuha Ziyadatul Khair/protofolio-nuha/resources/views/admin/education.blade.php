@extends('layouts.admin')
@section('title', 'Pendidikan')

@section('content')
<div style="display:grid;grid-template-columns:1fr 360px;gap:20px;align-items:start">

  <!-- List -->
  <div class="card">
    <div class="card-title">🎓 Riwayat Pendidikan ({{ $educations->count() }})</div>
    @if($educations->isEmpty())
      <div style="text-align:center;padding:40px;color:var(--text-soft)">
        <div style="font-size:2.5rem;margin-bottom:12px">🎓</div>
        <p>Belum ada data pendidikan. Tambahkan dari form di samping!</p>
      </div>
    @else
      @foreach($educations as $edu)
      <div style="border:1px solid var(--border);border-radius:14px;padding:20px;margin-bottom:12px;position:relative;overflow:hidden">
        <div style="position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,var(--rose),var(--rose-mid))"></div>
        <div style="display:flex;justify-content:space-between;align-items:flex-start">
          <div>
            <div style="font-family:'Cormorant Garamond',serif;font-size:1.1rem;font-weight:600;color:var(--text-dark)">{{ $edu->institution }}</div>
            <div style="font-size:0.78rem;color:var(--text-soft);margin-top:2px">
              {{ implode(' · ', array_filter([$edu->degree, $edu->major])) }}
            </div>
            <div style="font-size:0.7rem;color:var(--rose);margin-top:4px;font-family:'Space Mono',monospace">
              {{ $edu->year_start }} – {{ $edu->year_end ?? 'Sekarang' }}
            </div>
            @if($edu->description)
              <div style="font-size:0.77rem;color:var(--text-mid);margin-top:8px;line-height:1.6">{{ $edu->description }}</div>
            @endif
          </div>
          <div style="display:flex;gap:6px;margin-left:16px;flex-shrink:0">
            <button onclick="openEditEdu({{ $edu->id }}, '{{ addslashes($edu->institution) }}', '{{ addslashes($edu->major ?? '') }}', '{{ addslashes($edu->degree ?? '') }}', '{{ $edu->year_start }}', '{{ $edu->year_end ?? '' }}', '{{ addslashes($edu->description ?? '') }}', {{ $edu->sort_order }}, {{ $edu->is_active ? 'true' : 'false' }})" class="btn btn-outline btn-sm">Edit</button>
            <form method="POST" action="{{ route('admin.education.destroy', $edu) }}" onsubmit="return confirm('Hapus data ini?')">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
            </form>
          </div>
        </div>
        <span class="badge {{ $edu->is_active ? 'badge-active' : 'badge-inactive' }}" style="margin-top:10px;display:inline-block">{{ $edu->is_active ? 'Aktif' : 'Nonaktif' }}</span>
      </div>
      @endforeach
    @endif
  </div>

  <!-- Add Form -->
  <div class="card">
    <div class="card-title">➕ Tambah Pendidikan</div>
    <form method="POST" action="{{ route('admin.education.store') }}">
      @csrf
      <div class="form-group">
        <label>Nama Institusi *</label>
        <input type="text" name="institution" required placeholder="Universitas Jenderal Soedirman">
      </div>
      <div class="form-group">
        <label>Jenjang</label>
        <select name="degree">
          <option value="">-- Pilih --</option>
          <option value="SD">SD</option>
          <option value="SMP">SMP</option>
          <option value="SMA">SMA/SMK</option>
          <option value="D3">D3</option>
          <option value="S1">S1</option>
          <option value="S2">S2</option>
          <option value="S3">S3</option>
        </select>
      </div>
      <div class="form-group">
        <label>Jurusan / Program Studi</label>
        <input type="text" name="major" placeholder="Teknik Informatika">
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
        <div class="form-group">
          <label>Tahun Masuk *</label>
          <input type="text" name="year_start" required placeholder="2023">
        </div>
        <div class="form-group">
          <label>Tahun Lulus</label>
          <input type="text" name="year_end" placeholder="2027">
        </div>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="description" rows="3" placeholder="Aktivitas dan pencapaian selama di sini..."></textarea>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">➕ Tambah</button>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal-overlay" id="modal-edit-edu">
  <div class="modal">
    <div class="modal-title">
      ✏️ Edit Pendidikan
      <button class="modal-close" onclick="closeModal('modal-edit-edu')">✕</button>
    </div>
    <form method="POST" id="edit-edu-form">
      @csrf @method('PUT')
      <div class="form-group">
        <label>Nama Institusi *</label>
        <input type="text" name="institution" id="edit-edu-institution" required>
      </div>
      <div class="form-group">
        <label>Jenjang</label>
        <select name="degree" id="edit-edu-degree">
          <option value="">-- Pilih --</option>
          @foreach(['SD','SMP','SMA','D3','S1','S2','S3'] as $d)
            <option value="{{ $d }}">{{ $d }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label>Jurusan</label>
        <input type="text" name="major" id="edit-edu-major">
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
        <div class="form-group">
          <label>Tahun Masuk *</label>
          <input type="text" name="year_start" id="edit-edu-start" required>
        </div>
        <div class="form-group">
          <label>Tahun Lulus</label>
          <input type="text" name="year_end" id="edit-edu-end">
        </div>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="description" id="edit-edu-desc" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label>Urutan</label>
        <input type="number" name="sort_order" id="edit-edu-order">
      </div>
      <div class="form-group" style="display:flex;align-items:center;gap:10px">
        <input type="checkbox" name="is_active" id="edit-edu-active" value="1" style="width:auto">
        <label for="edit-edu-active" style="text-transform:none;letter-spacing:0;font-size:0.83rem;cursor:pointer">Aktif (tampil di portfolio)</label>
      </div>
      <div style="display:flex;gap:10px;margin-top:8px">
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
        <button type="button" class="btn btn-outline" onclick="closeModal('modal-edit-edu')">Batal</button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
function openEditEdu(id, institution, major, degree, start, end, desc, order, active) {
  document.getElementById('edit-edu-form').action = `/admin/education/${id}`;
  document.getElementById('edit-edu-institution').value = institution;
  document.getElementById('edit-edu-major').value = major;
  document.getElementById('edit-edu-degree').value = degree;
  document.getElementById('edit-edu-start').value = start;
  document.getElementById('edit-edu-end').value = end;
  document.getElementById('edit-edu-desc').value = desc;
  document.getElementById('edit-edu-order').value = order;
  document.getElementById('edit-edu-active').checked = active;
  document.getElementById('modal-edit-edu').classList.add('open');
}
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.modal-overlay').forEach(el => {
  el.addEventListener('click', e => { if (e.target === el) el.classList.remove('open'); });
});
</script>
@endpush
@endsection