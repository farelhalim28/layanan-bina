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
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Permohonan</th>
                            <th>Pemohon</th>
                            <th>Jenis Surat</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permohonan_surat as $index => $permohonan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
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
                                <a href="{{ route('admin.permohonan-surat.show', $permohonan->permohonan_id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.permohonan-surat.edit', $permohonan->permohonan_id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.permohonan-surat.destroy', $permohonan->permohonan_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus permohonan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada permohonan surat</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
