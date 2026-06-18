<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Arahkan ke nama tabel yang benar
    protected $table = 'transaksi';

    // Izinkan semua kolom diisi
    protected $guarded = [];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Variasi Produk
    public function variasi()
    {
        return $this->belongsTo(VariasiProduk::class, 'variasi_id');
    }
}
