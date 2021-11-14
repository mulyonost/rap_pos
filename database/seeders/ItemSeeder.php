<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('items')->insert([
            [
                'nama' => 'CAUSTIC SODA FLAKES 99% ASAHI',
                'kategori' => 'bahan_kimia',
                'stok_awal' => 0,
                'stok_minimum' => 0,
                'stok_sekarang' => 0,
                'harga_beli' => 19000,
                'foto' => 'jpg',
                'keterangan' => \Str::random(15),
            ],
        ]);
    }
}
