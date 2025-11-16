@extends('layouts.admin.app')

@section('title', 'Detail Berkas Persyaratan')

@section('content')
<div class="page-heading">
    <h3>Detail Berkas Persyaratan</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Informasi Berkas Persyaratan</h4></div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 30%">Nomor Permohonan</th>
                    <td>{{ $berkasPersyaratan->permohonanSurat->nomor_permohonan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Pemohon</th>
                    <td>{{ $berkasPersyaratan->permohonanSurat->pemohon->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jenis Surat</th>
                    <td>{{ $berkasPersyaratan->permohonanSurat->jenisSurat->nama_jenis ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Berkas</th>
                    <td>{{ $berkasPersyaratan->nama_berkas }}</td>
                </tr>
                <tr>
                    <th>Status Validasi</th>
                    <td>
                        @if($berkasPersyaratan->valid)
                            <span class="badge bg-success">Valid</span>
                        @else
                            <span class="badge bg-danger">Tidak Valid</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Dibuat</th>
                    <td>{{ $berkasPersyaratan->created_at->format('d F Y H:i') }}</td>
                </tr>
            </table>
            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('admin.berkas-persyaratan.edit', $berkasPersyaratan->berkas_id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('admin.berkas-persyaratan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
