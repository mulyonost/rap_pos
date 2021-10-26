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
            $table->id();
            $table->foreignID('id_laporan_produksi')->constrained('laporan_produksi')->onDelete('cascade');
            $table->string('nomor_laporan');
            $table->string('no_matras')->nullable();
            $table->foreignID('id_aluminium')->constrained('aluminium');
            $table->integer('qty');
            $table->decimal('berat', 5, 3);
            $table->float('total', 7, 3);
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
