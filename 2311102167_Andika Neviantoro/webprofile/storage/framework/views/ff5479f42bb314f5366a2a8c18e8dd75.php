<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div style="margin-bottom:24px">
    <p style="color:var(--muted);font-size:13px">Selamat datang kembali, <strong style="color:var(--ink)"><?php echo e(auth()->user()->name); ?></strong>! Kelola konten portfolio kamu di sini.</p>
</div>

<!-- STATS -->
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:32px">
    <div class="stat-card">
        <div class="stat-icon" style="background:rgba(232,88,10,.1)"><span style="font-size:22px">⚡</span></div>
        <div>
            <div class="stat-num"><?php echo e($stats['skills']); ?></div>
            <div class="stat-label">Kategori Skill</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:rgba(61,140,122,.1)"><span style="font-size:22px">🎓</span></div>
        <div>
            <div class="stat-num"><?php echo e($stats['education']); ?></div>
            <div class="stat-label">Pendidikan</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:rgba(247,164,74,.1)"><span style="font-size:22px">📁</span></div>
        <div>
            <div class="stat-num"><?php echo e($stats['projects']); ?></div>
            <div class="stat-label">Project</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:rgba(0,119,181,.1)"><span style="font-size:22px">📬</span></div>
        <div>
            <div class="stat-num"><?php echo e($stats['contacts']); ?></div>
            <div class="stat-label">Kontak</div>
        </div>
    </div>
</div>

<!-- QUICK ACTIONS -->
<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px">
    <div class="admin-card">
        <div class="admin-card-title">Aksi Cepat</div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
            <a href="<?php echo e(route('admin.profile')); ?>" style="text-decoration:none;background:var(--bg);border:1px solid var(--border);border-radius:12px;padding:16px;display:flex;align-items:center;gap:12px;transition:all .2s" onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--border)'">
                <span style="font-size:20px">🖼️</span>
                <div>
                    <div style="font-size:13px;font-weight:700;color:var(--ink)">Edit Profil</div>
                    <div style="font-size:11px;color:var(--muted)">Foto, nama, deskripsi</div>
                </div>
            </a>
            <a href="<?php echo e(route('admin.skills')); ?>" style="text-decoration:none;background:var(--bg);border:1px solid var(--border);border-radius:12px;padding:16px;display:flex;align-items:center;gap:12px;transition:all .2s" onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--border)'">
                <span style="font-size:20px">⚡</span>
                <div>
                    <div style="font-size:13px;font-weight:700;color:var(--ink)">Kelola Skills</div>
                    <div style="font-size:11px;color:var(--muted)">Tambah, edit, hapus</div>
                </div>
            </a>
            <a href="<?php echo e(route('admin.projects')); ?>" style="text-decoration:none;background:var(--bg);border:1px solid var(--border);border-radius:12px;padding:16px;display:flex;align-items:center;gap:12px;transition:all .2s" onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--border)'">
                <span style="font-size:20px">📁</span>
                <div>
                    <div style="font-size:13px;font-weight:700;color:var(--ink)">Kelola Project</div>
                    <div style="font-size:11px;color:var(--muted)">Portfolio karya</div>
                </div>
            </a>
            <a href="<?php echo e(route('admin.education')); ?>" style="text-decoration:none;background:var(--bg);border:1px solid var(--border);border-radius:12px;padding:16px;display:flex;align-items:center;gap:12px;transition:all .2s" onmouseover="this.style.borderColor='var(--accent)'" onmouseout="this.style.borderColor='var(--border)'">
                <span style="font-size:20px">🎓</span>
                <div>
                    <div style="font-size:13px;font-weight:700;color:var(--ink)">Pendidikan</div>
                    <div style="font-size:11px;color:var(--muted)">Riwayat sekolah</div>
                </div>
            </a>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card-title">Info Profil</div>
        <?php if($profile): ?>
        <div style="text-align:center;padding:8px 0">
            <?php if($profile->photo): ?>
            <img src="<?php echo e(asset('storage/'.$profile->photo)); ?>" style="width:72px;height:72px;border-radius:16px;object-fit:cover;margin-bottom:12px;border:2px solid var(--border)">
            <?php else: ?>
            <div style="width:72px;height:72px;border-radius:16px;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-size:28px;color:#fff;font-weight:700"><?php echo e(strtoupper(substr($profile->name,0,1))); ?></div>
            <?php endif; ?>
            <div style="font-family:var(--f-display);font-size:16px;font-weight:600;color:var(--ink)"><?php echo e($profile->name); ?></div>
            <div style="font-size:12px;color:var(--accent);font-weight:600;margin-top:3px"><?php echo e($profile->title); ?></div>
            <div style="font-size:11px;color:var(--muted);margin-top:4px;font-family:var(--f-mono)"><?php echo e($profile->nim); ?></div>
        </div>
        <div style="margin-top:16px;padding-top:16px;border-top:1px solid var(--border);text-align:center">
            <a href="<?php echo e(route('home')); ?>" target="_blank" class="btn-accent" style="text-decoration:none;font-size:12px;padding:8px 16px;border-radius:8px;display:inline-block">Lihat Portfolio →</a>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MATKUL SEMS 6\PRAKTIKUM ABP\webpro\webprofile\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>