<!-- FILE: resources/views/auth/register.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Admin - Bina Desa</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/bootstrap-icons/bootstrap-icons.css') }}">

    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Animated Background */
        .bg-decoration {
            position: fixed;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            opacity: 0.1;
            z-index: 0;
        }

        .circle-1 {
            background: white;
            top: -100px;
            right: -100px;
            animation: float 6s ease-in-out infinite;
        }

        .circle-2 {
            background: white;
            bottom: -150px;
            left: -150px;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(20px); }
        }

        .auth-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 480px;
        }

        /* Logo & Brand */
        .brand-section {
            text-align: center;
            margin-bottom: 40px;
            animation: slideDown 0.8s ease-out;
        }

        .logo-box {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            background: white;
            border-radius: 16px;
            margin-bottom: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            animation: bounce 1s ease-in-out;
        }

        .logo-box svg {
            width: 45px;
            height: 45px;
        }

        .brand-title {
            color: white;
            font-size: 28px;
            font-weight: 800;
            margin: 0 0 6px 0;
        }

        .brand-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 13px;
            margin: 0;
        }

        /* Form Card */
        .card-auth {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            border: none;
            overflow: hidden;
            animation: slideUp 0.8s ease-out;
        }

        .card-header-auth {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 35px 30px;
            text-align: center;
            color: white;
        }

        .card-header-auth h4 {
            font-size: 22px;
            font-weight: 800;
            margin: 0 0 6px 0;
        }

        .card-header-auth p {
            font-size: 12px;
            margin: 0;
            opacity: 0.9;
        }

        .card-body-auth {
            padding: 35px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 20px;
            animation: fadeIn 0.6s ease-out forwards;
            opacity: 0;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-label {
            font-size: 12px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .required-star {
            color: #ef4444;
            font-weight: 800;
        }

        .form-control-auth {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13px;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-control-auth:focus {
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .form-control-auth::placeholder {
            color: #cbd5e0;
        }

        /* Button */
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 13px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            margin-top: 8px;
            cursor: pointer;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-register:active {
            transform: translateY(-1px);
        }

        /* Alerts */
        .alert-custom {
            border-radius: 12px;
            border: none;
            padding: 14px;
            margin-bottom: 20px;
            font-size: 12px;
            animation: slideDown 0.4s ease-out;
        }

        .alert-success-custom {
            background: #d1fae5;
            color: #065f46;
            font-weight: 600;
        }

        .alert-danger-custom {
            background: #fee2e2;
            color: #7f1d1d;
        }

        .alert-danger-custom ul {
            margin: 8px 0 0 20px;
            padding: 0;
        }

        .alert-danger-custom li {
            margin: 4px 0;
            font-size: 12px;
        }

        /* Footer Links */
        .auth-footer {
            margin-top: 24px;
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
            margin-top: 30px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 11px;
            animation: fadeIn 1s ease-out;
        }

        /* Animations */
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .auth-container {
                max-width: 100%;
            }

            .brand-section {
                margin-bottom: 25px;
            }

            .card-body-auth {
                padding: 25px 18px;
            }

            .card-header-auth {
                padding: 25px 18px;
            }

            .brand-title {
                font-size: 22px;
            }

            .bg-decoration {
                width: 200px;
                height: 200px;
            }

            .form-group {
                margin-bottom: 16px;
            }
        }
    </style>
</head>

<body>
    {{-- Background Decoration --}}
    <div class="bg-decoration circle-1"></div>
    <div class="bg-decoration circle-2"></div>

    <div class="auth-container">
        {{-- Brand Section --}}
        <div class="brand-section">
            <div class="logo-box">
                <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <linearGradient id="logoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" style="stop-color:#667eea;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#764ba2;stop-opacity:1" />
                        </linearGradient>
                    </defs>
                    <!-- House/Building -->
                    <rect x="20" y="50" width="60" height="40" fill="url(#logoGradient)" rx="4"/>
                    <!-- Roof -->
                    <polygon points="15,50 50,20 85,50" fill="url(#logoGradient)"/>
                    <!-- Door -->
                    <rect x="43" y="60" width="14" height="30" fill="white" rx="2"/>
                    <!-- Door Handle -->
                    <circle cx="53" cy="75" r="2" fill="url(#logoGradient)"/>
                    <!-- Windows -->
                    <rect x="28" y="58" width="8" height="8" fill="white" rx="1"/>
                    <rect x="64" y="58" width="8" height="8" fill="white" rx="1"/>
                </svg>
            </div>
            <h1 class="brand-title">Bina Desa</h1>
            <p class="brand-subtitle">Sistem Layanan Administrasi Desa</p>
        </div>

        {{-- Register Card --}}
        <div class="card-auth">
            <div class="card-header-auth">
                <h4><i class="bi bi-person-plus"></i> Registrasi Admin</h4>
                <p>Buat akun administrator baru untuk sistem Bina Desa</p>
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
                        <strong>Validasi Gagal!</strong>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Register Form --}}
                <form action="{{ route('admin.register.post') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="bi bi-person"></i>
                            Nama Lengkap
                            <span class="required-star">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control form-control-auth"
                            placeholder="Masukkan nama lengkap Anda"
                            value="{{ old('name') }}"
                            required
                            autofocus>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope"></i>
                            Email Address
                            <span class="required-star">*</span>
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-control form-control-auth"
                            placeholder="admin@binadesa.com"
                            value="{{ old('email') }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock"></i>
                            Password
                            <span class="required-star">*</span>
                        </label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control form-control-auth"
                            placeholder="Minimal 6 karakter"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">
                            <i class="bi bi-shield-check"></i>
                            Konfirmasi Password
                            <span class="required-star">*</span>
                        </label>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control form-control-auth"
                            placeholder="Ulangi password Anda"
                            required>
                    </div>

                    <button type="submit" class="btn-register">
                        <i class="bi bi-check-circle"></i>
                        Daftar Sekarang
                    </button>
                </form>

                {{-- Login Link --}}
                <div class="auth-footer">
                    <p>
                        Sudah punya akun?
                        <a href="{{ route('admin.login') }}">Login di sini</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="footer-text">
            © 2025 Sistem Bina Desa | Pengembangan Modul Administrasi Desa
        </div>
    </div>

    <script src="{{ asset('assets-admin/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Input focus animation
        document.querySelectorAll('.form-control-auth').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.01)';
            });
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Password match validation
        const password = document.getElementById('password');
        const passwordConfirm = document.getElementById('password_confirmation');

        if (password && passwordConfirm) {
            passwordConfirm.addEventListener('change', function() {
                if (this.value !== password.value) {
                    this.style.borderColor = '#ef4444';
                } else {
                    this.style.borderColor = '#10b981';
                }
            });
        }
    </script>
</body>
</html>
