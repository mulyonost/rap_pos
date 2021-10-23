<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('suppliers')->insert([
            [
                'nama' => 'Amin Logam',
                'alamat' => 'Jl. Sunu 3 No 22',
                'kontak' => '08535455452',
                'nama_kontak' => 'Ko Amin',
                'keterangan' => \Str::random(15),
            ]
        ]);
    }
}
