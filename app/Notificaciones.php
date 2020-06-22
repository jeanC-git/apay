<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    protected $table = 'notificaciones';

    protected $fillable = [
        'id', 'mensaje', 'tipo','user_destino','id_user','created_at', 'updated_at'
    ];
}
