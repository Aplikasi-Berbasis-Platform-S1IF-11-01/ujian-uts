@extends('layouts.admin')
@section('title', 'Pengaturan')

@section('content')
<div style="max-width:700px">

  <form method="POST" action="{{ route('admin.settings.update') }}">
    @csrf

    <!-- API Keys -->
    <div class="card">
      <div class="card-title">🔑 API Keys & Integrasi</div>
      <div class="form-group">
        <label>GitHub Personal Access Token</label>
        <input type="password" name="github_token" value="{{ $github_token }}" placeholder="ghp_xxxxxxxxxxxx (opsional, untuk repo private)">
        <div style="font-size:0.72rem;color:var(--text-soft);margin-top:5px;line-height:1.6">
          Buat di: <a href="https://github.com/settings/tokens" target="_blank" style="color:var(--rose)">github.com/settings/tokens</a> · Scope: <code style="background:var(--rose-pale);padding:1px 6px;border-radius:4px">public_repo</code>
        </div>
      </div>
      <div class="form-group">
        <label>Quote API Key (API Ninjas)</label>
        <input type="password" name="quote_api_key" value="{{ $quote_api_key }}" placeholder="API key dari api-ninjas.com">
        <div style="font-size:0.72rem;color:var(--text-soft);margin-top:5px">
          Daftar gratis di <a href="https://api-ninjas.com" target="_blank" style="color:var(--rose)">api-ninjas.com</a>
        </div>
      </div>
    </div>

    <!-- Display Options -->
    <div class="card">
      <div class="card-title">👁 Tampilan Portfolio</div>
      <div style="display:flex;flex-direction:column;gap:14px">
        <label style="display:flex;align-items:center;gap:12px;cursor:pointer;padding:14px 16px;border:1px solid var(--border);border-radius:12px;transition:all 0.2s" onmouseover="this.style.borderColor='var(--rose-light)'" onmouseout="this.style.borderColor='var(--border)'">
          <input type="checkbox" name="show_github" value="1" {{ $show_github == '1' ? 'checked' : '' }} style="width:18px;height:18px;accent-color:var(--rose)">
          <div>
            <div style="font-size:0.85rem;font-weight:600;color:var(--text-dark);text-transform:none;letter-spacing:0">🐙 Tampilkan Seksi GitHub</div>
            <div style="font-size:0.73rem;color:var(--text-soft);margin-top:2px;font-weight:400">Menampilkan repository terbaru dari GitHub di portfolio publik</div>
          </div>
        </label>
        <label style="display:flex;align-items:center;gap:12px;cursor:pointer;padding:14px 16px;border:1px solid var(--border);border-radius:12px;transition:all 0.2s" onmouseover="this.style.borderColor='var(--rose-light)'" onmouseout="this.style.borderColor='var(--border)'">
          <input type="checkbox" name="show_quote" value="1" {{ $show_quote == '1' ? 'checked' : '' }} style="width:18px;height:18px;accent-color:var(--rose)">
          <div>
            <div style="font-size:0.85rem;font-weight:600;color:var(--text-dark);text-transform:none;letter-spacing:0">💬 Tampilkan Quote Motivasi</div>
            <div style="font-size:0.73rem;color:var(--text-soft);margin-top:2px;font-weight:400">Menampilkan kutipan inspiratif di bagian bawah portfolio</div>
          </div>
        </label>
      </div>
    </div>

    <!-- Admin Credentials -->
    <div class="card">
      <div class="card-title">🔐 Kredensial Admin</div>
      <div class="form-group">
        <label>Username Admin *</label>
        <input type="text" name="admin_username" value="{{ $admin_username }}" required>
      </div>
      <div style="background:var(--rose-pale);border:1px solid var(--rose-light);border-radius:12px;padding:16px;margin-bottom:16px">
        <div style="font-size:0.75rem;font-weight:600;color:var(--rose);margin-bottom:8px">🔒 Ganti Password (isi jika ingin mengubah)</div>
        <div class="form-group" style="margin-bottom:12px">
          <label>Password Baru</label>
          <input type="password" name="new_password" placeholder="Minimal 6 karakter" autocomplete="new-password">
        </div>
        <div class="form-group" style="margin-bottom:0">
          <label>Konfirmasi Password Baru</label>
          <input type="password" name="new_password_confirmation" placeholder="Ulangi password baru" autocomplete="new-password">
        </div>
      </div>
      @error('new_password')<div class="alert alert-error" style="margin-bottom:12px">{{ $message }}</div>@enderror
    </div>

    <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:14px;font-size:0.9rem">
      💾 Simpan Semua Pengaturan
    </button>
  </form>

  <!-- Danger Zone -->
  <div class="card" style="margin-top:20px;border-color:#f0c0c0">
    <div class="card-title" style="color:#8b2020">⚠️ Info Penting</div>
    <div style="font-size:0.8rem;color:var(--text-mid);line-height:1.8">
      <p>• Data portfolio disimpan di database SQLite lokal.</p>
      <p>• Foto profil & gambar proyek tersimpan di folder <code style="background:var(--rose-pale);padding:1px 6px;border-radius:4px">storage/app/public</code>.</p>
      <p>• Pastikan sudah menjalankan <code style="background:var(--rose-pale);padding:1px 6px;border-radius:4px">php artisan storage:link</code> agar foto tampil.</p>
      <p>• AJAX endpoint publik ada di <code style="background:var(--rose-pale);padding:1px 6px;border-radius:4px">/api/portfolio</code>.</p>
    </div>
  </div>
</div>
@endsection