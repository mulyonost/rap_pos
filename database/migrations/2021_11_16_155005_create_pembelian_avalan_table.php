<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianAvalanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_avalan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->date('tanggal');
            $table->date('due_date');
            $table->foreignId('id_supplier')->constrained('suppliers')->onDelete('cascade');
            $table->bigInteger('total_nota');
            $table->integer('diskon');
            $table->bigInteger('total_akhir');
            $table->string('foto_nota')->nullable();
            $table->boolean('status');
            $table->string('keterangan')->nullable();
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('pembelian_avalan');
    }
}
