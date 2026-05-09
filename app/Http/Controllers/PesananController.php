<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Layanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PesananController extends Controller
{
   public function index(Request $request)
{
    if (Auth::user()->role == 'admin') {
        $query = Pesanan::with(['user', 'layanan'])->latest();

        // Filter search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            })->orWhereHas('layanan', function($q) use ($search) {
                $q->where('nama_layanan', 'like', "%{$search}%");
            });
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status_pesanan', $request->status);
        }

        $pesanans = $query->paginate(10)->withQueryString();
    } else {
        $pesanans = Pesanan::with('layanan')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
    }

    return view('pesanan.index', compact('pesanans'));
}

    // 2. FORM CREATE: Menampilkan form pemesanan
    public function create()
    {
        $layanans = Layanan::all(); 
        return view('pesanan.create', compact('layanans'));
    }

    // 3. STORE: Logic Penyimpanan & Perhitungan Biaya Otomatis
    public function store(Request $request)
    {
        $request->validate([
            'layanan_id'   => 'required|exists:layanans,id',
            'jumlah'       => 'required|numeric|min:1',
            'file_dokumen' => 'required|mimes:pdf,jpg,png|max:2048',
        ]);

        $layanan = Layanan::findOrFail($request->layanan_id);
        $harga_satuan = $layanan->harga; 
        $total_biaya = $harga_satuan * $request->jumlah;

        $nama_file = null;
        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/dokumen'), $nama_file);
        }

        Pesanan::create([
            'user_id'           => Auth::id(), 
            'layanan_id'        => $request->layanan_id, 
            'tanggal_pemesanan' => now(), 
            'jumlah'            => $request->jumlah,
            'harga_satuan'      => $harga_satuan,
            'total_biaya'       => $total_biaya,
            'file_dokumen'      => $nama_file,
            'status_pesanan'    => 'menunggu', 
        ]);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan Fotokopi Berhasil Dibuat!');
    }

    // 4. UPDATE: Edit pesanan & Hitung ulang biaya otomatis
    public function update(Request $request, $id) 
    {
        $request->validate([
            'layanan_id' => 'required|exists:layanans,id',
            'jumlah'     => 'required|numeric|min:1',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $layanan = Layanan::findOrFail($request->layanan_id);
        
        $harga_satuan = $layanan->harga;
        $total_biaya = $harga_satuan * $request->jumlah;

        $pesanan->update([
            'layanan_id'  => $request->layanan_id,
            'jumlah'      => $request->jumlah,
            'harga_satuan'=> $harga_satuan,
            'total_biaya' => $total_biaya,
        ]);

        return redirect()->back()->with('success', 'Pesanan diperbarui dan biaya dihitung ulang!');
    }

    // 5. DELETE: Batalkan pesanan & Hapus file fisik
    public function destroy($id) 
    {
        $pesanan = Pesanan::findOrFail($id);
        $path = public_path('uploads/dokumen/' . $pesanan->file_dokumen);
        
        if (File::exists($path)) {
            File::delete($path);
        }

        $pesanan->delete();
        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan!');
    }

    // 6. EXPORT: Cetak Invoice (View)
    public function cetakInvoice($id) 
    {
        $pesanan = Pesanan::with(['user', 'layanan'])->findOrFail($id);
        return view('pesanan.invoice', compact('pesanan'));
    }

    // 7. DEVELOP: Fungsi Cetak (Placeholder)
  public function cetak($id)
{
    $pesanan = \App\Models\Pesanan::with('layanan', 'user')->findOrFail($id);
    
    // Menampilkan halaman khusus untuk print
    return view('pesanan.cetak_detail', compact('pesanan'));
}
// 8. UPDATE STATUS oleh Admin
public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status_pesanan' => 'required|in:menunggu,diproses,selesai,dibatalkan',
    ]);

    $pesanan = Pesanan::findOrFail($id);
    $pesanan->update(['status_pesanan' => $request->status_pesanan]);

    return redirect()->back()->with('success', 'Status pesanan #' . $id . ' berhasil diperbarui!');
}
}