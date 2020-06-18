<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_listas extends Model
{
    protected $table = 'detalle_listas';

    protected $fillable = [
        'id', 'estado', 'precio','cantidad','id_comerciante_producto','lista','created_at', 'updated_at'
    ];
}
