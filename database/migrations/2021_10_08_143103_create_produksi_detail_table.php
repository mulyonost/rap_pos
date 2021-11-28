<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksiDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produksi_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignID('id_laporan_produksi')->constrained('produksi')->onDelete('cascade');
            $table->string('no_matras')->nullable();
            $table->foreignID('id_aluminium_base')->constrained('aluminium_base');
            $table->integer('qty');
            $table->decimal('berat', 5, 3);
            $table->float('total', 7, 3);
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
        Schema::dropIfExists('produksi_detail');
    }
}
