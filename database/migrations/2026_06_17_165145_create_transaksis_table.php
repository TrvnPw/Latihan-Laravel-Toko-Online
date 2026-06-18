<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            // user_id boleh kosong (nullable) kalau lu mau ngizinin pengunjung yg belum login tetep bisa beli
            // Tapi kalau dia udah login, kita catat ID-nya biar masuk ke invoice dia
            $table->foreignId('user_id')->nullable()->constrained('user')->onDelete('set null');

            // Mencatat barang apa yang dibeli
            $table->foreignId('variasi_id')->constrained('variasi_produk')->onDelete('cascade');

            $table->string('metode_pembayaran'); // BCA, Mandiri, dll
            $table->double('total_harga'); // Total yang harus dibayar
            $table->enum('status', ['pending', 'lunas', 'batal'])->default('lunas'); // Kita anggap lunas dulu sementara
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
