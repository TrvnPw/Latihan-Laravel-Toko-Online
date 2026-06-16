<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariasiProduk extends Model
{
    protected $guarded = []; // Biar semua kolom bisa diisi

    // Tambahkan baris ini agar Laravel tahu nama tabelnya persis
    protected $table = 'variasi_produk';
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
