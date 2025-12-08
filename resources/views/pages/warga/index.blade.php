@extends('layouts.admin.app')

@section('title', 'Data Warga - Bina Desa')

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

    .modern-table thead th:first-child {
        border-radius: 0;
    }

    .modern-table thead th:last-child {
        border-radius: 0;
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

    .avatar-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .table-avatar {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 800;
        font-size: 18px;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .name-info {
        display: flex;
        flex-direction: column;
    }

    .name-info strong {
        font-weight: 700;
        color: #1e293b;
        font-size: 14px;
        margin-bottom: 3px;
    }

    .name-info small {
        color: #94a3b8;
        font-size: 11px;
        font-weight: 600;
    }

    .nik-badge {
        display: inline-block;
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: white;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .gender-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    .gender-male {
        background: #dbeafe;
        color: #1e40af;
    }

    .gender-female {
        background: #fce7f3;
        color: #be185d;
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
            min-width: 1000px;
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
                <h1>👨‍👩‍👧‍👦 Data Warga</h1>
                <p>Kelola data penduduk Bina Desa</p>
            </div>
            <a href="{{ route('admin.warga.create') }}" class="btn-add-floating">
                <i class="bi bi-plus-circle"></i> Tambah Warga
            </a>
        </div>

        {{-- Filter Card --}}
        <div class="filter-card">
            <form method="GET" action="{{ route('admin.warga.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <div class="filter-label">Gender</div>
                        <select name="jenis_kelamin" class="form-select-custom" onchange="this.form.submit()">
                            <option value="">Semua Gender</option>
                            <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <div class="filter-label">Agama</div>
                        <select name="agama" class="form-select-custom" onchange="this.form.submit()">
                            <option value="">Semua Agama</option>
                            @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $agm)
                                <option value="{{ $agm }}" {{ request('agama') == $agm ? 'selected' : '' }}>{{ $agm }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <div class="filter-label">Pencarian</div>
                        <div class="input-group">
                            <span class="input-group-text" style="background: #f8fafc; border: 2px solid #e2e8f0; border-right: none; border-radius: 12px 0 0 12px;">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control-custom"
                                   value="{{ request('search') }}"
                                   placeholder="Cari nama, email, atau NIK..."
                                   style="border-left: none; border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn-search-custom w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>

                    <div class="col-md-2">
                        @if(request('search') || request('jenis_kelamin') || request('agama'))
                            <a href="{{ route('admin.warga.index') }}" class="btn-reset-custom w-100">
                                <i class="bi bi-x-circle"></i> Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- Modern Table --}}
        <div class="table-container">
            @if($warga->count() > 0)
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th style="width: 250px;">Nama</th>
                            <th style="width: 180px;">NIK</th>
                            <th style="width: 200px;">Email</th>
                            <th style="width: 140px;">Telepon</th>
                            <th style="width: 120px;">Gender</th>
                            <th style="width: 120px;">Agama</th>
                            <th style="width: 150px;">Pekerjaan</th>
                            <th style="width: 200px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($warga as $index => $item)
                            <tr>
                                <td>
                                    <strong style="color: #667eea;">{{ $warga->firstItem() + $index }}</strong>
                                </td>
                                <td>
                                    <div class="avatar-cell">
                                        <div class="table-avatar">
                                            {{ strtoupper(substr($item->nama, 0, 1)) }}
                                        </div>
                                        <div class="name-info">
                                            <strong>{{ $item->nama }}</strong>
                                            <small>ID: {{ $item->warga_id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="nik-badge">{{ $item->no_ktp }}</span>
                                </td>
                                <td>
                                    <span style="color: #64748b; font-weight: 500;">{{ $item->email ?? '-' }}</span>
                                </td>
                                <td>
                                    <span style="color: #64748b; font-weight: 500;">{{ $item->telp ?? '-' }}</span>
                                </td>
                                <td>
                                    <span class="gender-badge {{ $item->jenis_kelamin == 'L' ? 'gender-male' : 'gender-female' }}">
                                        {{ $item->jenis_kelamin == 'L' ? '👨 Laki' : '👩 Perempuan' }}
                                    </span>
                                </td>
                                <td>
                                    <span style="font-weight: 600;">{{ $item->agama }}</span>
                                </td>
                                <td>
                                    <span style="color: #64748b; font-weight: 500;">{{ $item->pekerjaan }}</span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.warga.show', $item->warga_id) }}"
                                           class="btn-action btn-view"
                                           title="Detail">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                        <a href="{{ route('admin.warga.edit', $item->warga_id) }}"
                                           class="btn-action btn-edit"
                                           title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form action="{{ route('admin.warga.destroy', $item->warga_id) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin hapus warga ini?')">
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
                            Belum ada data warga
                        @endif
                    </h4>
                </div>
            @endif
        </div>

        {{-- Pagination --}}
        @if($warga->hasPages())
            <div class="mt-4">
                {{ $warga->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</div>

@endsection
