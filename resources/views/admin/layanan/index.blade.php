@extends('layouts.app')

@section('content')
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow rounded-4 overflow-hidden">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 fw-bold">
                <i class="fas fa-print me-2"></i>Data Layanan
            </h5>

            <span class="badge bg-primary rounded-pill px-3">
                Total: {{ $layanans->count() }} layanan
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4" style="width:60px">#</th>
                            <th>Nama Layanan</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($layanans as $layanan)
                        <tr>
                            <td class="px-4 fw-bold text-muted">
                                {{ $loop->iteration }}
                            </td>

                            <td class="fw-semibold">
                                {{ $layanan->nama_layanan }}
                            </td>

                            <td class="text-primary fw-bold">
                                Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                            </td>

                            <td class="text-muted">
                                {{ $layanan->deskripsi ?? '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="fas fa-print fa-3x mb-3 d-block opacity-25"></i>
                                Belum ada data layanan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection