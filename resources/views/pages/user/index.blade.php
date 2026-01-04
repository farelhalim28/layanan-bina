@extends('layouts.admin.app')

@section('title', 'Data User - Bina Desa')

@section('content')

{{-- ALERT SUCCESS --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 mb-4">
    <i class="bi bi-check-circle-fill me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- HEADER --}}
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h3 class="fw-bold mb-1 text-primary">
                <i class="bi bi-people-fill me-2"></i> Data User
            </h3>
            <small class="text-muted">
                Kelola akun pengguna sistem
            </small>
        </div>

        <a href="{{ route('admin.user.create') }}"
           class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah User
        </a>
    </div>
</div>

{{-- TABLE --}}
@if($users->count() > 0)
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="bg-primary text-white">
                <tr>
                    <th style="width:60px;">#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th style="width:140px;">Role</th>
                    <th style="width:160px;">Status</th>
                    <th class="text-center" style="width:160px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $index => $user)
                <tr class="border-bottom">
                    <td class="fw-bold text-primary">
                        {{ $users->firstItem() + $index }}
                    </td>

                    <td class="fw-semibold">
                        {{ $user->name }}
                    </td>

                    <td class="text-muted">
                        {{ $user->email }}
                    </td>

                    <td>
                        <span class="badge bg-info rounded-pill px-3 py-2">
                            {{ $user->role }}
                        </span>
                    </td>

                    <td>
                        @if($user->email_verified_at)
                            <span class="badge bg-success rounded-pill px-3 py-2">
                                <i class="bi bi-check-circle me-1"></i> Terverifikasi
                            </span>
                        @else
                            <span class="badge bg-secondary rounded-pill px-3 py-2">
                                <i class="bi bi-clock-history me-1"></i> Belum
                            </span>
                        @endif
                    </td>

                    {{-- AKSI --}}
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">

                            <a href="{{ route('admin.user.show', $user->id) }}"
                               class="btn btn-sm btn-outline-info"
                               title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('admin.user.edit', $user->id) }}"
                               class="btn btn-sm btn-outline-warning"
                               title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.user.destroy', $user->id) }}"
                                  onsubmit="return confirm('Yakin hapus user ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if($users->hasPages())
    <div class="d-flex justify-content-between align-items-center px-4 py-3">
        <small class="text-muted">
            Showing {{ $users->firstItem() }} - {{ $users->lastItem() }}
            of {{ $users->total() }}
        </small>
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@else
{{-- EMPTY --}}
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body text-center py-5">
        <i class="bi bi-inbox display-4 text-muted mb-3"></i>
        <h5 class="text-muted fw-semibold">
            Belum ada data user
        </h5>
    </div>
</div>
@endif

@endsection
