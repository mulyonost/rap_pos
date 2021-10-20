<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanProduksiDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_produksi_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_matras');
            $table->foreignID('id_laporan_produksi');
            $table->foreignID('id_aluminium');
            $table->decimal('berat', 5, 3);
            $table->integer('qty');
            $table->integer('total');
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
        Schema::dropIfExists('laporan_produksi_detail');
    }
}
