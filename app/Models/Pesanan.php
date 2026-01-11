<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    // Nama tabel jika berbeda dengan nama model (opsional)
    protected $table = 'pesanans';

    // Mass Assignment: Kolom yang boleh diisi secara masif
    protected $fillable = [
    'user_id', 
    'layanan_id', 
    'tanggal_pemesanan', // Tambahkan ini
    'jumlah', 
    'harga_satuan', 
    'total_biaya', 
    'file_dokumen', 
    'status_pesanan'
];

    /**
     * Relasi ke User (Pemesan)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Layanan (Menu/Jasa)
     */
    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
}