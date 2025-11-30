@extends('layouts.admin.app')

@section('title', 'Tambah Media - Bina Desa')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Tambah Media</h3>
    <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<section class="section mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Form Tambah Media</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- File Upload --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">File Media</label>
                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" required>
                    @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Mendukung gambar, video, dan file lainnya.</small>
                </div>

                {{-- Referensi Tabel --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Referensi Tabel</label>
                    <input type="text" name="ref_table" class="form-control @error('ref_table') is-invalid @enderror" placeholder="contoh: kegiatan, artikel, desa" required>
                    @error('ref_table')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Referensi ID --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">ID Referensi</label>
                    <input type="number" name="ref_id" class="form-control @error('ref_id') is-invalid @enderror" placeholder="ID data yang direferensikan" required>
                    @error('ref_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Caption --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Caption</label>
                    <textarea name="caption" class="form-control @error('caption') is-invalid @enderror" rows="3" placeholder="Tulis caption jika ada"></textarea>
                    @error('caption')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
