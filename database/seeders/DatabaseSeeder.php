<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Produk;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@admin.com',
            'role' => '1',
            'status' => 1,
            'hp' => '0812345678901',
            'password' => bcrypt('P@55word'),
        ]);
        #untuk record berikutnya silahkan, beri nilai berbeda pada nilai: nama, email, hp dengan nilai masing-masing anggota kelompok 
        User::create([
            'nama' => 'Sopian Aji',
            'email' => 'sopianaji@admin.com',
            'role' => '0',
            'status' => 1,
            'hp' => '081234567892',
            'password' => bcrypt('P@55word'),
        ]);
        User::create([
            'nama' => 'Revan',
            'email' => 'revan@admin.com',
            'role' => '0',
            'status' => 1,
            'hp' => '081234567892',
            'password' => bcrypt('P@55word'),
        ]);
        User::create([
            'nama' => 'Zackana',
            'email' => 'zackana@admin.com',
            'role' => '0',
            'status' => 0,
            'hp' => '081234567892',
            'password' => bcrypt('P@55word'),
        ]);

        #data kategori
        Kategori::create([
            'nama_kategori' => 'Brownies',
        ]);
        Kategori::create([
            'nama_kategori' => 'Combro',
        ]);
        Kategori::create([
            'nama_kategori' => 'Dawet',
        ]);
        Kategori::create([
            'nama_kategori' => 'Mochi',
        ]);
        Kategori::create([
            'nama_kategori' => 'Wingko',
        ]);

        #data produk
        // Produk::create([
        //     'kategori_id' => 1,
        //     'user_id' => 1,
        //     'status' => 1,
        //     'nama_produk' => 'Wingko Original',
        //     'detail' => 'Wingko enak dan legit',
        //     'harga' => 15000,
        //     'stok' => 50,
        //     'berat' => 0.5,
        //     'foto' => 'image.img-default.jpg',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
