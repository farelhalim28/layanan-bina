@extends('layouts.admin.app')

@section('title', 'Detail Riwayat Status')

@section('content')
<div class="page-heading"><h3>Detail Riwayat Status</h3></div>

<section class="section">
<div class="card">
<div class="card-body">

<table class="table table-bordered">
<tr><th>Nomor Permohonan</th><td>{{ $riwayatStatus->permohonanSurat->nomor_permohonan }}</td></tr>
<tr><th>Pemohon</th><td>{{ $riwayatStatus->permohonanSurat->pemohon->nama }}</td></tr>
<tr><th>Status</th><td>{{ strtoupper($riwayatStatus->status) }}</td></tr>
<tr><th>Petugas</th><td>{{ $riwayatStatus->petugas->nama }}</td></tr>
<tr><th>Waktu</th><td>{{ $riwayatStatus->waktu->format('d F Y H:i') }}</td></tr>
<tr><th>Keterangan</th><td>{{ $riwayatStatus->keterangan ?? '-' }}</td></tr>
</table>

<hr>
<h5>📁 Lampiran</h5>

@if($files->count() == 0)
<p class="text-muted">Belum ada lampiran</p>
@else
<div class="row">
@foreach($files as $file)
<div class="col-md-3 text-center">
<a href="{{ asset('storage/'.$file->file_name) }}" target="_blank" class="btn btn-outline-secondary w-100">Lihat File</a>
</div>
@endforeach
</div>
@endif

<a href="{{ route('admin.riwayat-status.index') }}" class="btn btn-secondary mt-3 w-100">Kembali</a>

</div></div>
</section>
@endsection
