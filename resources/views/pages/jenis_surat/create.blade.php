@extends('layouts.admin.app')

@section('title', 'Tambah Jenis Surat')

@section('content')
<div class="page-heading">
    <h3>Tambah Jenis Surat</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Form Tambah Jenis Surat</h4></div>
        <div class="card-body">
            <form action="{{ route('admin.jenis-surat.store') }}" method="POST">@csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kode">Kode Surat</label>
                        <input type="text" name="kode" id="kode" class="form-control" value="{{ old('kode') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nama_jenis">Nama Jenis Surat</label>
                        <input type="text" name="nama_jenis" id="nama_jenis" class="form-control" value="{{ old('nama_jenis') }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="syarat_json">Persyaratan (JSON/Text)</label>
                        <textarea name="syarat_json" id="syarat_json" rows="4" class="form-control">{{ old('syarat_json') }}</textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.jenis-surat.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
