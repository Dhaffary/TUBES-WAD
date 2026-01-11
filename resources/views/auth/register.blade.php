<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Fotokopi Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; display: flex; align-items: center; min-height: 100vh; }
        .register-card { 
            width: 100%; 
            max-width: 400px; 
            padding: 30px; 
            border-radius: 15px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
            background: white; 
            margin: auto; 
        }
        .form-control { border-radius: 8px; }
        .btn-primary { border-radius: 8px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="register-card text-center">
        <h3 class="fw-bold">Daftar Akun Baru</h3>
        <p class="text-muted small">Bergabung dengan Fotokopi App</p>

        @if($errors->any())
            <div class="alert alert-danger py-2 small">
                {{ $errors->first() }}
            </div>
        @endif
        
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3 text-start">
                <label class="form-label small">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3 text-start">
                <label class="form-label small">Email</label>
                <input type="email" name="email" class="form-control" placeholder="nama@email.com" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3 text-start">
                <label class="form-label small">Password</label>
                <input type="password" name="password" class="form-control" placeholder="******" required>
            </div>

            <div class="mb-3 text-start">
                <label class="form-label small">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="******" required>
            </div>
            
            <button type="submit" class="btn btn-primary w-100 py-2 mt-2">Daftar Sekarang</button>
            
            <p class="mt-3 mb-0 small text-muted">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-primary text-decoration-none fw-bold">Login di sini</a>
            </p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>