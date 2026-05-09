<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $pesanan->id }} - FotokopiDigital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .invoice-box {
            max-width: 680px; margin: 40px auto;
            background: white; border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .invoice-header {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            padding: 32px; color: white;
        }
        .invoice-body { padding: 32px; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 6px; font-size: 14px; }
        .info-label { color: #6c757d; }
        .info-value { font-weight: 600; }
        .total-box {
            background: linear-gradient(135deg, #0d6efd, #0a58ca);
            color: white; border-radius: 12px; padding: 20px 24px;
            margin-top: 24px;
        }
        @media print {
            body { background: white; }
            .invoice-box { box-shadow: none; margin: 0; border-radius: 0; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="invoice-header">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h4 class="fw-bold mb-1"><i class="fas fa-print me-2"></i>FotokopiDigital</h4>
                    <p class="mb-0 opacity-75 small">Jasa Fotokopi & Print Profesional</p>
                </div>
                <div class="text-end">
                    <h5 class="fw-bold mb-1">INVOICE</h5>
                    <p class="mb-0 opacity-75 small">#{{ str_pad($pesanan->id, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
            </div>
        </div>

        <div class="invoice-body">
            <div class="row mb-4">
                <div class="col-6">
                    <p class="text-muted small fw-bold mb-2">TAGIHAN KEPADA</p>
                    <p class="fw-bold mb-1">{{ $pesanan->user->name }}</p>
                    <p class="text-muted small mb-0">{{ $pesanan->user->email }}</p>
                </div>
                <div class="col-6 text-end">
                    <p class="text-muted small fw-bold mb-2">TANGGAL</p>
                    <p class="fw-bold mb-1">{{ \Carbon\Carbon::parse($pesanan->tanggal_pemesanan)->format('d F Y') }}</p>
                    <p class="text-muted small mb-0">{{ \Carbon\Carbon::parse($pesanan->tanggal_pemesanan)->format('H:i') }} WIB</p>
                </div>
            </div>

            <hr>

            <table class="table table-bordered rounded-3 overflow-hidden">
                <thead class="table-dark">
                    <tr>
                        <th>Layanan</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-end">Harga Satuan</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fw-semibold">{{ $pesanan->layanan->nama_layanan }}</td>
                        <td class="text-center">{{ $pesanan->jumlah }} lembar</td>
                        <td class="text-end">Rp {{ number_format($pesanan->harga_satuan, 0, ',', '.') }}</td>
                        <td class="text-end fw-bold text-primary">Rp {{ number_format($pesanan->total_biaya, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="total-box d-flex justify-content-between align-items-center">
                <span class="fw-bold fs-5">TOTAL PEMBAYARAN</span>
                <span class="fw-bold fs-4">Rp {{ number_format($pesanan->total_biaya, 0, ',', '.') }}</span>
            </div>

            <div class="mt-3 text-center">
                @if($pesanan->status_pesanan == 'selesai')
                    <span class="badge bg-success px-4 py-2 rounded-pill fs-6">✅ LUNAS</span>
                @elseif($pesanan->status_pesanan == 'diproses')
                    <span class="badge bg-info px-4 py-2 rounded-pill fs-6">⚙️ SEDANG DIPROSES</span>
                @elseif($pesanan->status_pesanan == 'menunggu')
                    <span class="badge bg-warning text-dark px-4 py-2 rounded-pill fs-6">⏳ MENUNGGU KONFIRMASI</span>
                @else
                    <span class="badge bg-danger px-4 py-2 rounded-pill fs-6">❌ DIBATALKAN</span>
                @endif
            </div>

            <hr class="mt-4">
            <p class="text-center text-muted small mb-0">
                Terima kasih telah menggunakan layanan FotokopiDigital.<br>
                Invoice ini dicetak otomatis oleh sistem.
            </p>
        </div>
    </div>

    <div class="text-center mt-3 mb-5 no-print">
        <button onclick="window.print()" class="btn btn-primary px-5 rounded-pill me-2">
            <i class="fas fa-print me-2"></i>Cetak Invoice
        </button>
        <a href="{{ route('pesanan.index') }}" class="btn btn-outline-secondary px-5 rounded-pill">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>