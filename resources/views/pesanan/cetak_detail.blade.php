<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Pesanan #{{ $pesanan->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .cetak-box {
            max-width: 680px; margin: 40px auto;
            background: white; border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .cetak-header {
            background: linear-gradient(135deg, #198754, #146c43);
            padding: 28px 32px; color: white;
        }
        .cetak-body { padding: 32px; }
        .detail-row {
            display: flex; justify-content: space-between;
            padding: 10px 0; border-bottom: 1px dashed #dee2e6;
            font-size: 14px;
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { color: #6c757d; }
        .detail-value { font-weight: 600; }
        @media print {
            body { background: white; }
            .cetak-box { box-shadow: none; margin: 0; border-radius: 0; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>
    <div class="cetak-box">
        <div class="cetak-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="fw-bold mb-1"><i class="fas fa-print me-2"></i>FotokopiDigital</h5>
                    <p class="mb-0 opacity-75 small">Bukti Transaksi Pesanan</p>
                </div>
                <div class="text-end">
                    <h6 class="fw-bold mb-0">#{{ str_pad($pesanan->id, 5, '0', STR_PAD_LEFT) }}</h6>
                    <small class="opacity-75">{{ \Carbon\Carbon::parse($pesanan->tanggal_pemesanan)->format('d/m/Y H:i') }}</small>
                </div>
            </div>
        </div>

        <div class="cetak-body">
            <h6 class="fw-bold text-muted mb-3 small text-uppercase">Detail Pesanan</h6>

            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-user me-2"></i>Nama Pelanggan</span>
                <span class="detail-value">{{ $pesanan->user->name }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-concierge-bell me-2"></i>Layanan</span>
                <span class="detail-value">{{ $pesanan->layanan->nama_layanan }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-layer-group me-2"></i>Jumlah</span>
                <span class="detail-value">{{ $pesanan->jumlah }} Lembar/Paket</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-tag me-2"></i>Harga Satuan</span>
                <span class="detail-value">Rp {{ number_format($pesanan->harga_satuan, 0, ',', '.') }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-calendar me-2"></i>Tanggal Pesan</span>
                <span class="detail-value">{{ \Carbon\Carbon::parse($pesanan->tanggal_pemesanan)->format('d F Y, H:i') }} WIB</span>
            </div>
            <div class="detail-row">
                <span class="detail-label"><i class="fas fa-info-circle me-2"></i>Status</span>
                <span class="detail-value">
                    @if($pesanan->status_pesanan == 'menunggu')
                        <span class="badge bg-warning text-dark">⏳ Menunggu</span>
                    @elseif($pesanan->status_pesanan == 'diproses')
                        <span class="badge bg-info">⚙️ Diproses</span>
                    @elseif($pesanan->status_pesanan == 'selesai')
                        <span class="badge bg-success">✅ Selesai</span>
                    @else
                        <span class="badge bg-danger">❌ Dibatalkan</span>
                    @endif
                </span>
            </div>

            <div class="bg-success bg-opacity-10 border border-success border-opacity-25 rounded-3 p-3 mt-4 d-flex justify-content-between align-items-center">
                <span class="fw-bold text-success fs-6">TOTAL BIAYA</span>
                <span class="fw-bold text-success fs-5">Rp {{ number_format($pesanan->total_biaya, 0, ',', '.') }}</span>
            </div>

            <p class="text-center text-muted small mt-4 mb-0">
                <i class="fas fa-check-circle text-success me-1"></i>
                Dokumen ini adalah bukti transaksi resmi dari FotokopiDigital.
            </p>
        </div>
    </div>

    <div class="text-center mt-3 mb-5 no-print">
        <button onclick="window.print()" class="btn btn-success px-5 rounded-pill me-2">
            <i class="fas fa-print me-2"></i>Cetak Sekarang
        </button>
        <a href="{{ route('pesanan.index') }}" class="btn btn-outline-secondary px-5 rounded-pill">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>