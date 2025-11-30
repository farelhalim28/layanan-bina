@extends('layouts.admin.app')

@section('title', 'Media - Bina Desa')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Media</h3>
    <a href="{{ route('admin.media.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Media
    </a>
</div>

<section class="section mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Media</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Preview</th>
                            <th>Referensi</th>
                            <th>Caption</th>
                            <th>Tipe</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($media as $index => $item)
                        <tr>
                            <td>{{ ($media->currentPage() - 1) * $media->perPage() + $index + 1 }}</td>
                            <td>
                                @if($item->isImage())
                                    <img src="{{ asset('storage/' . $item->file_name) }}" alt="preview" style="width: 60px; height: 60px; object-fit: cover;" class="rounded">
                                @elseif($item->isVideo())
                                    <video width="60" height="60" class="rounded">
                                        <source src="{{ asset('storage/' . $item->file_name) }}" type="{{ $item->mime_type }}">
                                    </video>
                                @else
                                    <span class="badge bg-secondary">📄 File</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">{{ $item->ref_table }}</small><br>
                                <span class="badge bg-info">ID: {{ $item->ref_id }}</span>
                            </td>
                            <td>{{ $item->caption ?? '-' }}</td>
                            <td><small class="badge bg-light text-dark">{{ $item->mime_type }}</small></td>
                            <td>
                                <a href="{{ route('admin.media.show', $item->media_id) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.media.edit', $item->media_id) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.media.destroy', $item->media_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus media ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada media</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $media->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
