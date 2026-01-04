@extends('layouts.admin.app')

@section('title', 'Data Warga - Bina Desa')

@section('content')

{{-- ALERT SUCCESS --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3 mb-4">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- HEADER --}}
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h3 class="fw-bold mb-1 text-primary">Data Warga</h3>
            <small class="text-muted">
                Kelola data penduduk desa
            </small>
        </div>

        <a href="{{ route('admin.warga.create') }}"
           class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Warga
        </a>
    </div>
</div>

{{-- TABLE --}}
@if($warga->count() > 0)
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">

            {{-- HEADER --}}
            <thead class="bg-primary text-white">
                <tr>
                    <th style="width:60px;">#</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Gender</th>
                    <th>Agama</th>
                    <th>Pekerjaan</th>
                    <th class="text-center" style="width:160px;">Aksi</th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody>
            @foreach($warga as $index => $item)
                <tr>

                    {{-- NO --}}
                    <td class="fw-bold text-primary">
                        {{ $warga->firstItem() + $index }}
                    </td>

                    {{-- NAMA --}}
                    <td class="fw-semibold">
                        {{ $item->nama }}
                    </td>

                    {{-- NIK --}}
                    <td class="fw-semibold text-warning">
                        {{ $item->no_ktp }}
                    </td>

                    {{-- GENDER --}}
                    <td>
                        <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                            {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                        </span>
                    </td>

                    {{-- AGAMA --}}
                    <td class="fw-semibold text-muted">
                        {{ $item->agama }}
                    </td>

                    {{-- PEKERJAAN --}}
                    <td class="text-muted">
                        {{ $item->pekerjaan ?? '-' }}
                    </td>

                    {{-- AKSI --}}
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-1">

                            {{-- DETAIL --}}
                            <a href="{{ route('admin.warga.show', $item->warga_id) }}"
                               class="btn btn-sm btn-info-subtle text-info rounded"
                               title="Detail">
                                <i class="bi bi-eye fs-6"></i>
                            </a>

                            {{-- EDIT --}}
                            <a href="{{ route('admin.warga.edit', $item->warga_id) }}"
                               class="btn btn-sm btn-warning-subtle text-warning rounded"
                               title="Edit">
                                <i class="bi bi-pencil-square fs-6"></i>
                            </a>

                            {{-- DELETE --}}
                            <form method="POST"
                                  action="{{ route('admin.warga.destroy', $item->warga_id) }}"
                                  onsubmit="return confirm('Yakin hapus data warga ini?')">
                                @csrf @method('DELETE')
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
    @if($warga->hasPages())
    <div class="d-flex justify-content-between align-items-center px-4 py-3">
        <small class="text-muted">
            Showing {{ $warga->firstItem() }} - {{ $warga->lastItem() }}
            of {{ $warga->total() }}
        </small>
        {{ $warga->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@else
{{-- EMPTY --}}
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body text-center py-5">
        <h5 class="text-muted fw-semibold">
            Belum ada data warga
        </h5>
    </div>
</div>
@endif

@endsection
