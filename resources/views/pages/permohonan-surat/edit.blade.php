@extends('layouts.admin.app')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Edit Permohonan Surat</h4>

    <form action="{{ route('admin.permohonan-surat.update', $permohonanSurat->permohonan_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">

            <div class="col-md-6">
                <label class="form-label">Nomor Permohonan</label>
                <input type="text" name="nomor_permohonan" class="form-control" value="{{ $permohonanSurat->nomor_permohonan }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Pemohon</label>
                <select name="pemohon_warga_id" class="form-control" required>
                    <option value="">-- Pilih Pemohon --</option>
                    @foreach($warga as $item)
                        <option value="{{ $item->warga_id }}"
                            {{ $item->warga_id == $permohonanSurat->pemohon_warga_id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Jenis Surat</label>
                <select name="jenis_id" class="form-control" required>
                    <option value="">-- Pilih Jenis Surat --</option>
                    @foreach($jenis_surat as $item)
                        <option value="{{ $item->jenis_id }}"
                            {{ $item->jenis_id == $permohonanSurat->jenis_id ? 'selected' : '' }}>
                            {{ $item->nama_jenis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Tanggal Pengajuan</label>
                <input type="date" name="tanggal_pengajuan" class="form-control" value="{{ $permohonanSurat->tanggal_pengajuan->format('Y-m-d') }}" required>
            </div>

            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="pending" {{ $permohonanSurat->status=='pending'?'selected':'' }}>Pending</option>
                    <option value="diproses" {{ $permohonanSurat->status=='diproses'?'selected':'' }}>Diproses</option>
                    <option value="selesai" {{ $permohonanSurat->status=='selesai'?'selected':'' }}>Selesai</option>
                    <option value="ditolak" {{ $permohonanSurat->status=='ditolak'?'selected':'' }}>Ditolak</option>
                </select>
            </div>

            <div class="col-md-12">
                <label class="form-label">Catatan</label>
                <textarea name="catatan" class="form-control" rows="3">{{ $permohonanSurat->catatan }}</textarea>
            </div>

            <div class="col-md-12">
                <label class="form-label">Upload Berkas Baru</label>
                <input type="file" name="files[]" class="form-control" multiple>
                <small class="text-muted">Bisa upload banyak file (PDF, Gambar, Video, ZIP)</small>
            </div>

        </div>

        <hr class="my-4">

        <h5>📁 Berkas Yang Sudah Diupload</h5>

        <div class="row mt-3">
            @forelse($mediaFiles as $file)
                <div class="col-md-3 mb-3 text-center">

                    @if(Str::contains($file->mime_type, 'image'))
                        <img src="{{ asset('storage/' . $file->file_name) }}" class="img-fluid rounded shadow">

                    @elseif(Str::contains($file->mime_type, 'video'))
                        <video class="w-100 rounded shadow" controls>
                            <source src="{{ asset('storage/' . $file->file_name) }}" type="{{ $file->mime_type }}">
                        </video>

                    @else
                        <a href="{{ asset('storage/' . $file->file_name) }}" class="btn btn-outline-primary w-100" download>
                            📄 Download File
                        </a>
                    @endif

                    <form action="{{ route('admin.permohonan-surat.media.delete', $file->media_id) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm w-100">Hapus</button>
                    </form>

                </div>
            @empty
                <p class="text-muted">Belum ada file</p>
            @endforelse
        </div>

        <button class="btn btn-primary mt-4">💾 Simpan Perubahan</button>
        <a href="{{ route('admin.permohonan-surat.index') }}" class="btn btn-secondary mt-4">Kembali</a>

    </form>
</div>
@endsection
