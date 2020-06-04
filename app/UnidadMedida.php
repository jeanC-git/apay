<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    protected $table = 'unidades_medidas';
    protected $fillable = [
        'id', 'nombre', 'created_at', 'updated_at'
    ];
}
