<?php

namespace App\Http\Controllers\Api;

use App\SubCategoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiSubCategoria extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategorias = SubCategoria::all();
        return response()->json(['data' => $subcategorias]);
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

        $subcategoria = new SubCategoria();
        $subcategoria->nombre = $data->nombre;
        $subcategoria->id_categoria = $data->id_categoria;
        $saved = $subcategoria->save();

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

        $subcategoria = SubCategoria::find($id);
        $subcategoria->nombre = $data->nombre;
        $subcategoria->id_categoria = $data->id_categoria;
        $saved = $subcategoria->save();

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
        $subcategoria = SubCategoria::destroy($id);
        return ($subcategoria) ? response()->json(['mensaje' => 'Eliminated :) '], 200) : response()->json(['mensaje' => 'Error :( '], 404);
    }
    public function show($id){
        $categorias = SubCategoria::where('id_categoria','=',$id)->get();
        return response()->json(['data' => $categorias]);
    }
}
