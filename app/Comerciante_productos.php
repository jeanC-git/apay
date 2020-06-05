<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comerciante_productos extends Model
{
    protected $table = 'comerciante_productos';
    protected $fillable = [
        'id', 'stock', 'id_comerciante','id_producto','created_at', 'updated_at'
    ];
}
