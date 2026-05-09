<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fotokopi App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>

        body{
            margin:0;
            background:#f1f5f9;
            font-family:'Segoe UI',sans-serif;
        }

        .sidebar{
            position:fixed;
            left:0;
            top:0;
            width:260px;
            height:100vh;
            background:#0f172a;
            padding:25px;
            overflow-y:auto;
        }

        .logo{
            color:white;
            font-size:28px;
            font-weight:bold;
            margin-bottom:40px;
        }

        .sidebar-menu{
            display:flex;
            flex-direction:column;
            gap:10px;
        }

        .sidebar-menu a{
            display:flex;
            align-items:center;
            gap:12px;
            color:#cbd5e1;
            text-decoration:none;
            padding:14px 18px;
            border-radius:14px;
            transition:0.3s;
            font-weight:600;
        }

        .sidebar-menu a:hover{
            background:#1e293b;
            color:white;
        }

        .main{
            margin-left:260px;
            padding:30px;
            min-height:100vh;
        }

        .topbar{
            background:white;
            padding:20px 25px;
            border-radius:20px;
            margin-bottom:25px;
            box-shadow:0 2px 10px rgba(0,0,0,0.05);
        }

        .modern-card{
            border:none;
            border-radius:24px;
            background:white;
            box-shadow:0 4px 20px rgba(0,0,0,0.05);
        }

        .btn-modern{
            border-radius:12px;
            padding:10px 18px;
            font-weight:600;
        }

        @media(max-width:768px){

            .sidebar{
                width:100%;
                height:auto;
                position:relative;
            }

            .main{
                margin-left:0;
            }

        }

    </style>
</head>
<body>

<div class="sidebar">

    <div class="logo">
        <i class="fas fa-print"></i>
        FotokopiApp
    </div>

    <div class="sidebar-menu">

        <a href="/dashboard">
            <i class="fas fa-chart-line"></i>
            Dashboard
        </a>

        {{-- MENU ADMIN --}}
        @if(Auth::user()->role == 'admin')

            <a href="/layanan">
                <i class="fas fa-print"></i>
                Layanan
            </a>

            <a href="/pelanggan">
                <i class="fas fa-users"></i>
                Pelanggan
            </a>

            <a href="/admin/pesanan">
                <i class="fas fa-shopping-cart"></i>
                Semua Pesanan
            </a>

        @endif


        {{-- MENU PELANGGAN --}}
        @if(Auth::user()->role == 'pelanggan')

            <a href="/pesanan">
                <i class="fas fa-shopping-cart"></i>
                Pesanan Saya
            </a>

            <a href="/pesanan/buat">
                <i class="fas fa-plus-circle"></i>
                Buat Pesanan
            </a>

        @endif

    </div>

    <form action="{{ route('logout') }}" method="POST" class="mt-4">
        @csrf

        <button type="submit"
                class="btn btn-danger w-100 btn-modern">

            <i class="fas fa-sign-out-alt me-2"></i>
            Logout

        </button>
    </form>

</div>

<div class="main">

    <div class="topbar d-flex justify-content-between align-items-center">

        <div>
            <h4 class="fw-bold mb-0">

                @if(Auth::user()->role == 'admin')
                    Dashboard Admin
                @else
                    Dashboard Pelanggan
                @endif

            </h4>

            <small class="text-muted">
                Selamat datang kembali 👋
            </small>
        </div>

        <div class="fw-semibold text-primary">
            {{ Auth::user()->name }}
        </div>

    </div>

    @yield('content')

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>