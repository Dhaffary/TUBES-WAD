@extends('layouts.app')

@section('content')
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 rounded-3" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 fw-bold">
                <i class="fas fa-history me-2"></i>
                @if(Auth::user()->role == 'admin') Semua Pesanan @else Riwayat Pesanan Saya @endif
            </h5>
            @if(Auth::user()->role == 'pelanggan')
            <a href="{{ route('pesanan.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                <i class="fas fa-plus me-1"></i>Pesanan Baru
            </a>
            @endif
        </div>

        {{-- Filter & Search (Admin) --}}
        @if(Auth::user()->role == 'admin')
        <div class="bg-light p-3 border-bottom">
            <form method="GET" action="{{ route('admin.pesanan.index') }}" class="row g-2 align-items-end">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control form-control-sm rounded-3"
                           placeholder="Cari nama pelanggan atau layanan..."
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm rounded-3">
                        <option value="">Semua Status</option>
                        <option value="menunggu"   {{ request('status') == 'menunggu'   ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses"   {{ request('status') == 'diproses'   ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai"    {{ request('status') == 'selesai'    ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-sm w-100 rounded-3">
                        <i class="fas fa-search me-1"></i>Filter
                    </button>
                </div>
                @if(request('search') || request('status'))
                <div class="col-md-2">
                    <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-secondary btn-sm w-100 rounded-3">
                        <i class="fas fa-times me-1"></i>Reset
                    </a>
                </div>
                @endif
            </form>
        </div>
        @endif

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4" style="width:60px">#</th>
                            @if(Auth::user()->role == 'admin')
                            <th>Pelanggan</th>
                            @endif
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
                            <td class="px-4 text-muted fw-bold">#{{ $p->id }}</td>
                            @if(Auth::user()->role == 'admin')
                            <td>
                                <span class="fw-semibold">{{ $p->user->name }}</span><br>
                                <small class="text-muted">{{ $p->user->email }}</small>
                            </td>
                            @endif
                            <td>
                                <span class="fw-semibold">{{ $p->layanan->nama_layanan }}</span><br>
                                <small class="text-muted">
                                    <i class="fas fa-layer-group me-1"></i>{{ $p->jumlah }} Lembar/Paket
                                </small>
                            </td>
                            <td class="fw-bold text-primary">
                                Rp {{ number_format($p->total_biaya, 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <a href="{{ asset('uploads/dokumen/'.$p->file_dokumen) }}" target="_blank"
                                   class="btn btn-outline-secondary btn-sm rounded-3">
                                    <i class="fas fa-file me-1"></i>Lihat
                                </a>
                            </td>
                            <td class="text-center">
                                @if($p->status_pesanan == 'menunggu')
                                    <span class="badge rounded-pill bg-warning text-dark px-3 py-2">⏳ Menunggu</span>
                                @elseif($p->status_pesanan == 'diproses')
                                    <span class="badge rounded-pill bg-info text-white px-3 py-2">⚙️ Diproses</span>
                                @elseif($p->status_pesanan == 'selesai')
                                    <span class="badge rounded-pill bg-success text-white px-3 py-2">✅ Selesai</span>
                                @else
                                    <span class="badge rounded-pill bg-danger text-white px-3 py-2">❌ Dibatalkan</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if(Auth::user()->role == 'admin')
                                <form action="{{ route('pesanan.updateStatus', $p->id) }}" method="POST" class="d-inline mb-1">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status_pesanan" class="form-select form-select-sm d-inline-block w-auto rounded-3"
                                            onchange="this.form.submit()" style="min-width:130px;">
                                        <option value="menunggu"   {{ $p->status_pesanan == 'menunggu'   ? 'selected' : '' }}>⏳ Menunggu</option>
                                        <option value="diproses"   {{ $p->status_pesanan == 'diproses'   ? 'selected' : '' }}>⚙️ Diproses</option>
                                        <option value="selesai"    {{ $p->status_pesanan == 'selesai'    ? 'selected' : '' }}>✅ Selesai</option>
                                        <option value="dibatalkan" {{ $p->status_pesanan == 'dibatalkan' ? 'selected' : '' }}>❌ Dibatalkan</option>
                                    </select>
                                </form>
                                @endif
                                <a href="{{ route('pesanan.cetak', $p->id) }}" class="btn btn-info btn-sm text-white rounded-3">
                                    <i class="fas fa-print me-1"></i>Cetak
                                </a>
                                @if(Auth::user()->role == 'pelanggan' && $p->status_pesanan == 'menunggu')
                                <form action="{{ route('pesanan.destroy', $p->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm rounded-3"
                                            onclick="return confirm('Batalkan pesanan ini?')">
                                        <i class="fas fa-times me-1"></i>Batal
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 d-block opacity-25"></i>
                                Belum ada riwayat pesanan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        @if($pesanans->hasPages())
        <div class="card-footer bg-white border-0 d-flex justify-content-center py-3">
            {{ $pesanans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection