<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyPorto</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- phospor --}}
    <script src="https://cdn.jsdelivr.net/npm/phosphor-icons@1.4.2/src/index.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/phosphor-icons@1.4.2/src/css/icons.min.css" rel="stylesheet">
</head>

<body>

    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="card shadow-sm w-100" style="max-width: 420px;">
            <div class="card-body p-4">
                <h3 class="card-title text-center mb-1">Welcome back</h3>
                <p class="text-muted text-center mb-4">Sign in to continue to MyPorto</p>

                <form action="{{ route('login') }}" method="POST" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            autofocus class="form-control @error('email') is-invalid @enderror"
                            placeholder="you@example.com">

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" required
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password">

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid mt-5 mb-3">
                        <button type="submit" class="btn btn-primary btn-lg"><i class="ph-bold ph-sign-in"></i> Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
