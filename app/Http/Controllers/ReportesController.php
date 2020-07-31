<?php

namespace App\Http\Controllers;

use App\Comerciante;
use App\Detalle_listas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportesController extends Controller
{
    public function Obtener_Reporte(Request $request){
        // Reportes mensuales
        $comerciante =Comerciante::where('id',Auth()->id())->first();
        $detalles = Detalle_listas::
        select(DB::raw('SUM(detalle_listas.cantidad) as total_cantidad'),'comerciante_productos.id_puesto','detalle_listas.cantidad')
        ->where('detalle_listas.estado','=',(int)3)
        ->where('comerciante_productos.id_comerciante',$comerciante->id)
        ->whereBetween('horario.fecha_inicio',[ $request->fecha_inicio.' 05:00:00',$request->fecha_fin .' 23:00:00'])
        ->join('comerciante_productos','comerciante_productos.id','=','detalle_listas.id_comerciante_producto')
        ->join('listas','listas.id','=','detalle_listas.id_lista')
        ->join('horario','horario.id','=','listas.id_horario')
        ->groupBy('detalle_listas.id_lista')
        ->dd();
        // foreach ($detalle_listas as $key => $detalle) {

        // }
        $collection = collect($detalles)->groupBy('id_puesto');
        dd($collection);
        return response()->json($collection,'200');
    }
    public function obtener_mes($mes){
        
    }
}
