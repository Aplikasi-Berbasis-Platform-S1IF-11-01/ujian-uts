<?php $__env->startSection('title', 'Kelola Skills'); ?>
<?php $__env->startSection('page-title', 'Kelola Skills'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-card">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px">
        <div class="admin-card-title" style="margin-bottom:0">⚡ Daftar Skills</div>
        <button class="btn-accent" onclick="openModal()">+ Tambah Skill</button>
    </div>

    <div id="skills-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Warna</th>
                    <th>Items</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="skills-tbody">
                <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr id="skill-row-<?php echo e($skill->id); ?>">
                    <td><strong style="color:var(--ink)"><?php echo e($skill->category); ?></strong></td>
                    <td><span style="display:inline-block;width:18px;height:18px;border-radius:50%;background:<?php echo e($skill->icon_color); ?>;vertical-align:middle"></span> <code style="font-size:11px;color:var(--muted)"><?php echo e($skill->icon_color); ?></code></td>
                    <td>
                        <div style="display:flex;flex-wrap:wrap;gap:4px">
                            <?php $__currentLoopData = $skill->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span style="font-size:11px;background:var(--bg);border:1px solid var(--border);border-radius:100px;padding:2px 10px;color:#5a5a7a"><?php echo e($item); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </td>
                    <td><?php echo e($skill->sort_order); ?></td>
                    <td>
                        <div style="display:flex;gap:6px">
                            <button class="btn-outline-accent" onclick="openModal(<?php echo e($skill->id); ?>, '<?php echo e($skill->category); ?>', '<?php echo e($skill->icon_color); ?>', '<?php echo e(implode(", ", (array)$skill->items)); ?>', <?php echo e($skill->sort_order); ?>)">Edit</button>
                            <button class="btn-danger-sm" onclick="deleteSkill(<?php echo e($skill->id); ?>)">Hapus</button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php if($skills->isEmpty()): ?>
        <div style="text-align:center;padding:40px;color:var(--muted);font-size:13px">Belum ada skill. Klik tombol di atas untuk menambah.</div>
        <?php endif; ?>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="skillModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Tambah Skill</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="skill-form">
                    <input type="hidden" id="skill-id" value="">
                    <div style="display:flex;flex-direction:column;gap:14px">
                        <div>
                            <label class="form-label-admin">Kategori</label>
                            <input class="form-ctrl" type="text" id="skill-category" placeholder="Frontend, Backend, Tools..." required>
                        </div>
                        <div>
                            <label class="form-label-admin">Warna Icon (hex)</label>
                            <div style="display:flex;gap:8px;align-items:center">
                                <input class="form-ctrl" type="text" id="skill-color" placeholder="#e8580a" style="flex:1">
                                <input type="color" id="skill-color-picker" value="#e8580a" style="width:40px;height:40px;border:1px solid var(--border);border-radius:8px;cursor:pointer;padding:2px">
                            </div>
                        </div>
                        <div>
                            <label class="form-label-admin">Items (pisahkan dengan koma)</label>
                            <textarea class="form-ctrl" id="skill-items" rows="3" placeholder="HTML5, CSS3, JavaScript, Vue.js"></textarea>
                            <small style="color:var(--muted);font-size:11px">Contoh: HTML5, CSS3, JavaScript</small>
                        </div>
                        <div>
                            <label class="form-label-admin">Urutan</label>
                            <input class="form-ctrl" type="number" id="skill-order" value="0">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-outline-accent" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn-accent" id="btn-save-skill" onclick="saveSkill()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
let skillModal = new bootstrap.Modal(document.getElementById('skillModal'));

document.getElementById('skill-color-picker').addEventListener('input', function() {
    document.getElementById('skill-color').value = this.value;
});
document.getElementById('skill-color').addEventListener('input', function() {
    document.getElementById('skill-color-picker').value = this.value;
});

function openModal(id = '', category = '', color = '#e8580a', items = '', order = 0) {
    document.getElementById('skill-id').value = id;
    document.getElementById('skill-category').value = category;
    document.getElementById('skill-color').value = color;
    document.getElementById('skill-color-picker').value = color;
    document.getElementById('skill-items').value = items;
    document.getElementById('skill-order').value = order;
    document.getElementById('modal-title').textContent = id ? 'Edit Skill' : 'Tambah Skill';
    skillModal.show();
}

async function saveSkill() {
    const id = document.getElementById('skill-id').value;
    const data = {
        category: document.getElementById('skill-category').value,
        icon_color: document.getElementById('skill-color').value,
        items: document.getElementById('skill-items').value,
        sort_order: document.getElementById('skill-order').value,
    };
    if (!data.category || !data.items) { showToast('Isi semua field yang wajib', 'error'); return; }

    const url = id ? `/admin/skills/${id}` : '<?php echo e(route("admin.skills.store")); ?>';
    const method = id ? 'PUT' : 'POST';
    const btn = document.getElementById('btn-save-skill');
    btn.textContent = 'Menyimpan...'; btn.disabled = true;

    try {
        const res = await ajaxRequest(url, method, data);
        if (res.success) {
            showToast(res.message);
            skillModal.hide();
            setTimeout(() => location.reload(), 700);
        } else {
            showToast(res.message || 'Gagal menyimpan', 'error');
        }
    } catch(e) { showToast('Terjadi kesalahan', 'error'); }
    btn.textContent = 'Simpan'; btn.disabled = false;
}

async function deleteSkill(id) {
    if (!confirm('Yakin ingin menghapus skill ini?')) return;
    try {
        const res = await ajaxRequest(`/admin/skills/${id}`, 'DELETE');
        if (res.success) {
            showToast(res.message);
            document.getElementById(`skill-row-${id}`)?.remove();
        } else showToast(res.message || 'Gagal menghapus', 'error');
    } catch(e) { showToast('Terjadi kesalahan', 'error'); }
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\MATKUL SEMS 6\PRAKTIKUM ABP\webpro\webprofile\resources\views/admin/skills.blade.php ENDPATH**/ ?>