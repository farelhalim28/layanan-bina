@extends('layouts.admin.app')

@section('title', 'Berkas Persyaratan - Bina Desa')

@section('content')

{{-- ALERT SUCCESS --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 mb-4">
    <strong>Berhasil!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- HEADER KOTAK (KAYA DATA USER) --}}
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">

        {{-- KIRI --}}
        <div class="d-flex align-items-center gap-3">
            <div class="bg-primary text-white rounded-3 d-flex align-items-center justify-content-center"
                 style="width:46px; height:46px;">
                <i class="bi bi-file-earmark-text fs-4"></i>
            </div>
            <div>
                <h4 class="fw-bold mb-0 text-primary">
                    Berkas Persyaratan
                </h4>
                <small class="text-muted">
                    Kelola berkas dan dokumen persyaratan pemohon
                </small>
            </div>
        </div>

        {{-- KANAN --}}
        <a href="{{ route('admin.berkas-persyaratan.create') }}"
           class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">
            Tambah Berkas
        </a>

    </div>
</div>


{{-- FILTER --}}
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">
        <form method="GET"
              action="{{ route('admin.berkas-persyaratan.index') }}"
              class="row g-3">

            <div class="col-md-5">
                <label class="form-label">Pencarian</label>
                <input type="text"
                       name="search"
                       class="form-control"
                       value="{{ request('search') }}"
                       placeholder="Cari nama berkas, pemohon, nomor...">
            </div>

            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="valid"
                        class="form-select"
                        onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="1" {{ request('valid') === '1' ? 'selected' : '' }}>
                        Valid
                    </option>
                    <option value="0" {{ request('valid') === '0' ? 'selected' : '' }}>
                        Tidak Valid
                    </option>
                </select>
            </div>

            <div class="col-md-4 d-flex align-items-end gap-2">
                <button class="btn btn-primary">
                    <i class="bi bi-search me-1"></i> Cari
                </button>

                @if(request('search') || request('valid') !== null)
                <a href="{{ route('admin.berkas-persyaratan.index') }}"
                   class="btn btn-outline-danger">
                    <i class="bi bi-x-circle me-1"></i> Reset
                </a>
                @endif
            </div>

        </form>
    </div>
</div>

{{-- TABLE --}}
@if($berkas_persyaratan->count() > 0)
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">

            <thead class="bg-primary text-white">
                <tr>
                    <th style="width:60px;">#</th>
                    <th>Nama Berkas</th>
                    <th>Pemohon</th>
                    <th>Nomor Permohonan</th>
                    <th>Status</th>
                    <th class="text-center" style="width:160px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @foreach($berkas_persyaratan as $index => $berkas)
                <tr>

                    <td class="fw-bold text-primary">
                        {{ $berkas_persyaratan->firstItem() + $index }}
                    </td>

                    <td class="fw-semibold">
                        <i class="bi bi-file-earmark-text text-primary me-1"></i>
                        {{ $berkas->nama_berkas }}
                    </td>

                    <td>
                        {{ $berkas->permohonanSurat->pemohon->nama ?? '-' }}
                    </td>

                    <td>
                        {{ $berkas->permohonanSurat->nomor_permohonan ?? '-' }}
                    </td>

                    <td>
                        @if($berkas->valid)
                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                                Valid
                            </span>
                        @else
                            <span class="badge bg-danger-subtle text-danger rounded-pill px-3 py-2">
                                Tidak Valid
                            </span>
                        @endif
                    </td>

                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">

                            <a href="{{ route('admin.berkas-persyaratan.show', $berkas->berkas_id) }}"
                               class="btn btn-sm btn-info-subtle text-info rounded"
                               title="Detail">
                                <i class="bi bi-eye fs-6"></i>
                            </a>

                            <a href="{{ route('admin.berkas-persyaratan.edit', $berkas->berkas_id) }}"
                               class="btn btn-sm btn-warning-subtle text-warning rounded"
                               title="Edit">
                                <i class="bi bi-pencil-square fs-6"></i>
                            </a>

                            <form action="{{ route('admin.berkas-persyaratan.destroy', $berkas->berkas_id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus berkas ini?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-sm btn-danger-subtle text-danger rounded"
                                        title="Hapus">
                                    <i class="bi bi-trash fs-6"></i>
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
    @if($berkas_persyaratan->hasPages())
    <div class="d-flex justify-content-between align-items-center px-4 py-3">
        <small class="text-muted">
            Menampilkan {{ $berkas_persyaratan->firstItem() }}
            - {{ $berkas_persyaratan->lastItem() }}
            dari {{ $berkas_persyaratan->total() }} data
        </small>

        {{ $berkas_persyaratan->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@else
{{-- EMPTY STATE --}}
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body text-center py-5">
        <i class="bi bi-inbox fs-1 text-muted mb-3"></i>
        <h6 class="text-muted fw-semibold">
            Belum ada berkas persyaratan
        </h6>
    </div>
</div>
@endif

@endsection
