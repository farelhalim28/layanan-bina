<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Bina Desa</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets-admin/images/favicon.svg') }}" type="image/x-icon">
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
                            <a href="{{ route('admin.permohonan.index') }}" class='sidebar-link'>
                                <i class="bi bi-file-earmark-text"></i>
                                <span>Permohonan Surat</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="{{ route('admin.jenis_surat.index') }}" class='sidebar-link'>
                                <i class="bi bi-folder"></i>
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
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="page-heading">
                <h3>Selamat Datang, {{ $user['nama'] }}!</h3>
            </div>

            <div class="page-heading">
                <h3>Statistik Permohonan Surat</h3>
            </div>

            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Permohonan</h6>
                                                <h6 class="font-extrabold mb-0">{{ $stats['total_permohonan'] }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Pending</h6>
                                                <h6 class="font-extrabold mb-0">{{ $stats['pending'] }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Disetujui</h6>
                                                <h6 class="font-extrabold mb-0">{{ $stats['disetujui'] }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Ditolak</h6>
                                                <h6 class="font-extrabold mb-0">{{ $stats['ditolak'] }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Permohonan Surat Terbaru</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-lg">
                                                <thead>
                                                    <tr>
                                                        <th>No. Permohonan</th>
                                                        <th>Pemohon</th>
                                                        <th>Jenis Surat</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($permohonan as $item)
                                                    <tr>
                                                        <td class="col-3">
                                                            <p class="font-bold mb-0">{{ $item['nomor_permohonan'] }}</p>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class="mb-0">User #{{ $item['pemohon_user_id'] }}</p>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class="mb-0">
                                                                @php
                                                                    $jenis = collect($jenis_surat)->firstWhere('jenis_id', $item['jenis_id']);
                                                                @endphp
                                                                {{ $jenis['kode'] ?? 'N/A' }} - {{ $jenis['nama_jenis'] ?? 'N/A' }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            @if($item['status'] == 'pending')
                                                                <span class="badge bg-warning">Pending</span>
                                                            @elseif($item['status'] == 'proses')
                                                                <span class="badge bg-info">Proses</span>
                                                            @elseif($item['status'] == 'disetujui')
                                                                <span class="badge bg-success">Disetujui</span>
                                                            @else
                                                                <span class="badge bg-danger">Ditolak</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.permohonan.show', $item['permohonan_id']) }}" class="btn btn-sm btn-primary">Detail</a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">Belum ada permohonan</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-3 text-center">
                                            <a href="{{ route('admin.permohonan.index') }}" class="btn btn-primary">Lihat Semua</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                                        <th>Template</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($jenis_surat as $jenis)
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-primary">{{ $jenis['kode'] }}</span>
                                                        </td>
                                                        <td>{{ $jenis['nama_jenis'] }}</td>
                                                        <td>{{ $jenis['template_file'] }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.jenis_surat.edit', $jenis['jenis_id']) }}" class="btn btn-sm btn-warning">Edit</a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center">Belum ada jenis surat</td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-3 text-center">
                                            <a href="{{ route('admin.jenis_surat.index') }}" class="btn btn-primary">Lihat Semua</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4 px-5">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl">
                                        <img src="{{ asset('assets-admin/images/faces/1.jpg') }}" alt="Face 1">
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold">{{ $user['nama'] }}</h5>
                                        <h6 class="text-muted mb-0">{{ $user['email'] }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header"><h4>Statistik Status</h4></div>
                            <div class="card-body">
                                <div id="chart-visitors-profile"></div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-primary" width="32" height="32" fill="blue" style="width:10px">
                                                <use xlink:href="{{ asset('assets-admin/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">Pending</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-0 text-end">{{ $stats['pending'] }}</h5>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-success" width="32" height="32" fill="blue" style="width:10px">
                                                <use xlink:href="{{ asset('assets-admin/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">Disetujui</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-0 text-end">{{ $stats['disetujui'] }}</h5>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">
                                            <svg class="bi text-danger" width="32" height="32" fill="blue" style="width:10px">
                                                <use xlink:href="{{ asset('assets-admin/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                            </svg>
                                            <h5 class="mb-0 ms-3">Ditolak</h5>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h5 class="mb-0 text-end">{{ $stats['ditolak'] }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header"><h4>Info Sistem</h4></div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <small class="text-muted">Total Jenis Surat</small>
                                    <h5 class="font-bold">{{ $stats['total_jenis_surat'] }} Jenis</h5>
                                </div>
                                <div class="mb-3">
                                    <small class="text-muted">Total Permohonan</small>
                                    <h5 class="font-bold">{{ $stats['total_permohonan'] }} Permohonan</h5>
                                </div>
                                <a href="{{ route('admin.permohonan.index') }}" class="btn btn-primary btn-block w-100">Lihat Semua</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2024 &copy; Bina Desa</p>
                    </div>
                    <div class="float-end">
                        <p>Sistem Layanan Mandiri & Surat Desa</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets-admin/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets-admin/vendors/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets-admin/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets-admin/js/main.js') }}"></script>
</body>
</html>
