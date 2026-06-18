<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Helpers\ImageHelper;
use App\Models\FotoProduk;
use App\Models\kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\VariasiProduk;



class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::orderBy('updated_at', 'desc')->get();
        return view('backend.v_produk.index', [
            'judul' => 'Data Produk',
            'index' => $produk
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('backend.v_produk.create', [
            'judul' => 'Tambah Produk',
            'kategori' => $kategori
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi diubah: foto dan stok_variasi jadi 'nullable' (opsional)
        $validatedData = $request->validate([
            'kategori_id' => 'required',
            'nama_produk' => 'required|max:255|unique:produk',
            'detail' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|file|max:1024', // Hapus required, ganti nullable
            // Validasi untuk variasi dinamis
            'nama_variasi' => 'required|array',
            'harga_variasi' => 'required|array',
            'stok_variasi' => 'nullable|array', // Hapus required, ganti nullable
        ], $messages = [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
        ]);

        // 2. Logic upload foto
        $namaFotoDisimpan = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-produk/';

            // Simpan gambar asli 
            $fileName = ImageHelper::uploadAndResize($file, $directory, $originalFileName);

            // create thumbnail 1 (lg) 
            ImageHelper::uploadAndResize($file, $directory, 'thumb_lg_' . $originalFileName, 800, null);

            // create thumbnail 2 (md) 
            ImageHelper::uploadAndResize($file, $directory, 'thumb_md_' . $originalFileName, 500, 519);

            // create thumbnail 3 (sm) 
            ImageHelper::uploadAndResize($file, $directory, 'thumb_sm_' . $originalFileName, 100, 110);

            $namaFotoDisimpan = $originalFileName;
        }

        // 3. Simpan data Produk Utama
        $produk = Produk::create([
            'kategori_id' => $request->kategori_id,
            'user_id' => auth()->id(),
            'status' => 0,
            'nama_produk' => $request->nama_produk,
            'detail' => $request->detail,
            'foto' => $namaFotoDisimpan, // Akan bernilai null jika foto tidak diupload
        ]);

        // 4. Looping dan Simpan data Variasi
        foreach ($request->nama_variasi as $key => $nama) {
            \App\Models\VariasiProduk::create([
                'produk_id'     => $produk->id,
                'nama_variasi'  => $nama,
                'harga_variasi' => $request->harga_variasi[$key],
                // Tambahkan '?? null' jaga-jaga kalau array stok kosong
                'stok'          => $request->stok_variasi[$key] ?? null,
            ]);
        }

        return redirect()->route('backend.produk.index')->with('success', 'Produk dan variasi berhasil tersimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produk = Produk::with('fotoProduk')->findOrFail($id);
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('backend.v_produk.show', [
            'judul' => 'Detail Produk',
            'show' => $produk,
            'kategori' => $kategori
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        return view('backend.v_produk.edit', [
            'judul' => 'Ubah Produk',
            'edit' => $produk,
            'kategori' => $kategori
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produk = Produk::findOrFail($id);

        // 1. Validasi Data
        $rules = [
            'nama_produk'   => 'required|max:255|unique:produk,nama_produk,' . $id,
            'kategori_id'   => 'required',
            'status'        => 'required',
            'detail'        => 'required',
            'foto'          => 'nullable|image|mimes:jpeg,jpg,png,gif|file|max:1024', // Tambah nullable
            'nama_variasi'  => 'required|array',
            'harga_variasi' => 'required|array',
            'stok_variasi'  => 'nullable|array', // Ubah jadi nullable
        ];

        $messages = [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max'   => 'Ukuran file gambar Maksimal adalah 1024 KB.'
        ];

        $validatedData = $request->validate($rules, $messages);
        $validatedData['user_id'] = auth()->id();

        // 2. Logic Upload Foto
        if ($request->hasFile('foto')) {
            // Hapus gambar lama 
            if ($produk->foto) {
                $oldPaths = [
                    public_path('storage/img-produk/') . $produk->foto,
                    public_path('storage/img-produk/') . 'thumb_lg_' . $produk->foto,
                    public_path('storage/img-produk/') . 'thumb_md_' . $produk->foto,
                    public_path('storage/img-produk/') . 'thumb_sm_' . $produk->foto
                ];
                foreach ($oldPaths as $path) {
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            }

            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-produk/';

            ImageHelper::uploadAndResize($file, $directory, $originalFileName);
            ImageHelper::uploadAndResize($file, $directory, 'thumb_lg_' . $originalFileName, 800, null);
            ImageHelper::uploadAndResize($file, $directory, 'thumb_md_' . $originalFileName, 500, 519);
            ImageHelper::uploadAndResize($file, $directory, 'thumb_sm_' . $originalFileName, 100, 110);

            $validatedData['foto'] = $originalFileName;
        } else {
            // Mencegah foto lama terhapus jika update form tidak upload foto baru
            unset($validatedData['foto']);
        }

        // 3. Simpan Update ke tabel 'produk'
        unset($validatedData['nama_variasi']);
        unset($validatedData['harga_variasi']);
        unset($validatedData['stok_variasi']);

        $produk->update($validatedData);

        // 4. Update data ke tabel 'variasi_produk'
        if ($request->has('nama_variasi')) {
            \App\Models\VariasiProduk::where('produk_id', $produk->id)->delete();

            foreach ($request->nama_variasi as $key => $nama) {
                \App\Models\VariasiProduk::create([
                    'produk_id'     => $produk->id,
                    'nama_variasi'  => $nama,
                    'harga_variasi' => $request->harga_variasi[$key],
                    'stok'          => $request->stok_variasi[$key] ?? null,
                ]);
            }
        }

        return redirect()->route('backend.produk.index')->with('success', 'Data berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        //Hapus file foto jika ada
        if ($produk->foto && File::exists(public_path('storage/img-produk/' . $produk->foto))) {
            File::delete(public_path('storage/img-produk/' . $produk->foto));
        }

        //Hapus data produk
        $produk->delete();

        return redirect()
            ->route('backend.produk.index')
            ->with('success', 'Data produk berhasil dihapus.');
    }

    // Method untuk menyimpan foto tambahan 
    public function storeFoto(Request $request)
    {
        // Validasi input 
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'foto_produk.*' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ]);
        if ($request->hasFile('foto_produk')) {
            foreach ($request->file('foto_produk') as $file) {
                // Buat nama file yang unik 
                $extension = $file->getClientOriginalExtension();
                $filename = date('YmdHis') . '_' . uniqid() . '.' . $extension;
                $directory = 'storage/img-produk/';

                // Simpan dan resize gambar menggunakan ImageHelper 
                ImageHelper::uploadAndResize($file, $directory, $filename, 800, null);
                // Simpan data ke database 
                FotoProduk::create([
                    'produk_id' => $request->produk_id,
                    'foto' => $filename,
                ]);
            }
        }
        return redirect()->route('backend.produk.show', $request->produk_id)
            ->with('success', 'Foto berhasil ditambahkan.');
    }

    // Method untuk menghapus foto 
    public function destroyFoto($id)
    {
        $foto = FotoProduk::findOrFail($id);
        $produkId = $foto->produk_id;

        // Hapus file gambar dari storage 
        $imagePath = public_path('storage/img-produk/') . $foto->foto;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        // Hapus record dari database 
        $foto->delete();

        return redirect()->route('backend.produk.show', $produkId)
            ->with('success', 'Foto berhasil dihapus.');
    }

    // Method untuk Form Laporan Produk 
    public function formProduk()
    {
        return view('backend.v_produk.form', [
            'judul' => 'Laporan Data Produk',
        ]);
    }

    // Method untuk Cetak Laporan Produk 
    public function cetakProduk(Request $request)
    {
        // Menambahkan aturan validasi 
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ], [
            'tanggal_awal.required' => 'Tanggal Awal harus diisi.',
            'tanggal_akhir.required' => 'Tanggal Akhir harus diisi.',
            'tanggal_akhir.after_or_equal' => 'Tanggal Akhir harus lebih besar atau sama dengan Tanggal Awal.',
        ]);

        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Pastikan Model Produk lu punya relasi ke 'kategori' dan 'variasi'
        $query = \App\Models\Produk::with(['kategori', 'variasi'])
            ->whereBetween('created_at', [
                $tanggalAwal . ' 00:00:00',
                $tanggalAkhir . ' 23:59:59'
            ])
            ->orderBy('id', 'desc');

        $produk = $query->get();

        return view('backend.v_produk.cetak', [
            'judul' => 'Laporan Data Produk',
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
            'cetak' => $produk // Variabel ini yang ditangkap sama foreach di blade tadi
        ]);
    }
}
