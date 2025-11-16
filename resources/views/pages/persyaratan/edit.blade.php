@extends('layouts.admin.app')

@section('title', 'Edit Berkas Persyaratan')

@section('content')
<div class="page-heading">
    <h3>Edit Berkas Persyaratan</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Form Edit Berkas Persyaratan</h4></div>
        <div class="card-body">
            <form action="{{ route('admin.berkas-persyaratan.update', $berkasPersyaratan->berkas_id) }}" method="POST">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="permohonan_id" class="form-label">Permohonan Surat</label>
                        <select name="permohonan_id" id="permohonan_id" class="form-select @error('permohonan_id') is-invalid @enderror" required>
                            <option value="">Pilih Permohonan</option>
                            @foreach($permohonan_surat as $permohonan)
                                <option value="{{ $permohonan->permohonan_id }}" {{ old('permohonan_id', $berkasPersyaratan->permohonan_id) == $permohonan->permohonan_id ? 'selected' : '' }}>
                                    {{ $permohonan->nomor_permohonan }} - {{ $permohonan->pemohon->nama ?? '-' }} ({{ $permohonan->jenisSurat->nama_jenis ?? '-' }})
                                </option>
                            @endforeach
                        </select>
                        @error('permohonan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="nama_berkas" class="form-label">Nama Berkas</label>
                        <input type="text" name="nama_berkas" id="nama_berkas" class="form-control @error('nama_berkas') is-invalid @enderror" value="{{ old('nama_berkas', $berkasPersyaratan->nama_berkas) }}" required>
                        @error('nama_berkas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="valid" class="form-label">Status Validasi</label>
                        <select name="valid" id="valid" class="form-select @error('valid') is-invalid @enderror" required>
                            <option value="0" {{ old('valid', $berkasPersyaratan->valid ? '1' : '0') == '0' ? 'selected' : '' }}>Tidak Valid</option>
                            <option value="1" {{ old('valid', $berkasPersyaratan->valid ? '1' : '0') == '1' ? 'selected' : '' }}>Valid</option>
                        </select>
                        @error('valid')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.berkas-persyaratan.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
