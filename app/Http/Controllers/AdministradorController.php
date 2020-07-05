<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class AdministradorController extends Controller
{
    function listar_consumidores(){
        $consumidores = User::whereHas(
            'roles', function($q){
                $q->where('name', 'consumidor');
            }
        )->get();
        return json_encode(['data'=>$consumidores]);
    }
    function listar_comerciantes(){
        $comerciantes = User::whereHas(
            'roles', function($q){
                $q->where('name', 'comerciante');
            }
        )->get();
        return json_encode(['data'=>$comerciantes]);
    }
}
