<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAluminiumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluminium', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('finishing');
            $table->string('kategori');
            $table->decimal('berat_maksimal', 5, 3);
            $table->integer('stok_awal')->default(0);
            $table->integer('stok_minimum')->default(0);
            $table->integer('stok_sekarang');
            $table->decimal('berat_jual', 5, 3);
            $table->integer('harga_jual');
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
        Schema::dropIfExists('aluminiums');
    }
}
