<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Consumidor;
use App\Detalle_listas;
use Illuminate\Http\Request;

class BloqueoDiario extends Controller
{
    public function __construct (){
        Carbon::setLocale('es');
    }
    public function BloqueoDiario(Request $request){
        if($request->key=='A36472'){
            $date=Carbon::now();
            $date_today=$date->format('Y-m-d').' 23:00:00';
            $listas =  Detalle_listas::
            where('fecha_fin','<',$date)->where('estado',1)->orWhere('estado', 2)
            ->join('listas', 'listas.id', '=', 'detalle_listas.id_comerciante_producto')
            ->join('horario', 'horario.id', '=', 'listas.id_horario')
            ->groupBy('id_lista')
            ->get();
            foreach ($listas as $key => $lista) {
                $usuario = Consumidor::where('id',$lista->id_consumidor)->first();
                $user_update = User::find($usuario->id); 
                $user_update->remember_token =  $date->add(15, 'day');
                $user_update->save();
            }
        }
    }
}
