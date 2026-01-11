<div class="invoice-box" style="border: 1px solid #eee; padding: 30px;">
    <h2>Invoice Pancong Balap</h2>
    <p>ID Pesanan: #{{ $pesanan->id }}</p>
    <p>Pemesan: {{ $pesanan->user->name }}</p>
    <hr>
    <table width="100%">
        <tr>
            <td>{{ $pesanan->layanan->name }} (x{{ $pesanan->jumlah }})</td>
            <td align="right">Rp {{ number_format($pesanan->total_biaya) }}</td>
        </tr>
    </table>
    <hr>
    <h4>Total Bayar: Rp {{ number_format($pesanan->total_biaya) }}</h4>
    <button onclick="window.print()">Cetak Halaman Ini</button>
</div>