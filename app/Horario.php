<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horario';
    protected $fillable = [
        'id', 'fecha_inicio', 'fecha_fin','cupo','created_at', 'updated_at'
    ];
}
