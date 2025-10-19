<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bina Desa</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/app.css') }}">
</head>
<body>
    @php
        use Illuminate\Support\Str;

        // safe defaults if controller belum kirim data
        $user = session('user') ?? null;
        $warga = $warga ?? [];
        $jenis_surat = $jenis_surat ?? [];
        $stats = $stats ?? ['total_warga' => 0, 'total_jenis_surat' => 0];
    @endphp

    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="{{ route('admin.dashboard') }}"><h4 class="text-success">🏘️ Bina Desa</h4></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active">
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

                        <li class="sidebar-item">
                            {{-- FIXED: use underscore sesuai resource name --}}
                            <a href="{{ route('admin.jenis_surat.index') }}" class='sidebar-link'>
                                <i class="bi bi-folder-fill"></i>
                                <span>Jenis Surat</span>
                            </a>
                        </li>

                        <li class="sidebar-title">Akun</li>
                        <li class="sidebar-item">
                            <a href="{{ route('admin.logout') }}" class='sidebar-link'
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
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

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="page-heading">
                {{-- safe access ke nama user --}}
                <h3>Selamat Datang, {{ $user['nama'] ?? 'Admin' }}!</h3>
            </div>

            <div class="page-heading">
                <h3>Statistik Data</h3>
            </div>

            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-6 col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Warga</h6>
                                                <h6 class="font-extrabold mb-0">{{ $stats['total_warga'] ?? 0 }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Jenis Surat</h6>
                                                <h6 class="font-extrabold mb-0">{{ $stats['total_jenis_surat'] ?? 0 }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Data Warga Terbaru --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Data Warga Terbaru</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-lg">
                                                <thead>
                                                    <tr>
                                                        <th>No KTP</th>
                                                        <th>Nama</th>
                                                        <th>JK</th>
                                                        <th>Pekerjaan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($warga as $w)
                                                        <tr>
                                                            <td class="font-bold">{{ $w->no_ktp }}</td>
                                                            <td>{{ $w->nama }}</td>
                                                            <td>{{ $w->jenis_kelamin }}</td>
                                                            <td>{{ $w->pekerjaan }}</td>
                                                            <td>
                                                                <a href="{{ route('admin.warga.show', $w->warga_id) }}" class="btn btn-sm btn-primary">
                                                                    <i class="bi bi-eye"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="5" class="text-center text-muted">Belum ada data warga</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-3 text-center">
                                            <a href="{{ route('admin.warga.index') }}" class="btn btn-primary">Lihat Semua</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Daftar Jenis Surat --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Daftar Jenis Surat</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-lg">
                                                <thead>
                                                    <tr>
                                                        <th>Kode</th>
                                                        <th>Nama Jenis</th>
                                                        <th>Persyaratan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($jenis_surat as $jenis)
                                                        <tr>
                                                            <td><span class="badge bg-primary">{{ $jenis->kode }}</span></td>
                                                            <td>{{ $jenis->nama_jenis }}</td>
                                                            <td>
                                                                @if($jenis->syarat_json)
                                                                    <small class="text-muted">{{ Str::limit($jenis->syarat_json, 40) }}</small>
                                                                @else
                                                                    <span class="text-muted">-</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{-- FIXED: use underscore sesuai resource name --}}
                                                                <a href="{{ route('admin.jenis_surat.edit', $jenis->jenis_id) }}" class="btn btn-sm btn-warning">
                                                                    <i class="bi bi-pencil"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center text-muted">Belum ada jenis surat</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-3 text-center">
                                            {{-- FIXED: use underscore sesuai resource name --}}
                                            <a href="{{ route('admin.jenis_surat.index') }}" class="btn btn-primary">Lihat Semua</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets-admin/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/main.js') }}"></script>
</body>
</html>
