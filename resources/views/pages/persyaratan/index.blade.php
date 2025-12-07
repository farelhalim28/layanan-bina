@extends('layouts.admin.app')

@section('title', 'Berkas Persyaratan - Bina Desa')

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

    /* BERKAS LIST STYLE */
    .berkas-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .berkas-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        border-left: 4px solid #667eea;
    }

    .berkas-card:hover {
        transform: translateX(8px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.12);
    }

    .berkas-left {
        display: flex;
        align-items: center;
        gap: 18px;
        flex: 1;
    }

    .file-preview {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        flex-shrink: 0;
    }

    .file-preview.image {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .file-preview.pdf {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .file-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
    }

    .berkas-info h4 {
        margin: 0 0 8px 0;
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
    }

    .berkas-meta {
        font-size: 13px;
        color: #64748b;
        display: flex;
        gap: 12px;
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

    .berkas-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 12px;
        display: inline-block;
    }

    .status-valid {
        background: #d1fae5;
        color: #059669;
    }

    .status-invalid {
        background: #fee2e2;
        color: #dc2626;
    }

    .action-dropdown {
        position: relative;
    }

    .action-btn {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        border: none;
        background: #f1f5f9;
        color: #64748b;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }

    .action-btn:hover {
        background: #e2e8f0;
        color: #667eea;
    }

    .dropdown-menu {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }

    .dropdown-item {
        padding: 10px 16px;
        font-size: 13px;
        font-weight: 500;
        transition: all 0.2s;
    }

    .dropdown-item:hover {
        background: #f1f5f9;
        color: #667eea;
    }

    .dropdown-item.text-danger:hover {
        background: #fee2e2;
        color: #dc2626;
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

        .berkas-right {
            flex-direction: column;
            gap: 10px;
        }

        .berkas-card {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
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
                <h1>📋 Berkas Persyaratan</h1>
                <p>Kelola semua berkas dan dokumen persyaratan dari pemohon</p>
            </div>
            <a href="{{ route('admin.berkas-persyaratan.create') }}" class="btn-add-floating">
                <i class="bi bi-plus-circle"></i> Tambah Berkas
            </a>
        </div>

        {{-- Filter Card --}}
        <div class="filter-card">
            <form method="GET" action="{{ route('admin.berkas-persyaratan.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <div class="filter-label">Pencarian</div>
                        <div class="input-group">
                            <span class="input-group-text" style="background: #f8fafc; border: 2px solid #e2e8f0; border-right: none; border-radius: 12px 0 0 12px;">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control-custom"
                                   value="{{ request('search') }}"
                                   placeholder="Cari berkas, pemohon, nomor..."
                                   style="border-left: none; border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="filter-label">Filter Status</div>
                        <select name="valid" class="form-select-custom" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="1" {{ request('valid') === '1' ? 'selected' : '' }}>Valid</option>
                            <option value="0" {{ request('valid') === '0' ? 'selected' : '' }}>Tidak Valid</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn-search-custom w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>

                    <div class="col-md-2">
                        @if(request('search') || request('valid') !== null)
                            <a href="{{ route('admin.berkas-persyaratan.index') }}" class="btn-reset-custom w-100">
                                <i class="bi bi-x-circle"></i> Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- Berkas List --}}
        <div class="berkas-list">
            @forelse($berkas_persyaratan as $berkas)
                <div class="berkas-card">
                    <div class="berkas-left">
                        {{-- File Preview --}}
                        <div class="file-preview {{ Str::endsWith($berkas->file_path, ['.jpg', '.png', '.jpeg']) ? 'image' : 'pdf' }}">
                            @if($berkas->file_path && file_exists(public_path('uploads/berkas/' . $berkas->file_path)))
                                @if(Str::endsWith($berkas->file_path, ['.jpg', '.png', '.jpeg']))
                                    <img src="{{ asset('uploads/berkas/' . $berkas->file_path) }}" alt="{{ $berkas->nama_berkas }}">
                                @else
                                    <i class="bi bi-file-earmark-pdf"></i>
                                @endif
                            @else
                                <i class="bi bi-file-earmark"></i>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="berkas-info">
                            <h4>{{ $berkas->nama_berkas }}</h4>
                            <div class="berkas-meta">
                                <div class="meta-item">
                                    <i class="bi bi-file-earmark"></i>
                                    <span>#{{ $berkas->permohonanSurat->nomor_permohonan ?? '-' }}</span>
                                </div>
                                <div class="meta-item">
                                    <i class="bi bi-person"></i>
                                    <span>{{ $berkas->permohonanSurat->pemohon->nama ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="berkas-right">
                        {{-- Status Badge --}}
                        @if($berkas->valid)
                            <span class="status-badge status-valid">
                                <i class="bi bi-check-circle"></i> Valid
                            </span>
                        @else
                            <span class="status-badge status-invalid">
                                <i class="bi bi-x-circle"></i> Tidak Valid
                            </span>
                        @endif

                        {{-- Action Menu --}}
                        <div class="action-dropdown dropdown">
                            <button class="action-btn" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.berkas-persyaratan.show', $berkas->berkas_id) }}">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.berkas-persyaratan.edit', $berkas->berkas_id) }}">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('admin.berkas-persyaratan.destroy', $berkas->berkas_id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus berkas ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            @empty
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h4>
                        @if(request('search'))
                            Tidak ditemukan dengan kata kunci "{{ request('search') }}"
                        @else
                            Belum ada berkas tersimpan
                        @endif
                    </h4>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($berkas_persyaratan->hasPages())
            <div class="mt-4">
                {{ $berkas_persyaratan->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</div>

@endsection
