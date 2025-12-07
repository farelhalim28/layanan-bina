@extends('layouts.admin.app')

@section('title', 'Media - Bina Desa')

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

    /* MEDIA GRID LAYOUT */
    .media-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        margin-top: 20px;
    }

    .media-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        position: relative;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .media-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.15);
    }

    .media-preview-container {
        position: relative;
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #f5f7fa 0%, #e2e8f0 100%);
        overflow: hidden;
    }

    .media-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .media-card:hover .media-preview {
        transform: scale(1.05);
    }

    .media-type-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 700;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .type-image {
        color: #0284c7;
    }

    .type-video {
        color: #dc2626;
    }

    .type-document {
        color: #d97706;
    }

    .document-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        font-size: 64px;
        opacity: 0.3;
    }

    .media-content {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .media-caption {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 12px;
        line-height: 1.4;
        word-break: break-word;
    }

    .media-info {
        flex: 1;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 10px;
    }

    .info-label {
        font-size: 11px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        min-width: 60px;
    }

    .info-value {
        font-size: 13px;
        color: #64748b;
        word-break: break-all;
    }

    .media-actions {
        display: flex;
        gap: 8px;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
        margin-top: auto;
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
        cursor: pointer;
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

    .video-play-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        color: #dc2626;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        transition: all 0.3s;
    }

    .media-preview-container:hover .video-play-icon {
        transform: translate(-50%, -50%) scale(1.1);
        background: rgba(255, 255, 255, 1);
    }

    @media (max-width: 768px) {
        .media-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }

        .modern-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .media-preview-container {
            height: 150px;
        }
    }

    @media (max-width: 480px) {
        .media-grid {
            grid-template-columns: 1fr;
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
                <h1>🖼️ Media</h1>
                <p>Kelola semua media seperti gambar, video, dan dokumen</p>
            </div>
            <a href="{{ route('admin.media.create') }}" class="btn-add-floating">
                <i class="bi bi-plus-circle"></i> Tambah Media
            </a>
        </div>

        {{-- Filter Card --}}
        <div class="filter-card">
            <form method="GET" action="{{ route('admin.media.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <div class="filter-label">Filter Tipe</div>
                        <select name="type" class="form-select-custom" onchange="this.form.submit()">
                            <option value="">Semua Tipe</option>
                            <option value="image" {{ request('type') == 'image' ? 'selected' : '' }}>Gambar</option>
                            <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Video</option>
                            <option value="file" {{ request('type') == 'file' ? 'selected' : '' }}>Dokumen</option>
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
                                   placeholder="Cari caption, tabel, atau ID..."
                                   style="border-left: none; border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn-search-custom w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>

                    <div class="col-md-2">
                        @if(request('search') || request('type'))
                            <a href="{{ route('admin.media.index') }}" class="btn-reset-custom w-100">
                                <i class="bi bi-x-circle"></i> Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- Media Grid --}}
        <div class="media-grid">
            @forelse($media as $item)
                <div class="media-card">
                    {{-- PREVIEW AREA --}}
                    <div class="media-preview-container">
                        @if($item->isImage())
                            <img src="{{ asset('storage/'.$item->file_name) }}"
                                 alt="{{ $item->caption }}"
                                 class="media-preview">
                            <div class="media-type-badge type-image">
                                <i class="bi bi-image"></i> Gambar
                            </div>

                        @elseif($item->isVideo())
                            <video class="media-preview">
                                <source src="{{ asset('storage/'.$item->file_name) }}"
                                        type="{{ $item->mime_type }}">
                            </video>
                            <div class="video-play-icon">
                                <i class="bi bi-play-fill"></i>
                            </div>
                            <div class="media-type-badge type-video">
                                <i class="bi bi-play-circle"></i> Video
                            </div>

                        @else
                            <div class="media-preview">
                                <div class="document-icon">
                                    📄
                                </div>
                            </div>
                            <div class="media-type-badge type-document">
                                <i class="bi bi-file-earmark"></i> Dokumen
                            </div>
                        @endif
                    </div>

                    {{-- CONTENT AREA --}}
                    <div class="media-content">
                        {{-- CAPTION --}}
                        <div class="media-caption">
                            {{ $item->caption ?: 'Tanpa Caption' }}
                        </div>

                        {{-- INFO --}}
                        <div class="media-info">
                            <div class="info-item">
                                <span class="info-label">Tabel</span>
                                <span class="info-value">{{ $item->ref_table }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">ID</span>
                                <span class="info-value">{{ $item->ref_id }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Tipe</span>
                                <span class="info-value">{{ $item->mime_type }}</span>
                            </div>
                        </div>

                        {{-- ACTIONS --}}
                        <div class="media-actions">
                            <a href="{{ route('admin.media.show', $item->media_id) }}"
                               class="btn-action-card btn-view">
                                <i class="bi bi-eye-fill"></i> Detail
                            </a>
                            <a href="{{ route('admin.media.edit', $item->media_id) }}"
                               class="btn-action-card btn-edit">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <form action="{{ route('admin.media.destroy', $item->media_id) }}"
                                  method="POST"
                                  class="d-inline"
                                  style="flex: 1;"
                                  onsubmit="return confirm('Yakin hapus media ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action-card btn-delete w-100">
                                    <i class="bi bi-trash-fill"></i> Hapus
                                </button>
                            </form>
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
                            Belum ada media
                        @endif
                    </h4>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($media->hasPages())
            <div class="mt-4">
                {{ $media->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</div>

@endsection
