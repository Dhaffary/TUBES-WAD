<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FotokopiDigital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 16px;
        }
        .card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        }
        .card-header-custom {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            padding: 32px 32px 24px;
            text-align: center;
        }
        .card-header-custom .icon-circle {
            width: 64px;
            height: 64px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 28px;
            color: white;
        }
        .card-header-custom h4 {
            color: white;
            font-weight: 700;
            margin: 0;
        }
        .card-header-custom p {
            color: rgba(255,255,255,0.75);
            margin: 4px 0 0;
            font-size: 14px;
        }
        .card-body {
            padding: 32px;
            background: white;
        }
        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #495057;
            margin-bottom: 6px;
        }
        .form-control {
            border-radius: 10px;
            padding: 10px 14px;
            border: 1.5px solid #dee2e6;
            font-size: 14px;
            transition: all 0.2s;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13,110,253,0.1);
        }
        .input-group-text {
            border-radius: 10px 0 0 10px;
            background: #f8f9fa;
            border: 1.5px solid #dee2e6;
            border-right: none;
            color: #6c757d;
        }
        .input-group .form-control {
            border-radius: 0 10px 10px 0;
            border-left: none;
        }
        .btn-login {
            border-radius: 10px;
            padding: 12px;
            font-weight: 700;
            font-size: 15px;
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            border: none;
            transition: all 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(13,110,253,0.35);
        }
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #adb5bd;
            font-size: 13px;
            margin: 20px 0;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #dee2e6;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="card">
            <div class="card-header-custom">
                <div class="icon-circle">
                    <i class="fas fa-print"></i>
                </div>
                <h4>FotokopiDigital</h4>
                <p>Masuk ke akun Anda untuk melanjutkan</p>
            </div>
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show py-2 small" role="alert">
                        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any() || session('error'))
                    <div class="alert alert-danger alert-dismissible fade show py-2 small" role="alert">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        @if(session('error'))
                            {{ session('error') }}
                        @else
                            {{ $errors->first() }}
                        @endif
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="nama@email.com"
                                   value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password"
                                   class="form-control"
                                   placeholder="Masukkan password"
                                   required>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-login">
                            <i class="fas fa-sign-in-alt me-2"></i>Masuk Sekarang
                        </button>
                    </div>
                </form>

                <div class="divider">atau</div>

                <div class="text-center">
                    <span class="text-muted small">Belum punya akun?</span>
                    <a href="{{ route('register') }}" class="text-decoration-none fw-bold ms-1 small">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <small class="text-white-50">&copy; {{ date('Y') }} FotokopiDigital. All rights reserved.</small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>