@extends('layout.admin.app')

@section('title', 'Data Warga')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Data Warga</h3>
    <a href="{{ route('admin.warga.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Warga
    </a>
</div>

<section class="section">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header"><h4>Daftar Warga</h4></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No KTP</th>
                            <th>Nama</th>
                            <th>JK</th>
                            <th>Agama</th>
                            <th>Pekerjaan</th>
                            <th>Telp</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($warga as $index => $w)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $w->no_ktp }}</td>
                                <td>{{ $w->nama }}</td>
                                <td>{{ $w->jenis_kelamin }}</td>
                                <td>{{ $w->agama }}</td>
                                <td>{{ $w->pekerjaan }}</td>
                                <td>{{ $w->telp }}</td>
                                <td>{{ $w->email }}</td>
                                <td>
                                    <a href="{{ route('admin.warga.show', $w->warga_id) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.warga.edit', $w->warga_id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.warga.destroy', $w->warga_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" class="text-center">Belum ada data warga</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
