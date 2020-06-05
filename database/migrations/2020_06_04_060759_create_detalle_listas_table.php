<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleListasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_listas', function (Blueprint $table) {
            $table->id();
            $table->Integer('estado');
            $table->Integer('precio');
            $table->Integer('cantidad');
            $table->bigInteger('id_comerciante_producto')->unsigned();
            $table->bigInteger('id_lista')->unsigned();
            $table->timestamps();
            $table->foreign('id_comerciante_producto')->references('id')->on('comerciante_productos');
            $table->foreign('id_lista')->references('id')->on('listas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_listas');
    }
}
