@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card p-4 shadow-sm">
        <div class="d-flex justify-content-between mb-3">
            <h4>Manajemen Pelanggan</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah"> Tambah Pelanggan</button>
        </div>

        <form action="{{ route('pelanggan.index') }}" method="GET" class="mb-3">
            <input type="text" name="search" class="form-control" placeholder="Cari nama pelanggan..." value="{{ request('search') }}">
        </form>

        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pelanggans as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->no_telepon }}</td>
                    <td><span class="badge {{ $p->status_pelanggan == 'aktif' ? 'bg-success' : 'bg-danger' }}">{{ $p->status_pelanggan }}</span></td>
                    <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1">
  <div class="modal-dialog">
    <form action="{{ route('pelanggan.store') }}" method="POST" class="modal-content">
        @csrf
        <div class="modal-header"><h5>Tambah Pelanggan Baru</h5></div>
        <div class="modal-body">
            <input type="text" name="name" class="form-control mb-2" placeholder="Nama" required>
            <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
            <textarea name="alamat" class="form-control mb-2" placeholder="Alamat"></textarea>
            <input type="text" name="no_telepon" class="form-control mb-2" placeholder="No Telepon">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
    </form>
  </div>
</div>
@endsection