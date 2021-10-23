<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPeleburanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_peleburan_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignID('id_laporan_peleburan')->constrained('laporan_peleburan');
            $table->foreignID('id_avalan')->constrained('avalan');
            $table->integer('berat_avalan');
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
        Schema::dropIfExists('laporan_peleburan_detail');
    }
}
