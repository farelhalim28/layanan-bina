@extends('layouts.admin.app')

@section('title', 'Detail Media')

@section('content')
<div class="page-heading">
    <h3>Detail Media</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Informasi Media</h4></div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12 text-center">
                    @if($media->isImage())
                        <img src="{{ asset('storage/' . $media->file_name) }}" alt="media" style="max-width: 100%; max-height: 500px;" class="img-thumbnail">
                    @elseif($media->isVideo())
                        <video width="600" controls class="rounded border">
                            <source src="{{ asset('storage/' . $media->file_name) }}" type="{{ $media->mime_type }}">
                            Browser tidak mendukung video.
                        </video>
                    @elseif($media->isPdf())
                        <iframe src="{{ asset('storage/' . $media->file_name) }}" width="100%" height="600px" class="border rounded"></iframe>
                    @else
                        <div class="alert alert-info">
                            <i class="bi bi-file-earmark"></i> File tidak dapat di-preview.
                            <a href="{{ asset('storage/' . $media->file_name) }}" target="_blank" class="btn btn-sm btn-primary">Download File</a>
                        </div>
                    @endif
                </div>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th style="width: 30%">Tabel Referensi</th>
                    <td>{{ $media->ref_table }}</td>
                </tr>
                <tr>
                    <th>ID Referensi</th>
                    <td><span class="badge bg-info">{{ $media->ref_id }}</span></td>
                </tr>
                <tr>
                    <th>Caption</th>
                    <td>{{ $media->caption ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tipe MIME</th>
                    <td><code>{{ $media->mime_type }}</code></td>
                </tr>
                <tr>
                    <th>Urutan Tampil</th>
                    <td>{{ $media->sort_order }}</td>
                </tr>
                <tr>
                    <th>Path File</th>
                    <td><small class="text-muted">{{ $media->file_name }}</small></td>
                </tr>
                <tr>
                    <th>Tanggal Upload</th>
                    <td>{{ $media->created_at->format('d F Y H:i') }}</td>
                </tr>
            </table>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('admin.media.edit', $media->media_id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
