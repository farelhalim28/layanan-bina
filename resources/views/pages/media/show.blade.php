@extends('layouts.admin.app')

@section('title', 'Detail File Media')

@section('content')

<style>
    .media-viewer-container {
        border-radius: 15px;
        border: 1px solid #ddd;
        padding: 20px;
        background: #fff;
    }

    .media-info-box {
        background: #f7f9fc;
        padding: 15px;
        border-radius: 10px;
        border: 1px solid #e3e6ea;
    }

    .btn-action-group {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    iframe.viewer-frame {
        width: 100%;
        height: 600px;
        border-radius: 10px;
        border: none;
    }

    .media-preview {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }

</style>


<div class="page-heading">
    <h3>📁 Detail Media</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">

            <div class="media-viewer-container">

                @php
                    $extension = strtolower(pathinfo($media->file_name, PATHINFO_EXTENSION));

                    $imageExt = ['jpg','jpeg','png','gif','webp'];
                    $videoExt = ['mp4','webm','avi','mkv','mov'];
                    $docExt   = ['pdf','doc','docx','xls','xlsx','ppt','pptx'];
                    $fileUrl  = asset('storage/' . $media->file_name);
                @endphp

                {{-- Image Preview --}}
                @if(in_array($extension, $imageExt))
                    <img src="{{ $fileUrl }}" class="media-preview mb-3">

                {{-- Video Preview --}}
                @elseif(in_array($extension, $videoExt))
                    <video controls class="media-preview mb-3">
                        <source src="{{ $fileUrl }}">
                    </video>

                {{-- Office & PDF Viewer via Google --}}
                @elseif(in_array($extension, $docExt))
                    <iframe
                        class="viewer-frame"
                        src="https://docs.google.com/gview?url={{ urlencode($fileUrl) }}&embedded=true">
                    </iframe>

                {{-- Other File Types --}}
                @else
                    <div class="alert alert-secondary text-center">
                        Preview tidak tersedia untuk format ini.<br><br>
                        <strong>{{ strtoupper($extension) }}</strong>
                    </div>
                @endif


                {{-- BUTTON ACTION --}}
                <div class="btn-action-group">
                    <a href="{{ $fileUrl }}" download class="btn btn-primary">
                        ⬇ Download
                    </a>

                    <a href="{{ route('admin.media.index') }}" class="btn btn-secondary">
                        ⬅ Kembali
                    </a>
                </div>

            </div>

            <hr>

            {{-- INFO BOX --}}
            <div class="media-info-box mt-3">
                <p><strong>Nama File:</strong> {{ $media->file_name }}</p>
                <p><strong>Caption:</strong> {{ $media->caption ?? '-' }}</p>
                <p><strong>Tipe:</strong> {{ $media->mime_type }}</p>
                <p><strong>Relasi:</strong> {{ $media->ref_table }} → ID {{ $media->ref_id }}</p>
            </div>

        </div>
    </div>
</section>

@endsection
