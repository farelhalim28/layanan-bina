<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jenis Surat - Bina Desa</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/app.css') }}">
</head>
<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ route('admin.dashboard') }}"><h4 class="text-primary">🏘️ Bina Desa</h4></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item">
                            <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('admin.warga.index') }}" class='sidebar-link'>
                                <i class="bi bi-people-fill"></i>
                                <span>Data Warga</span>
                            </a>
                        </li>
                        <li class="sidebar-item active">
                            <a href="{{ route('admin.jenis_surat.index') }}" class='sidebar-link'>
                                <i class="bi bi-folder-fill"></i>
                                <span>Jenis Surat</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Tambah Jenis Surat</h3>
            </div>

            <div class="page-content">
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Jenis Surat</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.jenis_surat.store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="kode" class="form-label">Kode Surat <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" value="{{ old('kode') }}" placeholder="Contoh: SKD" required>
                                        <small class="text-muted">Contoh: SKD, SKTM, SKU, dll</small>
                                        @error('kode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="nama_jenis" class="form-label">Nama Jenis Surat <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror" id="nama_jenis" name="nama_jenis" value="{{ old('nama_jenis') }}" placeholder="Contoh: Surat Keterangan Domisili" required>
                                        @error('nama_jenis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label for="syarat_json" class="form-label">Persyaratan (JSON/Text)</label>
                                        <textarea class="form-control @error('syarat_json') is-invalid @enderror" id="syarat_json" name="syarat_json" rows="4" placeholder='Contoh: {"ktp": true, "kk": true, "pengantar_rt": true}'>{{ old('syarat_json') }}</textarea>
                                        <small class="text-muted">Optional: Isi dengan format JSON untuk persyaratan surat</small>
                                        @error('syarat_json')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.jenis_surat.index') }}" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets-admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/main.js') }}"></script>
</body>
</html>
