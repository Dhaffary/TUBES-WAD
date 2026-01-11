@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="d-flex align-items-center justify-content-between bg-white p-4 shadow-sm rounded">
                <div>
                    <h2 class="mb-1">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-muted mb-0">Anda login sebagai: <span class="badge bg-secondary">{{ ucfirst(Auth::user()->role) }}</span></p>
                </div>
                <div class="text-end d-none d-md-block">
                    <p class="small text-muted mb-0">Tanggal Hari Ini</p>
                    <h6 class="fw-bold">{{ date('d F Y') }}</h6>
                </div>
            </div>
        </div>

        @if(Auth::user()->role == 'admin')
            <div class="col-md-4 mb-3">
                <div class="card bg-primary text-white shadow border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Total Layanan</h5>
                            <i class="fas fa-concierge-bell fa-2x opacity-50"></i>
                        </div>
                        <h2 class="display-4 fw-bold">{{ \App\Models\Layanan::count() }}</h2>
                        <hr>
                        <a href="{{ route('layanan.index') }}" class="text-white text-decoration-none small fw-bold">
                            Kelola Layanan →
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card bg-info text-white shadow border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Pesanan Masuk</h5>
                            <i class="fas fa-shopping-basket fa-2x opacity-50"></i>
                        </div>
                        <h2 class="display-4 fw-bold">{{ \App\Models\Pesanan::count() }}</h2>
                        <hr>
                        <a href="{{ route('admin.pesanan.index') }}" class="text-white text-decoration-none small fw-bold">
                            Lihat Semua Pesanan →
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card bg-success text-white shadow border-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Total Pengguna</h5>
                            <i class="fas fa-users fa-2x opacity-50"></i>
                        </div>
                        <h2 class="display-4 fw-bold">{{ \App\Models\User::count() }}</h2>
                        <hr>
                        <a href="{{ route('pelanggan.index') }}" class="text-white text-decoration-none small fw-bold">
                            Manajemen User →
                        </a>
                    </div>
                </div>
            </div>

        @else
            <div class="col-md-12">
                <div class="card shadow-sm border-0 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-4 bg-primary d-flex align-items-center justify-content-center p-4">
                            <i class="fas fa-print text-white" style="font-size: 8rem;"></i>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body p-5">
                                <h3 class="text-primary fw-bold">Halo Pelanggan Setia!</h3>
                                <p class="lead">Butuh fotokopi, jilid, atau print dokumen kilat? Kami siap membantu pesanan Anda hari ini.</p>
                                <hr class="my-4">
                                <div class="d-grid gap-3 d-md-flex">
                                    <a href="{{ route('pesanan.create') }}" class="btn btn-primary btn-lg px-5 rounded-pill shadow">
                                        <i class="fas fa-plus-circle me-2"></i>Mulai Pesanan
                                    </a>
                                    <a href="{{ route('pesanan.index') }}" class="btn btn-outline-secondary btn-lg px-5 rounded-pill">
                                        <i class="fas fa-history me-2"></i>Riwayat Pesanan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection