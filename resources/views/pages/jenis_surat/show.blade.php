@extends('layouts.admin.app')

@section('title', 'Detail Jenis Surat')

@section('content')
<div class="page-heading">
    <h3>Detail Jenis Surat</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Informasi Jenis Surat</h4></div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr><th>Kode Surat</th><td>{{ $jenisSurat->kode }}</td></tr>
                <tr><th>Nama Jenis Surat</th><td>{{ $jenisSurat->nama_jenis }}</td></tr>
                <tr><th>Persyaratan</th><td><pre>{{ $jenisSurat->syarat_json ?? '-' }}</pre></td></tr>
            </table>
            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('admin.jenis-surat.edit', $jenisSurat->jenis_id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('admin.jenis-surat.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
