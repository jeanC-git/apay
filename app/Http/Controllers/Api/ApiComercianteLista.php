<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Detalle_listas;
use App\Comerciante_productos;
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
            select('detalle_listas.id_lista','listas.codigo_lista','detalle_listas.estado','users.name','horario.fecha_inicio')
            ->where('id_puesto',$id)
            ->join('detalle_listas','detalle_listas.id_comerciante_producto','=','comerciante_productos.id')
            ->join('listas','listas.id','=','detalle_listas.id_lista')
            ->join('consumidores','consumidores.id','=','listas.id_consumidor')
            ->join('users','users.id','=','consumidores.id_user')
            ->join('horario','horario.id','=','listas.id_horario')
            ->groupBy('detalle_listas.id_lista')
            ->get();
        foreach ($listas as  $value) {
            switch ($value->estado) {
                case '1':
                    $value["estado_lista"]='pendiente';
                    break;
                case '2':
                    $value["estado_lista"]='revisado';
                    break;
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
    public function update(Request $request, $id)
    {
        //
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
