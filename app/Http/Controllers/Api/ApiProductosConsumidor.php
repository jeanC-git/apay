<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comerciante_productos;
class ApiProductosConsumidor extends Controller
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
    public function show($id){
        $categorias = Comerciante_productos::select(
            'comerciantes.id as id_comerciante', 
            'comerciante_productos.id as id','comerciante_productos.stock as stock',
            'productos.nombre as nombre','productos.precio as precio','productos.id as id_producto','productos.descripcion','productos.foto as foto',
            'unidades_medidas.nombre as unidad',
            'subcategorias.id as id_subcategoria','subcategorias.nombre as subcategoria',
            'categorias.id as id_categoria','categorias.nombre as categoria',
            )
        ->join('comerciantes', 'comerciante_productos.id_comerciante', '=', 'comerciantes.id')
        ->join('productos', 'productos.id', '=', 'comerciante_productos.id_producto')
        ->join('unidades_medidas', 'unidades_medidas.id', '=', 'productos.id_und_medida')
        ->join('subcategorias', 'subcategorias.id', '=', 'productos.id_subcategoria')
        ->join('categorias', 'categorias.id', '=', 'subcategorias.id_categoria')
        ->orderBy('stock', 'desc')
        ->where('productos.nombre','like','%'.$id.'%')
        ->get();
        return response()->json(['data' => $categorias]);
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
