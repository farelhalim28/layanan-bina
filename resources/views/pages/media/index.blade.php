@extends('layouts.admin.app')

@section('title', 'Media - Bina Desa')

@section('content')

{{-- ALERT --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- HEADER --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h3 class="fw-bold mb-1">
                <i class="bi bi-images"></i> Media
            </h3>
            <small class="text-muted">
                Kelola semua media seperti gambar, video, dan dokumen
            </small>
        </div>

        <a href="{{ route('admin.media.create') }}"
           class="btn btn-primary btn-lg rounded-pill">
            <i class="bi bi-plus-circle"></i> Tambah Media
        </a>
    </div>
</div>

{{-- GRID MEDIA --}}
@if($media->count())
<div class="row g-4">

@foreach($media as $item)
<div class="col-12 col-sm-6 col-md-4 col-lg-3">

    <div class="card h-100 shadow-sm border-0">

        {{-- PREVIEW --}}
        <div class="ratio ratio-4x3 bg-light">
            @if(Str::startsWith($item->mime_type, 'image'))
                <img src="{{ asset('storage/'.$item->file_path) }}"
                     class="img-fluid"
                     alt="media">

            @elseif(Str::startsWith($item->mime_type, 'video'))
                <video controls class="w-100 h-100">
                    <source src="{{ asset('storage/'.$item->file_path) }}"
                            type="{{ $item->mime_type }}">
                </video>

            @else
                <div class="d-flex justify-content-center align-items-center w-100 h-100">
                    <i class="bi bi-file-earmark-text"
                       style="font-size: 5rem;"></i>
                </div>
            @endif
        </div>

        {{-- BODY --}}
        <div class="card-body">

            <h6 class="fw-bold text-truncate">
                {{ $item->caption ?? 'Tanpa Caption' }}
            </h6>

            <small class="text-muted d-block">
                {{ strtoupper($item->mime_type) }}
            </small>

            <small class="text-muted">
                {{ number_format($item->file_size / 1024, 2) }} KB ·
                {{ $item->created_at->format('d M Y') }}
            </small>

            <div class="mt-2">
                <span class="badge bg-secondary">
                    {{ $item->ref_table ?? 'Umum' }}
                </span>
            </div>

        </div>

        {{-- ACTION --}}
        <div class="card-footer bg-white border-0">
            <div class="d-flex gap-2">

                <a href="{{ route('admin.media.show', $item->media_id) }}"
                   class="btn btn-outline-primary w-100 btn-lg"
                   title="Detail">
                    <i class="bi bi-eye-fill fs-4"></i>
                </a>

                <a href="{{ route('admin.media.edit', $item->media_id) }}"
                   class="btn btn-outline-warning w-100 btn-lg"
                   title="Edit">
                    <i class="bi bi-pencil-fill fs-4"></i>
                </a>

                <form action="{{ route('admin.media.destroy', $item->media_id) }}"
                      method="POST"
                      class="w-100"
                      onsubmit="return confirm('Yakin hapus media ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger w-100 btn-lg">
                        <i class="bi bi-trash-fill fs-4"></i>
                    </button>
                </form>

            </div>
        </div>

    </div>

</div>
@endforeach

</div>

{{-- PAGINATION --}}
<div class="mt-4">
    {{ $media->links('pagination::bootstrap-5') }}
</div>

@else
<div class="card border-0 shadow-sm">
    <div class="card-body text-center py-5">
        <i class="bi bi-inbox fs-1 text-muted"></i>
        <h5 class="mt-3 text-muted">Belum ada media</h5>
    </div>
</div>
@endif

@endsection
