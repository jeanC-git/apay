<?php

namespace App\Http\Controllers\Api;

use App\Detalle_listas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiConsumidorDetalleLista extends Controller
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
        dd($id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id_lista = $id;
        $detalle_lista = Detalle_listas::join('comerciante_productos', 'comerciante_productos.id', '=', 'detalle_listas.id_comerciante_producto')
                            ->join('puestos', 'puestos.id', '=', 'comerciante_productos.id_puesto')
                            ->join('comerciantes', 'comerciantes.id', '=', 'puestos.id_comerciante')
                            ->join('users', 'users.id', '=', 'comerciantes.id_user')
                            ->join('productos', 'productos.id', '=', 'comerciante_productos.id_producto')
                            ->join('unidades_medidas', 'unidades_medidas.id', '=', 'productos.id_und_medida')
                            ->where('id_lista', $id_lista)
                            ->select('detalle_listas.id AS det_lista_id', 'productos.nombre AS producto' ,
                            'detalle_listas.cantidad AS cantidad', 'puestos.nombre AS nombre_puesto',
                            'puestos.numero AS num_puesto',
                            'detalle_listas.estado AS estado', 'unidades_medidas.nombre AS und_medida', 'users.name AS nom_comerciante')
                            ->orderBy('puestos.id')
                            ->get();

        return response()->json([
                    'data' => $detalle_lista
                ]);
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
       
        dd($id);
    }
}
