<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\VariasiProduk;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Zackana Store',
            'email' => 'zackana@admin.com',
            'role' => '1',
            'status' => 1,
            'hp' => '0812345678901',
            'password' => bcrypt('P@55word'),
        ]);
        #untuk record berikutnya silahkan, beri nilai berbeda pada nilai: nama, email, hp dengan nilai masing-masing anggota kelompok 
        User::create([
            'nama' => 'Revan',
            'email' => 'revan@admin.com',
            'role' => '1',
            'status' => 1,
            'hp' => '081234567892',
            'password' => bcrypt('P@55word'),
        ]);

        User::create([
            'nama' => 'Zacky',
            'email' => 'zacky@admin.com',
            'role' => '1',
            'status' => 1,
            'hp' => '081234567892',
            'password' => bcrypt('P@55word'),
        ]);

        User::create([
            'nama' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => '0',
            'status' => 1,
            'hp' => '081234567892',
            'password' => bcrypt('P@55word'),
        ]);
        #data kategori 
        Kategori::create([
            'nama_kategori' => 'Apk Premium',
        ]);

        Kategori::create([
            'nama_kategori' => 'Top up Game',
        ]);

        #data produk

        #untuk produk ke 1
        // 1. Buat data produknya
        $produk1 = Produk::create([
            'kategori_id' => 1, // 'Apk Premium'
            'user_id'     => 1, // 'Zackana Store'
            'nama_produk' => 'CapCut',
            'status'      => 1
        ]);

        // 2. Buat variasinya berdasarkan ID produk di atas
        VariasiProduk::create([
            'produk_id'     => $produk1->id,
            'nama_variasi'  => 'Private 1 Bulan',
            'harga_variasi' => 22000,
            'stok'          => 99
        ]);

        VariasiProduk::create([
            'produk_id'     => $produk1->id,
            'nama_variasi'  => 'Private 1 Tahun',
            'harga_variasi' => 50000,
            'stok'          => 99
        ]);

        #untuk produk ke 2
        $produk2 = Produk::create([
            'kategori_id' => 2, // 'Top up Game'
            'user_id'     => 1, // 'Zackana Store'
            'nama_produk' => 'Diamond Ml',            
            'status'      => 1
        ]);

        // 2. Buat variasinya berdasarkan ID produk di atas
        VariasiProduk::create([
            'produk_id'     => $produk2->id,
            'nama_variasi'  => 'Diamond 1',
            'harga_variasi' => 1000,
            'stok'          => 99
        ]);

        VariasiProduk::create([
            'produk_id'     => $produk2->id,
            'nama_variasi'  => 'Diamond 3',
            'harga_variasi' => 1500,
            'stok'          => 99
        ]);
    }
}
