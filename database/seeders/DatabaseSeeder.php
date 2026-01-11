<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// INI YANG PENTING: Tambahkan baris di bawah ini agar tidak error lagi
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Mematikan pengecekan relasi agar bisa mengosongkan tabel
        Schema::disableForeignKeyConstraints();
        
        // Mengosongkan data lama agar tidak duplikat
        \App\Models\Layanan::truncate();

        // Mengisi data menu fotokopi sesuai kolom Hans (nama_layanan, harga, deskripsi)
        \App\Models\Layanan::create([
            'nama_layanan' => 'Fotokopi A4 (Hitam Putih)',
            'harga'        => 500, 
            'deskripsi'    => 'Fotokopi standar kertas A4 70gr'
        ]);

        \App\Models\Layanan::create([
            'nama_layanan' => 'Print Warna A4',
            'harga'        => 2000,
            'deskripsi'    => 'Print dokumen warna kualitas tinggi'
        ]);

        \App\Models\Layanan::create([
            'nama_layanan' => 'Jilid Mika + Lakban',
            'harga'        => 5000,
            'deskripsi'    => 'Jilid standar untuk tugas/makalah'
        ]);

        // Mengaktifkan kembali pengecekan relasi
        Schema::enableForeignKeyConstraints();
    }
}