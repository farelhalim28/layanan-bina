@extends('layouts.admin.app')

@section('title', 'Detail Berkas Persyaratan')

@section('content')
<div class="page-heading">
    <h3>Detail Berkas Persyaratan</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header"><h4>Informasi Berkas</h4></div>
        <div class="card-body">

            <table class="table table-bordered">
                <tr><th>Nomor Permohonan</th><td>{{ $berkasPersyaratan->permohonanSurat->nomor_permohonan }}</td></tr>
                <tr><th>Pemohon</th><td>{{ $berkasPersyaratan->permohonanSurat->pemohon->nama ?? '-' }}</td></tr>
                <tr><th>Nama Berkas</th><td>{{ $berkasPersyaratan->nama_berkas }}</td></tr>
                <tr><th>Status Validasi</th>
                    <td>
                        @if($berkasPersyaratan->valid)
                            <span class="badge bg-success">VALID</span>
                        @else
                            <span class="badge bg-danger">TIDAK VALID</span>
                        @endif
                    </td>
                </tr>
            </table>

            <hr>

            @php
                $files = \App\Models\Media::where('ref_table','berkas_persyaratan')
                ->where('ref_id',$berkasPersyaratan->berkas_id)->get();
            @endphp

            <h5>📁 Lampiran</h5>

            @if($files->count() == 0)
                <p class="text-muted">Belum ada file lampiran</p>
            @else
            <div class="row">
                @foreach ($files as $file)
                <div class="col-md-3 text-center">

                    @php
                        $ext = strtolower(pathinfo($file->file_name, PATHINFO_EXTENSION));
                        $img = ['jpg','jpeg','png','gif','webp'];
                        $vid = ['mp4','avi','mov','webm','mkv'];
                    @endphp

                    @if(in_array($ext,$img))
                        <img src="{{ asset('storage/'.$file->file_name) }}"
                        class="img-thumbnail mb-2" style="width:120px;height:120px;object-fit:cover;">
                    @elseif(in_array($ext,$vid))
                        <video width="120" height="120" controls><source src="{{ asset('storage/'.$file->file_name) }}"></video>
                    @else
                        <a href="{{ asset('storage/'.$file->file_name) }}" target="_blank"
                        class="btn btn-outline-secondary w-100 mb-2">📄 {{ basename($file->file_name) }}</a>
                    @endif

                    <a href="{{ asset('storage/'.$file->file_name) }}" download class="btn btn-primary btn-sm w-100">
                        Download
                    </a>

                </div>
                @endforeach
            </div>
            @endif

            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('admin.berkas-persyaratan.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

        </div>
    </div>
</section>
@endsection
