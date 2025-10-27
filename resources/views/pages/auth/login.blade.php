<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Bina Desa</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/app.css') }}">
    <style>
        body {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            font-family: 'Nunito', sans-serif;
        }
        #auth {
            padding: 50px 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .auth-logo h2 {
            color: white;
            font-weight: 800;
            font-size: 38px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }
        .auth-logo p {
            color: rgba(255,255,255,0.95);
            font-size: 15px;
        }
        .card {
            border-radius: 1.5rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
            border: none;
        }
        .card-header {
            background: white;
            border-bottom: 0;
            padding-top: 35px;
        }
        .card-header h4 {
            color: #27ae60;
            font-weight: 700;
        }
        .form-control {
            border-radius: 0.7rem;
            padding: 13px 15px;
            border: 2px solid #e0e0e0;
        }
        .form-control:focus {
            border-color: #27ae60;
            box-shadow: 0 0 0 0.2rem rgba(39, 174, 96, 0.15);
        }
        .btn-primary {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            border: none;
            padding: 14px;
            border-radius: 0.7rem;
            font-weight: 600;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(46, 204, 113, 0.4);
        }
        .module-info {
            background: rgba(255,255,255,0.15);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 25px;
        }
        .module-info img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid white;
            margin-bottom: 10px;
        }
        .module-info h3 {
            color: #fff;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .module-info p {
            color: rgba(255,255,255,0.9);
            font-size: 14px;
            line-height: 1.4;
        }
    </style>
</head>
<body>
    <div id="auth">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">

                    <!-- Modul Identitas -->
                    <div class="text-center module-info">
                        <h3>Modul Layanan Mandiri</h3>
                        <p>
                            Aplikasi ini memudahkan warga untuk mengakses layanan administrasi desa secara cepat dan transparan.
                            Data terintegrasi langsung ke sistem utama Bina Desa.
                        </p>
                    </div>

                    <!-- Judul Aplikasi -->
                    <div class="text-center mb-4">
                        <div class="auth-logo">
                            <h2>🏘️ Bina Desa</h2>
                            <p>Sistem Layanan Mandiri & Digitalisasi Surat Desa</p>
                        </div>
                    </div>

                    <!-- Form Login -->
                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Login Admin</h4>
                            <p class="text-muted mb-0">Masuk ke dashboard administrasi</p>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            @endif

                            @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                @foreach($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            @endif

                            <form action="{{ route('admin.login.post') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="admin@desa.com" value="{{ old('email') }}" required autofocus>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-box-arrow-in-right"></i> Login Sekarang
                                </button>
                            </form>

                            <div class="text-center mt-3">
                                <p class="text-muted mb-0">
                                    Belum punya akun? <a href="{{ route('admin.register') }}" class="fw-bold text-success">Daftar</a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Info -->
                    <div class="text-center mt-4 text-white">
                        <small>© 2025 Sistem Bina Desa | Pengembangan Modul Rekan-Rekan</small>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets-admin/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
