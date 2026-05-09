<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - FotokopiDigital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; background: #f4f6f9; }
        .sidebar { width: 240px; background: #1a1d23; color: #adb5bd; padding: 0; flex-shrink: 0; }
        .sidebar-brand { padding: 20px; background: #0d0f14; color: white; font-size: 16px; font-weight: 600; display: flex; align-items: center; gap: 10px; }
        .sidebar-brand i { color: #0d6efd; }
        .sidebar-menu { list-style: none; padding: 12px 0; margin: 0; }
        .sidebar-menu li a { display: flex; align-items: center; gap: 10px; padding: 10px 20px; color: #adb5bd; text-decoration: none; font-size: 14px; transition: all 0.2s; }
        .sidebar-menu li a:hover, .sidebar-menu li a.active { background: #2a2d35; color: white; }
        .sidebar-menu li a i { width: 18px; text-align: center; }
        .sidebar-divider { border-color: #2a2d35; margin: 8px 0; }
        .content { flex: 1; padding: 24px; overflow-auto; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="fas fa-print"></i> FotokopiDigital
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('layanan.index') }}" class="{{ request()->routeIs('layanan.*') ? 'active' : '' }}">
                    <i class="fas fa-concierge-bell"></i> Data Layanan
                </a>
            </li>
            <li>
                <a href="{{ route('pelanggan.index') }}" class="{{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Data Pelanggan
                </a>
            </li>
            <li>
                <a href="{{ route('admin.pesanan.index') }}" class="{{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-basket"></i> Semua Pesanan
                </a>
            </li>
        </ul>
        <hr class="sidebar-divider">
        <ul class="sidebar-menu">
            <li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="background:none;border:none;width:100%;text-align:left;display:flex;align-items:center;gap:10px;padding:10px 20px;color:#dc3545;font-size:14px;cursor:pointer;">
                        <i class="fas fa-sign-out-alt" style="width:18px;text-align:center;"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
    <div class="content">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>