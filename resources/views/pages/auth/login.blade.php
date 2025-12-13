<!-- FILE: resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Bina Desa</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">

    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        /* Background Image */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: url('{{ asset('assets-admin/images/bg/bg-desa.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            z-index: -2;
        }

        /* Dark Overlay */
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(51, 65, 85, 0.65);
            z-index: -1;
        }

        .auth-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1100px;
        }

        .auth-container {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 30px;
            align-items: stretch;
        }

        /* LEFT SIDE - INFO SECTION */
        .info-section {
            display: flex;
            flex-direction: column;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 20px;
            padding: 40px;
            color: white;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .info-image-container {
            width: 100%;
            height: 240px;
            margin-bottom: 30px;
            border-radius: 16px;
            overflow: hidden;
            background: rgba(0, 0, 0, 0.2);
        }

        .info-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info-title {
            font-size: 28px;
            font-weight: 800;
            margin: 0 0 12px 0;
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
        }

        .info-subtitle {
            font-size: 13px;
            margin: 0 0 28px 0;
            opacity: 0.9;
            line-height: 1.6;
            flex-grow: 1;
            color: white;
        }

        .info-details {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .info-detail {
            background: rgba(255, 255, 255, 0.08);
            border-left: 3px solid #667eea;
            padding: 14px 16px;
            border-radius: 10px;
            font-size: 12px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
            transition: all 0.3s ease;
        }

        .info-detail:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .info-detail-icon {
            display: inline-flex;
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            flex-shrink: 0;
        }

        .info-detail-content {
            flex: 1;
        }

        .info-detail-label {
            opacity: 0.7;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            display: block;
            margin-bottom: 2px;
            color: white;
        }

        .info-detail-text {
            font-size: 12px;
            opacity: 0.95;
            color: white;
        }

        /* RIGHT SIDE - LOGIN FORM */
        .form-section {
            display: flex;
        }

        .card-auth {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            border: none;
            overflow: hidden;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .card-header-auth {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 35px 35px 25px 35px;
            text-align: center;
            color: white;
        }

        /* Logo Container */
        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo-img {
            width: 120px;
            height: 120px;
            object-fit: contain;
            background: white;
            padding: 8px;
            border-radius: 50%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .card-header-auth h4 {
            font-size: 22px;
            font-weight: 800;
            margin: 0 0 6px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: white;
        }

        .card-header-auth p {
            font-size: 12px;
            margin: 0;
            opacity: 0.9;
            color: white;
        }

        .card-body-auth {
            padding: 35px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group:last-of-type {
            margin-bottom: 10px;
        }

        .form-label {
            font-size: 11px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control-auth {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13px;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-control-auth:focus {
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .form-control-auth::placeholder {
            color: #cbd5e0;
        }

        /* Button */
        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            cursor: pointer;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            color: white;
        }

        .btn-login:active {
            transform: translateY(0px);
        }

        /* Alerts */
        .alert-custom {
            border-radius: 10px;
            border: none;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .alert-success-custom {
            background: #d1fae5;
            color: #065f46;
            font-weight: 600;
        }

        .alert-danger-custom {
            background: #fee2e2;
            color: #7f1d1d;
            font-weight: 600;
        }

        /* Footer Links */
        .auth-footer {
            margin-top: 20px;
            text-align: center;
        }

        .auth-footer p {
            font-size: 12px;
            color: #64748b;
            margin: 0;
        }

        .auth-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .auth-footer a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Bottom Footer */
        .footer-text {
            text-align: center;
            margin-top: 35px;
            color: rgba(255, 255, 255, 0.75);
            font-size: 11px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .auth-container {
                grid-template-columns: 1fr;
            }

            .info-card {
                order: 2;
            }

            .form-section {
                order: 1;
            }

            .info-image-container {
                height: 200px;
            }

            .info-title {
                font-size: 24px;
            }
        }

        @media (max-width: 768px) {
            .auth-wrapper {
                max-width: 100%;
            }

            .info-card {
                padding: 30px;
            }

            .card-body-auth {
                padding: 25px;
            }

            .card-header-auth {
                padding: 25px 25px 20px 25px;
            }

            .logo-img {
                width: 70px;
                height: 70px;
            }

            .info-image-container {
                height: 160px;
                margin-bottom: 20px;
            }

            .info-title {
                font-size: 20px;
            }

            .info-subtitle {
                font-size: 12px;
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-container">
            {{-- LEFT SIDE - INFO SECTION --}}
            <div class="info-section">
                <div class="info-card">
                    {{-- Image --}}
                    <div class="info-image-container">
                        <img src="{{ asset('assets-admin/images/bg/bg-desa.jpg') }}" alt="Desa Penyasawan" class="info-image">
                    </div>

                    {{-- Title & Subtitle --}}
                    <h2 class="info-title">
                        <i class="bi bi-house-fill"></i>
                        Desa Penyasawan
                    </h2>
                    <p class="info-subtitle">
                        Platform Layanan Mandiri & Surat Digital yang memudahkan warga untuk mengakses layanan administrasi desa secara transparan, cepat, dan terpercaya.
                    </p>

                    {{-- Detail Information --}}
                    <div class="info-details">
                        <div class="info-detail">
                            <div class="info-detail-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div class="info-detail-content">
                                <span class="info-detail-label">Alamat</span>
                                <span class="info-detail-text">Jalan Raya Desa No. 123, Penyasawan, Riau</span>
                            </div>
                        </div>

                        <div class="info-detail">
                            <div class="info-detail-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div class="info-detail-content">
                                <span class="info-detail-label">Telepon</span>
                                <span class="info-detail-text">+62 812 3456 7890</span>
                            </div>
                        </div>

                        <div class="info-detail">
                            <div class="info-detail-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div class="info-detail-content">
                                <span class="info-detail-label">Email</span>
                                <span class="info-detail-text">admin@desapenyasawan.go.id</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDE - LOGIN FORM --}}
            <div class="form-section">
                <div class="card-auth">
                    <div class="card-header-auth">
                        {{-- Logo --}}
                        <div class="logo-container">
                            <img src="{{ asset('assets-admin/images/logo/unnamed.png') }}" alt="Logo Bina Desa" class="logo-img">
                        </div>

                        <h4>
                            <i class="bi bi-shield-lock"></i>
                            Login Admin
                        </h4>
                        <p>Masuk ke dashboard administrasi Bina Desa</p>
                    </div>

                    <div class="card-body-auth">
                        {{-- Success Alert --}}
                        @if(session('success'))
                            <div class="alert alert-custom alert-success-custom">
                                <i class="bi bi-check-circle"></i>
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Error Alert --}}
                        @if($errors->any())
                            <div class="alert alert-custom alert-danger-custom">
                                <i class="bi bi-exclamation-circle"></i>
                                <strong>Login Gagal!</strong>
                                @foreach($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        {{-- Login Form --}}
                        <form action="{{ route('admin.login.post') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="email" class="form-label">Email Address</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control form-control-auth"
                                    placeholder="admin@desapenyasawan.go.id"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus>
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-label">Password</label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control form-control-auth"
                                    placeholder="Masukkan password Anda"
                                    required>
                            </div>

                            <button type="submit" class="btn-login">
                                <i class="bi bi-box-arrow-in-right"></i>
                                Login Sekarang
                            </button>
                        </form>

                        {{-- Register Link --}}
                        <div class="auth-footer">
                            <p>
                                Belum punya akun?
                                <a href="{{ route('admin.register') }}">Daftar di sini</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="footer-text">
            © 2025 Sistem Bina Desa - Desa Penyasawan | Platform Layanan Mandiri & Surat Digital
        </div>
    </div>

    <script src="{{ asset('assets-admin/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
