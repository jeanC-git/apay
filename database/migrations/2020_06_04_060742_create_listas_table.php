<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listas', function (Blueprint $table) {
            $table->id();
            $table->Integer('total_lista');
            $table->bigInteger('id_horario')->unsigned();
            $table->bigInteger('id_consumidor')->unsigned();
            $table->timestamps();
            $table->foreign('id_horario')->references('id')->on('horario');
            $table->foreign('id_consumidor')->references('id')->on('consumidores');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listas');
    }
}
