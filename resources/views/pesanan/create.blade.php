@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <a href="{{ route('dashboard') }}" class="text-decoration-none mb-3 d-inline-block text-muted">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Dashboard
            </a>

            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white p-3 border-0">
                    <h5 class="mb-0 text-center text-uppercase fw-bold">
                        📋 Form Pemesanan Jasa Fotokopi
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('pesanan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Pilih Jasa Fotokopi/Print</label>
                            <select name="layanan_id" class="form-select @error('layanan_id') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Pilih Jasa --</option>
                                @foreach($layanans as $l)
    <option value="{{ $l->id }}">
        {{ $l->nama_layanan }} - (Rp {{ number_format($l->harga) }})
    </option>
@endforeach
                            </select>
                            @error('layanan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Jumlah (Lembar/Paket)</label>
                            <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" 
                                   placeholder="Contoh: 10" min="1" value="{{ old('jumlah') }}" required>
                            @error('jumlah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Unggah Dokumen (Bukti/Catatan)</label>
                            <input type="file" name="file_dokumen" class="form-control @error('file_dokumen') is-invalid @enderror" required>
                            <div class="form-text mt-1 text-danger small">
                                <i class="fas fa-info-circle"></i> Format: PDF, JPG, PNG (Max 2MB)
                            </div>
                            @error('file_dokumen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid mt-5">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                                <i class="fas fa-calculator me-2"></i> Buat Pesanan & Hitung Biaya
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4 text-muted small">
                &copy; 2026 Fotokopi Digital System
            </div>
        </div>
    </div>
</div>
@endsection