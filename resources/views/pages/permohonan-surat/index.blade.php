@extends('layouts.admin.app')

@section('title', 'Permohonan Surat - Bina Desa')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Permohonan Surat</h3>
    <a href="{{ route('admin.permohonan-surat.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Permohonan
    </a>
</div>

<section class="section mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Permohonan Surat</h4>
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
                <form method="GET" action="{{ route('admin.permohonan-surat.index') }}">
                    <div class="row g-2">
                        <!-- FILTER STATUS -->
                        <div class="col-md-2">
                            <select name="status" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <!-- SEARCH -->
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text"
                                       name="search"
                                       class="form-control"
                                       value="{{ request('search') }}"
                                       placeholder="Cari nomor permohonan...">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>
                        </div>

                        <!-- BUTTON RESET -->
                        <div class="col-md-2">
                            @if(request('search') || request('status'))
                                <a href="{{ route('admin.permohonan-surat.index') }}"
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
                            <th>Jenis Surat</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permohonan_surat as $index => $permohonan)
                        <tr>
                            <td>{{ ($permohonan_surat->currentPage() - 1) * $permohonan_surat->perPage() + $index + 1 }}</td>
                            <td><span class="badge bg-info">{{ $permohonan->nomor_permohonan }}</span></td>
                            <td>{{ $permohonan->pemohon->nama ?? '-' }}</td>
                            <td>{{ $permohonan->jenisSurat->nama_jenis ?? '-' }}</td>
                            <td>{{ $permohonan->tanggal_pengajuan->format('d/m/Y') }}</td>
                            <td>
                                @if($permohonan->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($permohonan->status == 'diproses')
                                    <span class="badge bg-info">Diproses</span>
                                @elseif($permohonan->status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.permohonan-surat.show', $permohonan->permohonan_id) }}"
                                   class="btn btn-sm btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.permohonan-surat.edit', $permohonan->permohonan_id) }}"
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.permohonan-surat.destroy', $permohonan->permohonan_id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin hapus permohonan ini?')">
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
                            <td colspan="7" class="text-center text-muted py-4">
                                @if(request('search'))
                                    <i class="bi bi-search"></i>
                                    Data tidak ditemukan
                                @else
                                    <i class="bi bi-inbox"></i>
                                    Belum ada permohonan surat
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="mt-3">
                {{ $permohonan_surat->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</section>
@endsection
