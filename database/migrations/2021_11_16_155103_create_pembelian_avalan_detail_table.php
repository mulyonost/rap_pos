<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembelianAvalanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelian_avalan_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pembelian_avalan')->constrained('pembelian_avalan')->onDelete('cascade');
            $table->foreignId('id_avalan')->constrained('avalan');
            $table->integer('qty');
            $table->float('potongan', 7, 2)->default(0);
            $table->float('qty_akhir', 7, 2);
            $table->integer('harga');
            $table->bigInteger('subtotal');
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
        Schema::dropIfExists('pembelian_avalan_detail');
    }
}
