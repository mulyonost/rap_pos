<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('customers')->insert([
            [
                'nama' => 'Jaya Aluminium',
                'alamat' => 'Jl. Maccini Gusung No 23',
                'kontak' => '08535453252',
                'nama_kontak' => 'Ningsih',
                'keterangan' => \Str::random(15),
            ],
            [
                'nama' => 'Maria',
                'alamat' => 'Banjarmasin',
                'kontak' => '08535455552',
                'nama_kontak' => 'Maria',
                'keterangan' => \Str::random(15),
            ],
        ]);
    }
}
