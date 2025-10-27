@extends('layouts.admin.app')

@section('title', 'Detail Media')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Detail Media</h3>
    <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Informasi Media</h4></div>
        <div class="card-body">
            <div class="text-center mb-4">
                @if($media->is_image)
                    <img src="{{ $media->full_url }}" class="img-fluid rounded mb-3" style="max-height: 300px; object-fit: cover;">
                @else
                    <div class="display-3 text-primary mb-3">
                        <i class="bi {{ $media->file_icon }}"></i>
                    </div>
                    <p><a href="{{ $media->full_url }}" target="_blank">{{ basename($media->file_url) }}</a></p>
                @endif
                <h4 class="mt-2">{{ $media->caption ?? '-' }}</h4>
            </div>

            <table class="table table-bordered">
                <tr><th>ID Media</th><td>{{ $media->media_id }}</td></tr>
                <tr><th>Ref Table</th><td>{{ $media->ref_table }}</td></tr>
                <tr><th>Ref ID</th><td>{{ $media->ref_id }}</td></tr>
                <tr><th>File Name</th><td>{{ basename($media->file_url) }}</td></tr>
                <tr><th>Type</th><td><code>{{ $media->mime_type }}</code></td></tr>
                <tr><th>Order</th><td>{{ $media->sort_order }}</td></tr>
                <tr><th>Dibuat Pada</th><td>{{ $media->created_at->format('d M Y, H:i') }}</td></tr>
                <tr><th>Terakhir Diperbarui</th><td>{{ $media->updated_at->format('d M Y, H:i') }}</td></tr>
            </table>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('admin.media.edit', $media->media_id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
                <form action="{{ route('admin.media.destroy', $media->media_id) }}" method="POST" onsubmit="return confirm('Yakin hapus media ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Hapus</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
