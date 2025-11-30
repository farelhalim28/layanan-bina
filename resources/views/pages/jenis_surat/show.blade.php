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
                <tr>
                    <th style="width: 30%">Kode Surat</th>
                    <td>{{ $jenisSurat->kode }}</td>
                </tr>
                <tr>
                    <th>Nama Jenis Surat</th>
                    <td>{{ $jenisSurat->nama_jenis }}</td>
                </tr>
                <tr>
                    <th>Persyaratan</th>
                    <td><pre>{{ $jenisSurat->syarat_json ?? '-' }}</pre></td>
                </tr>
            </table>

            {{-- FILE LIST --}}
            @php
                $files = \App\Models\Media::where('ref_table', 'jenis_surat')
                    ->where('ref_id', $jenisSurat->jenis_id)
                    ->get();
            @endphp

            @if($files->count() > 0)
                <hr>
                <h5>📁 Template & Dokumen Terkait</h5>

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

                            {{-- Download Button --}}
                            <a href="{{ asset('storage/' . $file->file_name) }}" download class="btn btn-primary btn-sm w-100 mb-2">
                                <i class="bi bi-download"></i> Download
                            </a>

                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info mt-3">
                    <i class="bi bi-info-circle"></i> Belum ada template atau dokumen yang diupload.
                </div>
            @endif

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
