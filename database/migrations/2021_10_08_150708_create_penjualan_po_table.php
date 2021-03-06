<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanPoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_po', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_po');
            $table->foreignID('id_customer')->constrained('customers');
            $table->date('tanggal');
            $table->date('due_date');
            $table->integer('total');
            $table->integer('diskon');
            $table->integer('total_akhir');
            $table->string('keterangan');
            $table->boolean('status');
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
        Schema::dropIfExists('penjualan_po');
    }
}
