@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
@php
    use Illuminate\Support\Str;
    $user = session('user') ?? null;
    $warga = $warga ?? [];
    $jenis_surat = $jenis_surat ?? [];
    $users = $users ?? [];
    $media = $media ?? [];
    $stats = $stats ?? [
        'total_warga' => 0,
        'total_jenis_surat' => 0,
        'total_users' => 0,
        'total_media' => 0,
        'surat_diproses' => 0,
        'pending_request' => 0
    ];
@endphp

<style>
    body {
        background: #f5f7fa !important;
    }

    .welcome-banner {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        padding: 20px 30px;
        border-radius: 10px;
        margin-bottom: 30px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .welcome-banner h5 {
        margin: 0;
        font-weight: 700;
        font-size: 20px;
        color: #2d3748;
    }

    .welcome-banner p {
        margin: 5px 0 0 0;
        font-size: 14px;
        color: #718096;
    }

    .page-title-light {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 30px;
        color: #2d3748;
    }

    .stats-grid-light {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card-light {
        background: #ffffff;
        border-radius: 10px;
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: transform 0.3s, box-shadow 0.3s;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .stat-card-light:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    .stat-icon-light {
        width: 65px;
        height: 65px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        color: white;
    }

    .stat-icon-light.purple { background: linear-gradient(135deg, #9775fa 0%, #7c5ceb 100%); }
    .stat-icon-light.blue { background: linear-gradient(135deg, #4c6ef5 0%, #3b5bdb 100%); }
    .stat-icon-light.green { background: linear-gradient(135deg, #51cf66 0%, #40c057 100%); }
    .stat-icon-light.red { background: linear-gradient(135deg, #ff6b6b 0%, #fa5252 100%); }
    .stat-icon-light.cyan { background: linear-gradient(135deg, #22d3ee 0%, #06b6d4 100%); }
    .stat-icon-light.yellow { background: linear-gradient(135deg, #ffd43b 0%, #fab005 100%); }

    .stat-details-light h6 {
        font-size: 13px;
        color: #718096;
        font-weight: 600;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-details-light h3 {
        font-size: 32px;
        font-weight: 800;
        margin: 0;
        color: #2d3748;
    }

    .card-light {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        margin-bottom: 30px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .card-light .card-header {
        background: #ffffff;
        border-bottom: 1px solid #e2e8f0;
        padding: 20px 25px;
        border-radius: 10px 10px 0 0;
    }

    .card-light .card-header h4 {
        font-size: 20px;
        font-weight: 700;
        margin: 0;
        color: #2d3748;
    }

    .card-light .card-body {
        padding: 25px;
    }

    .table-light-custom {
        width: 100%;
        border-collapse: collapse;
    }

    .table-light-custom thead {
        background: #f7fafc;
        border-bottom: 2px solid #e2e8f0;
    }

    .table-light-custom th {
        padding: 15px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: #4a5568;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .table-light-custom td {
        padding: 15px;
        border-bottom: 1px solid #e2e8f0;
        color: #2d3748;
    }

    .table-light-custom tbody tr:hover {
        background: #f7fafc;
    }

    .avatar-light {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4c6ef5 0%, #9775fa 100%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 16px;
        color: white;
        margin-right: 12px;
    }

    .badge-light {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-success-light {
        background: #d3f9e0;
        color: #2f9e44;
    }

    .badge-primary-light {
        background: #dbe4ff;
        color: #3b5bdb;
    }

    .badge-info-light {
        background: #ccf7ff;
        color: #0891b2;
    }

    .badge-warning-light {
        background: #fff3bf;
        color: #e67700;
    }

    .btn-action-light {
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        display: inline-block;
        text-decoration: none;
    }

    .btn-primary-light {
        background: #4c6ef5;
        color: white !important;
    }

    .btn-primary-light:hover {
        background: #3b5bdb;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(76, 110, 245, 0.3);
    }

    .btn-warning-light {
        background: #ffd43b;
        color: #1a1a1a !important;
    }

    .btn-warning-light:hover {
        background: #fab005;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(255, 212, 59, 0.3);
    }

    .btn-danger-light {
        background: #ff6b6b;
        color: white !important;
    }

    .btn-danger-light:hover {
        background: #fa5252;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(255, 107, 107, 0.3);
    }

    .btn-info-light {
        background: #22d3ee;
        color: white !important;
    }

    .btn-info-light:hover {
        background: #06b6d4;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(34, 211, 238, 0.3);
    }

    .chart-container {
        background: #ffffff;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 30px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .chart-header h4 {
        font-size: 20px;
        font-weight: 700;
        margin: 0;
        color: #2d3748;
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #a0aec0;
    }

    .empty-state i {
        font-size: 64px;
        opacity: 0.3;
        display: block;
        margin-bottom: 20px;
        color: #cbd5e0;
    }

    .empty-state p {
        margin: 0;
        font-size: 14px;
        color: #718096;
    }

    .grid-2-light {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 30px;
        margin-bottom: 30px;
    }

    @media (max-width: 768px) {
        .grid-2-light {
            grid-template-columns: 1fr;
        }

        .stats-grid-light {
            grid-template-columns: 1fr;
        }
    }

    .img-preview {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e2e8f0;
    }

    code {
        background: #f7fafc;
        padding: 4px 8px;
        border-radius: 4px;
        color: #3b5bdb;
        font-size: 12px;
        border: 1px solid #e2e8f0;
    }

    .form-select-custom {
        background: #ffffff;
        color: #2d3748;
        border: 1px solid #e2e8f0;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
    }

    .form-select-custom:focus {
        outline: none;
        border-color: #4c6ef5;
        box-shadow: 0 0 0 3px rgba(76, 110, 245, 0.1);
    }
</style>

{{-- Alert Sukses --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" style="background: #d3f9e0; border: 1px solid #51cf66; color: #2f9e44; border-radius: 8px;">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- Welcome Banner --}}
<div class="welcome-banner">
    <h5>Selamat Datang, {{ $user['nama'] ?? 'Admin' }}!</h5>
    <p>Dashboard monitoring sistem Bina Desa</p>
</div>

{{-- Page Title --}}
<h2 class="page-title-light">Statistik Data</h2>

{{-- Statistik Cards --}}
<div class="stats-grid-light">
    <div class="stat-card-light">
        <div class="stat-icon-light purple">
            <i class="bi bi-people-fill"></i>
        </div>
        <div class="stat-details-light">
            <h6>Total Warga</h6>
            <h3>{{ $stats['total_warga'] ?? 0 }}</h3>
        </div>
    </div>

    <div class="stat-card-light">
        <div class="stat-icon-light blue">
            <i class="bi bi-envelope-fill"></i>
        </div>
        <div class="stat-details-light">
            <h6>Jenis Surat</h6>
            <h3>{{ $stats['total_jenis_surat'] ?? 0 }}</h3>
        </div>
    </div>

    <div class="stat-card-light">
        <div class="stat-icon-light green">
            <i class="bi bi-person-check-fill"></i>
        </div>
        <div class="stat-details-light">
            <h6>User Aktif</h6>
            <h3>{{ $stats['total_users'] ?? count($users) }}</h3>
        </div>
    </div>

    <div class="stat-card-light">
        <div class="stat-icon-light red">
            <i class="bi bi-file-earmark-text-fill"></i>
        </div>
        <div class="stat-details-light">
            <h6>Surat Diproses</h6>
            <h3>{{ $stats['surat_diproses'] ?? 0 }}</h3>
        </div>
    </div>

    <div class="stat-card-light">
        <div class="stat-icon-light cyan">
            <i class="bi bi-images"></i>
        </div>
        <div class="stat-details-light">
            <h6>Total Media</h6>
            <h3>{{ $stats['total_media'] ?? count($media) }}</h3>
        </div>
    </div>

    <div class="stat-card-light">
        <div class="stat-icon-light yellow">
            <i class="bi bi-clock-history"></i>
        </div>
        <div class="stat-details-light">
            <h6>Pending Request</h6>
            <h3>{{ $stats['pending_request'] ?? 0 }}</h3>
        </div>
    </div>
</div>

{{-- Chart Aktivitas Bulanan --}}
<div class="chart-container">
    <div class="chart-header">
        <h4>Grafik Aktivitas Bulanan</h4>
        <select class="form-select-custom">
            <option>2025</option>
            <option>2024</option>
            <option>2023</option>
        </select>
    </div>
    <div style="height: 300px;">
        <canvas id="activityChart"></canvas>
    </div>
</div>

{{-- Grid 2 Columns: Data Warga & Jenis Surat --}}
<div class="grid-2-light">
    {{-- Data Warga Terbaru --}}
    <div class="card-light">
        <div class="card-header">
            <h4>Data Warga Terbaru</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-light-custom">
                    <thead>
                        <tr>
                            <th>No KTP</th>
                            <th>Nama</th>
                            <th>JK</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($warga as $w)
                        <tr>
                            <td>
                                <code>{{ $w->no_ktp }}</code>
                            </td>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <span class="avatar-light">{{ strtoupper(substr($w->nama, 0, 1)) }}</span>
                                    <div>
                                        <div style="font-weight: 600; color: #2d3748;">{{ $w->nama }}</div>
                                        <small style="color: #718096;">{{ $w->pekerjaan ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge-light {{ $w->jenis_kelamin == 'L' ? 'badge-primary-light' : 'badge-success-light' }}">
                                    {{ $w->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.warga.show', $w->warga_id) }}" class="btn-action-light btn-primary-light">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <i class="bi bi-people"></i>
                                    <p>Belum ada data warga</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

{{-- Chart.js Script --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('activityChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Aktivitas',
                    data: [5, 12, 18, 15, 10, 15, 20, 18, 12, 16, 22, 18],
                    backgroundColor: 'rgba(76, 110, 245, 0.8)',
                    borderColor: 'rgba(76, 110, 245, 1)',
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#ffffff',
                        titleColor: '#2d3748',
                        bodyColor: '#718096',
                        borderColor: '#e2e8f0',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false,
                        boxShadow: '0 4px 6px rgba(0,0,0,0.1)'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e2e8f0'
                        },
                        ticks: {
                            color: '#718096'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#718096'
                        }
                    }
                }
            }
        });
    }
});
</script>

@endsection
