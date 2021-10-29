<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignID('id_penjualan_po')->constrained('penjualan_po')->nullable();
            $table->string('nomor');
            $table->foreignID('id_customer')->constrained('customers');
            $table->integer('timbangan_mobil')->nullable();
            $table->bigInteger('total');
            $table->string('foto_mobil')->nullable();
            $table->string('foto_nota')->nullable();
            $table->date('tanggal');
            $table->date('due_date');
            $table->string('keterangan');
            $table->boolean('status');
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('penjualan');
    }
}
