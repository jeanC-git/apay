<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComercianteController extends Controller
{
    function Mis_productos(){
        $id_comerciante= DB::table('comerciantes')->select('comerciantes.id')
                                                ->join('users','users.id','=','comerciantes.id_user')
                                                ->where('comerciantes.id_user',auth()->user()->id)
                                                ->first();
        $comerciante = DB::table('puestos')->where('id_comerciante',$id_comerciante->id)->get();
        if(count($comerciante) == 0){
            $mensaje =  [
                'Titulo' => 'Debe registrar su puesto antes de registrar su producto',
                'Cuerpo' => 'required',
            ];
            return view('comerciante.registro_puesto',$mensaje);
        }else{
            return view('comerciante.mis-productos');
        }
    }
    function RegistrarPuesto(Request $request){
        $id_comerciante= DB::table('comerciantes')->select('comerciantes.id')
                                                ->join('users','users.id','=','comerciantes.id_user')
                                                ->where('comerciantes.id_user',$request->data['id_user'])
                                                ->first();
        DB::table('puestos')->insert(
            ['nombre' => $request->data['nombre_puesto'],
            'cellphone' => $request->data['celular'],
            'numero' => $request->data['numero_puesto'],
            'id_comerciante' => $id_comerciante->id,
            ]
        );
    }
    function Verificar_puestos(Request $request){
        $id_comerciante= DB::table('comerciantes')->select('comerciantes.id')
                            ->join('users','users.id','=','comerciantes.id_user')
                            ->where('comerciantes.id_user',$request->data)
                            ->first();
        $cantidad=DB::table('puestos')->select('puestos.*')
                            ->where('id_comerciante',$id_comerciante->id)->get();
        return json_encode(['data'=>$cantidad]);
    }
}
