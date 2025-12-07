@extends('layouts.admin.app')

@section('title', 'Data User')

@section('content')

<style>
    .user-card {
        background: #fff;
        border-radius: 14px;
        padding: 18px;
        border: 1px solid #eee;
        transition: 0.3s;
    }

    .user-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.07);
    }

    .user-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #0095ff;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 18px;
    }

    .card-actions button,
    .card-actions a {
        font-size: 12px;
        padding: 6px 10px;
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
                        <div class="filter-label">Filter Status</div>
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

                    @if(request()->filled('search') || request()->filled('email_verified'))
                        <div class="col-md-2">
                            <a href="{{ route('admin.user.index') }}" class="btn-reset-custom w-100">
                                <i class="bi bi-x-circle"></i> Reset
                            </a>
                        </div>
                    @endif
                </div>
            </form>
        </div>

        {{-- User Grid --}}
        <div class="user-grid">
            @forelse($users as $user)
                <div class="user-card">

                    {{-- User Header --}}
                    <div class="user-header">
                        <div class="user-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="user-info" style="flex: 1;">
                            <h4>{{ $user->name }}</h4>
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>

                    {{-- User Details --}}
                    <div class="user-details">

                        {{-- ➕ ROLE DITAMBAHKAN DI SINI --}}
                        <div class="detail-item">
                            <span class="detail-label">Role</span>
                            <span class="detail-value text-uppercase">
                                {{ $user->role ?? 'TIDAK ADA ROLE' }}
                            </span>
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Status</span>
                            @if($user->email_verified_at)
                                <span class="status-badge status-verified">
                                    <i class="bi bi-check-circle"></i> Terverifikasi
                                </span>
                            @else
                                <span class="status-badge status-unverified">
                                    <i class="bi bi-exclamation-circle"></i> Belum Verifikasi
                                </span>
                            @endif
                        </div>

                        <div class="detail-item">
                            <span class="detail-label">Bergabung</span>
                            <span class="detail-value">{{ $user->created_at->format('d M Y') }}</span>
                        </div>

                    </div>

                    {{-- Actions --}}
                    <div class="user-actions">
                        <a href="{{ route('admin.user.show', $user->id) }}"
                           class="btn-action-card btn-view">
                            <i class="bi bi-eye-fill"></i> Detail
                        </a>
                        <a href="{{ route('admin.user.edit', $user->id) }}"
                           class="btn-action-card btn-edit">
                            <i class="bi bi-pencil-fill"></i> Edit
                        </a>

                        <form action="{{ route('admin.user.destroy', $user->id) }}"
                              method="POST" class="d-inline" style="flex: 1;"
                              onsubmit="return confirm('Yakin hapus user ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-action-card btn-delete w-100">
                                <i class="bi bi-trash-fill"></i> Hapus
                            </button>
                        </form>
                    </div>

                </div>

            @empty
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <h4>Tidak ada data ditemukan.</h4>
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
