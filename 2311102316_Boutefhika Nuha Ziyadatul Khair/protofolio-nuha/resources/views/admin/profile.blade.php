@extends('layouts.admin')
@section('title', 'Profil & Foto')

@section('content')
<form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
  @csrf

  <div style="display:grid;grid-template-columns:1fr 320px;gap:20px;align-items:start">

    <!-- Form Fields -->
    <div>
      <div class="card">
        <div class="card-title">📝 Data Diri</div>
        <div class="form-grid">
          <div class="form-group">
            <label>Nama Lengkap *</label>
            <input type="text" name="full_name" value="{{ old('full_name', $profile->full_name ?? '') }}" required placeholder="Boutefhika Nuha Ziyadatul Khair">
            @error('full_name')<span style="font-size:0.72rem;color:var(--danger)">{{ $message }}</span>@enderror
          </div>
          <div class="form-group">
            <label>NIM</label>
            <input type="text" name="nim" value="{{ old('nim', $profile->nim ?? '') }}" placeholder="2311102316">
          </div>
          <div class="form-group full">
            <label>Judul / Tagline</label>
            <input type="text" name="title" value="{{ old('title', $profile->title ?? '') }}" placeholder="Mahasiswi Informatika · UI/UX Enthusiast">
          </div>
          <div class="form-group full">
            <label>Tentang Saya</label>
            <textarea name="about" rows="5" placeholder="Ceritakan sedikit tentang dirimu...">{{ old('about', $profile->about ?? '') }}</textarea>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-title">📬 Kontak & Sosial Media</div>
        <div class="form-grid">
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $profile->email ?? '') }}" placeholder="nuha@example.com">
          </div>
          <div class="form-group">
            <label>No. HP / WhatsApp</label>
            <input type="text" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" placeholder="+62 812-0000-0000">
          </div>
          <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="location" value="{{ old('location', $profile->location ?? '') }}" placeholder="Purwokerto, Jawa Tengah">
          </div>
          <div class="form-group">
            <label>GitHub Username</label>
            <input type="text" name="github" value="{{ old('github', $profile->github ?? '') }}" placeholder="nhaazk95">
          </div>
          <div class="form-group">
            <label>Instagram Username</label>
            <input type="text" name="instagram" value="{{ old('instagram', $profile->instagram ?? '') }}" placeholder="nuha.zkh">
          </div>
          <div class="form-group">
            <label>LinkedIn URL / Username</label>
            <input type="text" name="linkedin" value="{{ old('linkedin', $profile->linkedin ?? '') }}" placeholder="nuha-ziyadatul">
          </div>
        </div>
      </div>
    </div>

    <!-- Photo Upload -->
    <div>
      <div class="card">
        <div class="card-title">📸 Foto Profil</div>

        <!-- Current Photo -->
        <div style="text-align:center;margin-bottom:20px">
          @if($profile && $profile->photo)
            <img id="photo-preview" src="{{ asset('storage/'.$profile->photo) }}"
              style="width:160px;height:160px;border-radius:50%;object-fit:cover;object-position:top;border:4px solid var(--rose-light);box-shadow:0 8px 24px rgba(200,114,138,0.2)">
          @else
            <div id="photo-preview-placeholder" style="width:160px;height:160px;border-radius:50%;background:var(--rose-pale);border:3px dashed var(--rose-light);display:inline-flex;align-items:center;justify-content:center;font-size:3rem">🌸</div>
            <img id="photo-preview" src="" style="display:none;width:160px;height:160px;border-radius:50%;object-fit:cover;border:4px solid var(--rose-light)">
          @endif
        </div>

        <label for="photo-input" style="display:block;text-align:center;padding:10px 20px;background:var(--rose-pale);border:1px dashed var(--rose-light);border-radius:12px;cursor:pointer;font-size:0.8rem;color:var(--rose);transition:all 0.2s" onmouseover="this.style.background='var(--blush)'" onmouseout="this.style.background='var(--rose-pale)'">
          📁 Pilih Foto
        </label>
        <input type="file" id="photo-input" name="photo" accept="image/*" style="display:none" onchange="previewPhoto(this)">

        <div style="margin-top:12px;font-size:0.7rem;color:var(--text-soft);text-align:center;line-height:1.6">
          Format: JPG, PNG, WEBP<br>Maks: 2MB · Disarankan foto wajah
        </div>
      </div>

      <div class="card" style="background:var(--rose-pale);border-color:var(--rose-light)">
        <div style="font-size:0.78rem;color:var(--text-mid);line-height:1.7">
          💡 <strong>Tips:</strong> Foto akan ditampilkan di bagian header portfolio publik. Gunakan foto dengan pencahayaan bagus dan latar bersih.
        </div>
      </div>

      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:14px">
        💾 Simpan Perubahan
      </button>
    </div>

  </div>
</form>

@push('scripts')
<script>
function previewPhoto(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      const preview = document.getElementById('photo-preview');
      const placeholder = document.getElementById('photo-preview-placeholder');
      preview.src = e.target.result;
      preview.style.display = 'block';
      if (placeholder) placeholder.style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
@endpush
@endsection