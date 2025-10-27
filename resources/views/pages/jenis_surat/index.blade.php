@extends('layouts.admin.app')

@section('title', 'Jenis Surat - Bina Desa')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Jenis Surat</h3>
    <a href="{{ route('admin.jenis-surat.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Jenis Surat
    </a>
</div>

<section class="section mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Jenis Surat</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Jenis</th>
                            <th>Syarat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php use Illuminate\Support\Str; @endphp
                        @forelse($jenis_surat as $index => $jenis)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="badge bg-primary">{{ $jenis->kode }}</span></td>
                            <td>{{ $jenis->nama_jenis }}</td>
                            <td>
                                @if($jenis->syarat_json)
                                    <small class="text-muted">{{ Str::limit($jenis->syarat_json, 50) }}</small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.jenis-surat.show', $jenis->jenis_id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.jenis-surat.edit', $jenis->jenis_id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.jenis-surat.destroy', $jenis->jenis_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus jenis surat ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada jenis surat</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
