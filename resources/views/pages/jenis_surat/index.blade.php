@extends('layouts.admin.app')

@section('title', 'Jenis Surat - Bina Desa')

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

    /* CARD GRID LAYOUT */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 25px;
        margin-top: 20px;
    }

    .surat-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
    }

    .surat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .surat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0,0,0,0.15);
    }

    .card-header-custom {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .badge-kode-large {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 16px;
        display: inline-block;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .card-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }

    .card-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin: 15px 0 10px 0;
    }

    .card-description {
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 20px;
        min-height: 60px;
    }

    .card-actions {
        display: flex;
        gap: 8px;
        padding-top: 20px;
        border-top: 2px solid #f1f5f9;
    }

    .btn-action-card {
        flex: 1;
        padding: 10px;
        border-radius: 10px;
        border: none;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
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
        grid-column: 1 / -1;
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
        .cards-grid {
            grid-template-columns: 1fr;
        }

        .modern-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
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
                <h1>📄 Jenis Surat</h1>
                <p>Kelola jenis-jenis surat yang tersedia di sistem</p>
            </div>
            <a href="{{ route('admin.jenis-surat.create') }}" class="btn-add-floating">
                <i class="bi bi-plus-circle"></i> Tambah Jenis Surat
            </a>
        </div>

        {{-- Filter Card --}}
        <div class="filter-card">
            <form method="GET" action="{{ route('admin.jenis-surat.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <div class="filter-label">Filter Jenis</div>
                        <select name="filter_kode" class="form-select-custom" onchange="this.form.submit()">
                            <option value="">Semua Jenis</option>
                            <option value="SKTM" {{ request('filter_kode') == 'SKTM' ? 'selected' : '' }}>SKTM</option>
                            <option value="SKU" {{ request('filter_kode') == 'SKU' ? 'selected' : '' }}>SKU</option>
                            <option value="SKCK" {{ request('filter_kode') == 'SKCK' ? 'selected' : '' }}>SKCK</option>
                            <option value="SKD" {{ request('filter_kode') == 'SKD' ? 'selected' : '' }}>SKD</option>
                            <option value="SKPWNI" {{ request('filter_kode') == 'SKPWNI' ? 'selected' : '' }}>SKPWNI</option>
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
                                   placeholder="Cari kode atau nama jenis surat..."
                                   style="border-left: none; border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn-search-custom w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>

                    <div class="col-md-2">
                        @if(request('search') || request('filter_kode'))
                            <a href="{{ route('admin.jenis-surat.index') }}" class="btn-reset-custom w-100">
                                <i class="bi bi-x-circle"></i> Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- Cards Grid --}}
        <div class="cards-grid">
            @php use Illuminate\Support\Str; @endphp
            @forelse($jenis_surat as $jenis)
                <div class="surat-card">
                    <div class="card-header-custom">
                        <span class="badge-kode-large">{{ $jenis->kode }}</span>
                        <div class="card-icon">
                            <i class="bi bi-file-earmark-text-fill"></i>
                        </div>
                    </div>

                    <h3 class="card-title">{{ $jenis->nama_jenis }}</h3>

                    <div class="card-description">
                        @if($jenis->syarat_json)
                            {{ Str::limit($jenis->syarat_json, 100) }}
                        @else
                            <em style="color: #cbd5e0;">Tidak ada syarat</em>
                        @endif
                    </div>

                    <div class="card-actions">
                        <a href="{{ route('admin.jenis-surat.show', $jenis->jenis_id) }}"
                           class="btn-action-card btn-view">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <a href="{{ route('admin.jenis-surat.edit', $jenis->jenis_id) }}"
                           class="btn-action-card btn-edit">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('admin.jenis-surat.destroy', $jenis->jenis_id) }}"
                              method="POST" class="d-inline" style="flex: 1;"
                              onsubmit="return confirm('Yakin hapus jenis surat ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action-card btn-delete w-100">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h4>
                        @if(request('search'))
                            Tidak ditemukan dengan kata kunci "{{ request('search') }}"
                        @else
                            Belum ada jenis surat
                        @endif
                    </h4>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($jenis_surat->hasPages())
            <div class="mt-4">
                {{ $jenis_surat->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</div>

@endsection

