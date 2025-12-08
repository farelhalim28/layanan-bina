@extends('layouts.admin.app')

@section('title', 'Edit User')

@section('content')

<style>
    .page-wrapper {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 30px 0;
    }

    .modern-header {
        background: white;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-title h1 {
        margin: 0;
        font-size: 32px;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .form-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    }

    .form-label {
        font-size: 12px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control-custom {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 16px;
        transition: all 0.3s;
        background: #f8fafc;
    }

    .form-control-custom:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        background: white;
    }

    .btn-save {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .btn-cancel {
        background: white;
        border: 2px solid #e2e8f0;
        color: #64748b;
        padding: 12px 28px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-cancel:hover {
        background: #f8fafc;
        border-color: #cbd5e0;
    }

    /* Profile Picture Upload */
    .profile-upload-section {
        text-align: center;
        margin-bottom: 30px;
        padding: 30px;
        background: #f8fafc;
        border-radius: 16px;
        border: 2px dashed #e2e8f0;
    }

    .current-photo {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        margin-bottom: 20px;
    }

    .photo-label {
        display: inline-block;
        padding: 12px 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
    }

    .photo-label:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    }

    .photo-label i {
        margin-right: 8px;
    }

    #profile_picture {
        display: none;
    }

    .photo-info {
        margin-top: 12px;
        font-size: 12px;
        color: #64748b;
    }

    .preview-container {
        margin-top: 15px;
    }

    #imagePreview {
        max-width: 200px;
        max-height: 200px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: none;
    }
</style>

<div class="page-wrapper">
    <div class="container-fluid">

        {{-- Modern Header --}}
        <div class="modern-header">
            <div class="header-title">
                <h1>✏️ Edit User</h1>
            </div>
            <a href="{{ route('admin.user.index') }}" class="btn-cancel">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        {{-- Form Card --}}
        <div class="form-card">
            <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                {{-- Profile Picture Section --}}
                <div class="profile-upload-section">
                    <img src="{{ $user->profile_picture_url }}"
                         alt="{{ $user->name }}"
                         class="current-photo"
                         id="currentPhoto">

                    <div>
                        <label for="profile_picture" class="photo-label">
                            <i class="bi bi-camera-fill"></i>
                            Ganti Foto Profil
                        </label>
                        <input type="file"
                               id="profile_picture"
                               name="profile_picture"
                               accept="image/*"
                               onchange="previewImage(event)">
                    </div>

                    <div class="photo-info">
                        <i class="bi bi-info-circle"></i>
                        Format: JPG, JPEG, PNG | Maksimal: 2MB
                    </div>

                    {{-- Preview New Image --}}
                    <div class="preview-container">
                        <img id="imagePreview" alt="Preview">
                    </div>
                </div>

                {{-- Form Fields --}}
                <div class="row g-4">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control form-control-custom @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}"
                               required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control form-control-custom @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <select name="role"
                                id="role"
                                class="form-control form-control-custom @error('role') is-invalid @enderror"
                                required>
                            <option value="Super Admin" {{ $user->role == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="User" {{ $user->role == 'User' ? 'selected' : '' }}>User</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password"
                               id="password"
                               name="password"
                               class="form-control form-control-custom @error('password') is-invalid @enderror">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password"
                               id="password_confirmation"
                               name="password_confirmation"
                               class="form-control form-control-custom">
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="{{ route('admin.user.index') }}" class="btn-cancel">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                    <button type="submit" class="btn-save">
                        <i class="bi bi-save"></i> Update User
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');
    const currentPhoto = document.getElementById('currentPhoto');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            currentPhoto.style.display = 'none';
        }
        reader.readAsDataURL(file);
    }
}
</script>

@endsection
