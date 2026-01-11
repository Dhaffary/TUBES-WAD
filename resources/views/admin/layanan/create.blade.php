@extends('layouts.app')

@section('content')
<div class="card p-4 mx-auto" style="max-width: 600px;">
    <h4 class="mb-4">Tambah Layanan Baru</h4>
    
    <form action="{{ route('layanan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama Layanan</label>
            <input type="text" name="nama_layanan" class="form-control" placeholder="Contoh: Print Warna" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Harga (Rp)</label>
            <input type="number" name="harga" class="form-control" placeholder="2000" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>
        
        <div class="d-flex justify-content-between">
            <a href="{{ route('layanan.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </form>
</div>
@endsection