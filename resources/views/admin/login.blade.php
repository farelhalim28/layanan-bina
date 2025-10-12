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
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        #auth { padding: 50px 0; min-height: 100vh; display: flex; align-items: center; }
        .auth-logo h2 { color: white; font-weight: 700; font-size: 36px; text-shadow: 2px 2px 4px rgba(0,0,0,0.2); }
        .auth-logo p { color: rgba(255,255,255,0.9); }
        .card { border-radius: 1.5rem; box-shadow: 0 20px 60px rgba(0,0,0,0.2); border: none; }
        .card-header { background: white; border-bottom: 0; padding-top: 35px; }
        .card-header h4 { color: #435ebe; font-weight: 700; }
        .form-control { border-radius: 0.7rem; padding: 13px 15px; border: 2px solid #e0e0e0; }
        .form-control:focus { border-color: #435ebe; box-shadow: 0 0 0 0.2rem rgba(67, 94, 190, 0.15); }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; padding: 14px; border-radius: 0.7rem; font-weight: 600; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4); }
        .demo-box { background: linear-gradient(135deg, #e3f2fd 0%, #e8eaf6 100%); border-left: 4px solid #435ebe; padding: 18px; margin-bottom: 25px; border-radius: 0.7rem; }
        .demo-box h6 { color: #435ebe; font-weight: 700; margin-bottom: 12px; }
        .demo-box code { background: white; padding: 3px 8px; border-radius: 4px; color: #e83e8c; font-weight: 600; }
    </style>
</head>
<body>
    <div id="auth">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="text-center mb-4">
                        <div class="auth-logo">
                            <h2>🏘️ Bina Desa</h2>
                            <p>Sistem Layanan Mandiri & Surat Desa</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header text-center">
                            <h4>Login Admin</h4>
                            <p class="text-muted mb-0">Masuk ke dashboard administrasi</p>
                        </div>
                        <div class="card-body">
                            <div class="demo-box">
                                <h6><i class="bi bi-info-circle"></i> Akun Demo:</h6>
                                <p class="mb-1"><strong>Email:</strong> <code>admin@desa.com</code></p>
                                <p class="mb-0"><strong>Password:</strong> <code>password</code></p>
                            </div>

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
                                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="admin@desa.com" value="{{ old('email') }}" required autofocus>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Login Sekarang</button>
                            </form>

                            <div class="text-center mt-3">
                                <p class="text-muted mb-0">
                                    Belum punya akun? <a href="{{ route('admin.register') }}" class="fw-bold">Daftar</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets-admin/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
