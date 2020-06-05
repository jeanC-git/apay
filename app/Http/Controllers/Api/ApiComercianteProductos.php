<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comerciante_productos;
class ApiComercianteProductos extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_comerciante= Comerciante_productos::select('comerciantes.id')
                                                ->join('comerciantes','comerciantes.id','=','comerciante_productos.id_comerciante')
                                                ->where('comerciantes.id_user',$request->data['id_user'])
                                                ->first();
        $data = (object) $request->data;
        $producto = new Comerciante_productos();
        $producto->stock = $data->stock;
        $producto->id_comerciante = $id_comerciante->id;
        $producto->id_producto = $data->nombre;
        $saved = $producto->save();

        return ($saved) ? response()->json(['mensaje' => 'Created :) '], 200) : response()->json(['mensaje' => 'Error :( '], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categorias = Comerciante_productos::select(
            'comerciantes.id as id_comerciante', 
            'comerciante_productos.id as id','comerciante_productos.stock as stock',
            'productos.nombre as nombre','productos.precio as precio','productos.id as id_producto',
            'unidades_medidas.nombre as unidad',
            'subcategorias.id as id_subcategoria','subcategorias.nombre as subcategoria',
            'categorias.id as id_categoria','categorias.nombre as categoria',
            )
        ->join('comerciantes', 'comerciante_productos.id_comerciante', '=', 'comerciantes.id')
        ->join('productos', 'productos.id', '=', 'comerciante_productos.id_producto')
        ->join('unidades_medidas', 'unidades_medidas.id', '=', 'productos.id_und_medida')
        ->join('subcategorias', 'subcategorias.id', '=', 'productos.id_subcategoria')
        ->join('categorias', 'categorias.id', '=', 'subcategorias.id_categoria')
        
        ->where('comerciantes.id_user',$id)->get();
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
        $subcategoria = Comerciante_productos::destroy($id);

        return ($subcategoria) ? response()->json(['mensaje' => 'Eliminated :) '], 200) : response()->json(['mensaje' => 'Error :( '], 404);
    }
}
