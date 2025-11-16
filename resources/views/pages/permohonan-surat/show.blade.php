@extends('layouts.admin.app')

@section('title', 'Detail Permohonan Surat')

@section('content')
<div class="page-heading">
    <h3>Detail Permohonan Surat</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Informasi Permohonan Surat</h4></div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 30%">Nomor Permohonan</th>
                    <td>{{ $permohonanSurat->nomor_permohonan }}</td>
                </tr>
                <tr>
                    <th>Pemohon</th>
                    <td>{{ $permohonanSurat->pemohon->nama ?? '-' }} (NIK: {{ $permohonanSurat->pemohon->nik ?? '-' }})</td>
                </tr>
                <tr>
                    <th>Jenis Surat</th>
                    <td>{{ $permohonanSurat->jenisSurat->nama_jenis ?? '-' }} ({{ $permohonanSurat->jenisSurat->kode ?? '-' }})</td>
                </tr>
                <tr>
                    <th>Tanggal Pengajuan</th>
                    <td>{{ $permohonanSurat->tanggal_pengajuan->format('d F Y') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if($permohonanSurat->status == 'pending')
                            <span class="badge bg-warning">Pending</span>
                        @elseif($permohonanSurat->status == 'diproses')
                            <span class="badge bg-info">Diproses</span>
                        @elseif($permohonanSurat->status == 'selesai')
                            <span class="badge bg-success">Selesai</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Catatan</th>
                    <td>{{ $permohonanSurat->catatan ?? '-' }}</td>
                </tr>
            </table>

            <div class="mt-4">
                <h5>Berkas Persyaratan</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Berkas</th>
                                <th>Status Validasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permohonanSurat->berkasPersyaratan as $index => $berkas)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $berkas->nama_berkas }}</td>
                                <td>
                                    @if($berkas->valid)
                                        <span class="badge bg-success">Valid</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Valid</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">Belum ada berkas persyaratan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('admin.permohonan-surat.edit', $permohonanSurat->permohonan_id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('admin.permohonan-surat.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
