@extends('layouts.admin.app')

@section('title', 'Permohonan Surat - Bina Desa')

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
                <i class="bi bi-file-earmark-text me-2"></i> Permohonan Surat
            </h3>
            <small class="text-muted">
                Kelola seluruh permohonan surat dari masyarakat
            </small>
        </div>

        <a href="{{ route('admin.permohonan-surat.create') }}"
           class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Permohonan
        </a>
    </div>
</div>

{{-- FILTER --}}
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.permohonan-surat.index') }}">
            <div class="row g-3 align-items-end">

                <div class="col-md-4">
                    <label class="form-label text-uppercase text-muted fw-semibold" style="font-size:11px;">
                        Filter Status
                    </label>
                    <select name="filter_status"
                            class="form-select rounded-3"
                            onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        @foreach(['pending','diproses','selesai','ditolak'] as $status)
                            <option value="{{ $status }}" {{ request('filter_status') == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
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
                               placeholder="Cari nomor permohonan...">
                    </div>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-primary w-100 rounded-3 fw-semibold">
                        <i class="bi bi-search"></i> Cari
                    </button>

                    @if(request('search') || request('filter_status'))
                    <a href="{{ route('admin.permohonan-surat.index') }}"
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
@if($permohonan_surat->count() > 0)
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="bg-primary text-white">
                <tr>
                    <th style="width:60px;">#</th>
                    <th>Permohonan</th>
                    <th>Pemohon</th>
                    <th>Jenis Surat</th>
                    <th>Status</th>
                    <th class="text-center" style="width:160px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @foreach($permohonan_surat as $index => $permohonan)
                <tr class="border-bottom align-middle">

                    {{-- NO --}}
                    <td class="fw-bold text-primary">
                        {{ $permohonan_surat->firstItem() + $index }}
                    </td>

                    {{-- NOMOR --}}
                    <td>
                        <div class="fw-semibold text-dark">
                            {{ $permohonan->nomor_permohonan }}
                        </div>
                        <small class="text-muted">
                            ID: {{ $permohonan->permohonan_id }}
                        </small>
                    </td>

                    {{-- PEMOHON --}}
                    <td>
                        <div class="fw-semibold">
                            {{ $permohonan->pemohon->nama ?? '-' }}
                        </div>
                        <small class="text-muted">
                            {{ \Carbon\Carbon::parse($permohonan->tanggal_pengajuan)->format('d M Y') }}
                        </small>
                    </td>

                    {{-- JENIS SURAT --}}
                    <td>
                        <span class="badge bg-light text-primary border rounded-pill px-3 py-2">
                            <i class="bi bi-envelope-paper me-1"></i>
                            {{ $permohonan->jenisSurat->nama_jenis ?? '-' }}
                        </span>
                    </td>

                    {{-- STATUS --}}
                    <td>
                        <span class="badge
                            @if($permohonan->status == 'pending') bg-warning
                            @elseif($permohonan->status == 'diproses') bg-primary
                            @elseif($permohonan->status == 'selesai') bg-success
                            @else bg-danger
                            @endif
                            rounded-pill px-3 py-2 text-uppercase fw-semibold"
                            style="font-size:11px;">
                            {{ $permohonan->status }}
                        </span>
                    </td>

                    {{-- AKSI --}}
                    <td class="text-center">
    <div class="d-flex justify-content-center gap-1">

        <a href="{{ route('admin.permohonan-surat.show', $permohonan->permohonan_id) }}"
           class="btn btn-sm btn-outline-info"
           title="Detail">
            <i class="bi bi-eye"></i>
        </a>

        <a href="{{ route('admin.permohonan-surat.edit', $permohonan->permohonan_id) }}"
           class="btn btn-sm btn-outline-warning"
           title="Edit">
            <i class="bi bi-pencil"></i>
        </a>

        <form method="POST"
              action="{{ route('admin.permohonan-surat.destroy', $permohonan->permohonan_id) }}"
              onsubmit="return confirm('Yakin hapus permohonan ini?')">
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
    @if($permohonan_surat->hasPages())
    <div class="d-flex justify-content-between align-items-center px-4 py-3">
        <small class="text-muted">
            Showing {{ $permohonan_surat->firstItem() }} - {{ $permohonan_surat->lastItem() }}
            of {{ $permohonan_surat->total() }}
        </small>
        {{ $permohonan_surat->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@else
{{-- EMPTY --}}
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body text-center py-5">
        <i class="bi bi-inbox display-4 text-muted mb-3"></i>
        <h5 class="text-muted fw-semibold">
            {{ request('search') ? 'Data tidak ditemukan' : 'Belum ada permohonan surat' }}
        </h5>
    </div>
</div>
@endif

@endsection
