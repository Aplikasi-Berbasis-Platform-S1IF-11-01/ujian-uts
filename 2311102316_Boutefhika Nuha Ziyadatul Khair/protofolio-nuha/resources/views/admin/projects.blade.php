@extends('layouts.admin')
@section('title', 'Proyek')

@section('content')
<div style="display:grid;grid-template-columns:1fr 360px;gap:20px;align-items:start">

  <!-- Projects List -->
  <div class="card">
    <div class="card-title">🚀 Daftar Proyek ({{ $projects->count() }})</div>
    @if($projects->isEmpty())
      <div style="text-align:center;padding:40px;color:var(--text-soft)">
        <div style="font-size:2.5rem;margin-bottom:12px">🚀</div>
        <p>Belum ada proyek. Tambahkan dari form di samping!</p>
      </div>
    @else
      <div style="display:grid;gap:14px">
        @foreach($projects as $project)
        <div style="border:1px solid var(--border);border-radius:14px;overflow:hidden;display:flex">
          <!-- Thumbnail -->
          <div style="width:90px;flex-shrink:0;background:linear-gradient(135deg,var(--rose-light),var(--blush));display:flex;align-items:center;justify-content:center;font-size:2rem">
            @if($project->image)
              <img src="{{ asset('storage/'.$project->image) }}" style="width:100%;height:100%;object-fit:cover">
            @else
              🚀
            @endif
          </div>
          <!-- Info -->
          <div style="flex:1;padding:16px">
            <div style="display:flex;justify-content:space-between;align-items:flex-start">
              <div>
                <div style="font-weight:600;color:var(--text-dark);font-size:0.9rem">{{ $project->title }}</div>
                @if($project->tech_stack)
                  <div style="font-size:0.68rem;color:var(--rose);margin-top:3px">{{ $project->tech_stack }}</div>
                @endif
                @if($project->description)
                  <div style="font-size:0.75rem;color:var(--text-soft);margin-top:5px;line-height:1.5">{{ Str::limit($project->description, 80) }}</div>
                @endif
              </div>
              <div style="display:flex;gap:5px;margin-left:12px;flex-shrink:0">
                <button onclick="openEditProject(
                  {{ $project->id }},
                  '{{ addslashes($project->title) }}',
                  '{{ addslashes($project->description ?? '') }}',
                  '{{ addslashes($project->tech_stack ?? '') }}',
                  '{{ addslashes($project->url ?? '') }}',
                  {{ $project->sort_order }},
                  {{ $project->is_active ? 'true' : 'false' }}
                )" class="btn btn-outline btn-sm">Edit</button>
                <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Hapus proyek ini?')">
                  @csrf @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </div>
            </div>
            <div style="display:flex;align-items:center;gap:8px;margin-top:8px">
              <span class="badge {{ $project->is_active ? 'badge-active' : 'badge-inactive' }}">{{ $project->is_active ? 'Aktif' : 'Nonaktif' }}</span>
              @if($project->url && $project->url !== '#')
                <a href="{{ $project->url }}" target="_blank" style="font-size:0.68rem;color:var(--rose);text-decoration:none">↗ Lihat</a>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>
    @endif
  </div>

  <!-- Add Form -->
  <div class="card">
    <div class="card-title">➕ Tambah Proyek</div>
    <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label>Nama Proyek *</label>
        <input type="text" name="title" required placeholder="Web Skribee, Analisis Sentimen...">
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="description" rows="4" placeholder="Ceritakan proyek ini secara singkat..."></textarea>
      </div>
      <div class="form-group">
        <label>Tech Stack</label>
        <input type="text" name="tech_stack" placeholder="Laravel, Bootstrap, MySQL">
        <div style="font-size:0.68rem;color:var(--text-soft);margin-top:4px">Pisah dengan koma</div>
      </div>
      <div class="form-group">
        <label>URL / Link Proyek</label>
        <input type="text" name="url" placeholder="https://github.com/... atau #">
      </div>
      <div class="form-group">
        <label>Thumbnail Gambar</label>
        <input type="file" name="image" accept="image/*" style="padding:8px;font-size:0.8rem">
        <div style="font-size:0.68rem;color:var(--text-soft);margin-top:4px">JPG/PNG, maks 2MB</div>
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">➕ Tambah Proyek</button>
    </form>
  </div>
</div>

<!-- Edit Modal -->
<div class="modal-overlay" id="modal-edit-project">
  <div class="modal" style="max-width:580px">
    <div class="modal-title">
      ✏️ Edit Proyek
      <button class="modal-close" onclick="closeModal('modal-edit-project')">✕</button>
    </div>
    <form method="POST" id="edit-project-form" enctype="multipart/form-data">
      @csrf @method('PUT')
      <div class="form-group">
        <label>Nama Proyek *</label>
        <input type="text" name="title" id="edit-proj-title" required>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="description" id="edit-proj-desc" rows="4"></textarea>
      </div>
      <div class="form-group">
        <label>Tech Stack</label>
        <input type="text" name="tech_stack" id="edit-proj-tech">
      </div>
      <div class="form-group">
        <label>URL Proyek</label>
        <input type="text" name="url" id="edit-proj-url">
      </div>
      <div class="form-group">
        <label>Ganti Gambar (opsional)</label>
        <input type="file" name="image" accept="image/*" style="padding:8px;font-size:0.8rem">
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
        <div class="form-group">
          <label>Urutan</label>
          <input type="number" name="sort_order" id="edit-proj-order">
        </div>
        <div class="form-group" style="display:flex;align-items:flex-end;padding-bottom:2px">
          <div style="display:flex;align-items:center;gap:8px">
            <input type="checkbox" name="is_active" id="edit-proj-active" value="1" style="width:auto">
            <label for="edit-proj-active" style="text-transform:none;letter-spacing:0;font-size:0.83rem;cursor:pointer;margin:0">Aktif</label>
          </div>
        </div>
      </div>
      <div style="display:flex;gap:10px;margin-top:8px">
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
        <button type="button" class="btn btn-outline" onclick="closeModal('modal-edit-project')">Batal</button>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
function openEditProject(id, title, desc, tech, url, order, active) {
  document.getElementById('edit-project-form').action = `/admin/projects/${id}`;
  document.getElementById('edit-proj-title').value = title;
  document.getElementById('edit-proj-desc').value = desc;
  document.getElementById('edit-proj-tech').value = tech;
  document.getElementById('edit-proj-url').value = url;
  document.getElementById('edit-proj-order').value = order;
  document.getElementById('edit-proj-active').checked = active;
  document.getElementById('modal-edit-project').classList.add('open');
}
function closeModal(id) { document.getElementById(id).classList.remove('open'); }
document.querySelectorAll('.modal-overlay').forEach(el => {
  el.addEventListener('click', e => { if (e.target === el) el.classList.remove('open'); });
});
</script>
@endpush
@endsection