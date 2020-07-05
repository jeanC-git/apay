<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comerciante extends Model
{
    protected $table = 'comerciantes';

    protected $fillable = [
        'id', 'id_user', 'created_at', 'updated_at'
    ];
}
