<?php
namespace App\Http\Controllers;
use App\Models\User;

class DashboardController extends Controller {
    public function index() {
        // Data ringkasan untuk dashboard (Zacky)
        $data = [
            'total_pelanggan' => User::where('role', 'pelanggan')->count(),
            'total_layanan' => 0, // Nanti diisi oleh Hans
            'pesanan_baru' => 0,  // Nanti diisi oleh Arief
        ];
        return view('admin.dashboard', $data);
    }
}