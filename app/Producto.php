<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';


    protected $fillable = [
        'id', 'nombre', 'descripcion', 'precio', 'codigo', 'foto', 'id_subcategoria', 'id_categoria', 'created_at', 'updated_at'
    ];





}
