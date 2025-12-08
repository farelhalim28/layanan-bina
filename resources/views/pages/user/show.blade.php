@extends('layouts.admin.app')

@section('title', 'Detail User')

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

    .detail-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }

    .profile-section {
        text-align: center;
        padding: 40px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        margin-bottom: 40px;
        color: white;
    }

    .profile-photo {
        width: 180px;
        height: 180px;
        border-radius: 50%;
        object-fit: cover;
        border: 6px solid white;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        margin-bottom: 24px;
    }

    .profile-name {
        font-size: 32px;
        font-weight: 800;
        margin: 0 0 12px 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .profile-role {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 10px 24px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 30px;
    }

    .info-item {
        padding: 20px;
        background: #f8fafc;
        border-radius: 12px;
        border-left: 4px solid #667eea;
    }

    .info-label {
        font-size: 11px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .info-value {
        font-size: 16px;
        font-weight: 600;
        color: #1e293b;
    }

    .btn-edit {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(251, 191, 36, 0.4);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
        color: white;
    }

    .btn-back {
        background: white;
        border: 2px solid #e2e8f0;
        color: #64748b;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-back:hover {
        background: #f8fafc;
        border-color: #cbd5e0;
        color: #64748b;
    }

    .verified-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        background: #d1fae5;
        color: #059669;
    }

    .unverified-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        background: #fee2e2;
        color: #dc2626;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .profile-photo {
            width: 140px;
            height: 140px;
        }

        .profile-name {
            font-size: 24px;
        }
    }
</style>

<div class="page-wrapper">
    <div class="container-fluid">

        {{-- Modern Header --}}
        <div class="modern-header">
            <div class="header-title">
                <h1>👤 Detail User</h1>
            </div>
            <a href="{{ route('admin.user.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- Detail Card --}}
        <div class="detail-card">
            {{-- Profile Section --}}
            <div class="profile-section">
                <img src="{{ $user->profile_picture_url }}"
                     alt="{{ $user->name }}"
                     class="profile-photo">
                <h2 class="profile-name">{{ $user->name }}</h2>
                <span class="profile-role">
                    <i class="bi bi-shield-fill"></i>
                    {{ $user->role }}
                </span>
            </div>

            {{-- Info Grid --}}
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">
                        <i class="bi bi-person-badge"></i> ID User
                    </div>
                    <div class="info-value">{{ $user->id }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="bi bi-person"></i> Nama Lengkap
                    </div>
                    <div class="info-value">{{ $user->name }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="bi bi-envelope"></i> Email
                    </div>
                    <div class="info-value">{{ $user->email }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="bi bi-shield-check"></i> Role
                    </div>
                    <div class="info-value">{{ $user->role }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="bi bi-check-circle"></i> Status Verifikasi
                    </div>
                    <div class="info-value">
                        @if($user->email_verified_at)
                            <span class="verified-badge">
                                <i class="bi bi-check-circle-fill"></i>
                                Terverifikasi
                            </span>
                        @else
                            <span class="unverified-badge">
                                <i class="bi bi-x-circle-fill"></i>
                                Belum Verifikasi
                            </span>
                        @endif
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="bi bi-calendar-plus"></i> Bergabung
                    </div>
                    <div class="info-value">{{ $user->created_at->format('d M Y, H:i') }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="bi bi-calendar-check"></i> Terakhir Update
                    </div>
                    <div class="info-value">{{ $user->updated_at->format('d M Y, H:i') }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">
                        <i class="bi bi-clock-history"></i> Update Sejak
                    </div>
                    <div class="info-value">{{ $user->updated_at->diffForHumans() }}</div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex justify-content-end gap-3 pt-4 border-top">
                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn-edit">
                    <i class="bi bi-pencil-fill"></i> Edit User
                </a>
                <form action="{{ route('admin.user.destroy', $user->id) }}"
                      method="POST"
                      class="d-inline"
                      onsubmit="return confirm('Yakin hapus user ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-delete">
                        <i class="bi bi-trash-fill"></i> Hapus User
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection
