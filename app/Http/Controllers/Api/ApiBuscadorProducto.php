<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Comerciante_productos;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ApiBuscadorProducto extends Controller
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
     * MOSTRAR PRODUCTOS FILTRANDO POR : CATEGORIA, SUBCATEGORIA Y FILTRO
     *
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $query = DB::table('comerciante_productos')
                    ->join('comerciantes', 'comerciante_productos.id_comerciante', '=', 'comerciantes.id')
                    ->join('productos', 'productos.id', '=', 'comerciante_productos.id_producto')
                    ->join('unidades_medidas', 'unidades_medidas.id', '=', 'productos.id_und_medida')
                    ->join('subcategorias', 'subcategorias.id', '=', 'productos.id_subcategoria')
                    ->join('categorias', 'categorias.id', '=', 'subcategorias.id_categoria')
                    ->join('puestos', 'puestos.id', '=', 'comerciante_productos.id_puesto');
        if ((int)$request->categoria > 0) {
            $query->where('categorias.id','=', (int) $request->categoria);
        }
        if ((int)$request->subcategoria > 0) {
            $query->where('subcategorias.id','=', (int) $request->subcategoria);
        }
        if (!empty($request->filtro)) {
            $query->where('productos.nombre','like','%'.$request->filtro.'%');
        }
        $productos = $query->select([
            'comerciantes.id as id_comerciante',
            'comerciante_productos.id as id','comerciante_productos.stock as stock',
            'productos.nombre as nombre','productos.precio as precio','productos.id as id_producto','productos.descripcion','productos.foto as foto',
            'unidades_medidas.nombre as unidad',
            'subcategorias.id as id_subcategoria','subcategorias.nombre as subcategoria',
            'categorias.id as id_categoria','categorias.nombre as categoria',
            'puestos.nombre as nombre_puesto','puestos.numero as numero_puesto'])
            ->orderBy('stock', 'desc')
            ->get();

        $collectProductos = collect($productos);
        foreach ($collectProductos as $producto) {
            $producto->cantidad = 1;
        }
        // AGRUPAR DE n EN n CON chunk(n)
        $groups = $collectProductos->chunk(4);

        return response()->json(['data' => $groups->toArray()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
