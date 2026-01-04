@extends('layouts.admin.app')

@section('title', 'Dashboard - Layanan Mandiri & Surat')

@section('content')
@php
    $user = session('user') ?? null;
@endphp

<div class="page-heading">
    <h3>Dashboard Layanan Mandiri & Surat</h3>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <!-- STATISTIK UTAMA -->
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldLocation"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total Warga</h6>
                                    <h6 class="font-extrabold mb-0">{{ $stats['total_warga'] }}</h6>
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
                                        <i class="iconly-boldHome"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jenis Surat</h6>
                                    <h6 class="font-extrabold mb-0">{{ $stats['total_jenis_surat'] }}</h6>
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
                                        <i class="iconly-boldTicket"></i>
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
                                    <div class="stats-icon red">
                                        <i class="iconly-boldStar"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total Media</h6>
                                    <h6 class="font-extrabold mb-0">{{ $stats['total_media'] }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CHART PERMOHONAN -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistik Permohonan Surat Tahun {{ date('Y') }}</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-permohonan"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TOP JENIS SURAT & PERMOHONAN TERBARU -->
            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Top Jenis Surat Diajukan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Jenis Surat</th>
                                            <th>Total</th>
                                            <th>Selesai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($topJenisSurat ?? [] as $jenis)
                                            <tr>
                                                <td>{{ $jenis->nama_jenis ?? '-' }}</td>
                                                <td><span class="badge bg-info">{{ $jenis->total_permohonan ?? 0 }}</span></td>
                                                <td><span class="badge bg-success">{{ $jenis->selesai ?? 0 }}</span></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">Belum ada data</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Status Permohonan</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Pending</td>
                                            <td><span class="badge bg-warning">{{ $stats['surat_pending'] ?? 0 }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Diproses</td>
                                            <td><span class="badge bg-info">{{ $stats['surat_diproses'] ?? 0 }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Selesai</td>
                                            <td><span class="badge bg-success">{{ $stats['surat_selesai'] ?? 0 }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Ditolak</td>
                                            <td><span class="badge bg-danger">{{ $stats['surat_ditolak'] ?? 0 }}</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PERMOHONAN TERBARU -->
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
                                            <th>Nomor</th>
                                            <th>Pemohon</th>
                                            <th>Jenis Surat</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($permohonan_terbaru as $p)
                                            <tr>
                                                <td>
                                                    <span class="badge bg-light text-dark">{{ $p->nomor_permohonan }}</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar avatar-md bg-primary">
                                                            <span class="text-white fw-bold">
                                                                {{ substr($p->pemohon->nama ?? 'U', 0, 1) }}
                                                            </span>
                                                        </div>
                                                        <p class="font-bold ms-3 mb-0">{{ $p->pemohon->nama ?? '-' }}</p>
                                                    </div>
                                                </td>
                                                <td>{{ $p->jenisSurat->nama_jenis ?? '-' }}</td>
                                                <td>
                                                    @if($p->status == 'diajukan')
                                                        <span class="badge bg-warning">Diajukan</span>
                                                    @elseif($p->status == 'diproses')
                                                        <span class="badge bg-info">Diproses</span>
                                                    @elseif($p->status == 'selesai')
                                                        <span class="badge bg-success">Selesai</span>
                                                    @else
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @endif
                                                </td>
                                                <td>{{ $p->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">Belum ada permohonan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SIDEBAR KANAN -->
        <div class="col-12 col-lg-3">
            <!-- STATISTIK CEPAT -->
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="text-center">
                        <div class="avatar avatar-xl bg-success mb-3">
                            <i class="bi bi-file-earmark-check text-white" style="font-size: 2rem;"></i>
                        </div>
                        <div class="name">
                            <h6 class="text-muted mb-1">Permohonan Selesai</h6>
                            <h5 class="font-bold text-success">{{ $stats['surat_selesai'] ?? 0 }}</h5>
                        </div>
                        <hr>
                        <div class="name">
                            <h6 class="text-muted mb-1">Permohonan Pending</h6>
                            <h6 class="font-bold text-warning">{{ $stats['surat_pending'] ?? 0 }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PROGRESS STATUS PERMOHONAN -->
            <div class="card">
                <div class="card-header">
                    <h4>Progress Status Permohonan</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Pending</span>
                            <span class="badge bg-warning">{{ $stats['surat_pending'] ?? 0 }}</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-warning" style="width: {{ $stats['total_permohonan'] > 0 ? ($stats['surat_pending']/$stats['total_permohonan'])*100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Diproses</span>
                            <span class="badge bg-info">{{ $stats['surat_diproses'] ?? 0 }}</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-info" style="width: {{ $stats['total_permohonan'] > 0 ? ($stats['surat_diproses']/$stats['total_permohonan'])*100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Selesai</span>
                            <span class="badge bg-success">{{ $stats['surat_selesai'] ?? 0 }}</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" style="width: {{ $stats['total_permohonan'] > 0 ? ($stats['surat_selesai']/$stats['total_permohonan'])*100 : 0 }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Ditolak</span>
                            <span class="badge bg-danger">{{ $stats['surat_ditolak'] ?? 0 }}</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-danger" style="width: {{ $stats['total_permohonan'] > 0 ? ($stats['surat_ditolak']/$stats['total_permohonan'])*100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CHART STATUS PERMOHONAN (DONUT) -->
            <div class="card">
                <div class="card-header">
                    <h4>Distribusi Status</h4>
                </div>
                <div class="card-body">
                    <div id="chart-status-donut"></div>
                </div>
            </div>

            <!-- WARGA TERBARU -->
            <div class="card">
                <div class="card-header">
                    <h4>Warga Terbaru</h4>
                </div>
                <div class="card-content pb-4">
                    @forelse($warga as $w)
                        <div class="recent-message d-flex px-4 py-3 border-bottom">
                            <div class="avatar avatar-lg bg-info">
                                <span class="text-white fw-bold">
                                    {{ substr($w->nama, 0, 1) }}
                                </span>
                            </div>
                            <div class="name ms-4">
                                <h5 class="mb-1">{{ $w->nama }}</h5>
                                <h6 class="text-muted mb-0">{{ $w->nik }}</h6>
                                <small class="text-muted">{{ $w->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    @empty
                        <div class="px-4 py-3 text-center text-muted">
                            <p>Belum ada data warga</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('assets-admin/vendors/apexcharts/apexcharts.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data dari server (convert ke JS)
        var pendingCount = {{ $stats['surat_pending'] ?? 0 }};
        var diproseCount = {{ $stats['surat_diproses'] ?? 0 }};
        var selesaiCount = {{ $stats['surat_selesai'] ?? 0 }};
        var ditolakCount = {{ $stats['surat_ditolak'] ?? 0 }};

        // Chart Permohonan per Bulan
        var chartElement = document.querySelector("#chart-permohonan");
        if (chartElement) {
            var optionsPermohonan = {
                series: [{
                    name: 'Permohonan',
                    data: [
                        {{ $chartData[0] ?? 0 }},
                        {{ $chartData[1] ?? 0 }},
                        {{ $chartData[2] ?? 0 }},
                        {{ $chartData[3] ?? 0 }},
                        {{ $chartData[4] ?? 0 }},
                        {{ $chartData[5] ?? 0 }},
                        {{ $chartData[6] ?? 0 }},
                        {{ $chartData[7] ?? 0 }},
                        {{ $chartData[8] ?? 0 }},
                        {{ $chartData[9] ?? 0 }},
                        {{ $chartData[10] ?? 0 }},
                        {{ $chartData[11] ?? 0 }}
                    ]
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                colors: ['#435ebe'],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des']
                },
                dataLabels: {
                    enabled: false
                },
                title: {
                    text: 'Total Permohonan per Bulan',
                    align: 'left'
                }
            };
            var chartPermohonan = new ApexCharts(chartElement, optionsPermohonan);
            chartPermohonan.render();
        }

        // Chart Status Donut
        var chartDonutElement = document.querySelector("#chart-status-donut");
        if (chartDonutElement) {
            var optionsStatus = {
                series: [pendingCount, diproseCount, selesaiCount, ditolakCount],
                chart: {
                    type: 'donut',
                    height: 250
                },
                labels: ['Pending', 'Diproses', 'Selesai', 'Ditolak'],
                colors: ['#ffc107', '#0dcaf0', '#198754', '#dc3545'],
                legend: {
                    show: false
                }
            };
            var chartStatus = new ApexCharts(chartDonutElement, optionsStatus);
            chartStatus.render();
        }
    });
</script>

@endsection
