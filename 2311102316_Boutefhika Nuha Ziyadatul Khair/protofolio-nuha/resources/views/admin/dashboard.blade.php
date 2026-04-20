@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

<!-- Stats -->
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-icon">💡</div>
    <div class="stat-num">{{ $skillsCount }}</div>
    <div class="stat-label">Keahlian</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon">🎓</div>
    <div class="stat-num">{{ $educationCount }}</div>
    <div class="stat-label">Pendidikan</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon">💼</div>
    <div class="stat-num">{{ $experienceCount }}</div>
    <div class="stat-label">Pengalaman</div>
  </div>
  <div class="stat-card">
    <div class="stat-icon">🚀</div>
    <div class="stat-num">{{ $projectsCount }}</div>
    <div class="stat-label">Proyek</div>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">

  <!-- Profile -->
  <div class="card">
    <div class="card-title">👤 Profil Aktif</div>

    @if($profile)
      <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px">
        
        @if($profile->photo)
          <img src="{{ asset('storage/'.$profile->photo) }}"
               style="width:64px;height:64px;border-radius:50%;object-fit:cover;border:3px solid var(--rose-light)">
        @else
          <div style="width:64px;height:64px;border-radius:50%;background:var(--rose-pale);display:flex;align-items:center;justify-content:center;font-size:1.8rem;border:3px solid var(--rose-light)">
            🌸
          </div>
        @endif

        <div>
          <div style="font-weight:600;color:var(--text-dark);font-size:0.95rem">
            {{ $profile->full_name }}
          </div>
          <div style="font-size:0.75rem;color:var(--text-soft);margin-top:3px">
            {{ $profile->title ?? 'Belum ada judul' }}
          </div>
          <div style="font-size:0.72rem;color:var(--rose);margin-top:3px;font-family:'Space Mono',monospace">
            NIM: {{ $profile->nim ?? '-' }}
          </div>
        </div>
      </div>

      <!-- CONTACT -->
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">

        @php
          $contacts = [
            ['<i class="fas fa-envelope"></i>', $profile->email],
            ['<i class="fas fa-location-dot"></i>', $profile->location],
            ['<i class="fab fa-github"></i>', $profile->github ? '@'.$profile->github : null],
            ['<i class="fab fa-instagram"></i>', $profile->instagram ? '@'.$profile->instagram : null],
          ];
        @endphp

        @foreach($contacts as [$icon, $val])
          @if($val)
            <div style="font-size:0.76rem;color:var(--text-mid);background:var(--rose-pale);padding:6px 10px;border-radius:8px;display:flex;gap:6px;align-items:center">
              <span>{!! $icon !!}</span>
              {{ $val }}
            </div>
          @endif
        @endforeach

      </div>

      <a href="{{ route('admin.profile') }}" class="btn btn-outline btn-sm" style="margin-top:16px">
        Edit Profil →
      </a>

    @else
      <p style="color:var(--text-soft);font-size:0.85rem">
        Profil belum diisi.
      </p>
      <a href="{{ route('admin.profile') }}" class="btn btn-primary btn-sm" style="margin-top:12px">
        Isi Profil
      </a>
    @endif
  </div>

  <!-- Quick Links -->
  <div class="card">
    <div class="card-title">⚡ Aksi Cepat</div>

    <div style="display:flex;flex-direction:column;gap:10px">
      @foreach([
        ['admin.skills',     '💡', 'Tambah Skill Baru'],
        ['admin.education',  '🎓', 'Tambah Pendidikan'],
        ['admin.experience', '💼', 'Tambah Pengalaman'],
        ['admin.projects',   '🚀', 'Tambah Proyek Baru'],
      ] as [$route, $icon, $label])

        <a href="{{ route($route) }}"
           style="display:flex;align-items:center;gap:12px;padding:12px 16px;border:1px solid var(--border);border-radius:12px;text-decoration:none;color:var(--text-mid);font-size:0.83rem;transition:all 0.2s"
           onmouseover="this.style.borderColor='var(--rose-mid)';this.style.color='var(--rose)'"
           onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text-mid)'">

          <span style="font-size:1.2rem">{{ $icon }}</span>
          <span>{{ $label }}</span>
          <span style="margin-left:auto">→</span>
        </a>

      @endforeach
    </div>
  </div>

</div>

@endsection