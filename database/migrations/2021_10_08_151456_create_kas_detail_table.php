<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignID('id_kas')
                ->constrained('kas')
                ->onDelete('cascade');
            $table->string('nama');
            $table->integer('qty');
            $table->integer('harga');
            $table->integer('subtotal');
            $table->string('kategori');
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
        Schema::dropIfExists('kas_detail');
    }
}
