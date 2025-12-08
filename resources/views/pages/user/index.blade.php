@extends('layouts.admin.app')

@section('title', 'Data User')

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

    /* USER GRID LAYOUT */
    .user-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 25px;
        margin-top: 20px;
    }

    .user-card {
        background: white;
        border-radius: 16px;
        padding: 25px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .user-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    }

    .user-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.15);
    }

    .user-header {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 20px;
    }

    .user-avatar {
        width: 70px;
        height: 70px;
        border-radius: 14px;
        object-fit: cover;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        border: 3px solid white;
    }

    .user-avatar-placeholder {
        width: 70px;
        height: 70px;
        border-radius: 14px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 800;
        font-size: 32px;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .user-info h4 {
        margin: 0 0 8px 0;
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
    }

    .user-info p {
        margin: 0;
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
    }

    .user-details {
        flex: 1;
        padding: 18px;
        background: #f8fafc;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        font-size: 13px;
    }

    .detail-label {
        color: #94a3b8;
        font-weight: 600;
        min-width: 80px;
    }

    .detail-value {
        color: #1e293b;
        font-weight: 600;
        text-align: right;
    }

    .detail-item:not(:last-child) {
        border-bottom: 1px solid #e2e8f0;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .status-verified {
        background: #d1fae5;
        color: #065f46;
    }

    .status-unverified {
        background: #fee2e2;
        color: #991b1b;
    }

    .user-actions {
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
        cursor: pointer;
        text-decoration: none;
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

    .role-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        background: #dbeafe;
        color: #1e40af;
    }

    @media (max-width: 768px) {
        .user-grid {
            grid-template-columns: 1fr;
        }

        .modern-header {
            flex-direction: column;
            gap: 20px;
            text-align: center;
        }

        .detail-item {
            flex-direction: column;
            gap: 4px;
            align-items: flex-start;
        }

        .detail-value {
            text-align: left;
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
                <h1>👥 Data User</h1>
                <p>Kelola akun pengguna sistem Bina Desa</p>
            </div>
            <a href="{{ route('admin.user.create') }}" class="btn-add-floating">
                <i class="bi bi-plus-circle"></i> Tambah User
            </a>
        </div>

        {{-- Filter Card --}}
        <div class="filter-card">
            <form method="GET" action="{{ route('admin.user.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <div class="filter-label">Status Verifikasi</div>
                        <select name="email_verified" class="form-select-custom" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="verified" {{ request('email_verified') == 'verified' ? 'selected' : '' }}>Terverifikasi</option>
                            <option value="unverified" {{ request('email_verified') == 'unverified' ? 'selected' : '' }}>Belum Verifikasi</option>
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
                                   placeholder="Cari nama atau email..."
                                   style="border-left: none; border-radius: 0 12px 12px 0;">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn-search-custom w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>

                    <div class="col-md-2">
                        @if(request('search') || request('email_verified'))
                            <a href="{{ route('admin.user.index') }}" class="btn-reset-custom w-100">
                                <i class="bi bi-x-circle"></i> Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- User Grid --}}
        <div class="user-grid">
            @forelse($users as $user)
                <div class="user-card">
                    {{-- User Header --}}
                    <div class="user-header">
                        @if($user->profile_picture)
                            <img src="{{ $user->profile_picture_url }}"
                                 alt="{{ $user->name }}"
                                 class="user-avatar">
                        @else
                            <div class="user-avatar-placeholder">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="user-info" style="flex: 1;">
                            <h4>{{ $user->name }}</h4>
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>

                    {{-- User Details --}}
                    <div class="user-details">
                        <div class="detail-item">
                            <span class="detail-label">Role</span>
                            <span class="role-badge">
                                {{ $user->role ?? 'USER' }}
                            </span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Status</span>
                            @if($user->email_verified_at)
                                <span class="status-badge status-verified">
                                    <i class="bi bi-check-circle-fill"></i> Terverifikasi
                                </span>
                            @else
                                <span class="status-badge status-unverified">
                                    <i class="bi bi-exclamation-circle-fill"></i> Belum Verifikasi
                                </span>
                            @endif
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Bergabung</span>
                            <span class="detail-value">{{ $user->created_at->format('d M Y') }}</span>
                        </div>
                    </div>

                    {{-- Actions - HANYA ICON --}}
                    <div class="user-actions">
                        <a href="{{ route('admin.user.show', $user->id) }}"
                           class="btn-action-card btn-view"
                           title="Detail">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <a href="{{ route('admin.user.edit', $user->id) }}"
                           class="btn-action-card btn-edit"
                           title="Edit">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('admin.user.destroy', $user->id) }}"
                              method="POST" class="d-inline" style="flex: 1;"
                              onsubmit="return confirm('Yakin hapus user ini?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="btn-action-card btn-delete w-100"
                                    title="Hapus">
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
                            Belum ada data user
                        @endif
                    </h4>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($users->hasPages())
            <div class="mt-4">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>
</div>

@endsection
