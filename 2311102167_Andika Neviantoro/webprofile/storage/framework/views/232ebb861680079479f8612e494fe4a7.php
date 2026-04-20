<?php $__env->startSection('title', 'Edit Profil'); ?>
<?php $__env->startSection('page-title', 'Edit Profil'); ?>

<?php $__env->startSection('content'); ?>
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">

    <!-- FOTO -->
    <div class="admin-card">
        <div class="admin-card-title">📷 Foto Profil</div>
        <div style="text-align:center;padding:12px 0">
            <div id="photo-preview-wrap" style="margin-bottom:20px">
                <?php if($profile && $profile->photo): ?>
                <img id="photo-preview" src="<?php echo e(asset('storage/'.$profile->photo)); ?>" style="width:120px;height:120px;border-radius:20px;object-fit:cover;border:2px solid var(--border)">
                <?php else: ?>
                <div id="photo-placeholder" style="width:120px;height:120px;border-radius:20px;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;margin:0 auto;font-size:40px;color:#fff;font-weight:700">
                    <?php echo e($profile ? strtoupper(substr($profile->name,0,1)) : 'A'); ?>

                </div>
                <?php endif; ?>
            </div>
            <label for="photo-input" class="btn-accent" style="cursor:pointer;display:inline-block;padding:9px 20px;border-radius:10px;font-size:13px;font-weight:700">Pilih Foto</label>
            <input type="file" id="photo-input" accept="image/*" style="display:none">
            <p style="font-size:11px;color:var(--muted);margin-top:10px">JPG, PNG, WEBP. Maks 2MB.</p>
            <button id="btn-upload-photo" class="btn-outline-accent" style="margin-top:12px;display:none">Upload Foto</button>
        </div>
    </div>

    <!-- INFO -->
    <div class="admin-card">
        <div class="admin-card-title">👤 Informasi Diri</div>
        <form id="form-profile">
            <div style="display:flex;flex-direction:column;gap:14px">
                <div>
                    <label class="form-label-admin">Nama Lengkap</label>
                    <input class="form-ctrl" type="text" name="name" value="<?php echo e($profile->name ?? ''); ?>" required>
                </div>
                <div>
                    <label class="form-label-admin">Judul / Title</label>
                    <input class="form-ctrl" type="text" name="title" value="<?php echo e($profile->title ?? ''); ?>" placeholder="UI Developer">
                </div>
                <div>
                    <label class="form-label-admin">NIM</label>
                    <input class="form-ctrl" type="text" name="nim" value="<?php echo e($profile->nim ?? ''); ?>" placeholder="2311102167">
                </div>
                <div>
                    <label class="form-label-admin">Universitas</label>
                    <input class="form-ctrl" type="text" name="university" value="<?php echo e($profile->university ?? ''); ?>">
                </div>
                <div>
                    <label class="form-label-admin">GitHub Username</label>
                    <input class="form-ctrl" type="text" name="github_username" value="<?php echo e($profile->github_username ?? ''); ?>" placeholder="andikaneviantoro">
                </div>
                <div>
                    <label class="form-label-admin">Status Label</label>
                    <input class="form-ctrl" type="text" name="status_label" value="<?php echo e($profile->status_label ?? ''); ?>" placeholder="Available for work">
                </div>
                <div>
                    <label class="form-label-admin">Deskripsi</label>
                    <textarea class="form-ctrl" name="description" rows="4" style="resize:vertical"><?php echo e($profile->description ?? ''); ?></textarea>
                </div>
                <div>
                    <button type="submit" class="btn-accent" style="width:100%">Simpan Perubahan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const photoInput = document.getElementById('photo-input');
const btnUpload = document.getElementById('btn-upload-photo');
let selectedFile = null;

photoInput.addEventListener('change', function() {
    selectedFile = this.files[0];
    if (!selectedFile) return;
    const reader = new FileReader();
    reader.onload = e => {
        const wrap = document.getElementById('photo-preview-wrap');
        wrap.innerHTML = `<img id="photo-preview" src="${e.target.result}" style="width:120px;height:120px;border-radius:20px;object-fit:cover;border:2px solid var(--border)">`;
    };
    reader.readAsDataURL(selectedFile);
    btnUpload.style.display = 'inline-block';
});

btnUpload.addEventListener('click', async function() {
    if (!selectedFile) return;
    const formData = new FormData();
    formData.append('photo', selectedFile);
    this.textContent = 'Mengupload...';
    this.disabled = true;
    try {
        const res = await ajaxRequest('<?php echo e(route("admin.profile.photo")); ?>', 'POST', formData);
        if (res.success) {
            showToast(res.message);
            btnUpload.style.display = 'none';
        } else {
            showToast(res.message || 'Gagal upload', 'error');
        }
    } catch(e) {
        showToast('Terjadi kesalahan', 'error');
    }
    this.textContent = 'Upload Foto';
    this.disabled = false;
});

document.getElementById('form-profile').addEventListener('submit', async function(e) {
    e.preventDefault();
    const fd = new FormData(this);
    const data = Object.fromEntries(fd.entries());
    const btn = this.querySelector('button[type=submit]');
    btn.textContent = 'Menyimpan...'; btn.disabled = true;
    try {
        const res = await ajaxRequest('<?php echo e(route("admin.profile.update")); ?>', 'POST', data);
        if (res.success) showToast(res.message);
        else showToast(res.message || 'Gagal menyimpan', 'error');
    } catch(e) { showToast('Terjadi kesalahan', 'error'); }
    btn.textContent = 'Simpan Perubahan'; btn.disabled = false;
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MATKUL SEMS 6\PRAKTIKUM ABP\webpro\webprofile\resources\views/admin/profile.blade.php ENDPATH**/ ?>