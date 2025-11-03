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
    :root {
        --bg-dark: #1a1d2e;
        --bg-card: #252837;
        --text-primary: #ffffff;
        --text-muted: #a4a6b3;
        --primary: #4c6ef5;
        --success: #51cf66;
        --warning: #ffd43b;
        --danger: #ff6b6b;
        --purple: #9775fa;
        --cyan: #22d3ee;
    }

    body {
        background: var(--bg-dark) !important;
        color: var(--text-primary) !important;
    }

    .welcome-banner {
        display: flex;
        align-items: center;
        gap: 15px;
        background: linear-gradient(135deg, var(--success) 0%, var(--primary) 100%);
        padding: 20px 30px;
        border-radius: 12px;
        margin-bottom: 30px;
        color: white;
    }

    .welcome-banner i {
        font-size: 32px;
    }

    .welcome-banner h5 {
        margin: 0;
        font-weight: 700;
        font-size: 20px;
    }

    .welcome-banner p {
        margin: 0;
        font-size: 14px;
        opacity: 0.95;
    }

    .page-title-dark {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 30px;
        color: var(--text-primary);
    }

    .stats-grid-dark {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card-dark {
        background: var(--bg-card);
        border-radius: 12px;
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: transform 0.3s, box-shadow 0.3s;
        border: 1px solid rgba(255,255,255,0.05);
    }

    .stat-card-dark:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.4);
    }

    .stat-icon-dark {
        width: 65px;
        height: 65px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        color: white;
    }

    .stat-icon-dark.purple { background: linear-gradient(135deg, #9775fa 0%, #7c5ceb 100%); }
    .stat-icon-dark.blue { background: linear-gradient(135deg, #4c6ef5 0%, #3b5bdb 100%); }
    .stat-icon-dark.green { background: linear-gradient(135deg, #51cf66 0%, #40c057 100%); }
    .stat-icon-dark.red { background: linear-gradient(135deg, #ff6b6b 0%, #fa5252 100%); }
    .stat-icon-dark.cyan { background: linear-gradient(135deg, #22d3ee 0%, #06b6d4 100%); }
    .stat-icon-dark.yellow { background: linear-gradient(135deg, #ffd43b 0%, #fab005 100%); }

    .stat-details-dark h6 {
        font-size: 13px;
        color: var(--text-muted);
        font-weight: 600;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-details-dark h3 {
        font-size: 32px;
        font-weight: 800;
        margin: 0;
        color: var(--text-primary);
    }

    .card-dark {
        background: var(--bg-card);
        border: 1px solid rgba(255,255,255,0.05);
        border-radius: 12px;
        margin-bottom: 30px;
        color: var(--text-primary);
    }

    .card-dark .card-header {
        background: transparent;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        padding: 20px 25px;
    }

    .card-dark .card-header h4 {
        font-size: 20px;
        font-weight: 700;
        margin: 0;
        color: var(--text-primary);
    }

    .card-dark .card-body {
        padding: 25px;
    }

    .table-dark-custom {
        width: 100%;
        border-collapse: collapse;
        color: var(--text-primary);
    }

    .table-dark-custom thead {
        border-bottom: 2px solid rgba(255,255,255,0.1);
    }

    .table-dark-custom th {
        padding: 15px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .table-dark-custom td {
        padding: 15px;
        border-bottom: 1px solid rgba(255,255,255,0.05);
        color: var(--text-primary);
    }

    .table-dark-custom tbody tr:hover {
        background: rgba(76, 110, 245, 0.08);
    }

    .avatar-dark {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary) 0%, var(--purple) 100%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 16px;
        color: white;
        margin-right: 12px;
    }

    .badge-dark {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-success-dark {
        background: rgba(81, 207, 102, 0.2);
        color: var(--success);
    }

    .badge-primary-dark {
        background: rgba(76, 110, 245, 0.2);
        color: var(--primary);
    }

    .badge-info-dark {
        background: rgba(34, 211, 238, 0.2);
        color: var(--cyan);
    }

    .btn-action-dark {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        display: inline-block;
        text-decoration: none;
    }

    .btn-primary-dark {
        background: var(--primary);
        color: white !important;
    }

    .btn-primary-dark:hover {
        background: #3b5bdb;
        transform: translateY(-2px);
        color: white !important;
    }

    .btn-warning-dark {
        background: var(--warning);
        color: #1a1d2e !important;
    }

    .btn-warning-dark:hover {
        background: #fab005;
        transform: translateY(-2px);
    }

    .btn-danger-dark {
        background: var(--danger);
        color: white !important;
    }

    .btn-danger-dark:hover {
        background: #fa5252;
        transform: translateY(-2px);
    }

    .btn-info-dark {
        background: var(--cyan);
        color: white !important;
    }

    .btn-info-dark:hover {
        background: #06b6d4;
        transform: translateY(-2px);
    }

    .chart-container {
        background: var(--bg-card);
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        border: 1px solid rgba(255,255,255,0.05);
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
        color: var(--text-primary);
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: var(--text-muted);
    }

    .empty-state i {
        font-size: 64px;
        opacity: 0.3;
        display: block;
        margin-bottom: 20px;
    }

    .grid-2-dark {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 30px;
        margin-bottom: 30px;
    }

    @media (max-width: 768px) {
        .grid-2-dark {
            grid-template-columns: 1fr;
        }

        .stats-grid-dark {
            grid-template-columns: 1fr;
        }
    }

    .img-preview {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid rgba(255,255,255,0.1);
    }

    code {
        background: rgba(76, 110, 245, 0.1);
        padding: 4px 8px;
        border-radius: 4px;
        color: var(--cyan);
        font-size: 12px;
    }
</style>

{{-- Alert Sukses --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" style="background: rgba(81, 207, 102, 0.2); border: 1px solid var(--success); color: var(--success);">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" style="filter: brightness(1.5);"></button>
</div>
@endif

{{-- Welcome Banner --}}
<div class="welcome-banner">
    <i class="bi bi-emoji-smile-fill"></i>
    <div>
        <h5>Selamat Datang, {{ $user['nama'] ?? 'Admin' }}!</h5>
        <p>Dashboard monitoring sistem Bina Desa</p>
    </div>
</div>

{{-- Page Title --}}
<h2 class="page-title-dark">Statistik Data</h2>

{{-- Statistik Cards --}}
<div class="stats-grid-dark">
    <div class="stat-card-dark">
        <div class="stat-icon-dark purple">
            <i class="bi bi-people-fill"></i>
        </div>
        <div class="stat-details-dark">
            <h6>Total Warga</h6>
            <h3>{{ $stats['total_warga'] ?? 0 }}</h3>
        </div>
    </div>

    <div class="stat-card-dark">
        <div class="stat-icon-dark blue">
            <i class="bi bi-envelope-paper-fill"></i>
        </div>
        <div class="stat-details-dark">
            <h6>Jenis Surat</h6>
            <h3>{{ $stats['total_jenis_surat'] ?? 0 }}</h3>
        </div>
    </div>

    <div class="stat-card-dark">
        <div class="stat-icon-dark green">
            <i class="bi bi-person-check-fill"></i>
        </div>
        <div class="stat-details-dark">
            <h6>User Aktif</h6>
            <h3>{{ $stats['total_users'] ?? count($users) }}</h3>
        </div>
    </div>

    <div class="stat-card-dark">
        <div class="stat-icon-dark red">
            <i class="bi bi-file-earmark-text-fill"></i>
        </div>
        <div class="stat-details-dark">
            <h6>Surat Diproses</h6>
            <h3>{{ $stats['surat_diproses'] ?? 0 }}</h3>
        </div>
    </div>

    <div class="stat-card-dark">
        <div class="stat-icon-dark cyan">
            <i class="bi bi-images"></i>
        </div>
        <div class="stat-details-dark">
            <h6>Total Media</h6>
            <h3>{{ $stats['total_media'] ?? count($media) }}</h3>
        </div>
    </div>

    <div class="stat-card-dark">
        <div class="stat-icon-dark yellow">
            <i class="bi bi-clock-history"></i>
        </div>
        <div class="stat-details-dark">
            <h6>Pending Request</h6>
            <h3>{{ $stats['pending_request'] ?? 0 }}</h3>
        </div>
    </div>
</div>

{{-- Chart Aktivitas Bulanan --}}
<div class="chart-container">
    <div class="chart-header">
        <h4>Grafik Aktivitas Bulanan</h4>
        <select class="form-select form-select-sm" style="width: 150px; background: var(--bg-dark); color: var(--text-primary); border: 1px solid rgba(255,255,255,0.1);">
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
<div class="grid-2-dark">
    {{-- Data Warga Terbaru --}}
    <div class="card-dark">
        <div class="card-header">
            <h4>Data Warga Terbaru</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-dark-custom">
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
                                    <span class="avatar-dark">{{ strtoupper(substr($w->nama, 0, 1)) }}</span>
                                    <div>
                                        <div style="font-weight: 600;">{{ $w->nama }}</div>
                                        <small style="color: var(--text-muted);">{{ $w->pekerjaan ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge-dark {{ $w->jenis_kelamin == 'L' ? 'badge-primary-dark' : 'badge-success-dark' }}">
                                    {{ $w->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.warga.show', $w->warga_id) }}" class="btn-action-dark btn-primary-dark">
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

    {{-- Daftar Jenis Surat --}}
    <div class="card-dark">
        <div class="card-header">
            <h4>Daftar Jenis Surat</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Jenis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jenis_surat as $jenis)
                        <tr>
                            <td>
                                <span class="badge-dark badge-primary-dark">{{ $jenis->kode }}</span>
                            </td>
                            <td>
                                <div style="font-weight: 600;">{{ $jenis->nama_jenis }}</div>
                                @if($jenis->syarat_json)
                                <small style="color: var(--text-muted);">{{ Str::limit($jenis->syarat_json, 30) }}</small>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.jenis-surat.edit', $jenis->jenis_id) }}" class="btn-action-dark btn-warning-dark">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">
                                <div class="empty-state">
                                    <i class="bi bi-envelope-paper"></i>
                                    <p>Belum ada jenis surat</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Grid 2 Columns: User & Media --}}
<div class="grid-2-dark">
    {{-- Daftar User --}}
    <div class="card-dark">
        <div class="card-header">
            <h4>Daftar User</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $u)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <span class="avatar-dark">{{ strtoupper(substr($u->name, 0, 2)) }}</span>
                                    <span style="font-weight: 600;">{{ $u->name }}</span>
                                </div>
                            </td>
                            <td>{{ $u->email }}</td>
                            <td>
                                @if($u->status == 'active')
                                <span class="badge-dark badge-success-dark">
                                    <i class="bi bi-check-circle"></i> Aktif
                                </span>
                                @else
                                <span class="badge-dark" style="background: rgba(255,255,255,0.1); color: var(--text-muted);">
                                    <i class="bi bi-x-circle"></i> Inactive
                                </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.user.edit', $u->id) }}" class="btn-action-dark btn-warning-dark">
                                    <i class="bi bi-pencil"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <i class="bi bi-person-badge"></i>
                                    <p>Belum ada user</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Daftar Media --}}
    <div class="card-dark">
        <div class="card-header">
            <h4>Daftar Media</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-dark-custom">
                    <thead>
                        <tr>
                            <th>Preview</th>
                            <th>File</th>
                            <th>Ref</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($media as $m)
                        <tr>
                            <td>
                                @if($m->is_image ?? false)
                                <img src="{{ $m->full_url }}" alt="{{ $m->caption }}" class="img-preview">
                                @else
                                <div style="width: 60px; height: 60px; background: rgba(76, 110, 245, 0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi {{ $m->file_icon ?? 'bi-file-earmark' }} text-primary" style="font-size: 24px;"></i>
                                </div>
                                @endif
                            </td>
                            <td>
                                <div style="font-weight: 600;">{{ $m->caption ?? 'No caption' }}</div>
                                <small style="color: var(--text-muted);">{{ basename($m->file_url ?? '') }}</small>
                            </td>
                            <td>
                                <span class="badge-dark badge-info-dark">{{ $m->ref_table ?? '-' }}</span>
                                <div style="margin-top: 4px;"><code>ID: {{ $m->ref_id ?? '-' }}</code></div>
                            </td>
                            <td>
                                <a href="{{ route('admin.media.show', $m->media_id) }}" class="btn-action-dark btn-info-dark" style="margin-right: 5px;">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.media.edit', $m->media_id) }}" class="btn-action-dark btn-warning-dark" style="margin-right: 5px;">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.media.destroy', $m->media_id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus media ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-dark btn-danger-dark">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <i class="bi bi-images"></i>
                                    <p>Belum ada data media</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
                        backgroundColor: '#252837',
                        titleColor: '#ffffff',
                        bodyColor: '#a4a6b3',
                        borderColor: 'rgba(255,255,255,0.1)',
                        borderWidth: 1,
                        padding: 12,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        },
                        ticks: {
                            color: '#a4a6b3'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#a4a6b3'
                        }
                    }
                }
            }
        });
    }
});
</script>

@endsection
