<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->string('kategori');
            $table->string('unit');
            $table->integer('stok_awal')->default(0);
            $table->integer('stok_minimum')->default(0);
            $table->integer('stok_sekarang')->default(0);
            $table->float('harga',12,2);
            $table->string('foto')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('items');
    }
}
