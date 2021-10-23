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
        [    'nama' => \Str::random(10),
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
        [   'nama' => 'HOLLOW 22 X 22 KOTAK CW',
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
        ]
        ]);
    }
}
