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
        Schema::create('variasi_produk', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel produk (kalau produk dihapus, variasinya ikut terhapus)
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');
            $table->string('nama_variasi'); // Contoh: "Ukuran M", "Warna Merah"
            $table->double('harga_variasi'); // Harga untuk variasi ini
            $table->integer('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variasi_produk');
    }
};
