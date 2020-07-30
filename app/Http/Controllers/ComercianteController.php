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
        //VERIFICAR NOMBRE DEL PUESTO
        $verificar_nombre = DB::table('puestos')->where('nombre',$request->data['nombre_puesto'])->get();
        if(count($verificar_nombre) > 0){
            return response()->json(['data'=>'Ya existe el nombre del puesto, porfavor escoger otro','result'=>'error']);
        }
        // VERIFICAR NUMERO DE PUESTO
        $verificar_numero = DB::table('puestos')->where('numero',$request->data['numero_puesto'])->get();
        if(count($verificar_numero) > 0){
            return response()->json(['data'=>'Ya existe el numero de puesto','result'=>'error']);
        }
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
        return response()->json(['data'=>'El puesto ha sido registrado','result'=>'success']);
    }
    function Verificar_puestos(Request $request){
        $id_comerciante= DB::table('comerciantes')->select('comerciantes.id')
                            ->join('users','users.id','=','comerciantes.id_user')
                            ->where('comerciantes.id_user', $request->data)
                            ->first();
        $cantidad=DB::table('puestos')->select('puestos.*')
                            ->where('id_comerciante',$id_comerciante->id)->get();
        return json_encode(['data'=>$cantidad]);
    }
}
