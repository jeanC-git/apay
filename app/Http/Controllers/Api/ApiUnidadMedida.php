<?php

namespace App\Http\Controllers\Api;
use App\UnidadMedida;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiUnidadMedida extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidad_medida = UnidadMedida::all();
        return response()->json(['data' => $unidad_medida]);
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
        $unidades = UnidadMedida::select('unidades_medidas.*', 'productos.precio','productos.descripcion', 'productos.nombre as prodNom')
                                ->join('productos', 'unidades_medidas.id', '=', 'productos.id_und_medida')
                                ->where('productos.id',$id)
                                ->first();
                                
        return response()->json(['data' => $unidades]);
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
