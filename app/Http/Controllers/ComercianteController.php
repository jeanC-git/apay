<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Comerciante_productos;
class ComercianteController extends Controller
{
    function RegistrarPuesto(Request $request){
        $id_comerciante= Comerciante_productos::select('comerciantes.id')
                                                ->join('comerciantes','comerciantes.id','=','comerciante_productos.id_comerciante')
                                                ->where('comerciantes.id_user',$request->data['id_user'])
                                                ->first();
        DB::table('puestos')->insert(
            ['nombre' => $request->data['nombre_puesto'], 
            'cellphone' => $request->data['celular'],
            'numero' => $request->data['numero_puesto'],
            'id_categoria' => $request->data['categoria'],
            'id_comerciante' => $id_comerciante->id,
            ]
        );
    }
    function Verificar_puestos(Request $request){
        $id_comerciante= Comerciante_productos::select('comerciantes.id')
                                                ->join('comerciantes','comerciantes.id','=','comerciante_productos.id_comerciante')
                                                ->where('comerciantes.id_user',$request->data)
                                                ->first();
        $cantidad=DB::table('puestos')->select('puestos.*','categorias.nombre as categoria')
                            ->join('categorias','categorias.id','=','puestos.id_categoria')
                            ->where('id_comerciante',$id_comerciante->id)->get();
        return json_encode(['data'=>$cantidad]);
    }
}
