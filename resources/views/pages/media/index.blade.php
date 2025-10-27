@extends('layouts.admin.app')

@section('title', 'Data Media')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Data Media</h3>
    <a href="{{ route('admin.media.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Upload Media
    </a>
</div>

<section class="section">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header"><h4>Daftar Media</h4></div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Preview</th>
                            <th>Ref Table</th>
                            <th>Ref ID</th>
                            <th>File Name</th>
                            <th>Caption</th>
                            <th>Type</th>
                            <th>Order</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($media as $m)
                            <tr>
                                <td>
                                    @if($m->is_image)
                                        <img src="{{ $m->full_url }}" alt="{{ $m->caption }}" class="img-thumbnail" style="width:60px;height:60px;object-fit:cover;">
                                    @else
                                        <div class="text-center" style="font-size:2rem;">
                                            <i class="bi {{ $m->file_icon }} text-primary"></i>
                                        </div>
                                    @endif
                                </td>
                                <td><span class="badge bg-info">{{ $m->ref_table }}</span></td>
                                <td>{{ $m->ref_id }}</td>
                                <td><small class="text-muted">{{ basename($m->file_url) }}</small></td>
                                <td>{{ $m->caption ?? '-' }}</td>
                                <td><code>{{ $m->mime_type }}</code></td>
                                <td><span class="badge bg-secondary">{{ $m->sort_order }}</span></td>
                                <td>
                                    <a href="{{ route('admin.media.show', $m->media_id) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.media.edit', $m->media_id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.media.destroy', $m->media_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus media ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center text-muted">Belum ada data media</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
