<!-- FILE: resources/views/pages/riwayat-status/index.blade.php -->
@extends('layouts.admin.app')

@section('title', 'Riwayat Status Surat - Bina Desa')

@section('content')

<style>
    .page-wrapper {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 30px 0;
    }

    .modern-header {
        background: white;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-title h1 {
        margin: 0;
        font-size: 32px;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .header-title p {
        margin: 5px 0 0 0;
        color: #64748b;
        font-size: 14px;
    }

    .btn-add-floating {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-add-floating:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(102, 126, 234, 0.6);
        color: white;
    }

    .filter-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        margin-bottom: 30px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }

    .filter-label {
        font-size: 11px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .form-control-custom, .form-select-custom {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 16px;
        transition: all 0.3s;
        background: #f8fafc;
    }

    .form-control-custom:focus, .form-select-custom:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        background: white;
    }

    .btn-search-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 12px 24px;
        border-radius: 12px;
        color: white;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-search-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-reset-custom {
        background: white;
        border: 2px solid #ef4444;
        color: #ef4444;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-reset-custom:hover {
        background: #ef4444;
        color: white;
    }

    /* TIMELINE STYLE */
    .riwayat-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .riwayat-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        position: relative;
        z-index: 1;
    }

    .riwayat-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px 0 0 16px;
    }

    .riwayat-card:hover {
        transform: translateX(8px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.12);
    }

    .status-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: white;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        position: relative;
        z-index: 1;
    }

    .status-pending {
        background: #f59e0b;
    }

    .status-diproses {
        background: #3b82f6;
    }

    .status-selesai {
        background: #10b981;
    }

    .status-ditolak {
        background: #ef4444;
    }

    .riwayat-content {
        flex: 1;
    }

    .riwayat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .nomor-permohonan {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .nomor-permohonan-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        text-transform: capitalize;
        display: inline-block;
    }

    .badge-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-diproses {
        background: #dbeafe;
        color: #1e40af;
    }

    .badge-selesai {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-ditolak {
        background: #fee2e2;
        color: #7f1d1d;
    }

    .riwayat-meta {
        font-size: 13px;
        color: #64748b;
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .meta-item i {
        color: #667eea;
        font-weight: 600;
    }

    .riwayat-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-shrink: 0;
    }

    .btn-action {
        padding: 8px 14px;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        font-size: 12px;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-detail {
        background: #e0f2fe;
        color: #0284c7;
    }

    .btn-detail:hover {
        background: #0284c7;
        color: white;
        transform: translateY(-2px);
    }

    .btn-edit {
        background: #fef3c7;
        color: #d97706;
    }

    .btn-edit:hover {
        background: #d97706;
        color: white;
        transform: translateY(-2px);
    }

    .btn-delete {
        background: #fee2e2;
        color: #dc2626;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: white;
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .empty-state i {
        font-size: 80px;
        opacity: 0.2;
        color: #667eea;
        margin-bottom: 20px;
    }

    .empty-state h4 {
        font-weight: 700;
        color: #64748b;
        margin: 0;
    }

    .alert-success-custom {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        border: none;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 20px;
        color: #065f46;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }

    @media (max-width: 768px) {
        .modern-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .riwayat-actions {
            flex-direction: column;
            width: 100%;
        }

        .riwayat-card {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .riwayat-header {
            flex-direction: column;
            gap: 8px;
            width: 100%;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="page-wrapper">
    <div class="container-fluid">

        {{-- Alert Success --}}
        @if(session('success'))
            <div class="alert-success-custom alert-dismissible fade show">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Modern Header --}}
        <div class="modern-header">
            <div class="header-title">
                <h1>📜 Riwayat Status Surat</h1>
                <p>Kelola riwayat perubahan status surat pemohon</p>
            </div>
            <a href="{{ route('admin.riwayat-status.create') }}" class="btn-add-floating">
                <i class="bi bi-plus-circle"></i> Tambah Riwayat
            </a>
        </div>

        {{-- Filter Card --}}
        <div class="filter-card">
            <form method="GET" action="{{ route('admin.riwayat-status.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <div class="filter-label">Pencarian</div>
                        <div class="input-group">
                            <span class="input-group-text" style="background: #f8fafc; border: 2px solid #e2e8f0; border-right: none; border-radius: 12px 0 0 12px;">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control-custom"
                                   value="{{ request('search') }}"
                                   placeholder="Cari nomor atau petugas..."
                                   style="border-left: none; border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="filter-label">Filter Status</div>
                        <select name="status" class="form-select-custom" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <div class="filter-label">Filter Petugas</div>
                        <select name="petugas_warga_id" class="form-select-custom" onchange="this.form.submit()">
                            <option value="">Semua Petugas</option>
                            @foreach($petugas_list as $petugas)
                                <option value="{{ $petugas->warga_id }}"
                                    {{ request('petugas_warga_id') == $petugas->warga_id ? 'selected' : '' }}>
                                    {{ $petugas->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn-search-custom w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>

                    <div class="col-md-2">
                        @if(request()->query())
                            <a href="{{ route('admin.riwayat-status.index') }}" class="btn-reset-custom w-100">
                                <i class="bi bi-x-circle"></i> Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- Riwayat List --}}
        <div class="riwayat-list">
            @forelse($riwayat_status as $item)
                <div class="riwayat-card">
                    {{-- Status Icon --}}
                    <div class="status-icon status-{{ $item->status }}">
                        @if($item->status == 'pending')
                            ⏳
                        @elseif($item->status == 'diproses')
                            🔧
                        @elseif($item->status == 'selesai')
                            ✅
                        @else
                            ❌
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="riwayat-content">
                        <div class="riwayat-header">
                            <div style="display: flex; align-items: center; gap: 16px;">
                                <div class="nomor-permohonan">
                                    <i class="bi bi-file-earmark"></i>
                                    #{{ $item->permohonanSurat->nomor_permohonan ?? '-' }}
                                </div>
                                <span class="status-badge badge-{{ $item->status }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                        </div>

                        <div class="riwayat-meta">
                            <div class="meta-item">
                                <i class="bi bi-person-check"></i>
                                <span><strong>{{ $item->petugas->nama ?? '—' }}</strong></span>
                            </div>
                            <div class="meta-item">
                                <i class="bi bi-calendar-event"></i>
                                <span>{{ $item->waktu->format('d M Y - H:i') }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="riwayat-actions">
                        <a href="{{ route('admin.riwayat-status.show', $item->riwayat_id) }}" class="btn-action btn-detail">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <a href="{{ route('admin.riwayat-status.edit', $item->riwayat_id) }}" class="btn-action btn-edit">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('admin.riwayat-status.destroy', $item->riwayat_id) }}" method="POST" style="flex: 1; max-width: 80px;"
                            onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action btn-delete w-100">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>
                </div>

            @empty
                <div class="empty-state">
                    <i class="bi bi-clock-history"></i>
                    <h4>
                        @if(request('search'))
                            Tidak ditemukan dengan kata kunci "{{ request('search') }}"
                        @else
                            Belum ada riwayat
                        @endif
                    </h4>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($riwayat_status->hasPages())
            <div class="mt-4">
                {{ $riwayat_status->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</div>

@endsection
