<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanProduksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_produksi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_laporan_produksi');
            $table->date('tanggal');
            $table->string('anggota');
            $table->string('mesin');
            $table->string('shift');
            $table->integer('total_produksi');
            $table->integer('jumlah_billet');
            $table->integer('jumlah_avalan');
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan_produksi');
    }
}
