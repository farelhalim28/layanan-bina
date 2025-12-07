@extends('layouts.admin.app')

@section('title', 'Dashboard - Bina Desa')

@section('content')
@php
    $user = session('user') ?? null;
@endphp

<style>
    body { background: #f5f7fa !important; }

    .welcome-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 30px;
        border-radius: 12px;
        margin-bottom: 30px;
        color: white;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }

    .welcome-banner h2 { margin: 0; font-weight: 700; font-size: 28px; }
    .welcome-banner p { margin: 8px 0 0 0; opacity: 0.9; }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: transform 0.3s, box-shadow 0.3s;
        border: 1px solid #e2e8f0;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.1);
    }

    .stat-icon {
        width: 65px;
        height: 65px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        color: white;
    }

    .stat-icon.purple { background: linear-gradient(135deg, #9775fa 0%, #7c5ceb 100%); }
    .stat-icon.blue { background: linear-gradient(135deg, #4c6ef5 0%, #3b5bdb 100%); }
    .stat-icon.green { background: linear-gradient(135deg, #51cf66 0%, #40c057 100%); }
    .stat-icon.red { background: linear-gradient(135deg, #ff6b6b 0%, #fa5252 100%); }
    .stat-icon.cyan { background: linear-gradient(135deg, #22d3ee 0%, #06b6d4 100%); }
    .stat-icon.yellow { background: linear-gradient(135deg, #ffd43b 0%, #fab005 100%); }
    .stat-icon.orange { background: linear-gradient(135deg, #ff922b 0%, #fd7e14 100%); }
    .stat-icon.pink { background: linear-gradient(135deg, #ff6b9d 0%, #e91e63 100%); }

    .stat-details h6 {
        font-size: 12px;
        color: #718096;
        font-weight: 600;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .stat-details h3 {
        font-size: 32px;
        font-weight: 800;
        margin: 0;
        color: #2d3748;
    }

    .card-custom {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .card-custom .card-header {
        background: white;
        border-bottom: 1px solid #e2e8f0;
        padding: 20px 25px;
        border-radius: 12px 12px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-custom .card-header h4 {
        font-size: 18px;
        font-weight: 700;
        margin: 0;
        color: #2d3748;
    }

    .card-custom .card-body { padding: 25px; }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }

    .table-custom thead {
        background: #f7fafc;
        border-bottom: 2px solid #e2e8f0;
    }

    .table-custom th {
        padding: 12px 15px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        color: #4a5568;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-custom td {
        padding: 15px;
        border-bottom: 1px solid #e2e8f0;
        color: #2d3748;
    }

    .table-custom tbody tr:hover { background: #f7fafc; }

    .badge-custom {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .badge-pending { background: #fff3bf; color: #e67700; }
    .badge-diproses { background: #dbe4ff; color: #3b5bdb; }
    .badge-selesai { background: #d3f9e0; color: #2f9e44; }
    .badge-ditolak { background: #ffe0e0; color: #c92a2a; }

    .btn-sm-custom {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary-custom {
        background: #4c6ef5;
        color: white !important;
    }

    .btn-primary-custom:hover {
        background: #3b5bdb;
        transform: translateY(-2px);
    }

    .media-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 15px;
    }

    .media-item {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        aspect-ratio: 1;
        background: #f7fafc;
        border: 2px solid #e2e8f0;
    }

    .media-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .media-badge {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(0,0,0,0.7);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 10px;
        font-weight: 600;
    }

    .grid-2 {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 30px;
    }

    @media (max-width: 768px) {
        .stats-grid { grid-template-columns: 1fr; }
        .grid-2 { grid-template-columns: 1fr; }
    }
</style>

{{-- Alert --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" style="background: #d3f9e0; border: 1px solid #51cf66; color: #2f9e44; border-radius: 8px;">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- Welcome Banner --}}
<div class="welcome-banner">
    <h2>👋 Selamat Datang, {{ $user['nama'] ?? 'Admin' }}!</h2>
    <p>Dashboard Monitoring Sistem Layanan Mandiri & Surat - Bina Desa</p>
</div>

{{-- Statistik Cards --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon purple">
            <i class="bi bi-people-fill"></i>
        </div>
        <div class="stat-details">
            <h6>Total Warga</h6>
            <h3>{{ $stats['total_warga'] }}</h3>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="bi bi-envelope-fill"></i>
        </div>
        <div class="stat-details">
            <h6>Jenis Surat</h6>
            <h3>{{ $stats['total_jenis_surat'] }}</h3>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            <i class="bi bi-file-earmark-text-fill"></i>
        </div>
        <div class="stat-details">
            <h6>Total Permohonan</h6>
            <h3>{{ $stats['total_permohonan'] }}</h3>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon yellow">
            <i class="bi bi-clock-history"></i>
        </div>
        <div class="stat-details">
            <h6>Pending</h6>
            <h3>{{ $stats['surat_pending'] }}</h3>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon cyan">
            <i class="bi bi-hourglass-split"></i>
        </div>
        <div class="stat-details">
            <h6>Diproses</h6>
            <h3>{{ $stats['surat_diproses'] }}</h3>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div class="stat-details">
            <h6>Selesai</h6>
            <h3>{{ $stats['surat_selesai'] }}</h3>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon red">
            <i class="bi bi-x-circle-fill"></i>
        </div>
        <div class="stat-details">
            <h6>Ditolak</h6>
            <h3>{{ $stats['surat_ditolak'] }}</h3>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon pink">
            <i class="bi bi-images"></i>
        </div>
        <div class="stat-details">
            <h6>Total Media</h6>
            <h3>{{ $stats['total_media'] }}</h3>
        </div>
    </div>
</div>

{{-- Chart Aktivitas --}}
<div class="card-custom">
    <div class="card-header">
        <h4>📊 Grafik Permohonan Surat (2025)</h4>
    </div>
    <div class="card-body">
        <canvas id="activityChart" height="80"></canvas>
    </div>
</div>

{{-- Grid 2 Columns --}}
<div class="grid-2">
    {{-- Permohonan Terbaru --}}
    <div class="card-custom">
        <div class="card-header">
            <h4>📄 Permohonan Terbaru</h4>
            <a href="{{ route('admin.permohonan-surat.index') }}" class="btn-sm-custom btn-primary-custom">
                Lihat Semua →
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Pemohon</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permohonan_terbaru as $p)
                        <tr>
                            <td><code>{{ $p->nomor_permohonan }}</code></td>
                            <td>
                                <div style="font-weight: 600;">{{ $p->pemohon->nama ?? '-' }}</div>
                                <small style="color: #718096;">{{ $p->jenisSurat->nama_jenis ?? '-' }}</small>
                            </td>
                            <td>
                                <span class="badge-custom badge-{{ $p->status }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align: center; color: #a0aec0; padding: 40px;">
                                Belum ada permohonan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Data Warga Terbaru --}}
    <div class="card-custom">
        <div class="card-header">
            <h4>👥 Data Warga Terbaru</h4>
            <a href="{{ route('admin.warga.index') }}" class="btn-sm-custom btn-primary-custom">
                Lihat Semua →
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>JK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($warga as $w)
                        <tr>
                            <td><code>{{ $w->nik }}</code></td>
                            <td>
                                <div style="font-weight: 600;">{{ $w->nama }}</div>
                                <small style="color: #718096;">{{ $w->pekerjaan ?? '-' }}</small>
                            </td>
                            <td>
                                <span class="badge-custom {{ $w->jenis_kelamin == 'L' ? 'badge-diproses' : 'badge-selesai' }}">
                                    {{ $w->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" style="text-align: center; color: #a0aec0; padding: 40px;">
                                Belum ada data warga
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Media Gallery --}}
<div class="card-custom">
    <div class="card-header">
        <h4>🖼️ Media Terbaru</h4>
        <a href="{{ route('admin.media.index') }}" class="btn-sm-custom btn-primary-custom">
            Lihat Semua →
        </a>
    </div>
    <div class="card-body">
        @if($media_terbaru->count() > 0)
            <div class="media-grid">
                @foreach($media_terbaru as $m)
                    <div class="media-item">
                        @php
                            $ext = strtolower(pathinfo($m->file_name, PATHINFO_EXTENSION));
                            $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                        @endphp

                        @if($isImage)
                            <img src="{{ asset('storage/' . $m->file_name) }}" alt="media">
                        @else
                            <div style="display: flex; align-items: center; justify-content: center; height: 100%; font-size: 40px; color: #cbd5e0;">
                                <i class="bi bi-file-earmark"></i>
                            </div>
                        @endif

                        <span class="media-badge">{{ strtoupper($ext) }}</span>
                    </div>
                @endforeach
            </div>
        @else
            <p style="text-align: center; color: #a0aec0; padding: 40px;">Belum ada media</p>
        @endif
    </div>
</div>

{{-- Chart.js --}}
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
                    label: 'Permohonan Surat',
                    data: @json($chartData),
                    backgroundColor: 'rgba(76, 110, 245, 0.8)',
                    borderColor: 'rgba(76, 110, 245, 1)',
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#ffffff',
                        titleColor: '#2d3748',
                        bodyColor: '#718096',
                        borderColor: '#e2e8f0',
                        borderWidth: 1,
                        padding: 12
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#e2e8f0' },
                        ticks: { color: '#718096' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#718096' }
                    }
                }
            }
        });
    }
});
</script>

@endsection
