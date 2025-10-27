@extends('layouts.admin.app')

@section('title', 'Detail User')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Detail User</h3>
    <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Informasi User</h4></div>
        <div class="card-body">
            <div class="text-center mb-4">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=150&background=random"
                     alt="{{ $user->name }}" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
                <h4>{{ $user->name }}</h4>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr><th>ID User</th><td>: {{ $user->id }}</td></tr>
                        <tr><th>Nama Lengkap</th><td>: {{ $user->name }}</td></tr>
                        <tr><th>Email</th><td>: {{ $user->email }}</td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr><th>Dibuat Pada</th><td>: {{ $user->created_at->format('d M Y, H:i') }}</td></tr>
                        <tr><th>Terakhir Update</th><td>: {{ $user->updated_at->format('d M Y, H:i') }}</td></tr>
                    </table>
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit User
                </a>
                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Hapus User
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
