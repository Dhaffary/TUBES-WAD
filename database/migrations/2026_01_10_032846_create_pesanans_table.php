<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('pesanans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained();
        $table->foreignId('layanan_id')->constrained();
        $table->datetime('tanggal_pemesanan'); // KOLOM YANG HILANG
        $table->integer('jumlah');
        $table->integer('harga_satuan');
        $table->integer('total_biaya');
        $table->string('file_dokumen');
        $table->string('status_pesanan')->default('menunggu');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
