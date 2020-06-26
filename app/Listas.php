<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listas extends Model
{
    protected $table = 'listas';

    protected $fillable = [
        'id', 'total_lista','id_horario','id_consumidor','created_at', 'updated_at'
    ];
}
