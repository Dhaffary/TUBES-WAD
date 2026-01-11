<body onload="window.print()"> <div style="text-align: center;">
        <h2>NOTA PEMESANAN FOTOKOPI DIGITAL</h2>
        <hr>
    </div>
    <p>ID Pesanan: #{{ $pesanan->id }}</p>
    <p>Nama Pelanggan: {{ $pesanan->user->name }}</p>
    <p>Layanan: {{ $pesanan->layanan->nama_layanan }}</p>
    <p>Jumlah: {{ $pesanan->jumlah }} Lembar</p>
    <h3>Total Bayar: Rp {{ number_format($pesanan->total_biaya) }}</h3>
</body>