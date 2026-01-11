@extends('layouts.app')
@section('content')
<div class="card p-4">
    <div class="d-flex justify-content-between mb-3">
        <h4>Daftar Layanan</h4>
        <a href="{{ route('layanan.create') }}" class="btn btn-primary">Tambah Layanan</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Layanan</th>
                <th>Harga</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($layanans as $l)
            <tr>
                <td>{{ $l->nama_layanan }}</td>
                <td>Rp {{ number_format($l->harga) }}</td>
                <td>{{ $l->deskripsi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection