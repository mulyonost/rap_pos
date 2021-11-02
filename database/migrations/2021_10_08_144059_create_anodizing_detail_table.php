<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnodizingDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anodizing_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignID('id_laporan_anodizing')->constrained('anodizing')->onDelete('cascade');
            $table->string('nomor');
            $table->foreignID('id_aluminium')->constrained('aluminium');
            $table->integer('qty');
            $table->float('berat');
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
        Schema::dropIfExists('anodizing_detail');
    }
}
