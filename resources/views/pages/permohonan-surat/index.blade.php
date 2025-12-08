@extends('layouts.admin.app')

@section('title', 'Permohonan Surat - Bina Desa')

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
        text-decoration: none;
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

    /* MODERN TABLE STYLING */
    .table-container {
        background: white;
        border-radius: 20px;
        padding: 0;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .modern-table {
        margin: 0;
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .modern-table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .modern-table thead th {
        padding: 20px 18px;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
        border: none;
        white-space: nowrap;
    }

    .modern-table tbody tr {
        transition: all 0.3s;
        border-bottom: 1px solid #f1f5f9;
    }

    .modern-table tbody tr:hover {
        background: linear-gradient(90deg, #f8fafc 0%, #f1f5f9 100%);
        transform: scale(1.01);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .modern-table tbody td {
        padding: 18px;
        vertical-align: middle;
        font-size: 13px;
        color: #1e293b;
        border: none;
    }

    .nomor-badge {
        display: inline-block;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .pemohon-info {
        display: flex;
        flex-direction: column;
    }

    .pemohon-info strong {
        font-weight: 700;
        color: #1e293b;
        font-size: 14px;
        margin-bottom: 3px;
    }

    .pemohon-info small {
        color: #94a3b8;
        font-size: 11px;
        font-weight: 600;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .status-diajukan {
        background: #fef3c7;
        color: #d97706;
    }

    .status-diproses {
        background: #dbeafe;
        color: #0284c7;
    }

    .status-selesai {
        background: #d1fae5;
        color: #059669;
    }

    .status-ditolak {
        background: #fee2e2;
        color: #dc2626;
    }

    .jenis-surat-badge {
        display: inline-block;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    .btn-action {
        padding: 8px 14px;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        font-size: 12px;
        transition: all 0.3s;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-view {
        background: #e0f2fe;
        color: #0284c7;
    }

    .btn-view:hover {
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

    /* Responsive */
    @media (max-width: 768px) {
        .modern-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .table-container {
            overflow-x: auto;
        }

        .modern-table {
            min-width: 1100px;
        }

        .action-buttons {
            flex-direction: column;
        }
    }

    /* Pagination styling */
    .pagination {
        margin-top: 25px;
        justify-content: center;
    }

    .page-link {
        border: 2px solid #e2e8f0;
        color: #667eea;
        margin: 0 4px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .page-link:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-color: #667eea;
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
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
                <h1>📋 Permohonan Surat</h1>
                <p>Kelola semua permohonan surat dari masyarakat</p>
            </div>
            <a href="{{ route('admin.permohonan-surat.create') }}" class="btn-add-floating">
                <i class="bi bi-plus-circle"></i> Tambah Permohonan
            </a>
        </div>

        {{-- Filter Card --}}
        <div class="filter-card">
            <form method="GET" action="{{ route('admin.permohonan-surat.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <div class="filter-label">Filter Status</div>
                        <select name="filter_status" class="form-select-custom" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="diajukan" {{ request('filter_status') == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                            <option value="diproses" {{ request('filter_status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ request('filter_status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak" {{ request('filter_status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="col-md-5">
                        <div class="filter-label">Pencarian</div>
                        <div class="input-group">
                            <span class="input-group-text" style="background: #f8fafc; border: 2px solid #e2e8f0; border-right: none; border-radius: 12px 0 0 12px;">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control-custom"
                                   value="{{ request('search') }}"
                                   placeholder="Cari nomor, nama, atau email..."
                                   style="border-left: none; border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn-search-custom w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>

                    <div class="col-md-2">
                        @if(request('search') || request('filter_status'))
                            <a href="{{ route('admin.permohonan-surat.index') }}" class="btn-reset-custom w-100">
                                <i class="bi bi-x-circle"></i> Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- Modern Table --}}
        <div class="table-container">
            @if($permohonan_surat->count() > 0)
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th style="width: 180px;">Nomor Permohonan</th>
                            <th style="width: 200px;">Nama Pemohon</th>
                            <th style="width: 180px;">Jenis Surat</th>
                            <th style="width: 140px;">Status</th>
                            <th style="width: 140px;">Tanggal Ajuan</th>
                            <th style="width: 140px;">Tanggal Proses</th>
                            <th style="width: 200px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permohonan_surat as $index => $permohonan)
                            <tr>
                                <td>
                                    <strong style="color: #667eea;">{{ $permohonan_surat->firstItem() + $index }}</strong>
                                </td>
                                <td>
                                    <span class="nomor-badge">
                                        <i class="bi bi-file-earmark-text"></i> {{ $permohonan->nomor_permohonan }}
                                    </span>
                                </td>
                                <td>
                                    <div class="pemohon-info">
                                        <strong>{{ $permohonan->nama_pemohon }}</strong>
                                        <small>{{ $permohonan->email_pemohon ?? '-' }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="jenis-surat-badge">
                                        {{ $permohonan->jenisSurat->nama_jenis ?? 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $permohonan->status }}">
                                        @if($permohonan->status == 'diajukan')
                                            <i class="bi bi-clock-fill"></i>
                                        @elseif($permohonan->status == 'diproses')
                                            <i class="bi bi-gear-fill"></i>
                                        @elseif($permohonan->status == 'selesai')
                                            <i class="bi bi-check-circle-fill"></i>
                                        @elseif($permohonan->status == 'ditolak')
                                            <i class="bi bi-x-circle-fill"></i>
                                        @endif
                                        {{ ucfirst($permohonan->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span style="color: #64748b; font-weight: 600;">
                                        {{ $permohonan->created_at->format('d M Y') }}
                                    </span>
                                </td>
                                <td>
                                    <span style="color: #64748b; font-weight: 600;">
                                        {{ $permohonan->tanggal_proses ? \Carbon\Carbon::parse($permohonan->tanggal_proses)->format('d M Y') : '-' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.permohonan-surat.show', $permohonan->permohonan_id) }}"
                                           class="btn-action btn-view"
                                           title="Detail">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('admin.permohonan-surat.edit', $permohonan->permohonan_id) }}"
                                           class="btn-action btn-edit"
                                           title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('admin.permohonan-surat.destroy', $permohonan->permohonan_id) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin hapus permohonan ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h4>
                        @if(request('search'))
                            Tidak ditemukan dengan kata kunci "{{ request('search') }}"
                        @else
                            Belum ada permohonan surat
                        @endif
                    </h4>
                </div>
            @endif
        </div>

        {{-- Pagination --}}
        @if($permohonan_surat->hasPages())
            <div class="mt-4">
                {{ $permohonan_surat->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</div>

@endsection
