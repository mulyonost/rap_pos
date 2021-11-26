<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->foreignID('id_supplier')->constrained('suppliers');
            $table->date('tanggal');
            $table->date('due_date');
            $table->boolean('status');
            $table->string('foto')->nullable();
            $table->integer('total');
            $table->string('keterangan')->nullable();
            $table->string('tanggal_bayar')->nullable();
            $table->string('keterangan_bayar')->nullable();
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
        Schema::dropIfExists('pembelian');
    }
}
