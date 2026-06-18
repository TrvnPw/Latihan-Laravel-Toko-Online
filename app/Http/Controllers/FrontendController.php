<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\VariasiProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class FrontendController extends Controller
{
    public function index()
    {
        // Mengambil semua produk yang statusnya '1' (Public)
        // Kita pakai 'with' untuk memuat data variasi sekaligus
        $produk = Produk::with('variasi')->where('status', 1)->get();

        return view('frontend.index', compact('produk'));
    }

    public function detail($id)
    {
        // Mengambil detail satu produk beserta variasinya
        $produk = Produk::with('variasi')->findOrFail($id);

        return view('frontend.detail', compact('produk'));
    }

    public function checkout(Request $request)
    {
        // Ambil data produk dan variasi yang dipilih user dari halaman detail
        $variasi = VariasiProduk::with('produk')->findOrFail($request->variasi_id);

        // Tampilkan halaman checkout untuk milih payment
        return view('frontend.checkout', compact('variasi'));
    }

    public function prosesBeli(Request $request)
    {
        // 1. Tambahkan email_tujuan di validasi
        $request->validate([
            'variasi_id' => 'required',
            'metode_pembayaran' => 'required',
            'no_hp_tujuan' => 'required|string|max:20',
            'email_tujuan' => 'required|email|max:255' // Validasi email
        ]);

        return DB::transaction(function () use ($request) {
            $variasi = VariasiProduk::findOrFail($request->variasi_id);

            if ($variasi->stok > 0) {
                $variasi->stok = $variasi->stok - 1;
                $variasi->save();

                // 2. Simpan email dan no_hp ke database
                Transaksi::create([
                    'user_id' => Auth::check() ? Auth::id() : null,
                    'variasi_id' => $variasi->id,
                    'metode_pembayaran' => $request->metode_pembayaran,
                    'total_harga' => $variasi->harga_variasi,
                    'status' => 'pending',
                    'no_hp_tujuan' => $request->no_hp_tujuan,
                    'email_tujuan' => $request->email_tujuan // Simpan emailnya di sini
                ]);

                // CEK SIAPA YANG BELI BIAR NGGAK SALAH ARAH
                if (Auth::check()) {
                    // Kalau member, lempar ke halaman riwayat
                    return redirect()->route('frontend.riwayat')->with('success', 'Pembelian berhasil! Pesanan sedang diproses.');
                } else {
                    // Kalau guest, lempar ke halaman utama
                    return redirect()->route('frontend.index')->with('success', 'Pembelian berhasil! Pesanan sedang diproses. Bukti transaksi akan dikirim ke Email / WA Anda.');
                }
            }

            return redirect()->back()->with('error', 'Maaf, stok sudah habis!');
        });
    }

    public function riwayat()
    {
        // Ambil transaksi milik user yang sedang login
        // Kita gunakan 'with' untuk menarik relasi variasi dan produknya sekaligus biar nggak error
        $transaksi = Transaksi::with(['variasi.produk']) // Pastikan model VariasiProduk punya relasi 'produk'
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc') // Urutkan dari yang paling baru dibeli
            ->get();

        return view('frontend.riwayat', compact('transaksi'));
    }
    public function profile()
    {
        // Kirim data user yang sedang login ke view
        $user = Auth::user();
        return view('frontend.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        // Ganti Auth::user() dengan pencarian ID lewat Model User
        $user = User::find(Auth::id());

        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . $user->id,
            'hp' => 'nullable|string|max:13',
            'password' => 'nullable|min:8|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048' // Validasi file gambar
        ]);

        // Update data basic
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->hp = $request->hp;

        // Kalau user ngisi kolom password, berarti mau ganti password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // --- PROSES UPLOAD FOTO ---
        if ($request->hasFile('foto')) {
            // Hapus foto lama kalau ada biar storage nggak penuh
            if ($user->foto && Storage::disk('public')->exists('img-user/' . $user->foto)) {
                Storage::disk('public')->delete('img-user/' . $user->foto);
            }

            // Simpan foto baru ke folder storage/app/public/img-user
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/img-user', $filename);

            $user->foto = $filename;
        }

        // Nah, sekarang save() dijamin terbaca!
        $user->save();

        return back()->with('success', 'Profil Anda berhasil diperbarui!');
    }
}
