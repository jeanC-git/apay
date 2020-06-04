<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComercianteProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comerciante_productos', function (Blueprint $table) {
            $table->id();
            $table->string('stock'); 
            $table->bigInteger('id_comerciante')->unsigned();
            $table->bigInteger('id_producto')->unsigned();
            $table->timestamps();
            $table->foreign('id_comerciante')->references('id')->on('comerciantes'); 
            $table->foreign('id_producto')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comerciante_productos');
    }
}
