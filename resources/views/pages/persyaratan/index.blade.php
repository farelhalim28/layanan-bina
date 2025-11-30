@extends('layouts.admin.app')

@section('title', 'Berkas Persyaratan - Bina Desa')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Berkas Persyaratan</h3>
    <a href="{{ route('admin.berkas-persyaratan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Berkas
    </a>
</div>

<section class="section mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Berkas Persyaratan</h4>
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
                <form method="GET" action="{{ route('admin.berkas-persyaratan.index') }}">
                    <div class="row g-2">
                        <!-- FILTER VALIDASI -->
                        <div class="col-md-2">
                            <select name="valid" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="1" {{ request('valid') === '1' ? 'selected' : '' }}>Valid</option>
                                <option value="0" {{ request('valid') === '0' ? 'selected' : '' }}>Tidak Valid</option>
                            </select>
                        </div>

                        <!-- SEARCH -->
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text"
                                       name="search"
                                       class="form-control"
                                       value="{{ request('search') }}"
                                       placeholder="Cari nama berkas...">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>
                        </div>

                        <!-- BUTTON RESET -->
                        <div class="col-md-2">
                            @if(request('search') || request('valid') !== null)
                                <a href="{{ route('admin.berkas-persyaratan.index') }}"
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
                            <th>Nomor Permohonan</th>
                            <th>Pemohon</th>
                            <th>Nama Berkas</th>
                            <th>Status Validasi</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($berkas_persyaratan as $index => $berkas)
                        <tr>
                            <td>{{ ($berkas_persyaratan->currentPage() - 1) * $berkas_persyaratan->perPage() + $index + 1 }}</td>
                            <td><span class="badge bg-info">{{ $berkas->permohonanSurat->nomor_permohonan ?? '-' }}</span></td>
                            <td>{{ $berkas->permohonanSurat->pemohon->nama ?? '-' }}</td>
                            <td>{{ $berkas->nama_berkas }}</td>
                            <td>
                                @if($berkas->valid)
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Valid
                                    </span>
                                @else
                                    <span class="badge bg-danger">
                                        <i class="bi bi-x-circle"></i> Tidak Valid
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.berkas-persyaratan.show', $berkas->berkas_id) }}"
                                   class="btn btn-sm btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.berkas-persyaratan.edit', $berkas->berkas_id) }}"
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.berkas-persyaratan.destroy', $berkas->berkas_id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin hapus berkas ini?')">
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
                                    Belum ada berkas persyaratan
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="mt-3">
                {{ $berkas_persyaratan->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</section>
@endsection
