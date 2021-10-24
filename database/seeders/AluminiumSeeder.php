<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AluminiumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('aluminium')->insert([
            [
                'nama' => 'HOLLOW 22 X 22 KOTAK BR',
                'base_name' => 'hollow-22-x-22-kotak',
                'finishing' => 'BR',
                'kategori' => 'ALUMINIUM',
                'berat_maksimal' => 0.55,
                'stok_awal' => 0,
                'stok_minimum' => 0,
                'stok_sekarang' => 0,
                'berat_jual' => 0.55,
                'harga_jual' => 34500,
                'foto' => 'jpg',
                'keterangan' => \Str::random(15),
            ],
            [
                'nama' => 'HOLLOW 22 X 22 KOTAK CA',
                'base_name' => 'hollow-22-x-22-kotak',
                'finishing' => 'CA',
                'kategori' => 'ALUMINIUM',
                'berat_maksimal' => 0.55,
                'stok_awal' => 0,
                'stok_minimum' => 0,
                'stok_sekarang' => 0,
                'berat_jual' => 0.55,
                'harga_jual' => 30500,
                'foto' => 'jpg',
                'keterangan' => \Str::random(15),
            ],
            [
                'nama' => 'HOLLOW 10 X 21 TANDUK CA',
                'base_name' => 'hollow-10-x-21-tanduk',
                'finishing' => 'CA',
                'kategori' => 'ALUMINIUM',
                'berat_maksimal' => 0.65,
                'stok_awal' => 0,
                'stok_minimum' => 0,
                'stok_sekarang' => 0,
                'berat_jual' => 0.65,
                'harga_jual' => 35500,
                'foto' => 'jpg',
                'keterangan' => \Str::random(15),
            ]
        ]);
    }
}
