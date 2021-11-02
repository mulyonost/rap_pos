<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackingDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packing_detail', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->foreignID('id_laporan_packing')->constrained('packing')->onDelete('cascade');
            $table->foreignID('id_aluminium')->constrained('aluminium');
            $table->integer('qty_colly');
            $table->integer('qty_isi');
            $table->integer('qty_subtotal');
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
        Schema::dropIfExists('packing_detail');
    }
}
