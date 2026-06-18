<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        // Ambil SEMUA transaksi, urutkan dari yang paling baru.
        // Kita panggil relasi 'user' biar tahu siapa yang beli (kalau dia login).
        // Kita panggil relasi 'variasi.produk' biar tahu barang apa yang dibeli.
        $transaksi = Transaksi::with(['user', 'variasi.produk'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.v_transaksi.index', compact('transaksi'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi input status
        $request->validate([
            'status' => 'required|in:pending,lunas,batal'
        ]);

        // Cari transaksi dan ubah statusnya
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = $request->status;
        $transaksi->save();

        return redirect()->back()->with('success', 'Status transaksi berhasil diperbarui!');
    }
}
