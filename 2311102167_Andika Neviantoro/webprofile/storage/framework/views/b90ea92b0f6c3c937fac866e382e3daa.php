<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin Dashboard'); ?> – Portfolio Andika</title>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,600;0,9..144,700;1,9..144,300&family=DM+Mono:wght@400;500&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --ink: #1a1a2e;
            --accent: #e8580a;
            --accent2: #f7a44a;
            --sage: #3d8c7a;
            --bg: #f4f5f7;
            --dark: #1a1a2e;
            --white: #fff;
            --muted: #8a8aaa;
            --border: #e2e4e9;
            --card: #fff;
            --sidebar-w: 260px;
            --f-display: 'Fraunces', serif;
            --f-body: 'Nunito', sans-serif;
            --f-mono: 'DM Mono', monospace;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--f-body); background: var(--bg); color: #4a4a6a; display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--dark);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            display: flex; flex-direction: column;
            z-index: 100;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 24px 24px 20px;
            border-bottom: 1px solid rgba(255,255,255,.06);
        }
        .sidebar-brand a {
            font-family: var(--f-display);
            font-size: 18px; font-weight: 600;
            color: #fff; text-decoration: none;
            letter-spacing: -.01em;
        }
        .sidebar-brand a span { color: var(--accent2); }
        .sidebar-brand small {
            display: block; font-size: 11px;
            color: rgba(255,255,255,.3);
            font-family: var(--f-mono);
            margin-top: 2px; letter-spacing: .06em;
        }
        .sidebar-nav { padding: 16px 12px; flex: 1; }
        .nav-section-label {
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .1em;
            color: rgba(255,255,255,.25);
            padding: 8px 12px 6px;
        }
        .sidebar-nav .nav-link {
            display: flex; align-items: center; gap: 10px;
            color: rgba(255,255,255,.5);
            font-size: 13px; font-weight: 600;
            padding: 9px 12px; border-radius: 10px;
            text-decoration: none;
            transition: all .2s; margin-bottom: 2px;
        }
        .sidebar-nav .nav-link i { font-size: 16px; width: 20px; text-align: center; }
        .sidebar-nav .nav-link:hover { color: #fff; background: rgba(255,255,255,.07); }
        .sidebar-nav .nav-link.active { color: var(--accent2); background: rgba(232,88,10,.15); }
        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,.06);
        }
        .sidebar-footer .nav-link {
            display: flex; align-items: center; gap: 10px;
            color: rgba(255,255,255,.4); font-size: 13px; font-weight: 600;
            padding: 9px 12px; border-radius: 10px;
            text-decoration: none; transition: all .2s;
        }
        .sidebar-footer .nav-link:hover { color: #ff6b6b; background: rgba(255,107,107,.1); }

        /* MAIN */
        .main-wrap { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .topbar {
            background: var(--white); border-bottom: 1px solid var(--border);
            padding: 14px 32px; display: flex; align-items: center;
            justify-content: space-between; position: sticky; top: 0; z-index: 50;
        }
        .topbar-title { font-family: var(--f-display); font-size: 20px; font-weight: 600; color: var(--ink); letter-spacing: -.02em; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .topbar-user {
            display: flex; align-items: center; gap: 8px;
            font-size: 13px; font-weight: 600; color: #5a5a7a;
        }
        .topbar-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 12px; font-weight: 700;
        }
        .page-content { padding: 32px; flex: 1; }

        /* CARDS */
        .admin-card {
            background: var(--white); border: 1px solid var(--border);
            border-radius: 16px; padding: 24px;
            box-shadow: 0 1px 8px rgba(26,26,46,.05);
        }
        .admin-card-title {
            font-family: var(--f-display); font-size: 16px; font-weight: 600;
            color: var(--ink); margin-bottom: 20px; letter-spacing: -.01em;
        }
        .stat-card {
            background: var(--white); border: 1px solid var(--border);
            border-radius: 16px; padding: 20px 24px;
            display: flex; align-items: center; gap: 16px;
            box-shadow: 0 1px 8px rgba(26,26,46,.05);
        }
        .stat-icon {
            width: 48px; height: 48px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; flex-shrink: 0;
        }
        .stat-num { font-family: var(--f-display); font-size: 28px; font-weight: 600; color: var(--ink); line-height: 1; }
        .stat-label { font-size: 12px; color: var(--muted); font-weight: 600; margin-top: 2px; }

        /* TABLES */
        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table th {
            font-size: 11px; font-weight: 700; text-transform: uppercase;
            letter-spacing: .06em; color: var(--muted);
            padding: 10px 16px; border-bottom: 1px solid var(--border);
            text-align: left; white-space: nowrap;
        }
        .admin-table td {
            padding: 14px 16px; border-bottom: 1px solid var(--border);
            font-size: 13px; color: #5a5a7a; vertical-align: middle;
        }
        .admin-table tr:last-child td { border-bottom: none; }
        .admin-table tr:hover td { background: #fafafa; }

        /* BADGES */
        .badge-active { background: rgba(61,140,122,.1); color: var(--sage); border: 1px solid rgba(61,140,122,.25); font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 100px; }
        .badge-done { background: var(--border); color: var(--muted); border: 1px solid var(--border); font-size: 11px; font-weight: 700; padding: 3px 10px; border-radius: 100px; }

        /* BUTTONS */
        .btn-accent { background: var(--accent); color: #fff; border: none; border-radius: 10px; padding: 9px 18px; font-size: 13px; font-weight: 700; cursor: pointer; transition: all .2s; }
        .btn-accent:hover { background: #c94808; color: #fff; }
        .btn-outline-accent { background: transparent; color: var(--accent); border: 1px solid var(--accent); border-radius: 10px; padding: 7px 14px; font-size: 12px; font-weight: 700; cursor: pointer; transition: all .2s; }
        .btn-outline-accent:hover { background: var(--accent); color: #fff; }
        .btn-danger-sm { background: transparent; color: #e53e3e; border: 1px solid rgba(229,62,62,.3); border-radius: 8px; padding: 5px 10px; font-size: 12px; font-weight: 700; cursor: pointer; transition: all .2s; }
        .btn-danger-sm:hover { background: #e53e3e; color: #fff; }

        /* FORMS */
        .form-label-admin { font-size: 12px; font-weight: 700; color: #5a5a7a; margin-bottom: 5px; display: block; letter-spacing: .02em; }
        .form-ctrl { width: 100%; padding: 10px 14px; border: 1px solid var(--border); border-radius: 10px; font-size: 13px; font-family: var(--f-body); color: var(--ink); transition: border-color .2s; }
        .form-ctrl:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(232,88,10,.1); }

        /* MODAL */
        .modal-content { border-radius: 16px; border: 1px solid var(--border); }
        .modal-header { border-bottom: 1px solid var(--border); padding: 20px 24px; }
        .modal-title { font-family: var(--f-display); font-size: 18px; font-weight: 600; color: var(--ink); }
        .modal-body { padding: 24px; }
        .modal-footer { border-top: 1px solid var(--border); padding: 16px 24px; }

        /* TOAST */
        #toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; display: flex; flex-direction: column; gap: 8px; }
        .toast-notif { background: var(--white); border: 1px solid var(--border); border-radius: 12px; padding: 14px 18px; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 20px rgba(26,26,46,.12); font-size: 13px; font-weight: 600; min-width: 260px; animation: slideIn .3s ease; }
        .toast-notif.success { border-left: 3px solid var(--sage); }
        .toast-notif.error { border-left: 3px solid #e53e3e; }
        @keyframes slideIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }

        @media(max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-wrap { margin-left: 0; }
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <a href="<?php echo e(route('admin.dashboard')); ?>"><span>A</span>ndika<span>.</span></a>
            <small>ADMIN PANEL</small>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu</div>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                <i class="bi bi-grid-1x2"></i> Dashboard
            </a>
            <a href="<?php echo e(route('admin.profile')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.profile') ? 'active' : ''); ?>">
                <i class="bi bi-person-circle"></i> Profil
            </a>
            <div class="nav-section-label" style="margin-top:12px">Konten</div>
            <a href="<?php echo e(route('admin.skills')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.skills') ? 'active' : ''); ?>">
                <i class="bi bi-lightning-charge"></i> Skills
            </a>
            <a href="<?php echo e(route('admin.education')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.education') ? 'active' : ''); ?>">
                <i class="bi bi-mortarboard"></i> Pendidikan
            </a>
            <a href="<?php echo e(route('admin.projects')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.projects') ? 'active' : ''); ?>">
                <i class="bi bi-folder2-open"></i> Project
            </a>
            <a href="<?php echo e(route('admin.contacts')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.contacts') ? 'active' : ''); ?>">
                <i class="bi bi-chat-dots"></i> Kontak
            </a>
            <div class="nav-section-label" style="margin-top:12px">Lainnya</div>
            <a href="<?php echo e(route('home')); ?>" target="_blank" class="nav-link">
                <i class="bi bi-box-arrow-up-right"></i> Lihat Portfolio
            </a>
        </nav>
        <div class="sidebar-footer">
            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="nav-link" style="background:none;border:none;width:100%;text-align:left;cursor:pointer;">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main-wrap">
        <div class="topbar">
            <div class="topbar-title"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></div>
            <div class="topbar-right">
                <div class="topbar-user">
                    <div class="topbar-avatar"><?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?></div>
                    <?php echo e(auth()->user()->name); ?>

                </div>
            </div>
        </div>
        <div class="page-content">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <!-- TOAST CONTAINER -->
    <div id="toast-container"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Global AJAX setup dengan CSRF token
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').content;

        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `toast-notif ${type}`;
            toast.innerHTML = `
                <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-x-circle-fill'}" style="color:${type === 'success' ? '#3d8c7a' : '#e53e3e'}"></i>
                <span>${message}</span>
            `;
            container.appendChild(toast);
            setTimeout(() => { toast.style.opacity = '0'; toast.style.transition = 'opacity .3s'; setTimeout(() => toast.remove(), 300); }, 3000);
        }

        async function ajaxRequest(url, method = 'GET', data = null) {
            const options = {
                method,
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json',
                },
            };
            if (data && !(data instanceof FormData)) {
                options.headers['Content-Type'] = 'application/json';
                options.body = JSON.stringify(data);
            } else if (data instanceof FormData) {
                options.body = data;
            }
            const response = await fetch(url, options);
            return response.json();
        }
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\MATKUL SEMS 6\PRAKTIKUM ABP\webpro\webprofile\resources\views/layouts/admin.blade.php ENDPATH**/ ?>