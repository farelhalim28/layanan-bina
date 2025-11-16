@extends('layouts.admin.app')

@section('title', 'Tambah Permohonan Surat')

@section('content')
<div class="page-heading">
    <h3>Tambah Permohonan Surat</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Form Tambah Permohonan Surat</h4></div>
        <div class="card-body">
            <form action="{{ route('admin.permohonan-surat.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nomor_permohonan" class="form-label">Nomor Permohonan</label>
                        <input type="text" name="nomor_permohonan" id="nomor_permohonan" class="form-control @error('nomor_permohonan') is-invalid @enderror" value="{{ old('nomor_permohonan') }}" required>
                        @error('nomor_permohonan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pemohon_warga_id" class="form-label">Pemohon</label>
                        <select name="pemohon_warga_id" id="pemohon_warga_id" class="form-select @error('pemohon_warga_id') is-invalid @enderror" required>
                            <option value="">Pilih Pemohon</option>
                            @foreach($warga as $w)
                                <option value="{{ $w->warga_id }}" {{ old('pemohon_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                    {{ $w->nama }} - {{ $w->nik }}
                                </option>
                            @endforeach
                        </select>
                        @error('pemohon_warga_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jenis_id" class="form-label">Jenis Surat</label>
                        <select name="jenis_id" id="jenis_id" class="form-select @error('jenis_id') is-invalid @enderror" required>
                            <option value="">Pilih Jenis Surat</option>
                            @foreach($jenis_surat as $jenis)
                                <option value="{{ $jenis->jenis_id }}" {{ old('jenis_id') == $jenis->jenis_id ? 'selected' : '' }}>
                                    {{ $jenis->kode }} - {{ $jenis->nama_jenis }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan</label>
                        <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan" class="form-control @error('tanggal_pengajuan') is-invalid @enderror" value="{{ old('tanggal_pengajuan') }}" required>
                        @error('tanggal_pengajuan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea name="catatan" id="catatan" rows="4" class="form-control @error('catatan') is-invalid @enderror">{{ old('catatan') }}</textarea>
                        @error('catatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.permohonan-surat.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
