{{-- resources/views/pages/riwayat-status/edit.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Edit Riwayat Status')

@section('content')
<div class="page-heading"><h3>Edit Riwayat Status</h3></div>

<section class="section">
<div class="card">
<div class="card-body">

<form action="{{ route('admin.riwayat-status.update', $riwayatStatus->riwayat_id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="mb-3">
        <label>Permohonan Surat</label>
        <select name="permohonan_id" class="form-select">
            @foreach($permohonan_surat as $ps)
                <option value="{{ $ps->permohonan_id }}" {{ $ps->permohonan_id == $riwayatStatus->permohonan_id ? 'selected' : '' }}>
                    {{ $ps->nomor_permohonan }} - {{ $ps->pemohon->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-select">
            <option value="pending" {{ $riwayatStatus->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="diproses" {{ $riwayatStatus->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="selesai" {{ $riwayatStatus->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="ditolak" {{ $riwayatStatus->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Petugas</label>
        <select name="petugas_warga_id" class="form-select">
            @foreach($warga as $w)
                <option value="{{ $w->warga_id }}" {{ $w->warga_id == $riwayatStatus->petugas_warga_id ? 'selected' : '' }}>
                    {{ $w->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Waktu</label>
        <input type="datetime-local" name="waktu" class="form-control"
               value="{{ $riwayatStatus->waktu->format('Y-m-d\TH:i') }}">
    </div>

    <div class="mb-3">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control">{{ $riwayatStatus->keterangan }}</textarea>
    </div>

    <hr>
    <h5>📁 Lampiran Tersimpan</h5>

    <div class="row">
        @foreach($files as $file)
            <div class="col-md-3 text-center mb-3">

                @php $ext = strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION)); @endphp

                @if(in_array($ext, ['jpg','jpeg','png','webp','gif']))
                    <a href="{{ asset('storage/'.$file->file_name) }}" target="_blank">
                        <img src="{{ asset('storage/'.$file->file_name) }}" class="img-thumbnail" style="width:120px;height:120px;object-fit:cover;">
                    </a>

                @elseif(in_array($ext, ['mp4','webm','ogg','mov','avi','mkv']))
                    {{-- gunakan tag video dengan source yang langsung mengarah ke storage --}}
                    <a href="{{ asset('storage/'.$file->file_name) }}" target="_blank" class="d-block mb-2">
                        <video width="120" height="120" preload="metadata" controls style="object-fit:cover;">
                            <source src="{{ asset('storage/'.$file->file_name) }}" type="{{ $file->mime_type ?? 'video/mp4' }}">
                            Browser tidak mendukung video.
                        </video>
                    </a>

                @else
                    <a href="{{ asset('storage/'.$file->file_name) }}" target="_blank" class="btn btn-outline-secondary w-100 mb-2">📄 {{ $file->caption ?? basename($file->file_name) }}</a>
                @endif

                {{-- Hapus file: gunakan route media.destroy yang ada (admin.media.destroy) atau route khusus jika sudah dibuat --}}
                <form method="POST" action="{{ route('admin.media.destroy', $file->media_id) }}" onsubmit="return confirm('Yakin ingin menghapus file ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm mt-2 w-100">Hapus</button>
                </form>

            </div>
        @endforeach
    </div>

    <hr>

    <h6>Tambah Lampiran Baru</h6>
    <input type="file" name="files[]" multiple class="form-control" accept="image/*,video/*,.pdf,.doc,.docx,.zip">

    <button class="btn btn-primary mt-3">Simpan Perubahan</button>
</form>

</div></div>
</section>
@endsection
