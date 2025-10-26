@extends('layout.admin.app')

@section('title', 'Tambah Warga')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Tambah Warga</h3>
    <a href="{{ route('admin.warga.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Form Tambah Warga</h4></div>
        <div class="card-body">
            <form action="{{ route('admin.warga.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>No KTP</label>
                        <input type="text" name="no_ktp" class="form-control" value="{{ old('no_ktp') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Agama</label>
                        <input type="text" name="agama" class="form-control" value="{{ old('agama') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>No Telepon</label>
                        <input type="text" name="telp" class="form-control" value="{{ old('telp') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.warga.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
