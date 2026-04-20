@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang di panel admin portfolio kamu')

@section('content')
<div class="row g-4 mb-4">
  <div class="col-sm-6 col-xl-3">
    <div class="stat-card">
      <div class="stat-icon" style="background:#eff6ff;color:#1d6cf0"><i class="bi bi-person-circle"></i></div>
      <div class="stat-num">1</div>
      <div class="stat-label">Profil Aktif</div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="stat-card">
      <div class="stat-icon" style="background:#d1fae5;color:#059669"><i class="bi bi-mortarboard"></i></div>
      <div class="stat-num">{{ $educationCount }}</div>
      <div class="stat-label">Riwayat Pendidikan</div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="stat-card">
      <div class="stat-icon" style="background:#fef3c7;color:#d97706"><i class="bi bi-lightning-charge"></i></div>
      <div class="stat-num">{{ $skillCount }}</div>
      <div class="stat-label">Skills</div>
    </div>
  </div>
  <div class="col-sm-6 col-xl-3">
    <div class="stat-card">
      <div class="stat-icon" style="background:#fce7f3;color:#be185d"><i class="bi bi-folder2-open"></i></div>
      <div class="stat-num">{{ $projectCount }}</div>
      <div class="stat-label">Proyek</div>
    </div>
  </div>
</div>

<div class="row g-4">
  <div class="col-lg-8">
    <div class="admin-card">
      <div class="admin-card-header">
        <div class="admin-card-title"><i class="bi bi-lightning-charge" style="color:#1d6cf0"></i> Menu Cepat</div>
      </div>
      <div class="p-4">
        <div class="row g-3">
          <div class="col-sm-6">
            <a href="{{ route('admin.profile') }}" style="display:flex;align-items:center;gap:1rem;padding:1.25rem;background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;transition:all .2s;text-decoration:none;color:inherit" onmouseover="this.style.borderColor='#93c5fd';this.style.background='#eff6ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">
              <div style="width:44px;height:44px;background:#eff6ff;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#1d6cf0;font-size:1.2rem"><i class="bi bi-person-circle"></i></div>
              <div><div style="font-weight:700;font-size:.9rem;color:#0a1628">Edit Profil</div><div style="font-size:.78rem;color:#64748b">Nama, foto, deskripsi</div></div>
            </a>
          </div>
          <div class="col-sm-6">
            <a href="{{ route('admin.skills') }}" style="display:flex;align-items:center;gap:1rem;padding:1.25rem;background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;transition:all .2s;text-decoration:none;color:inherit" onmouseover="this.style.borderColor='#93c5fd';this.style.background='#eff6ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">
              <div style="width:44px;height:44px;background:#fef3c7;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#d97706;font-size:1.2rem"><i class="bi bi-lightning-charge"></i></div>
              <div><div style="font-weight:700;font-size:.9rem;color:#0a1628">Kelola Skills</div><div style="font-size:.78rem;color:#64748b">Tambah, edit, hapus skill</div></div>
            </a>
          </div>
          <div class="col-sm-6">
            <a href="{{ route('admin.projects') }}" style="display:flex;align-items:center;gap:1rem;padding:1.25rem;background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;transition:all .2s;text-decoration:none;color:inherit" onmouseover="this.style.borderColor='#93c5fd';this.style.background='#eff6ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">
              <div style="width:44px;height:44px;background:#fce7f3;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#be185d;font-size:1.2rem"><i class="bi bi-folder2-open"></i></div>
              <div><div style="font-weight:700;font-size:.9rem;color:#0a1628">Kelola Proyek</div><div style="font-size:.78rem;color:#64748b">Tambah, edit, hapus proyek</div></div>
            </a>
          </div>
          <div class="col-sm-6">
            <a href="{{ route('admin.education') }}" style="display:flex;align-items:center;gap:1rem;padding:1.25rem;background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;transition:all .2s;text-decoration:none;color:inherit" onmouseover="this.style.borderColor='#93c5fd';this.style.background='#eff6ff'" onmouseout="this.style.borderColor='#e2e8f0';this.style.background='#f8fafc'">
              <div style="width:44px;height:44px;background:#d1fae5;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#059669;font-size:1.2rem"><i class="bi bi-mortarboard"></i></div>
              <div><div style="font-weight:700;font-size:.9rem;color:#0a1628">Riwayat Pendidikan</div><div style="font-size:.78rem;color:#64748b">Tambah, edit, hapus edu</div></div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="admin-card">
      <div class="admin-card-header">
        <div class="admin-card-title"><i class="bi bi-info-circle" style="color:#1d6cf0"></i> Info Admin</div>
      </div>
      <div class="p-4">
        <div style="font-size:.85rem;color:#475569;line-height:1.7">
          <p><strong>Login sebagai:</strong><br>{{ auth()->user()->name ?? 'Admin' }}<br><span style="color:#94a3b8;font-size:.78rem">{{ auth()->user()->email ?? '' }}</span></p>
          <hr style="border-color:#e2e8f0;margin:1rem 0">
          <p style="color:#94a3b8;font-size:.78rem">
            <i class="bi bi-info-circle me-1"></i>
            Semua perubahan langsung tampil di halaman portfolio via AJAX tanpa reload halaman.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection