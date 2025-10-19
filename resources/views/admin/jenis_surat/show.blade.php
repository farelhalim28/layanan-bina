<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jenis Surat - Bina Desa</title>
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
            <h3>Detail Jenis Surat</h3>
        </div>

        <div class="page-content">
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi Jenis Surat</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px;">Kode Surat</th>
                                <td>{{ $jenisSurat->kode }}</td>
                            </tr>
                            <tr>
                                <th>Nama Jenis Surat</th>
                                <td>{{ $jenisSurat->nama_jenis }}</td>
                            </tr>
                            <tr>
                                <th>Persyaratan</th>
                                <td>
                                    <pre class="m-0">{{ $jenisSurat->syarat_json ?? '-' }}</pre>
                                </td>
                            </tr>
                        </table>

                        <div class="d-flex justify-content-end gap-2 mt-3">
                            <a href="{{ route('admin.jenis_surat.edit', $jenisSurat->jenis_id) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="{{ route('admin.jenis_surat.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
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
