@extends('layouts.admin')
@section('title', 'Pengalaman')

@push('styles')
<style>
/* ── Timeline ── */
.exp-timeline { position: relative; padding-left: 40px; }
.exp-timeline::before {
  content: '';
  position: absolute; left: 13px; top: 8px; bottom: 8px;
  width: 2px;
  background: linear-gradient(to bottom, var(--rose), var(--rose-light));
  border-radius: 2px;
}
.exp-entry { position: relative; margin-bottom: 28px; }
.exp-entry:last-child { margin-bottom: 0; }
.exp-dot {
  position: absolute; left: -31px; top: 20px;
  width: 14px; height: 14px; border-radius: 50%;
  background: var(--rose); border: 3px solid var(--white);
  box-shadow: 0 0 0 2px var(--rose-light); z-index: 1;
}

/* Card */
.exp-card {
  background: var(--white); border: 1px solid var(--border);
  border-radius: 16px; overflow: hidden;
  transition: box-shadow 0.2s, border-color 0.2s;
}
.exp-card:hover {
  box-shadow: 0 4px 24px rgba(200,114,138,0.12);
  border-color: var(--rose-light);
}
.exp-card-top {
  background: linear-gradient(135deg, var(--rose-pale), var(--blush));
  padding: 18px 22px 14px;
  border-bottom: 1px solid var(--border);
  display: flex; justify-content: space-between;
  align-items: flex-start; gap: 12px;
}
.exp-company {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.25rem; font-weight: 600;
  color: var(--text-dark); line-height: 1.2; margin-bottom: 3px;
}
.exp-position { font-size: 0.78rem; color: var(--rose); font-weight: 600; letter-spacing: 0.04em; }
.exp-pills { display: flex; flex-wrap: wrap; gap: 6px; margin-top: 10px; }
.exp-pill {
  display: inline-flex; align-items: center; gap: 4px;
  background: var(--white); border: 1px solid var(--rose-light);
  color: var(--text-mid); font-size: 0.68rem; font-weight: 600;
  padding: 3px 10px; border-radius: 20px;
}
.exp-actions { display: flex; gap: 6px; flex-shrink: 0; margin-top: 2px; }
.exp-btn {
  display: inline-flex; align-items: center; gap: 5px;
  padding: 6px 14px; border-radius: 20px;
  font-size: 0.72rem; font-weight: 600; cursor: pointer;
  transition: all 0.18s; border: none;
  font-family: 'DM Sans', sans-serif;
}
.exp-btn-edit {
  background: var(--white); border: 1px solid var(--border); color: var(--text-mid);
}
.exp-btn-edit:hover { border-color: var(--rose-mid); color: var(--rose); background: var(--rose-pale); }
.exp-btn-del { background: #fef0f0; border: 1px solid #f0c0c0; color: var(--danger); }
.exp-btn-del:hover { background: var(--danger); color: white; border-color: var(--danger); }

.exp-card-body { padding: 18px 22px; }
.exp-resp-item {
  display: flex; gap: 10px; align-items: flex-start;
  font-size: 0.8rem; color: var(--text-mid); line-height: 1.55;
  margin-bottom: 8px;
}
.exp-resp-item:last-child { margin-bottom: 0; }
.exp-resp-item::before {
  content: ''; width: 6px; height: 6px; border-radius: 50%;
  background: var(--rose-mid); margin-top: 6px; flex-shrink: 0;
}

/* Empty */
.empty-state {
  text-align: center; padding: 56px 24px;
  background: var(--white); border: 1px dashed var(--border);
  border-radius: 16px; color: var(--text-soft);
}
.empty-state .ei { font-size: 2.5rem; margin-bottom: 12px; opacity: 0.5; }
.empty-state p { font-size: 0.85rem; margin-bottom: 16px; }

/* Modal helpers */
.mrow   { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.mrow3  { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 12px; }
.mgrp   { margin-bottom: 14px; }
.mgrp label {
  display: block; font-size: 0.68rem; font-weight: 700;
  letter-spacing: 0.08em; text-transform: uppercase;
  color: var(--text-mid); margin-bottom: 5px;
}
.mlabel {
  font-size: 0.62rem; font-weight: 700; letter-spacing: 0.15em;
  text-transform: uppercase; color: var(--text-soft);
  margin: 18px 0 10px; padding-bottom: 6px;
  border-bottom: 1px solid var(--border); display: block;
}
.mfoot {
  display: flex; justify-content: flex-end; gap: 10px;
  padding-top: 20px; margin-top: 8px;
  border-top: 1px solid var(--border);
}

/* Page header */
.page-hd { display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px; }
.page-hd h2 { font-family: 'Cormorant Garamond', serif; font-size: 1.6rem; font-weight: 600; color: var(--text-dark); }
.page-hd p { font-size: 0.8rem; color: var(--text-soft); margin-top: 2px; }
</style>
@endpush

@section('content')

<div class="page-hd">
  <div>
    <h2>Pengalaman Kerja</h2>
    <p>Kelola riwayat magang dan pengalaman kerja kamu.</p>
  </div>
  <button class="btn btn-primary" type="button" onclick="openModal('addExpModal')">
    + &nbsp;Tambah Pengalaman
  </button>
</div>

@if($experiences->isNotEmpty())
<div class="exp-timeline">
  @foreach($experiences as $exp)
  <div class="exp-entry">
    <div class="exp-dot"></div>
    <div class="exp-card">

      <div class="exp-card-top">
        <div style="flex:1">
          <div class="exp-company">{{ $exp->company }}</div>
          <div class="exp-position">{{ $exp->position }}</div>
          <div class="exp-pills">
            @if($exp->year)
              <span class="exp-pill">📅 {{ $exp->year }}{{ $exp->duration ? ' · '.$exp->duration : '' }}</span>
            @endif
            @if($exp->location)
              <span class="exp-pill">📍 {{ $exp->location }}</span>
            @endif
            <span class="exp-pill"
              style="background:{{ $exp->is_active ? '#edf7f1' : '#f5f5f5' }};
                     border-color:{{ $exp->is_active ? '#b8e2c8' : '#e0e0e0' }};
                     color:{{ $exp->is_active ? '#2d7a4e' : '#999' }}">
              {{ $exp->is_active ? '● Aktif' : '○ Nonaktif' }}
            </span>
          </div>
        </div>

        <div class="exp-actions">
          <button type="button" class="exp-btn exp-btn-edit"
            onclick="openEditExp(this)"
            data-id="{{ $exp->id }}"
            data-company="{{ addslashes($exp->company) }}"
            data-position="{{ addslashes($exp->position) }}"
            data-location="{{ addslashes($exp->location ?? '') }}"
            data-year="{{ $exp->year }}"
            data-duration="{{ $exp->duration }}"
            data-order="{{ $exp->sort_order }}"
            data-active="{{ $exp->is_active ? '1' : '0' }}"
            data-resp='@json($exp->responsibilities ?? [])'
          >✎ Edit</button>
          <button type="button" class="exp-btn exp-btn-del"
            onclick="submitDelete('{{ route('admin.experience.destroy', $exp) }}')">
            ✕ Hapus
          </button>
        </div>
      </div>

      @if(is_array($exp->responsibilities) && count($exp->responsibilities))
      <div class="exp-card-body">
        @foreach($exp->responsibilities as $r)
          <div class="exp-resp-item">{{ $r }}</div>
        @endforeach
      </div>
      @endif

    </div>
  </div>
  @endforeach
</div>

@else
<div class="empty-state">
  <div class="ei">💼</div>
  <p>Belum ada data pengalaman kerja.</p>
  <button type="button" class="btn btn-primary" onclick="openModal('addExpModal')">+ Tambah Sekarang</button>
</div>
@endif


{{-- ── MODAL TAMBAH ── --}}
<div class="modal-overlay" id="addExpModal" style="display:none">
  <div class="modal" style="max-width:600px">
    <div class="modal-title">
      <span>Tambah Pengalaman</span>
      <button class="modal-close" type="button" onclick="closeModal('addExpModal')">✕</button>
    </div>
    <form action="{{ route('admin.experience.store') }}" method="POST">
      @csrf
      <span class="mlabel">Informasi Utama</span>
      <div class="mrow">
        <div class="mgrp"><label>Nama Perusahaan *</label><input type="text" name="company" placeholder="PT SIMS" required></div>
        <div class="mgrp"><label>Posisi / Jabatan *</label><input type="text" name="position" placeholder="Admin Teknisi WiFi" required></div>
      </div>
      <span class="mlabel">Detail</span>
      <div class="mrow3">
        <div class="mgrp"><label>Lokasi</label><input type="text" name="location" placeholder="Yogyakarta"></div>
        <div class="mgrp"><label>Tahun *</label><input type="text" name="year" placeholder="2022" required></div>
        <div class="mgrp"><label>Durasi</label><input type="text" name="duration" placeholder="3 bulan"></div>
      </div>
      <span class="mlabel">Deskripsi Tugas</span>
      <div class="mgrp">
        <label>Tugas / Tanggung Jawab</label>
        <textarea name="responsibilities" rows="7"
          placeholder="Tulis satu tugas per baris:&#10;Melakukan monitoring jaringan WiFi.&#10;Menangani laporan gangguan pelanggan."></textarea>
        <div style="font-size:.7rem;color:var(--text-soft);margin-top:4px">Satu baris = satu poin yang ditampilkan.</div>
      </div>
      <div class="mfoot">
        <button type="button" class="btn btn-outline" onclick="closeModal('addExpModal')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Pengalaman</button>
      </div>
    </form>
  </div>
</div>


{{-- ── MODAL EDIT ── --}}
<div class="modal-overlay" id="editExpModal" style="display:none">
  <div class="modal" style="max-width:600px">
    <div class="modal-title">
      <span>Edit Pengalaman</span>
      <button class="modal-close" type="button" onclick="closeModal('editExpModal')">✕</button>
    </div>
    <form id="editExpForm" method="POST">
      @csrf
      @method('PUT')
      <span class="mlabel">Informasi Utama</span>
      <div class="mrow">
        <div class="mgrp"><label>Nama Perusahaan *</label><input type="text" name="company" id="exCompany" required></div>
        <div class="mgrp"><label>Posisi / Jabatan *</label><input type="text" name="position" id="exPosition" required></div>
      </div>
      <span class="mlabel">Detail</span>
      <div class="mrow3">
        <div class="mgrp"><label>Lokasi</label><input type="text" name="location" id="exLocation"></div>
        <div class="mgrp"><label>Tahun</label><input type="text" name="year" id="exYear"></div>
        <div class="mgrp"><label>Durasi</label><input type="text" name="duration" id="exDuration"></div>
      </div>
      <span class="mlabel">Deskripsi Tugas</span>
      <div class="mgrp">
        <label>Tugas / Tanggung Jawab</label>
        <textarea name="responsibilities" id="exResp" rows="7"></textarea>
        <div style="font-size:.7rem;color:var(--text-soft);margin-top:4px">Satu baris = satu poin.</div>
      </div>
      <span class="mlabel">Lainnya</span>
      <div class="mrow">
        <div class="mgrp"><label>Urutan Tampil</label><input type="number" name="sort_order" id="exOrder" min="0"></div>
        <div class="mgrp" style="display:flex;align-items:flex-end;padding-bottom:6px">
          <label style="display:flex;align-items:center;gap:8px;text-transform:none;letter-spacing:0;font-size:.82rem;color:var(--text-mid);cursor:pointer">
            <input type="checkbox" name="is_active" id="exActive" value="1" style="width:16px;height:16px;accent-color:var(--rose)">
            Tampilkan di portfolio
          </label>
        </div>
      </div>
      <div class="mfoot">
        <button type="button" class="btn btn-outline" onclick="closeModal('editExpModal')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>

@endsection

@push('scripts')
<script>
const expBase = "{{ url('admin/experience') }}";

function openEditExp(btn) {
  const d = btn.dataset;
  document.getElementById('editExpForm').action = expBase + '/' + d.id;
  document.getElementById('exCompany').value   = d.company  || '';
  document.getElementById('exPosition').value  = d.position || '';
  document.getElementById('exLocation').value  = d.location || '';
  document.getElementById('exYear').value      = d.year     || '';
  document.getElementById('exDuration').value  = d.duration || '';
  document.getElementById('exOrder').value     = d.order    || 0;
  document.getElementById('exActive').checked  = d.active === '1';
  try {
    const resp = JSON.parse(d.resp || '[]');
    document.getElementById('exResp').value = Array.isArray(resp) ? resp.join('\n') : '';
  } catch(e) { document.getElementById('exResp').value = ''; }
  openModal('editExpModal');
}
</script>
@endpush