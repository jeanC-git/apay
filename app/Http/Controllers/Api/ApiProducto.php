<?php

namespace App\Http\Controllers\Api;

use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ApiProducto extends Controller
{
    //  GET METHOD
    public function index()
    {
        $productos = DB::table('productos')
                    ->select('productos.*', 'categorias.nombre as categoria',
                            'subcategorias.nombre as subcategoria',
                            'unidades_medidas.nombre as medida')
                    ->join('subcategorias', 'productos.id_subcategoria', '=', 'subcategorias.id',)
                    ->join('categorias', 'subcategorias.id_categoria', '=', 'categorias.id')
                    ->join('unidades_medidas', 'unidades_medidas.id', '=', 'productos.id_und_medida')
                    ->get();
        return response()->json(['data' => $productos]);
    }

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

        if($data->foto!=null){
            $imagen_b64 = explode(',',$data->foto);
            $imagen= base64_decode($imagen_b64[1]);
            $path = Storage::disk('productos')->put($producto->id.'.jpg',$imagen);
            $producto->foto = $producto->id.'.jpg';
            $producto->save();
        }
        return ($saved) ? response()->json(['mensaje' => 'Created :) '], 200) : response()->json(['mensaje' => 'Error :( '], 404);
    }

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

    public function destroy($id)
    {
        $producto = Producto::destroy($id);
        $delete = Storage::disk('productos')->delete($id.'.jpg');

        return ($producto) ? response()->json(['mensaje' => 'Eliminated :) '], 200) : response()->json(['mensaje' => 'Error :( '], 404);
    }

    public function show($id){
        $productos = Producto::where('id_subcategoria','=',$id)->get();
        if(count($productos)>0){
            return response()->json(['data' => $productos,"descripcion"=>$productos[0]->descripcion]);
        }
        return response()->json(['data' =>[]]);
    }
}
