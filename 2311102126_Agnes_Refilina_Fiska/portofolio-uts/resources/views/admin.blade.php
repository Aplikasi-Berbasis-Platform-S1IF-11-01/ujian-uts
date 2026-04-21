<!DOCTYPE html>
<html lang="id">
<head>
    <title>Admin Dashboard | Portofolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f7f6; padding-top: 50px; }
        .card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card p-5">
                    <h2 class="fw-bold mb-4">Update Data Portofolio</h2>
                    
                    @if(session('success'))
                        <div class="alert alert-success border-0 rounded-pill px-4">{{ session('success') }}</div>
                    @endif

                    <form action="/update-profile" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control form-control-lg" value="{{ $data->nama ?? '' }}" placeholder="Contoh: Agnes Refilina Fiska" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Peran / Profesi</label>
                            <input type="text" name="peran" class="form-control form-control-lg" value="{{ $data->peran ?? '' }}" placeholder="Contoh: UI/UX Designer" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Tentang Saya & Pengalaman</label>
                            <textarea name="deskripsi" class="form-control" rows="6" placeholder="Ambil data dari CV kamu..." required>{{ $data->deskripsi ?? '' }}</textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill">Simpan Perubahan</button>
                            <a href="/" class="btn btn-link text-decoration-none text-muted">Batal & Lihat Web</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>