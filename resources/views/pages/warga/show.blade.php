@extends('layouts.admin.app')

@section('title', 'Detail Warga')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Detail Warga</h3>
    <a href="{{ route('admin.warga.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Informasi Warga</h4></div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr><th>No KTP</th><td>{{ $warga->no_ktp }}</td></tr>
                <tr><th>Nama</th><td>{{ $warga->nama }}</td></tr>
                <tr><th>Jenis Kelamin</th><td>{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
                <tr><th>Agama</th><td>{{ $warga->agama }}</td></tr>
                <tr><th>Pekerjaan</th><td>{{ $warga->pekerjaan }}</td></tr>
                <tr><th>No Telepon</th><td>{{ $warga->telp }}</td></tr>
                <tr><th>Email</th><td>{{ $warga->email }}</td></tr>
            </table>
        </div>
    </div>
</section>
@endsection
