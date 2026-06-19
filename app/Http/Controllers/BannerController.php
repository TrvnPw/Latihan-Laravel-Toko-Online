<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    // Tampil Data Banner
    public function index()
    {
        $banners = Banner::orderBy('id', 'desc')->get();
        return view('backend.v_banner.index', compact('banners'));
    }

    // Form Tambah Banner
    public function create()
    {
        return view('backend.v_banner.create');
    }

    // Simpan Banner ke DB & Folder Storage
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $namaFile = time() . '.' . $request->foto->extension();
        $request->foto->storeAs('public/img-banner', $namaFile);

        Banner::create([
            'foto' => $namaFile,
            'status' => 1
        ]);

        return redirect()->route('backend.banner.index')->with('success', 'Banner berhasil ditambahkan!');
    }

    // Hapus Banner
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if (Storage::exists('public/img-banner/' . $banner->foto)) {
            Storage::delete('public/img-banner/' . $banner->foto);
        }

        $banner->delete();

        return back()->with('success', 'Banner berhasil dihapus!');
    }
}
