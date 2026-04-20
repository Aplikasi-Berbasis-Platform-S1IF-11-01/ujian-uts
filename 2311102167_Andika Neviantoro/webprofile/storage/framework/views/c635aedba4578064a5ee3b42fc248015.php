<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – Admin Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,600;0,9..144,700;1,9..144,300&family=DM+Mono:wght@400;500&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --ink: #1a1a2e; --accent: #e8580a; --accent2: #f7a44a;
            --dark: #1a1a2e; --bg: #faf9f6; --border: #eeecf0;
            --f-display: 'Fraunces', serif; --f-body: 'Nunito', sans-serif; --f-mono: 'DM Mono', monospace;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--f-body); background: var(--dark); min-height: 100vh; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; }
        body::before {
            content: ''; position: absolute; width: 600px; height: 600px; border-radius: 50%;
            background: radial-gradient(circle, rgba(232,88,10,.12) 0%, transparent 70%);
            top: -200px; right: -200px; pointer-events: none;
        }
        body::after {
            content: ''; position: absolute; width: 400px; height: 400px; border-radius: 50%;
            background: radial-gradient(circle, rgba(61,140,122,.08) 0%, transparent 70%);
            bottom: -100px; left: -100px; pointer-events: none;
        }
        .login-wrap {
            width: 100%; max-width: 420px; padding: 24px;
            position: relative; z-index: 10;
        }
        .login-brand {
            text-align: center; margin-bottom: 32px;
        }
        .login-brand h1 {
            font-family: var(--f-display); font-size: 32px; font-weight: 600;
            color: #fff; letter-spacing: -.03em;
        }
        .login-brand h1 span { color: var(--accent2); }
        .login-brand p { font-size: 13px; color: rgba(255,255,255,.35); margin-top: 6px; font-family: var(--f-mono); letter-spacing: .06em; }
        .login-card {
            background: rgba(255,255,255,.04); border: 1px solid rgba(255,255,255,.08);
            border-radius: 20px; padding: 36px;
            backdrop-filter: blur(20px);
        }
        .login-title { font-size: 16px; font-weight: 700; color: rgba(255,255,255,.8); margin-bottom: 24px; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 11px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: rgba(255,255,255,.35); margin-bottom: 8px; }
        .form-group input {
            width: 100%; padding: 12px 16px;
            background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.1);
            border-radius: 12px; color: #fff; font-size: 14px; font-family: var(--f-body);
            transition: border-color .2s, background .2s;
        }
        .form-group input:focus { outline: none; border-color: rgba(232,88,10,.5); background: rgba(255,255,255,.08); }
        .form-group input::placeholder { color: rgba(255,255,255,.2); }
        .form-check { display: flex; align-items: center; gap: 8px; margin-bottom: 24px; }
        .form-check input { width: 16px; height: 16px; accent-color: var(--accent); cursor: pointer; }
        .form-check label { font-size: 13px; color: rgba(255,255,255,.4); cursor: pointer; }
        .btn-login {
            width: 100%; padding: 13px; background: var(--accent); color: #fff;
            border: none; border-radius: 12px; font-size: 14px; font-weight: 700;
            font-family: var(--f-body); cursor: pointer; transition: all .2s; letter-spacing: .02em;
        }
        .btn-login:hover { background: #c94808; transform: translateY(-1px); box-shadow: 0 8px 24px rgba(232,88,10,.3); }
        .alert-error {
            background: rgba(229,62,62,.1); border: 1px solid rgba(229,62,62,.25);
            border-radius: 10px; padding: 12px 16px; margin-bottom: 20px;
            color: #fc8181; font-size: 13px;
        }
        .login-footer { text-align: center; margin-top: 20px; font-size: 12px; color: rgba(255,255,255,.2); }
        .login-footer a { color: rgba(255,255,255,.4); text-decoration: none; }
        .login-footer a:hover { color: var(--accent2); }
        .demo-info {
            background: rgba(247,164,74,.07); border: 1px solid rgba(247,164,74,.2);
            border-radius: 10px; padding: 12px 16px; margin-bottom: 20px;
            font-size: 12px; color: rgba(247,164,74,.8); font-family: var(--f-mono);
        }
        .demo-info strong { color: var(--accent2); }
    </style>
</head>
<body>
    <div class="login-wrap">
        <div class="login-brand">
            <h1><span>A</span>ndika<span>.</span></h1>
            <p>ADMIN PANEL</p>
        </div>
        <div class="login-card">
            <div class="login-title">Masuk ke Dashboard</div>

            <?php if($errors->any()): ?>
            <div class="alert-error">
                <?php echo e($errors->first()); ?>

            </div>
            <?php endif; ?>

            <form action="<?php echo e(route('login.post')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>" placeholder="admin@portfolio.com" required autofocus>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Ingat saya</label>
                </div>
                <button type="submit" class="btn-login">Masuk →</button>
            </form>
        </div>
        <div class="login-footer">
            <a href="<?php echo e(route('home')); ?>">← Kembali ke Portfolio</a>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\MATKUL SEMS 6\PRAKTIKUM ABP\webpro\webprofile\resources\views/auth/login.blade.php ENDPATH**/ ?>