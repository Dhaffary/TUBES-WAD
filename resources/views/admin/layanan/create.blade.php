@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <a href="{{ route('layanan.index') }}" class="text-decoration-none mb-3 d-inline-block text-muted small">
                <i class="fas fa-arrow-left me-1"></i>Kembali ke Data Layanan
            </a>

            <div class="card border-0 shadow rounded-4 overflow-hidden">
                <div class="card-header border-0 p-4" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h5 class="mb-0 text-white fw-bold text-center">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Layanan Baru
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('layanan.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-tag me-1 text-primary"></i>Nama Layanan
                            </label>
                            <input type="text" name="nama_layanan"
                                   class="form-control @error('nama_layanan') is-invalid @enderror"
                                   placeholder="Contoh: Fotokopi Hitam Putih"
                                   value="{{ old('nama_layanan') }}" required>
                            @error('nama_layanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-money-bill me-1 text-primary"></i>Harga per Lembar (Rp)
                            </label>
                            <input type="number" name="harga"
                                   class="form-control @error('harga') is-invalid @enderror"
                                   placeholder="Contoh: 500" min="0"
                                   value="{{ old('harga') }}" required>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-align-left me-1 text-primary"></i>Deskripsi (Opsional)
                            </label>
                            <textarea name="deskripsi" rows="3"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      placeholder="Keterangan tambahan tentang layanan ini...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold">
                                <i class="fas fa-save me-2"></i>Simpan Layanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection