<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualanPoDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualan_po_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignID('id_penjualan_po')->constrained('penjualan_po');
            $table->foreignID('id_aluminium')->constrained('aluminium');
            $table->integer('harga');
            $table->integer('qty');
            $table->string('unit');
            $table->integer('subtotal');
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
        Schema::dropIfExists('penjualan_po_detail');
    }
}
