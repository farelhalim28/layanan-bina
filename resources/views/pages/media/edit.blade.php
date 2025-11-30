@extends('layouts.admin.app')

@section('title', 'Edit Media')

@section('content')
<div class="page-heading">
    <h3>Edit Media</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Form Edit Media</h4></div>
        <div class="card-body">
            <form action="{{ route('admin.media.update', $media->media_id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Preview Saat Ini</label><br>
                        @if($media->isImage())
                            <img src="{{ asset('storage/' . $media->file_name) }}" alt="preview" style="max-width: 300px;" class="img-thumbnail">
                        @elseif($media->isVideo())
                            <video width="300" controls class="rounded border">
                                <source src="{{ asset('storage/' . $media->file_name) }}" type="{{ $media->mime_type }}">
                            </video>
                        @else
                            <a href="{{ asset('storage/' . $media->file_name) }}" target="_blank" class="btn btn-outline-secondary">
                                📄 Lihat File
                            </a>
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="file" class="form-label">Upload File Baru (Opsional)</label>
                        <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti file</small>
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="caption" class="form-label">Caption</label>
                        <input type="text" name="caption" id="caption" class="form-control @error('caption') is-invalid @enderror" value="{{ old('caption', $media->caption) }}">
                        @error('caption')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="sort_order" class="form-label">Urutan Tampil</label>
                        <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $media->sort_order) }}">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
