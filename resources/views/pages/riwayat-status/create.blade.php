@extends('layouts.admin.app')

@section('title', 'Tambah Riwayat Status')

@section('content')
<div class="page-heading">
    <h3>Tambah Riwayat Status</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Form Tambah Riwayat Status</h4></div>
        <div class="card-body">
            <form action="{{ route('admin.riwayat-status.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="permohonan_id" class="form-label">Permohonan Surat</label>
                        <select name="permohonan_id" id="permohonan_id" class="form-select @error('permohonan_id') is-invalid @enderror" required>
                            <option value="">Pilih Permohonan</option>
                            @foreach($permohonan_surat as $permohonan)
                                <option value="{{ $permohonan->permohonan_id }}" {{ old('permohonan_id') == $permohonan->permohonan_id ? 'selected' : '' }}>
                                    {{ $permohonan->nomor_permohonan }} - {{ $permohonan->pemohon->nama ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                        @error('permohonan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
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
                    <div class="col-md-6 mb-3">
                        <label for="petugas_warga_id" class="form-label">Petugas</label>
                        <select name="petugas_warga_id" id="petugas_warga_id" class="form-select @error('petugas_warga_id') is-invalid @enderror" required>
                            <option value="">Pilih Petugas</option>
                            @foreach($warga as $w)
                                <option value="{{ $w->warga_id }}" {{ old('petugas_warga_id') == $w->warga_id ? 'selected' : '' }}>
                                    {{ $w->nama }} - {{ $w->nik }}
                                </option>
                            @endforeach
                        </select>
                        @error('petugas_warga_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="waktu" class="form-label">Waktu</label>
                        <input type="datetime-local" name="waktu" id="waktu" class="form-control @error('waktu') is-invalid @enderror" value="{{ old('waktu') }}" required>
                        @error('waktu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="4" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.riwayat-status.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
