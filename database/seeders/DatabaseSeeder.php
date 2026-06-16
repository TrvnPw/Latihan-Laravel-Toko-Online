<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use App\Models\User;


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

    }
}
