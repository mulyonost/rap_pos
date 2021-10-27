<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_packing', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->date('tanggal');
            $table->integer('total_btg');
            $table->integer('total_colly');
            $table->integer('total_cacat')->nullable();
            $table->string('foto')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('laporan_packing');
    }
}
