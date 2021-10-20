<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPackingDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_packing_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignID('id_laporan_packing');
            $table->foreignID('id_aluminium');
            $table->integer('qty_colly');
            $table->integer('qty_isi');
            $table->integer('qty_subtotal');
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
        Schema::dropIfExists('laporan_packing_detail');
    }
}
