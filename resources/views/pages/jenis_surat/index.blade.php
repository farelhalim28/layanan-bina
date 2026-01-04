@extends('layouts.admin.app')

@section('title', 'Jenis Surat - Bina Desa')

@section('content')

{{-- ALERT SUCCESS --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 mb-4" role="alert">
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
                <i class="bi bi-envelope-paper me-2"></i> Jenis Surat
            </h3>
            <small class="text-muted">
                Kelola jenis-jenis surat yang tersedia di sistem
            </small>
        </div>

        <a href="{{ route('admin.jenis-surat.create') }}"
           class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Jenis Surat
        </a>
    </div>
</div>

{{-- FILTER --}}
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.jenis-surat.index') }}">
            <div class="row g-3 align-items-end">

                <div class="col-md-4">
                    <label class="form-label text-uppercase text-muted fw-semibold" style="font-size:11px;">
                        Filter Kode
                    </label>
                    <select name="filter_kode"
                            class="form-select rounded-3"
                            onchange="this.form.submit()">
                        <option value="">Semua Jenis</option>
                        @foreach(['SKTM','SKU','SKCK','SKD','SKPWNI'] as $kode)
                            <option value="{{ $kode }}" {{ request('filter_kode') == $kode ? 'selected' : '' }}>
                                {{ $kode }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-5">
                    <label class="form-label text-uppercase text-muted fw-semibold" style="font-size:11px;">
                        Pencarian
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control border-start-0"
                               placeholder="Cari kode atau nama jenis surat...">
                    </div>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-primary w-100 rounded-3 fw-semibold">
                        <i class="bi bi-search"></i> Cari
                    </button>

                    @if(request('search') || request('filter_kode'))
                    <a href="{{ route('admin.jenis-surat.index') }}"
                       class="btn btn-outline-danger w-100 rounded-3 fw-semibold">
                        <i class="bi bi-x-circle"></i>
                    </a>
                    @endif
                </div>

            </div>
        </form>
    </div>
</div>

{{-- TABLE --}}
@if($jenis_surat->count() > 0)
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="bg-primary text-white">
                <tr>
                    <th style="width:60px;">#</th>
                    <th>Kode</th>
                    <th>Nama Jenis Surat</th>
                    <th>Deskripsi</th>
                    <th class="text-center" style="width:160px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @foreach($jenis_surat as $index => $jenis)
                <tr class="border-bottom">

                    <td class="fw-bold text-primary">
                        {{ $jenis_surat->firstItem() + $index }}
                    </td>

                    <td>
                        <span class="badge bg-primary rounded-pill px-3 py-2">
                            {{ $jenis->kode }}
                        </span>
                    </td>

                    <td class="fw-semibold">
                        {{ $jenis->nama_jenis }}
                    </td>

                    <td>
                        <small class="text-muted">
                            {{ $jenis->syarat_json ? \Illuminate\Support\Str::limit($jenis->syarat_json, 60) : '-' }}
                        </small>
                    </td>

                    {{-- AKSI (SINKRON DENGAN PERMOHONAN) --}}
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">

                            <a href="{{ route('admin.jenis-surat.show', $jenis->jenis_id) }}"
                               class="btn btn-sm btn-outline-info"
                               title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('admin.jenis-surat.edit', $jenis->jenis_id) }}"
                               class="btn btn-sm btn-outline-warning"
                               title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.jenis-surat.destroy', $jenis->jenis_id) }}"
                                  onsubmit="return confirm('Yakin hapus jenis surat ini?')">
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
    @if($jenis_surat->hasPages())
    <div class="d-flex justify-content-between align-items-center px-4 py-3">
        <small class="text-muted">
            Showing {{ $jenis_surat->firstItem() }} - {{ $jenis_surat->lastItem() }}
            of {{ $jenis_surat->total() }}
        </small>
        {{ $jenis_surat->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@else
{{-- EMPTY --}}
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body text-center py-5">
        <i class="bi bi-inbox display-4 text-muted mb-3"></i>
        <h5 class="text-muted fw-semibold">
            {{ request('search') ? 'Data tidak ditemukan' : 'Belum ada jenis surat' }}
        </h5>
    </div>
</div>
@endif

@endsection
