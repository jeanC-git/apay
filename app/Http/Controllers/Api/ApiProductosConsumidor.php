<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comerciante_productos;
use App\Listas;
use App\Detalle_listas;
use App\Consumidor;
use App\Notificaciones;
use App\Events\ListaRecibida;
use  App\Comerciante;
class ApiProductosConsumidor extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        dd($request->all());
        dd($filtro, $categoria, $subcategoria);
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
        $user_id=$request->data_horario['user_id'];
        $id_consumidor=Consumidor::where('id_user',$user_id)->first();

        $lista = new Listas();
        $lista->total_lista = '1997';
        $lista->fecha_entrega = '1000-01-01';
        $lista->id_horario = '1';
        $lista->id_consumidor = $id_consumidor->id;
        $saved = $lista->save();
        $lista_id = $lista->id;
        $precio;
        foreach ($request->data_lista as $value) {
            $id_comerciante_producto=Comerciante_productos::where('id_comerciante',$value['id_comerciante'])
                            ->where('id_producto',$value['id_producto'])
                            ->first();
            $detalle_lista = new Detalle_listas();
            $detalle_lista->estado = '1';
            $detalle_lista->precio = $value['precio'];
            $detalle_lista->cantidad = $value['cantidad'];
            $detalle_lista->id_comerciante_producto = $id_comerciante_producto->id;
            $detalle_lista->id_lista = $lista_id;
            $saved = $detalle_lista->save();
            $id_usuario_comerciante=Comerciante::find($value['id_comerciante']);
            broadcast( new ListaRecibida('Acaba de recibir un nuevo pedido',$id_usuario_comerciante->id_user));
        }
        // $notificaciones = new Notificaciones();
        // $notificaciones->mensaje = '1';
        // $notificaciones->tipo = $value['precio'];
        // $notificaciones->usuario_destino = $value['cantidad'];
        // $notificaciones->id_user = $user_id;

        return "ok ._.";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $comerciante = Comerciante_productos::select(
            'comerciantes.id as id_comerciante',
            'comerciante_productos.id as id','comerciante_productos.stock as stock',
            'productos.nombre as nombre','productos.precio as precio','productos.id as id_producto','productos.descripcion','productos.foto as foto',
            'unidades_medidas.nombre as unidad',
            'subcategorias.id as id_subcategoria','subcategorias.nombre as subcategoria',
            'categorias.id as id_categoria','categorias.nombre as categoria'
            )
        ->join('comerciantes', 'comerciante_productos.id_comerciante', '=', 'comerciantes.id')
        ->join('productos', 'productos.id', '=', 'comerciante_productos.id_producto')
        ->join('unidades_medidas', 'unidades_medidas.id', '=', 'productos.id_und_medida')
        ->join('subcategorias', 'subcategorias.id', '=', 'productos.id_subcategoria')
        ->join('categorias', 'categorias.id', '=', 'subcategorias.id_categoria')
        ->orderBy('stock', 'desc')
        ->where('productos.nombre','like','%'.$id.'%')
        ->get();
        return response()->json(['data' => $comerciante]);
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
