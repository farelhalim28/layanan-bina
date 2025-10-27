@extends('layouts.admin.app')

@section('title', 'Dashboard')

@section('content')
    @php
        use Illuminate\Support\Str;
        $user = session('user') ?? null;
        $warga = $warga ?? [];
        $jenis_surat = $jenis_surat ?? [];
        $users = $users ?? [];
        $media = $media ?? [];
        $stats = $stats ?? ['total_warga' => 0, 'total_jenis_surat' => 0];
    @endphp

    {{-- Alert Sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Heading --}}
    <div class="page-heading">
        <h3>Selamat Datang, {{ $user['nama'] ?? 'Admin' }}!</h3>
    </div>

    <div class="page-heading">
        <h3>Statistik Data</h3>
    </div>

    {{-- Statistik --}}
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Total Warga</h6>
                                    <h6 class="font-extrabold mb-0">{{ $stats['total_warga'] ?? 0 }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Jenis Surat</h6>
                                    <h6 class="font-extrabold mb-0">{{ $stats['total_jenis_surat'] ?? 0 }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Data Warga Terbaru --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Warga Terbaru</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>No KTP</th>
                                            <th>Nama</th>
                                            <th>JK</th>
                                            <th>Pekerjaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($warga as $w)
                                            <tr>
                                                <td class="font-bold">{{ $w->no_ktp }}</td>
                                                <td>{{ $w->nama }}</td>
                                                <td>{{ $w->jenis_kelamin }}</td>
                                                <td>{{ $w->pekerjaan }}</td>
                                                <td>
                                                    <a href="{{ route('admin.warga.show', $w->warga_id) }}" class="btn btn-sm btn-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">Belum ada data warga</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Daftar Jenis Surat --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Jenis Surat</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Jenis</th>
                                            <th>Persyaratan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($jenis_surat as $jenis)
                                            <tr>
                                                <td><span class="badge bg-primary">{{ $jenis->kode }}</span></td>
                                                <td>{{ $jenis->nama_jenis }}</td>
                                                <td>
                                                    @if ($jenis->syarat_json)
                                                        <small class="text-muted">{{ Str::limit($jenis->syarat_json, 40) }}</small>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.jenis-surat.edit', $jenis->jenis_id) }}" class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">Belum ada jenis surat</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Daftar User --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-white border-bottom">
                            <h4 class="mb-0 text-dark">Daftar User</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $u)
                                            <tr>
                                                <td>{{ $u->name }}</td>
                                                <td>{{ $u->email }}</td>
                                                <td><code>{{ Str::limit($u->password, 25) }}</code></td>
                                                <td>
                                                    @if ($u->status == 'active')
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.user.edit', $u->id) }}" class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">Belum ada user</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Daftar Media --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Media</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Preview</th>
                                            <th>Ref Table</th>
                                            <th>Ref ID</th>
                                            <th>File Name</th>
                                            <th>Caption</th>
                                            <th>Type</th>
                                            <th>Order</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($media as $m)
                                            <tr>
                                                <td>
                                                    @if ($m->is_image)
                                                        <img src="{{ $m->full_url }}" alt="{{ $m->caption }}" class="img-thumbnail"
                                                            style="width:60px;height:60px;object-fit:cover;">
                                                    @else
                                                        <div class="text-center" style="font-size:2rem;">
                                                            <i class="bi {{ $m->file_icon }} text-primary"></i>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td><span class="badge bg-info">{{ $m->ref_table }}</span></td>
                                                <td>{{ $m->ref_id }}</td>
                                                <td><small class="text-muted">{{ basename($m->file_url) }}</small></td>
                                                <td>{{ $m->caption ?? '-' }}</td>
                                                <td><code>{{ $m->mime_type }}</code></td>
                                                <td><span class="badge bg-secondary">{{ $m->sort_order }}</span></td>
                                                <td>
                                                    <a href="{{ route('admin.media.show', $m->media_id) }}" class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.media.edit', $m->media_id) }}" class="btn btn-sm btn-warning">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('admin.media.destroy', $m->media_id) }}" method="POST" class="d-inline"
                                                        onsubmit="return confirm('Yakin hapus media ini?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">Belum ada data media</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
