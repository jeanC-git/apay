<?php

namespace App\Http\Controllers\Api;

use App\Listas;
use App\Horario;
use App\Consumidor;
use App\Comerciante;
use App\Detalle_listas;
use App\Notificaciones;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\ListaRecibida;
use App\Comerciante_productos;
use App\Http\Controllers\Controller;

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
        $user_id=$request->info['user_id'];
        $id_consumidor=Consumidor::where('id_user',$user_id)->first();
        $lista = new Listas();
        $lista->total_lista = $request->info['total_lista'];;
        $lista->id_horario = $request->info['hora'];
        $lista->id_consumidor = $id_consumidor->id;
        $lista->codigo_lista  = '#'. strtoupper(Str::random(4));
        $saved = $lista->save();
        $lista_id = $lista->id;
        $precio;
        foreach ($request->data_lista as $arrayxcomerciante) {
            for ($i=0; $i <count($arrayxcomerciante) ; $i++) {
                $id_comerciante_producto=Comerciante_productos::where('id_comerciante',$arrayxcomerciante[$i]['id_comerciante'])
                ->where('id_producto',$arrayxcomerciante[$i]['id_producto'])
                ->first();
                //GUARDAR_STOCK
                $id_comerciante_producto->stock=$id_comerciante_producto->stock-$arrayxcomerciante[$i]['cantidad'];
                $id_comerciante_producto->save();
                //GUARDAR DETALLE LISTA
                $detalle_lista = new Detalle_listas();
                $detalle_lista->estado = '1';
                $detalle_lista->precio = $arrayxcomerciante[$i]['precio'];
                $detalle_lista->cantidad = $arrayxcomerciante[$i]['cantidad'];
                $detalle_lista->id_comerciante_producto = $id_comerciante_producto->id;
                $detalle_lista->id_lista = $lista_id;
                $saved = $detalle_lista->save();
                $id_usuario_comerciante=Comerciante::find($arrayxcomerciante[$i]['id_comerciante']);
                if($i==0){
                    broadcast( new ListaRecibida('EL puesto #'.$arrayxcomerciante[$i]['numero_puesto'].' ha recibido una lista',$id_usuario_comerciante->id_user));
                    $notificaciones = new Notificaciones();
                    $notificaciones->mensaje = 'Acaba de recibir un nuevo pedido';
                    $notificaciones->tipo = '1';
                    $notificaciones->user_destino = $id_usuario_comerciante->id_user;
                    $notificaciones->id_user = $user_id;
                    $notificaciones->save();
                }
            }
        }
        //DISMUNIR CANTIDAD DE PERSONAS
        $horario= Horario::find($request->info['hora']);
        $horario->cupo=$horario->cupo-1;
        $horario->save();
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
