<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puestos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); 
            $table->string('cellphone'); 
            $table->Integer('numero'); 
            $table->bigInteger('id_categoria')->unsigned();
            $table->bigInteger('id_comerciante')->unsigned();
            $table->foreign('id_categoria')->references('id')->on('categorias'); // FK: user_id
            $table->foreign('id_comerciante')->references('id')->on('comerciantes'); // FK: user_id
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
        Schema::dropIfExists('puestos');
    }
}
