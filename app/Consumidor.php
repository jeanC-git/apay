<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumidor extends Model
{
    protected $table = 'consumidores';

    protected $fillable = [
        'id', 'id_user', 'direccion','celular','created_at', 'updated_at'
    ];
}
