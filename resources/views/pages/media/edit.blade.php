@extends('layouts.admin.app')

@section('title', 'Edit Media')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Edit Media</h3>
    <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Form Edit Media</h4></div>
        <div class="card-body">
            <form action="{{ route('admin.media.update', $media->media_id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label for="caption" class="form-label">Caption</label>
                    <input type="text" id="caption" name="caption" class="form-control @error('caption') is-invalid @enderror" value="{{ old('caption', $media->caption) }}">
                    @error('caption') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="sort_order" class="form-label">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $media->sort_order) }}">
                    @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">Ganti File (Opsional)</label>
                    <input type="file" id="file" name="file" class="form-control @error('file') is-invalid @enderror" accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx">
                    @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
