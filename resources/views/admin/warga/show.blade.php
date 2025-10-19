<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Warga - Bina Desa</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/app.css') }}">
</head>
<body>
<div id="app">
    <div id="main" class="container py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Detail Data Warga</h4>
                <a href="{{ route('admin.warga.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr><th>No KTP</th><td>{{ $warga->no_ktp }}</td></tr>
                    <tr><th>Nama</th><td>{{ $warga->nama }}</td></tr>
                    <tr><th>Jenis Kelamin</th><td>{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                    <tr><th>Agama</th><td>{{ $warga->agama }}</td></tr>
                    <tr><th>Pekerjaan</th><td>{{ $warga->pekerjaan }}</td></tr>
                    <tr><th>No Telepon</th><td>{{ $warga->telp }}</td></tr>
                    <tr><th>Email</th><td>{{ $warga->email }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets-admin/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets-admin/js/main.js') }}"></script>
</body>
</html>
