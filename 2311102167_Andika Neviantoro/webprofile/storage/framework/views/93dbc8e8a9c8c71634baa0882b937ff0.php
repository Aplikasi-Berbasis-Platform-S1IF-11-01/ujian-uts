<?php $__env->startSection('title', 'Kelola Pendidikan'); ?>
<?php $__env->startSection('page-title', 'Kelola Pendidikan'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-card">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
        <div class="admin-card-title" style="margin-bottom:0">🎓 Riwayat Pendidikan</div>
        <button class="btn-accent" onclick="openModal()">+ Tambah</button>
    </div>
    <table class="admin-table">
        <thead>
            <tr><th>Sekolah/Universitas</th><th>Jurusan</th><th>Periode</th><th>Status</th><th>Aksi</th></tr>
        </thead>
        <tbody id="edu-tbody">
            <?php $__currentLoopData = $education; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr id="edu-row-<?php echo e($edu->id); ?>">
                <td><strong style="color:var(--ink)"><?php echo e($edu->school); ?></strong></td>
                <td><?php echo e($edu->major); ?></td>
                <td><code style="font-size:12px;color:var(--muted)"><?php echo e($edu->period); ?></code></td>
                <td>
                    <span class="<?php echo e($edu->status === 'active' ? 'badge-active' : 'badge-done'); ?>">
                        <?php echo e($edu->status === 'active' ? 'Aktif' : 'Selesai'); ?>

                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:6px">
                        <button class="btn-outline-accent" onclick="openModal(<?php echo e($edu->id); ?>,'<?php echo e(addslashes($edu->school)); ?>','<?php echo e(addslashes($edu->major)); ?>','<?php echo e($edu->period); ?>','<?php echo e($edu->status); ?>','<?php echo e($edu->icon_bg); ?>','<?php echo e($edu->icon_color); ?>',<?php echo e($edu->sort_order); ?>)">Edit</button>
                        <button class="btn-danger-sm" onclick="deleteEdu(<?php echo e($edu->id); ?>)">Hapus</button>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php if($education->isEmpty()): ?>
    <div style="text-align:center;padding:40px;color:var(--muted);font-size:13px">Belum ada data pendidikan.</div>
    <?php endif; ?>
</div>

<!-- MODAL -->
<div class="modal fade" id="eduModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Tambah Pendidikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edu-id">
                <div style="display:flex;flex-direction:column;gap:14px">
                    <div>
                        <label class="form-label-admin">Nama Sekolah / Universitas</label>
                        <input class="form-ctrl" type="text" id="edu-school" placeholder="Telkom University Purwokerto" required>
                    </div>
                    <div>
                        <label class="form-label-admin">Jurusan / Program Studi</label>
                        <input class="form-ctrl" type="text" id="edu-major" placeholder="S1 Informatika" required>
                    </div>
                    <div>
                        <label class="form-label-admin">Periode</label>
                        <input class="form-ctrl" type="text" id="edu-period" placeholder="2023 – Sekarang" required>
                    </div>
                    <div>
                        <label class="form-label-admin">Status</label>
                        <select class="form-ctrl" id="edu-status">
                            <option value="active">Aktif</option>
                            <option value="done">Selesai</option>
                        </select>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                        <div>
                            <label class="form-label-admin">Warna BG Icon</label>
                            <input class="form-ctrl" type="text" id="edu-icon-bg" placeholder="#eef4fb">
                        </div>
                        <div>
                            <label class="form-label-admin">Warna Icon</label>
                            <input class="form-ctrl" type="text" id="edu-icon-color" placeholder="#0077b5">
                        </div>
                    </div>
                    <div>
                        <label class="form-label-admin">Urutan</label>
                        <input class="form-ctrl" type="number" id="edu-order" value="0">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-outline-accent" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn-accent" id="btn-save-edu" onclick="saveEdu()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
let eduModal = new bootstrap.Modal(document.getElementById('eduModal'));

function openModal(id='',school='',major='',period='',status='active',iconBg='#eef4fb',iconColor='#0077b5',order=0){
    document.getElementById('edu-id').value = id;
    document.getElementById('edu-school').value = school;
    document.getElementById('edu-major').value = major;
    document.getElementById('edu-period').value = period;
    document.getElementById('edu-status').value = status;
    document.getElementById('edu-icon-bg').value = iconBg;
    document.getElementById('edu-icon-color').value = iconColor;
    document.getElementById('edu-order').value = order;
    document.getElementById('modal-title').textContent = id ? 'Edit Pendidikan' : 'Tambah Pendidikan';
    eduModal.show();
}

async function saveEdu() {
    const id = document.getElementById('edu-id').value;
    const data = {
        school: document.getElementById('edu-school').value,
        major: document.getElementById('edu-major').value,
        period: document.getElementById('edu-period').value,
        status: document.getElementById('edu-status').value,
        icon_bg: document.getElementById('edu-icon-bg').value,
        icon_color: document.getElementById('edu-icon-color').value,
        sort_order: document.getElementById('edu-order').value,
    };
    const url = id ? `/admin/education/${id}` : '<?php echo e(route("admin.education.store")); ?>';
    const method = id ? 'PUT' : 'POST';
    const btn = document.getElementById('btn-save-edu');
    btn.textContent = 'Menyimpan...'; btn.disabled = true;
    try {
        const res = await ajaxRequest(url, method, data);
        if (res.success) { showToast(res.message); eduModal.hide(); setTimeout(() => location.reload(), 700); }
        else showToast(res.message || 'Gagal', 'error');
    } catch(e) { showToast('Terjadi kesalahan', 'error'); }
    btn.textContent = 'Simpan'; btn.disabled = false;
}

async function deleteEdu(id) {
    if (!confirm('Yakin ingin menghapus data pendidikan ini?')) return;
    try {
        const res = await ajaxRequest(`/admin/education/${id}`, 'DELETE');
        if (res.success) { showToast(res.message); document.getElementById(`edu-row-${id}`)?.remove(); }
        else showToast(res.message || 'Gagal', 'error');
    } catch(e) { showToast('Terjadi kesalahan', 'error'); }
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MATKUL SEMS 6\PRAKTIKUM ABP\webpro\webprofile\resources\views/admin/education.blade.php ENDPATH**/ ?>