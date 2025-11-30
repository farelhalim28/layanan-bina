@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <h4>Detail Permohonan Surat</h4>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Nomor Permohonan:</strong> {{ $permohonanSurat->nomor_permohonan }}</p>
            <p><strong>Pemohon:</strong> {{ $permohonanSurat->pemohon->nama ?? '-' }}</p>
            <p><strong>Jenis Surat:</strong> {{ $permohonanSurat->jenisSurat->nama_jenis ?? '-' }}</p>
            <p><strong>Status:</strong> <span class="badge bg-info">{{ $permohonanSurat->status }}</span></p>
            <p><strong>Tanggal Pengajuan:</strong> {{ $permohonanSurat->tanggal_pengajuan->format('d/m/Y') }}</p>
            <p><strong>Catatan:</strong> {{ $permohonanSurat->catatan ?? '-' }}</p>
        </div>
    </div>

    <h5 class="mt-4">📎 Berkas Lampiran</h5>

    <div class="row mt-2">
        @forelse($mediaFiles as $file)
            <div class="col-md-3 mb-3 text-center">

                @if(Str::contains($file->mime_type, 'image'))
                    <img src="{{ asset('storage/' . $file->file_name) }}" class="img-fluid rounded shadow">

                @elseif(Str::contains($file->mime_type, 'video'))
                    <video class="w-100 rounded shadow" controls>
                        <source src="{{ asset('storage/' . $file->file_name) }}" type="{{ $file->mime_type }}">
                    </video>

                @else
                    <a href="{{ asset('storage/' . $file->file_name) }}" class="btn btn-outline-primary w-100" download>
                        📄 Download File
                    </a>
                @endif

            </div>
        @empty
            <p class="text-muted">Belum ada file lampiran.</p>
        @endforelse
    </div>

    <a href="{{ route('admin.permohonan-surat.index') }}" class="btn btn-secondary mt-4">⬅ Kembali</a>
</div>
@endsection
