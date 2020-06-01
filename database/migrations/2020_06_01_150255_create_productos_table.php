<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); 
            $table->string('descripcion'); 
            $table->string('precio'); 
            $table->string('codigo'); 
            $table->string('foto'); 
            $table->timestamps();
            $table->bigInteger('id_subcategoria')->unsigned(); // ID DEL USUARIO DEL PERFIL
            $table->bigInteger('id_categoria')->unsigned(); // ID DEL USUARIO DEL PERFIL
            $table->foreign('id_subcategoria')->references('id')->on('subcategorias'); // FK: user_id
            $table->foreign('id_categoria')->references('id')->on('categorias'); // FK: user_id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
