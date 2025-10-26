@extends('layout.admin.app')

@section('title', 'Edit Warga')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Edit Data Warga</h3>
    <a href="{{ route('admin.warga.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Form Edit Warga</h4></div>
        <div class="card-body">
            <form action="{{ route('admin.warga.update', $warga->warga_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>No KTP</label>
                    <input type="text" name="no_ktp" class="form-control" value="{{ old('no_ktp', $warga->no_ktp) }}" required>
                </div>
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama', $warga->nama) }}" required>
                </div>
                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="L" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $warga->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label>Agama</label>
                    <input type="text" name="agama" class="form-control" value="{{ old('agama', $warga->agama) }}" required>
                </div>
                <div class="mb-3">
                    <label>Pekerjaan</label>
                    <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan', $warga->pekerjaan) }}" required>
                </div>
                <div class="mb-3">
                    <label>No Telepon</label>
                    <input type="text" name="telp" class="form-control" value="{{ old('telp', $warga->telp) }}" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $warga->email) }}" required>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.warga.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
