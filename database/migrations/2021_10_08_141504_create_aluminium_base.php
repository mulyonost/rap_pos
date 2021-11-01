<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AluminiumBase extends Migration
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
            $table->decimal('berat_avg', 5, 3)->nullable();
            $table->decimal('berat_maksimal', 5, 3);
            $table->integer('stok_awal')->default(0);
            $table->integer('stok_minimum')->default(0);
            $table->integer('stok_sekarang');
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
        Schema::dropIfExists('aluminium_base');
    }
}
