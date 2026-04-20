<!DOCTYPE html>
<html lang="id">


<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login — Portfolio</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Syne:wght@700;800&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo e(asset('css/admin-login.css')); ?>">
</head>

<body>

    <div class="login-card">
        <div class="logo">
            <div class="logo-icon"><i class="fas fa-shield-halved"></i></div>
            <h1>Admin Panel</h1>
            <p>// portfolio.dashboard</p>
        </div>

        
        <?php if($errors->any()): ?>
            <div class="error-box">
                <i class="fas fa-circle-exclamation"></i>
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.login.post')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label>Email</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="admin@portfolio.com" value="<?php echo e(old('email')); ?>"
                        required autofocus />
                </div>
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="••••••••" required />
                </div>
            </div>

            <div class="checkbox-row">
                <input type="checkbox" name="remember" id="remember" />
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-right-to-bracket"></i> Masuk ke Dashboard
            </button>
        </form>

        <div class="back-link">
            <a href="<?php echo e(route('home')); ?>"><i class="fas fa-arrow-left"></i> Kembali ke Portfolio</a>
        </div>
    </div>

</body>

</html>
<?php /**PATH D:\semester 6\ABP praktikum\portfolio-laravel\portfolio-laravel\resources\views/admin/login.blade.php ENDPATH**/ ?>