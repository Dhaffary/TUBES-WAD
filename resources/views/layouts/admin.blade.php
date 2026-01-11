<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Fotokopi Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #343a40; color: white; padding: 20px; }
        .content { flex: 1; padding: 20px; background: #f8f9fa; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 10px; }
        .sidebar a:hover { background: #495057; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Fotokopi App</h3>
        <hr>
        <a href="/dashboard">Dashboard</a>
        <a href="/layanan">Data Layanan (Hans)</a>
        <a href="/pelanggan">Data Pelanggan (Noval)</a>
        <a href="/pesanan">Data Pesanan (Arief)</a>
        <a href="/status">Status Pesanan (Rafli)</a>
        <hr>
        <form action="/logout" method="POST">
            @csrf
            <button class="btn btn-danger btn-sm">Logout</button>
        </form>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>