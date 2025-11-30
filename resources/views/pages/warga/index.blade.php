@extends('layouts.admin.app')

@section('title', 'Data Warga - Bina Desa')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Data Warga</h3>
    <a href="{{ route('admin.warga.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Warga
    </a>
</div>

<section class="section mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Warga</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- FORM FILTER & SEARCH -->
            <div class="mb-3">
                <form method="GET" action="{{ route('admin.warga.index') }}">
                    <div class="row g-2">
                        <!-- FILTER JENIS KELAMIN -->
                        <div class="col-md-2">
                            <select name="jenis_kelamin" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Gender</option>
                                <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- FILTER AGAMA -->
                        <div class="col-md-2">
                            <select name="agama" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Agama</option>
                                <option value="Islam" {{ request('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ request('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ request('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ request('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ request('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ request('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                        </div>

                        <!-- SEARCH -->
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text"
                                       name="search"
                                       class="form-control"
                                       value="{{ request('search') }}"
                                       placeholder="Cari KTP, nama, email...">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>
                        </div>

                        <!-- BUTTON RESET -->
                        <div class="col-md-2">
                            @if(request('search') || request('jenis_kelamin') || request('agama'))
                                <a href="{{ route('admin.warga.index') }}"
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
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th>No KTP</th>
                            <th>Nama</th>
                            <th>JK</th>
                            <th>Agama</th>
                            <th>Pekerjaan</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($warga as $index => $item)
                        <tr>
                            <td>{{ ($warga->currentPage() - 1) * $warga->perPage() + $index + 1 }}</td>
                            <td><code>{{ $item->no_ktp }}</code></td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                <span class="badge bg-{{ $item->jenis_kelamin == 'L' ? 'primary' : 'danger' }}">
                                    {{ $item->jenis_kelamin == 'L' ? 'L' : 'P' }}
                                </span>
                            </td>
                            <td>{{ $item->agama }}</td>
                            <td>{{ $item->pekerjaan }}</td>
                            <td>{{ $item->telp }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a href="{{ route('admin.warga.show', $item->warga_id) }}"
                                   class="btn btn-sm btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.warga.edit', $item->warga_id) }}"
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.warga.destroy', $item->warga_id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin hapus warga ini?')">
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
                            <td colspan="9" class="text-center text-muted py-4">
                                @if(request('search'))
                                    <i class="bi bi-search"></i>
                                    Data tidak ditemukan dengan kata kunci "{{ request('search') }}"
                                @else
                                    <i class="bi bi-inbox"></i>
                                    Belum ada data warga
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="mt-3">
                {{ $warga->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</section>
@endsection
