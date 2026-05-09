<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - FotokopiDigital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        .register-wrapper { width: 100%; max-width: 440px; padding: 16px; }
        .card { border: none; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.4); }
        .card-header-custom {
            background: linear-gradient(135deg, #198754, #146c43);
            padding: 28px 32px 20px;
            text-align: center;
        }
        .card-header-custom .icon-circle {
            width: 60px; height: 60px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 10px;
            font-size: 26px; color: white;
        }
        .card-header-custom h4 { color: white; font-weight: 700; margin: 0; }
        .card-header-custom p { color: rgba(255,255,255,0.75); margin: 4px 0 0; font-size: 13px; }
        .card-body { padding: 28px 32px; background: white; }
        .form-label { font-size: 13px; font-weight: 600; color: #495057; margin-bottom: 5px; }
        .form-control {
            border-radius: 10px; padding: 10px 14px;
            border: 1.5px solid #dee2e6; font-size: 14px; transition: all 0.2s;
        }
        .form-control:focus { border-color: #198754; box-shadow: 0 0 0 3px rgba(25,135,84,0.1); }
        .input-group-text {
            border-radius: 10px 0 0 10px; background: #f8f9fa;
            border: 1.5px solid #dee2e6; border-right: none; color: #6c757d;
        }
        .input-group .form-control { border-radius: 0 10px 10px 0; border-left: none; }
        .btn-register {
            border-radius: 10px; padding: 12px; font-weight: 700; font-size: 15px;
            background: linear-gradient(135deg, #198754, #146c43);
            border: none; transition: all 0.3s;
        }
        .btn-register:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(25,135,84,0.35); }
    </style>
</head>
<body>
    <div class="register-wrapper">
        <div class="card">
            <div class="card-header-custom">
                <div class="icon-circle"><i class="fas fa-user-plus"></i></div>
                <h4>Buat Akun Baru</h4>
                <p>Bergabung dengan FotokopiDigital sekarang</p>
            </div>
            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show py-2 small">
                        <i class="fas fa-exclamation-circle me-1"></i> {{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" name="name" class="form-control"
                                   placeholder="Nama lengkap Anda"
                                   value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control"
                                   placeholder="nama@email.com"
                                   value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" class="form-control"
                                   placeholder="Minimal 8 karakter" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="Ulangi password Anda" required>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-register">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <span class="text-muted small">Sudah punya akun?</span>
                    <a href="{{ route('login') }}" class="text-decoration-none fw-bold ms-1 small">
                        Login di sini
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