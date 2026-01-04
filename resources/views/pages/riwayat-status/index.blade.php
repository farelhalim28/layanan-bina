<!-- FILE: resources/views/pages/riwayat-status/index.blade.php -->
@extends('layouts.admin.app')

@section('title', 'Riwayat Status Surat - Bina Desa')

@section('content')

{{-- Alert --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- Header --}}
{{-- Header Kotak --}}
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">

        {{-- Kiri --}}
        <div>
            <h4 class="fw-bold mb-1 text-primary">
                Riwayat Status Surat
            </h4>
            <small class="text-muted">
                Kelola riwayat perubahan status surat pemohon
            </small>
        </div>

        {{-- Kanan --}}
        <a href="{{ route('admin.riwayat-status.create') }}"
           class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">
            Tambah Riwayat
        </a>

    </div>
</div>



<div class="page-content">
<section class="section">

{{-- Filter --}}
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.riwayat-status.index') }}" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Pencarian</label>
                <input type="text"
                       name="search"
                       class="form-control"
                       value="{{ request('search') }}"
                       placeholder="Cari nomor permohonan atau petugas">
            </div>

            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">Petugas</label>
                <select name="petugas_warga_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Petugas</option>
                    @foreach($petugas_list as $petugas)
                        <option value="{{ $petugas->warga_id }}"
                            {{ request('petugas_warga_id') == $petugas->warga_id ? 'selected' : '' }}>
                            {{ $petugas->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 d-flex align-items-end gap-2">
                <button class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> Cari
                </button>
                @if(request()->query())
                    <a href="{{ route('admin.riwayat-status.index') }}" class="btn btn-outline-danger w-100">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

{{-- Table --}}
@if($riwayat_status->count() > 0)
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Nomor Permohonan</th>
                        <th>Status</th>
                        <th>Petugas</th>
                        <th>Waktu</th>
                        <th class="text-center" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat_status as $index => $item)
                    <tr>
                        <td>
                            <strong class="text-primary">
                                {{ $riwayat_status->firstItem() + $index }}
                            </strong>
                        </td>

                        <td>
                            <i class="bi bi-file-earmark-text text-primary me-1"></i>
                            {{ $item->permohonanSurat->nomor_permohonan ?? '-' }}
                        </td>

                        <td>
                            @if($item->status == 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @elseif($item->status == 'diproses')
                                <span class="badge bg-info">Diproses</span>
                            @elseif($item->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>

                        <td>
                            {{ $item->petugas->nama ?? '-' }}
                        </td>

                        <td>
                            {{ $item->waktu->format('d M Y H:i') }}
                        </td>

                        <td class="text-center">
                            <a href="{{ route('admin.riwayat-status.show', $item->riwayat_id) }}"
                               class="btn btn-sm btn-info"
                               title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('admin.riwayat-status.edit', $item->riwayat_id) }}"
                               class="btn btn-sm btn-warning"
                               title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('admin.riwayat-status.destroy', $item->riwayat_id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin hapus riwayat ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($riwayat_status->hasPages())
    <div class="card-footer d-flex justify-content-between align-items-center">
        <small class="text-muted">
            Menampilkan {{ $riwayat_status->firstItem() }}
            sampai {{ $riwayat_status->lastItem() }}
            dari {{ $riwayat_status->total() }} data
        </small>

        {{ $riwayat_status->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@else
<div class="card">
    <div class="card-body text-center py-5">
        <i class="bi bi-inbox display-4 text-muted mb-3"></i>
        <h6 class="text-muted">Belum ada riwayat status</h6>
    </div>
</div>
@endif

</section>
</div>

@endsection
