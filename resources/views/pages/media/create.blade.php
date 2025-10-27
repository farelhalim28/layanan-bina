@extends('layouts.admin.app')

@section('title', 'Upload Media')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Upload Media Baru</h3>
    <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Form Upload Media</h4></div>
        <div class="card-body">
            <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="ref_table" class="form-label">Reference Table <span class="text-danger">*</span></label>
                    <input type="text" id="ref_table" name="ref_table" class="form-control @error('ref_table') is-invalid @enderror" value="{{ old('ref_table') }}" required>
                    @error('ref_table') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="ref_id" class="form-label">Reference ID <span class="text-danger">*</span></label>
                    <input type="number" id="ref_id" name="ref_id" class="form-control @error('ref_id') is-invalid @enderror" value="{{ old('ref_id') }}" required>
                    @error('ref_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="file" class="form-label">File <span class="text-danger">*</span></label>
                    <input type="file" id="file" name="file" class="form-control @error('file') is-invalid @enderror" accept="image/*,application/pdf,.doc,.docx,.xls,.xlsx" required>
                    @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="caption" class="form-label">Caption</label>
                    <input type="text" id="caption" name="caption" class="form-control @error('caption') is-invalid @enderror" value="{{ old('caption') }}">
                    @error('caption') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="sort_order" class="form-label">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', 0) }}">
                    @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Upload</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
