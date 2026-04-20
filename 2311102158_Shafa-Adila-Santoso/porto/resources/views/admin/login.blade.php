<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --pink:#ff4d88; --pink-deep:#c2185b; --pink-light:#ffb3cc;
      --black:#0a0a0a; --black-2:#111111; --black-3:#1a1a1a;
      --white:#faf5f7; --muted:#9e8a90;
      --gradient:linear-gradient(135deg,#ff4d88 0%,#c2185b 60%,#7b0038 100%);
      --glow:0 0 40px rgba(255,77,136,.35);
      --font-display:'Cormorant Garamond',serif;
      --font-body:'DM Sans',sans-serif;
    }
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
    body{
      font-family:var(--font-body); background:var(--black);
      color:var(--white); min-height:100vh;
      display:flex; align-items:center; justify-content:center;
      cursor:none; overflow:hidden;
    }
    /* mesh bg */
    body::before{
      content:''; position:fixed; inset:0;
      background:
        radial-gradient(ellipse 70% 60% at 80% 30%, rgba(194,24,91,.2) 0%, transparent 65%),
        radial-gradient(ellipse 50% 50% at 10% 80%, rgba(255,77,136,.1) 0%, transparent 60%),
        radial-gradient(ellipse 40% 40% at 50% 10%, rgba(123,0,56,.15) 0%, transparent 60%);
      pointer-events:none; z-index:0;
    }
    /* cursor */
    .cursor{width:10px;height:10px;background:var(--pink);border-radius:50%;position:fixed;top:0;left:0;pointer-events:none;z-index:9999;transform:translate(-50%,-50%);transition:transform .15s;}
    .cursor-ring{width:32px;height:32px;border:1.5px solid rgba(255,77,136,.5);border-radius:50%;position:fixed;top:0;left:0;pointer-events:none;z-index:9998;transform:translate(-50%,-50%);transition:transform .3s,width .2s,height .2s;}
    /* scrollbar */
    ::-webkit-scrollbar{width:3px;} ::-webkit-scrollbar-thumb{background:var(--pink);}

    .login-wrap{
      position:relative; z-index:1;
      width:100%; max-width:420px;
      padding:0 1.5rem;
    }

    .brand{
      font-family:var(--font-display); font-weight:600;
      font-size:1.6rem; color:var(--white);
      text-align:center; margin-bottom:.25rem;
      letter-spacing:.02em;
    }
    .brand span{color:var(--pink);}

    .brand-sub{
      font-size:10px; letter-spacing:.4em; text-transform:uppercase;
      color:var(--muted); text-align:center; margin-bottom:2.5rem;
    }

    .card{
      background:rgba(17,17,17,.85);
      border:1px solid rgba(255,77,136,.15);
      border-radius:4px;
      padding:2.5rem 2rem;
      backdrop-filter:blur(12px);
      box-shadow:0 20px 60px rgba(0,0,0,.5), inset 0 1px 0 rgba(255,77,136,.08);
    }

    .field-label{
      font-size:10px; letter-spacing:.35em; text-transform:uppercase;
      color:var(--muted); display:block; margin-bottom:.5rem;
    }

    .field{margin-bottom:1.5rem; position:relative;}

    .field-input{
      width:100%; background:var(--black-3);
      border:none; border-bottom:1px solid rgba(255,77,136,.2);
      color:var(--white); padding:.7rem 0.5rem;
      font-family:var(--font-body); font-size:.9rem;
      outline:none; transition:border-color .3s;
    }
    .field-input:focus{border-bottom-color:var(--pink);}
    .field-input::placeholder{color:#4a3a40;}

    /* line animation on focus */
    .field::after{
      content:''; position:absolute; bottom:0; left:0;
      width:0; height:1px; background:var(--gradient);
      transition:width .4s ease;
    }
    .field:focus-within::after{width:100%;}

    .btn-login{
      width:100%; background:var(--gradient); color:#fff;
      border:none; padding:.85rem; border-radius:2px;
      font-family:var(--font-display); font-weight:600;
      font-size:1.1rem; letter-spacing:.05em;
      cursor:pointer; transition:opacity .25s, transform .2s;
      box-shadow:var(--glow); margin-top:.5rem;
      display:flex; align-items:center; justify-content:center; gap:.5rem;
    }
    .btn-login:hover{opacity:.88; transform:translateY(-2px);}

    .divider{
      display:flex; align-items:center; gap:1rem;
      margin:1.5rem 0; color:rgba(255,77,136,.2); font-size:.7rem;
    }
    .divider::before,.divider::after{content:''; flex:1; height:1px; background:rgba(255,77,136,.12);}

    .demo-box{
      background:var(--black); border:1px solid rgba(255,77,136,.1);
      border-radius:2px; padding:.9rem 1rem;
      font-size:.75rem; color:var(--muted); line-height:2;
    }
    .demo-box .c{
      font-style:italic; color:var(--pink-light);
      font-family:var(--font-display); font-size:.9rem;
    }
    .demo-box code{color:rgba(255,77,136,.7); font-size:.75rem;}

    .error-box{
      background:rgba(255,77,136,.08); border:1px solid rgba(255,77,136,.25);
      border-radius:2px; padding:.7rem 1rem;
      font-size:.82rem; color:var(--pink-light);
      margin-bottom:1.25rem; display:flex; align-items:center; gap:.5rem;
    }

    .back-link{
      display:block; text-align:center; margin-top:1.5rem;
      font-size:11px; letter-spacing:.2em; text-transform:uppercase;
      color:var(--muted); text-decoration:none;
      transition:color .25s;
    }
    .back-link:hover{color:var(--pink-light);}
  </style>
</head>
<body>

<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<div class="login-wrap">
  <div class="brand">Admin Login</div>
  <div class="brand-sub">portfolio dashboard</div>

  <div class="card">

    @if($errors->any())
      <div class="error-box">
        <i class="bi bi-exclamation-circle"></i>
        {{ $errors->first() }}
      </div>
    @endif

    @if(session('error'))
      <div class="error-box">
        <i class="bi bi-exclamation-circle"></i>
        {{ session('error') }}
      </div>
    @endif

    <form action="{{ route('admin.login.post') }}" method="POST">
      @csrf

      <div class="field">
        <label class="field-label">Email</label>
        <input type="email" name="email" class="field-input"
               placeholder="email@domain.com"
               value="{{ old('email') }}" required autofocus>
      </div>

      <div class="field">
        <label class="field-label">Password</label>
        <input type="password" name="password" class="field-input"
               placeholder="••••••••" required>
      </div>

      <button type="submit" class="btn-login">
        <i class="bi bi-arrow-right-circle"></i> Masuk ke Dashboard
      </button>
    </form>

    <div class="divider">akun demo</div>

    <div class="demo-box">
      <span class="c">// demo credentials</span><br>
      email &nbsp;&nbsp;: <code>admin@porto.com</code><br>
      passwd : <code>password123</code>
    </div>

  </div>

  <a href="/" class="back-link">← Kembali ke Portofolio</a>
</div>

<script>
  const cursor = document.getElementById('cursor');
  const ring   = document.getElementById('cursorRing');
  document.addEventListener('mousemove', e => {
    cursor.style.left = ring.style.left = e.clientX + 'px';
    cursor.style.top  = ring.style.top  = e.clientY + 'px';
  });
  document.querySelectorAll('a, button, input').forEach(el => {
    el.addEventListener('mouseenter', () => { cursor.style.transform='translate(-50%,-50%) scale(1.5)'; ring.style.width=ring.style.height='48px'; ring.style.borderColor='rgba(255,77,136,.7)'; });
    el.addEventListener('mouseleave', () => { cursor.style.transform='translate(-50%,-50%) scale(1)';   ring.style.width=ring.style.height='32px'; ring.style.borderColor='rgba(255,77,136,.5)'; });
  });
</script>
</body>
</html>
