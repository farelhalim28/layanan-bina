@extends('layouts.admin.app')

@section('title', 'Edit Berkas Persyaratan')

@section('content')
<div class="page-heading">
    <h3>Edit Berkas Persyaratan</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Form Edit Berkas</h4></div>
        <div class="card-body">
            <form action="{{ route('admin.berkas-persyaratan.update', $berkasPersyaratan->berkas_id) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Permohonan Surat</label>
                    <select name="permohonan_id" class="form-select" required>
                        @foreach($permohonan_surat as $permohonan)
                        <option value="{{ $permohonan->permohonan_id }}"
                            {{ $permohonan->permohonan_id == $berkasPersyaratan->permohonan_id ? 'selected' : '' }}>
                            {{ $permohonan->nomor_permohonan }} - {{ $permohonan->pemohon->nama ?? '-' }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Berkas</label>
                    <input type="text" name="nama_berkas" class="form-control"
                           value="{{ $berkasPersyaratan->nama_berkas }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Validasi</label>
                    <select name="valid" class="form-select" required>
                        <option value="1" {{ $berkasPersyaratan->valid ? 'selected' : '' }}>Valid</option>
                        <option value="0" {{ !$berkasPersyaratan->valid ? 'selected' : '' }}>Tidak Valid</option>
                    </select>
                </div>

                <hr>

                <h5>📎 Upload Lampiran (Opsional)</h5>
                <input type="file" name="files[]" multiple class="form-control"
                accept="image/*,video/*,.pdf,.doc,.docx,.zip,.xlsx">

                <small class="text-muted">Boleh upload lebih dari 1 file.</small>

                <div class="d-flex justify-content-end mt-3 gap-2">
                    <a href="{{ route('admin.berkas-persyaratan.index') }}" class="btn btn-secondary">Batal</a>
                    <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                </div>
            </form>

            {{-- FILES LIST --}}
            @php
                $files = \App\Models\Media::where('ref_table','berkas_persyaratan')
                    ->where('ref_id',$berkasPersyaratan->berkas_id)->get();
            @endphp

            @if($files->count() > 0)
            <hr>
            <h5>📁 Lampiran Tersimpan</h5>

            <div class="row">
                @foreach ($files as $file)
                <div class="col-md-3 text-center mt-3">

                    @php
                        $ext = strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION));
                        $isImg = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                        $isVid = in_array($ext, ['mp4','mov','mkv','avi','webm']);
                    @endphp

                    @if($isImg)
                        <img src="{{ asset('storage/'.$file->file_name) }}" class="img-thumbnail"
                        style="width:120px;height:120px;object-fit:cover;">
                    @elseif($isVid)
                        <video width="120" height="120" controls>
                            <source src="{{ asset('storage/'.$file->file_name) }}" type="video/mp4">
                        </video>
                    @else
                        <a href="{{ asset('storage/'.$file->file_name) }}" target="_blank"
                            class="btn btn-outline-secondary w-100 mb-2">
                            📄 {{ basename($file->file_name) }}
                        </a>
                    @endif

                    <form action="{{ route('admin.media.delete', $file->media_id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm mt-2 w-100">Hapus</button>
                    </form>

                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>
</section>
@endsection
