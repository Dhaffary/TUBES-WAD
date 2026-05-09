@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <a href="{{ route('dashboard') }}" class="text-decoration-none mb-3 d-inline-block text-muted small">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
            </a>

            <div class="card border-0 shadow rounded-4 overflow-hidden">
                <div class="card-header border-0 p-4" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h5 class="mb-0 text-white fw-bold text-center">
                        <i class="fas fa-file-alt me-2"></i>Form Pemesanan Jasa Fotokopi
                    </h5>
                </div>
                <div class="card-body p-4">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show small">
                            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('pesanan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Pilih Layanan --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-concierge-bell me-1 text-primary"></i>Pilih Jasa
                            </label>
                            <select name="layanan_id" id="layanan_id"
                                    class="form-select @error('layanan_id') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Pilih Jasa Fotokopi/Print --</option>
                                @foreach($layanans as $l)
                                    <option value="{{ $l->id }}" data-harga="{{ $l->harga }}">
                                        {{ $l->nama_layanan }} — Rp {{ number_format($l->harga, 0, ',', '.') }}/lembar
                                    </option>
                                @endforeach
                            </select>
                            @error('layanan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jumlah --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-layer-group me-1 text-primary"></i>Jumlah (Lembar/Paket)
                            </label>
                            <input type="number" name="jumlah" id="jumlah"
                                   class="form-control @error('jumlah') is-invalid @enderror"
                                   placeholder="Contoh: 10" min="1" value="{{ old('jumlah') }}" required>
                            @error('jumlah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Preview Harga --}}
                        <div id="preview-total"></div>

                        {{-- Upload Dokumen --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-upload me-1 text-primary"></i>Unggah Dokumen
                            </label>
                            <input type="file" name="file_dokumen"
                                   class="form-control @error('file_dokumen') is-invalid @enderror" required>
                            <div class="form-text text-danger small mt-1">
                                <i class="fas fa-info-circle me-1"></i>Format: PDF, JPG, PNG (Maks. 2MB)
                            </div>
                            @error('file_dokumen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm fw-bold">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Pesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4 text-muted small">
                &copy; {{ date('Y') }} FotokopiDigital
            </div>
        </div>
    </div>
</div>

<script>
const hargaLayanan = {
    @foreach($layanans as $l)
    {{ $l->id }}: {{ $l->harga }},
    @endforeach
};

function hitungTotal() {
    const layananId = document.getElementById('layanan_id').value;
    const jumlah    = parseInt(document.getElementById('jumlah').value) || 0;
    const box       = document.getElementById('preview-total');

    if (layananId && hargaLayanan[layananId] && jumlah > 0) {
        const harga   = hargaLayanan[layananId];
        const total   = harga * jumlah;
        const fTotal  = new Intl.NumberFormat('id-ID').format(total);
        const fHarga  = new Intl.NumberFormat('id-ID').format(harga);
        box.innerHTML = `
            <div class="alert alert-primary border-0 rounded-3 mb-4 py-3">
                <div class="d-flex align-items-center">
                    <i class="fas fa-calculator fa-lg me-3 text-primary"></i>
                    <div>
                        <div class="small text-muted">Rp ${fHarga} × ${jumlah} lembar</div>
                        <div class="fw-bold fs-5 text-primary">Estimasi Total: Rp ${fTotal}</div>
                    </div>
                </div>
            </div>`;
    } else {
        box.innerHTML = '';
    }
}

document.getElementById('layanan_id').addEventListener('change', hitungTotal);
document.getElementById('jumlah').addEventListener('input', hitungTotal);
</script>
@endsection