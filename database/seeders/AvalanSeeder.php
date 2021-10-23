<?php

namespace Database\Seeders;

use App\Models\Avalan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvalanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('avalan')->insert([
            [
                'id_supplier' => 1,
                'nama' => 'KAWAT',
                'harga' => 37000,
            ],
            [
                'id_supplier' => 1,
                'nama' => 'SIKU',
                'harga' => 32500,
            ],
        ]);

        // Avalan::create([
        //     //isi sesuatu
        // ]);
    }
}
