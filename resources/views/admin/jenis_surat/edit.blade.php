<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jenis Surat - Bina Desa</title>
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
                <div class="logo">
                    <a href="{{ route('admin.dashboard') }}">
                        <h4 class="text-primary">🏘️ Bina Desa</h4>
                    </a>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                            <i class="bi bi-grid-fill"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.warga.index') }}" class="sidebar-link">
                            <i class="bi bi-people-fill"></i><span>Data Warga</span>
                        </a>
                    </li>
                    <li class="sidebar-item active">
                        <a href="{{ route('admin.jenis_surat.index') }}" class="sidebar-link">
                            <i class="bi bi-folder-fill"></i><span>Jenis Surat</span>
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
            <h3>Edit Jenis Surat</h3>
        </div>

        <div class="page-content">
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Edit Jenis Surat</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.jenis_surat.update', $jenisSurat->jenis_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="kode" class="form-label">Kode Surat</label>
                                <input type="text" id="kode" name="kode" class="form-control"
                                       value="{{ old('kode', $jenisSurat->kode) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="nama_jenis" class="form-label">Nama Jenis Surat</label>
                                <input type="text" id="nama_jenis" name="nama_jenis" class="form-control"
                                       value="{{ old('nama_jenis', $jenisSurat->nama_jenis) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="syarat_json" class="form-label">Persyaratan (JSON / Text)</label>
                                <textarea id="syarat_json" name="syarat_json" class="form-control" rows="4">{{ old('syarat_json', $jenisSurat->syarat_json) }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.jenis_surat.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
