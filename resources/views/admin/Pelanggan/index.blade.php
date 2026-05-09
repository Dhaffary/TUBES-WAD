@extends('layouts.app')

@section('content')
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow rounded-4 overflow-hidden">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center p-3">
            <h5 class="mb-0 fw-bold">
                <i class="fas fa-users me-2"></i>Data Pelanggan
            </h5>
            <span class="badge bg-primary rounded-pill px-3">
                Total: {{ $users->count() }} pengguna
            </span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4" style="width:60px">#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Total Pesanan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="px-4 text-muted fw-bold">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-primary bg-opacity-10 d-flex align-items-center justify-content-center fw-bold text-primary"
                                         style="width:36px;height:36px;font-size:14px;">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <span class="fw-semibold">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="text-muted small">{{ $user->email }}</td>
                            <td class="text-muted small">{{ $user->no_hp ?? '-' }}</td>
                            <td class="text-center">
                                @if($user->role == 'admin')
                                    <span class="badge bg-danger rounded-pill px-3">Admin</span>
                                @else
                                    <span class="badge bg-success rounded-pill px-3">Pelanggan</span>
                                @endif
                            </td>
                            <td class="text-center fw-bold text-primary">
                                {{ $user->pesanans()->count() ?? 0 }}
                            </td>
                            <td class="text-center">
                                <form action="{{ route('pelanggan.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm rounded-3"
                                            onclick="return confirm('Hapus pengguna {{ $user->name }}?')">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="fas fa-users fa-3x mb-3 d-block opacity-25"></i>
                                Belum ada data pelanggan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection