<?php

namespace App\Http\Controllers\Api;
use App\Detalle_listas;
use Illuminate\Http\Request;

use App\Comerciante_productos;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ApiComercianteLista extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fecha_inicio = $request["data"]["date"];
        $id_puesto= $request["data"]["id_puesto"];
        $listas=Comerciante_productos::
            select(DB::raw('count(*) as contador_detalles, detalle_listas.id_lista'),
            DB::raw('SUM(detalle_listas.estado) as total_lista'),'detalle_listas.id_lista','listas.codigo_lista',
            'detalle_listas.estado','users.name','horario.fecha_inicio')
            ->where('id_puesto',$id_puesto);

        if(!empty($fecha_inicio)){
            $listas  = $listas->whereBetween('horario.fecha_inicio',[$fecha_inicio.' 08:00:00',$fecha_inicio.' 19:00:00']);
        }

        $listas=$listas->join('detalle_listas','detalle_listas.id_comerciante_producto','=','comerciante_productos.id')
            ->join('listas','listas.id','=','detalle_listas.id_lista')
            ->join('consumidores','consumidores.id','=','listas.id_consumidor')
            ->join('users','users.id','=','consumidores.id_user')
            ->join('horario','horario.id','=','listas.id_horario')
            ->groupBy('detalle_listas.id_lista')
        ->get();
        foreach ($listas as  $value) {

            if ($value->contador_detalles!==(2*$value->total_lista)) {
                $value["estado_lista"]='PENDIENTE';
            }else{
                $value["estado_lista"]='REVISADO';
            }
        }

        return response()->json(['data' => $listas]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listas=Comerciante_productos::
            select(DB::raw('count(*) as contador_detalles, detalle_listas.id_lista'),DB::raw('SUM(detalle_listas.estado) as total_lista'),'detalle_listas.id_lista','listas.codigo_lista','detalle_listas.estado','users.name','horario.fecha_inicio')
                ->where('id_puesto',$id)
                ->join('detalle_listas','detalle_listas.id_comerciante_producto','=','comerciante_productos.id')
                ->join('listas','listas.id','=','detalle_listas.id_lista')
                ->join('consumidores','consumidores.id','=','listas.id_consumidor')
                ->join('users','users.id','=','consumidores.id_user')
                ->join('horario','horario.id','=','listas.id_horario')
                ->groupBy('detalle_listas.id_lista')
                ->get();

                foreach ($listas as  $value) {
                    if ($value->contador_detalles!==(2*$value->total_lista)) {
                        $value["estado_lista"]='PENDIENTE';
                    }else{
                        $value["estado_lista"]='REVISADO';
                    }
                }
        return response()->json(['data' => $listas]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // ACTUALIZAR ESTADO DE LOS PRODUCTOS QUE LE PERTENECEN A UN COMERCIANTE A RECOGIDO
    public function update(Request $request, $id)
    {
        $data = (object) $request->all();

        $id_detalles_listas = Detalle_listas::
                            join('comerciante_productos' , 'comerciante_productos.id', '=', 'detalle_listas.id_comerciante_producto')
                            ->join('puestos' , 'puestos.id', '=', 'comerciante_productos.id_puesto')
                            ->join('listas' , 'listas.id', '=', 'detalle_listas.id_lista')
                            ->where('detalle_listas.estado', '=', 2)
                            ->where('detalle_listas.id_lista', '=', $id)
                            ->where('comerciante_productos.id_comerciante', '=', $data->id_comerciante)
                            ->where('puestos.id', '=', $data->id_puesto)
                            ->select('detalle_listas.id')
                            ->get();

        foreach ($id_detalles_listas as $key => $value) {

            $det_lista_update = Detalle_listas::find($value->id);
            $det_lista_update->estado = 3; // ESTADO 3 : PRODUCTO RECOGIDO
            $det_lista_update->save();
        }

        return  response()->json([
            'data' => 'Ok :D'
        ], 200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
