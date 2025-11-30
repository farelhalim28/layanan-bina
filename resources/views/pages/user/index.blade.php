@extends('layouts.admin.app')

@section('title', 'Data User')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Data User</h3>
    <a href="{{ route('admin.user.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah User
    </a>
</div>

<section class="section">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header"><h4>Daftar User</h4></div>
        <div class="card-body">
            <!-- FORM FILTER & SEARCH -->
            <div class="mb-3">
                <form method="GET" action="{{ route('admin.user.index') }}">
                    <div class="row g-2">
                        <!-- FILTER EMAIL VERIFIED -->
                        <div class="col-md-2">
                            <select name="email_verified" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="verified" {{ request('email_verified') == 'verified' ? 'selected' : '' }}>Email Terverifikasi</option>
                                <option value="unverified" {{ request('email_verified') == 'unverified' ? 'selected' : '' }}>Belum Verifikasi</option>
                            </select>
                        </div>

                        <!-- SEARCH -->
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text"
                                       name="search"
                                       class="form-control"
                                       value="{{ request('search') }}"
                                       placeholder="Cari nama atau email...">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>
                        </div>

                        <!-- BUTTON RESET -->
                        <div class="col-md-2">
                            @if(request('search') || request('email_verified'))
                                <a href="{{ route('admin.user.index') }}"
                                   class="btn btn-outline-danger w-100">
                                    <i class="bi bi-x-circle"></i> Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Status Verifikasi</th>
                            <th>Tanggal Dibuat</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-md me-2">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" alt="{{ $user->name }}">
                                        </div>
                                        <span>{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->email_verified_at)
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle"></i> Terverifikasi
                                        </span>
                                    @else
                                        <span class="badge bg-warning">
                                            <i class="bi bi-clock"></i> Belum Verifikasi
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.user.show', $user->id) }}"
                                       class="btn btn-sm btn-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.user.edit', $user->id) }}"
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.user.destroy', $user->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    @if(request('search'))
                                        <i class="bi bi-search"></i>
                                        Data tidak ditemukan
                                    @else
                                        <i class="bi bi-inbox"></i>
                                        Belum ada data user
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="mt-3">
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</section>
@endsection
