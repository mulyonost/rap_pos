<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengambilanBahanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengambilan_bahan_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengambilan_bahan')->constrained('pengambilan_bahan', 'id')->onDelete('cascade');
            $table->foreignId('id_item')->constrained('items', 'id')->onDelete('cascade');
            $table->float('qty', 7, 2);
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
        Schema::dropIfExists('pengambilan_bahan_detail');
    }
}
