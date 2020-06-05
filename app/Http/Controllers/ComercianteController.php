<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComercianteController extends Controller
{
    function RegistrarPuesto(Request $request){
        DB::table('puesto')->insert(
            ['nombre' => $request->data['nombre_puesto'], 
            'cellphone' => $request->data['celular'],
            'numero' => $request->data['numero_puesto'],
            'id_categoria' => $request->data['categoria'],
            ]
        );
    }
}
