@extends('layouts.app')

@section('content')
<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow border-0">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0"><i class="fas fa-history me-2"></i>Riwayat Pesanan Fotokopi</h5>
            <a href="{{ route('pesanan.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                <i class="fas fa-plus me-1"></i> Pesanan Baru
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 text-center" style="width: 80px;">ID</th>
                            <th>Layanan & Detail</th>
                            <th>Total Biaya</th>
                            <th class="text-center">Dokumen</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesanans as $p)
                        <tr>
                            <td class="px-4 fw-bold text-muted text-center">#{{ $p->id }}</td>
                            <td>
                                <span class="fw-bold text-dark">{{ $p->layanan->nama_layanan }}</span><br>
                                <small class="text-muted"><i class="fas fa-layer-group me-1"></i>{{ $p->jumlah }} Lembar / Paket</small>
                            </td>
                            <td class="text-primary fw-bold">
                                Rp {{ number_format($p->total_biaya, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <a href="{{ asset('uploads/dokumen/'.$p->file_dokumen) }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-file-pdf me-1"></i> Lihat File
                                </a>
                            </td>
                            <td class="text-center">
                                @if($p->status_pesanan == 'menunggu')
                                    <span class="badge rounded-pill bg-warning text-dark px-3">Menunggu</span>
                                @elseif($p->status_pesanan == 'diproses')
                                    <span class="badge rounded-pill bg-info text-white px-3">Diproses</span>
                                @else
                                    <span class="badge rounded-pill bg-success text-white px-3">{{ ucfirst($p->status_pesanan) }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('pesanan.cetak', $p->id) }}" class="btn btn-info btn-sm text-white shadow-sm" title="Cetak Transaksi">
                                        <i class="fas fa-print me-1"></i> Cetak
                                    </a>
                                    
                                    <form action="{{ route('pesanan.destroy', $p->id) }}" method="POST" class="d-inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')" title="Batalkan Pesanan">
                                            <i class="fas fa-times me-1"></i> Batal
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3"></i><br>
                                Belum ada riwayat pesanan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-3 text-muted small text-end">
        <i class="fas fa-info-circle me-1"></i> Klik "Lihat File" untuk memeriksa dokumen yang Anda unggah.
    </div>
</div>
@endsection