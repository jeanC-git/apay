<?php

namespace App\Http\Controllers\Api;

use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ApiProducto extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  GET METHOD
    public function index()
    {
        // $productos = Producto::all();

        $productos = DB::table('productos')
                    ->select('productos.*', 'categorias.nombre as categoria', 'subcategorias.nombre as subcategoria')
                    ->join('subcategorias', 'productos.id_subcategoria', '=', 'subcategorias.id',)
                    ->join('categorias', 'subcategorias.id_categoria', '=', 'categorias.id')
                    ->get();
        return response()->json(['data' => $productos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = (object) $request->data;

        $producto = new Producto();
        $producto->nombre = $data->nombre;
        $producto->descripcion = $data->descripcion;
        $producto->precio = $data->precio;
        $producto->id_subcategoria = $data->id_subcategoria;
        $producto->id_und_medida = $data->id_und_medida;
        $saved = $producto->save();

        return ($saved) ? response()->json(['mensaje' => 'Created :) '], 200) : response()->json(['mensaje' => 'Error :( '], 404);
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
        $data = (object) $request->data;

        $producto = Producto::find($id);
        $producto->nombre = $data->nombre;
        $producto->descripcion = $data->descripcion;
        $producto->precio = $data->precio;
        $producto->id_subcategoria = $data->id_subcategoria;
        $producto->id_und_medida = $data->id_und_medida;
        $saved = $producto->save();

        return ($saved) ? response()->json(['mensaje' => 'Updated :) '], 200) : response()->json(['mensaje' => 'Error :( '], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategoria = Producto::destroy($id);

        return ($subcategoria) ? response()->json(['mensaje' => 'Eliminated :) '], 200) : response()->json(['mensaje' => 'Error :( '], 404);
    }
}
