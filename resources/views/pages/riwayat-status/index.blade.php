@extends('layouts.admin.app')

@section('title', 'Riwayat Status Surat - Bina Desa')

@section('content')

<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Riwayat Status Surat</h3>
    <a href="{{ route('admin.riwayat-status.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Riwayat
    </a>
</div>

<section class="section mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Riwayat Status Surat</h4>
        </div>

        <div class="card-body">

            {{-- FILTER & SEARCH FORM --}}
            <form method="GET" action="">
                <div class="row g-2 mb-3">

                    {{-- FILTER STATUS --}}
                    <div class="col-md-3">
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Status</option>
                            <option value="pending"   {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="diproses"  {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai"   {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak"   {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    {{-- FILTER PETUGAS --}}
                    <div class="col-md-3">
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

                    {{-- SEARCH --}}
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                   placeholder="Cari nomor permohonan / nama petugas...">
                            <button class="btn btn-primary">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>

                    {{-- RESET --}}
                    <div class="col-md-2">
                        @if(request()->query())
                            <a href="{{ route('admin.riwayat-status.index') }}" class="btn btn-outline-danger w-100">
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>

            {{-- TABEL --}}
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Permohonan</th>
                            <th>Status</th>
                            <th>Petugas</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($riwayat_status as $i => $item)
                        <tr>
                            <td>{{ $riwayat_status->firstItem() + $i }}</td>

                            <td>
                                <span class="badge bg-info">
                                    {{ $item->permohonanSurat->nomor_permohonan ?? '-' }}
                                </span>
                            </td>

                            <td>
                                @if($item->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($item->status == 'diproses')
                                    <span class="badge bg-primary">Diproses</span>
                                @elseif($item->status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>

                            <td>{{ $item->petugas->nama ?? '-' }}</td>
                            <td>{{ $item->waktu->format('d/m/Y H:i') }}</td>

                            <td>
                                <a href="{{ route('admin.riwayat-status.show', $item->riwayat_id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('admin.riwayat-status.edit', $item->riwayat_id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('admin.riwayat-status.destroy', $item->riwayat_id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Tidak ada data ditemukan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-3">
                {{ $riwayat_status->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</section>
@endsection
