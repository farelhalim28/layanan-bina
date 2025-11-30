@extends('layouts.admin.app')

@section('title', 'Edit Jenis Surat')

@section('content')
<div class="page-heading">
    <h3>Edit Jenis Surat</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Form Edit Jenis Surat</h4></div>
        <div class="card-body">
            <form action="{{ route('admin.jenis-surat.update', $jenisSurat->jenis_id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kode">Kode Surat</label>
                        <input type="text" name="kode" id="kode" class="form-control @error('kode') is-invalid @enderror" value="{{ old('kode', $jenisSurat->kode) }}" required>
                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nama_jenis">Nama Jenis Surat</label>
                        <input type="text" name="nama_jenis" id="nama_jenis" class="form-control @error('nama_jenis') is-invalid @enderror" value="{{ old('nama_jenis', $jenisSurat->nama_jenis) }}" required>
                        @error('nama_jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="syarat_json">Persyaratan</label>
                        <textarea name="syarat_json" id="syarat_json" class="form-control @error('syarat_json') is-invalid @enderror" rows="4">{{ old('syarat_json', $jenisSurat->syarat_json) }}</textarea>
                        @error('syarat_json')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr>

                <h5>📎 Upload Template Surat / Dokumen Pendukung</h5>
                <p class="text-muted small">Upload template atau dokumen pendukung untuk jenis surat ini (PDF, Gambar, Video, Dokumen)</p>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="files">Pilih File</label>
                        <input type="file" name="files[]" id="files" class="form-control @error('files.*') is-invalid @enderror" multiple accept="image/*,video/*,.pdf,.doc,.docx,.zip">
                        <small class="text-muted">Format: JPG, PNG, MP4, PDF, DOCX, ZIP (Max: 200MB per file)</small>
                        @error('files.*')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="caption">Caption/Keterangan (Opsional)</label>
                        <input type="text" name="caption" id="caption" class="form-control" placeholder="Contoh: Template SKTM 2025">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.jenis-surat.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>

                {{-- FILE LIST --}}
                @php
                    $files = \App\Models\Media::where('ref_table', 'jenis_surat')
                        ->where('ref_id', $jenisSurat->jenis_id)
                        ->get();
                @endphp

                @if($files->count() > 0)
                    <hr>
                    <h5>File yang sudah diupload</h5>

                    <div class="row mt-3">
                        @foreach ($files as $file)
                            <div class="col-md-3 mb-4 text-center p-2">

                                @php
                                    $ext = strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION));
                                    $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                                    $isVideo = in_array($ext, ['mp4','mov','avi','mkv','webm']);

                                    $mimeTypes = [
                                        'mp4' => 'video/mp4',
                                        'webm' => 'video/webm',
                                        'mov' => 'video/quicktime',
                                        'avi' => 'video/x-msvideo',
                                        'mkv' => 'video/x-matroska'
                                    ];

                                    $mime = $mimeTypes[$ext] ?? 'video/mp4';
                                @endphp

                                {{-- PREVIEW --}}
                                @if($isImage)
                                    <img src="{{ asset('storage/' . $file->file_name) }}"
                                        class="img-thumbnail mb-2"
                                        style="width: 150px; height: 150px; object-fit: cover;">

                                @elseif($isVideo)
                                    <video width="150" height="150" controls class="rounded border mb-2" style="object-fit:cover;">
                                        <source src="{{ asset('storage/' . $file->file_name) }}" type="{{ $mime }}">
                                        Browser tidak mendukung video.
                                    </video>

                                @else
                                    <a href="{{ asset('storage/' . $file->file_name) }}" target="_blank"
                                        class="btn btn-outline-secondary w-100 mb-2">
                                        📄 {{ $file->caption ?? basename($file->file_name) }}
                                    </a>
                                @endif

                                {{-- Caption --}}
                                @if($file->caption)
                                    <p class="small text-muted mb-2">{{ $file->caption }}</p>
                                @endif

                                {{-- DELETE --}}
                                <form action="{{ route('admin.jenis-surat.media.delete', $file->media_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm w-100" onclick="return confirm('Yakin hapus file ini?')">Hapus</button>
                                </form>

                            </div>
                        @endforeach
                    </div>
                @endif
        </div>
    </div>
</section>
@endsection
