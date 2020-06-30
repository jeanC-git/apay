<?php

namespace App\Http\Controllers\Api;

use App\Consumidor;
use App\Detalle_listas;
use Illuminate\Http\Request;
use App\Comerciante_productos;
use App\Http\Controllers\Controller;

class ApiComercianteDetalleLista extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $porciones = explode(":", $id);
        $id_lista   = $porciones[0];
        $id_puesto  = $porciones[1];
        $detalle_listas=Detalle_listas::
                join('comerciante_productos','detalle_listas.id_comerciante_producto','=','comerciante_productos.id')
                ->join('listas','listas.id','=','detalle_listas.id_lista')
                ->join('productos','productos.id','=','comerciante_productos.id_producto')
                ->where('detalle_listas.id_lista',$id_lista)
                ->where('comerciante_productos.id_puesto',$id_puesto)
                ->get();
        foreach ($detalle_listas as $value) {
            if ($value->estado==1) {
                $value["estado_switch"]=false;
            }else {
                $value["estado_switch"]=true;
            }
        }
        return response()->json(['data' => $detalle_listas]);
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
    public function update(Request $request, $id)
    {
        
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
