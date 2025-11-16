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
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Permohonan</th>
                            <th>Nama Berkas</th>
                            <th>Status Validasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($berkas_persyaratan as $index => $berkas)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="badge bg-info">{{ $berkas->permohonanSurat->nomor_permohonan ?? '-' }}</span></td>
                            <td>{{ $berkas->nama_berkas }}</td>
                            <td>
                                @if($berkas->valid)
                                    <span class="badge bg-success">Valid</span>
                                @else
                                    <span class="badge bg-danger">Tidak Valid</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.berkas-persyaratan.show', $berkas->berkas_id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.berkas-persyaratan.edit', $berkas->berkas_id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.berkas-persyaratan.destroy', $berkas->berkas_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus berkas ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada berkas persyaratan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
