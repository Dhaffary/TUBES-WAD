@extends('layouts.app')

@section('content')

<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="card modern-card">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between">

                    <div>
                        <p class="text-muted">
                            Total Pesanan
                        </p>

                        <h2 class="fw-bold text-primary">
                            128
                        </h2>
                    </div>

                    <i class="fas fa-shopping-cart fa-2x text-primary"></i>

                </div>

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card modern-card">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between">

                    <div>
                        <p class="text-muted">
                            Pelanggan
                        </p>

                        <h2 class="fw-bold text-success">
                            54
                        </h2>
                    </div>

                    <i class="fas fa-users fa-2x text-success"></i>

                </div>

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card modern-card">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between">

                    <div>
                        <p class="text-muted">
                            Pendapatan
                        </p>

                        <h2 class="fw-bold text-warning">
                            Rp 2JT
                        </h2>
                    </div>

                    <i class="fas fa-wallet fa-2x text-warning"></i>

                </div>

            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card modern-card">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between">

                    <div>
                        <p class="text-muted">
                            Layanan
                        </p>

                        <h2 class="fw-bold text-danger">
                            6
                        </h2>
                    </div>

                    <i class="fas fa-print fa-2x text-danger"></i>

                </div>

            </div>
        </div>
    </div>

</div>

<div class="card modern-card">

    <div class="card-body p-4">

        <h5 class="fw-bold mb-4">
            Aktivitas Terbaru
        </h5>

        <table class="table table-hover align-middle">

            <thead>

                <tr>
                    <th>Nama</th>
                    <th>Layanan</th>
                    <th>Status</th>
                    <th>Harga</th>
                </tr>

            </thead>

            <tbody>

                <tr>
                    <td>Zacky</td>
                    <td>Print Warna</td>

                    <td>
                        <span class="badge bg-warning">
                            Diproses
                        </span>
                    </td>

                    <td>Rp 20.000</td>
                </tr>

                <tr>
                    <td>Rizky</td>
                    <td>Fotokopi</td>

                    <td>
                        <span class="badge bg-success">
                            Selesai
                        </span>
                    </td>

                    <td>Rp 10.000</td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection