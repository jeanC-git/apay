<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    protected $table = 'subcategorias';


    protected $fillable = [
        'id', 'nombre', 'created_at', 'updated_at', 'id_categoria'
    ];
}
