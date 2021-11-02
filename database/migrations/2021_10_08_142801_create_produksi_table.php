<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produksi', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_laporan');
            $table->date('tanggal');
            $table->string('anggota')->nullable();
            $table->string('mesin');
            $table->string('shift');
            $table->float('total_produksi', 7, 3);
            $table->integer('jumlah_billet')->default(0)->nullable();
            $table->integer('jumlah_avalan')->default(0)->nullable();
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('produksi');
    }
}
