<?php

namespace App\Http\Controllers\Api;

use App\Listas;
use App\Horario;
use Carbon\Carbon;
use App\Consumidor;
use App\Comerciante;
use App\Detalle_listas;
use Illuminate\Http\Request;
use App\Comerciante_productos;
use App\Http\Controllers\Controller;

class ApiConsumidorLista extends Controller
{
    public function __construct (){
        Carbon::setLocale('es');
    }
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
            $detalle=Detalle_listas::where('id_lista', $request->data['id'])->get();
            $valor=1;;
            foreach ($detalle as $value) {
                if($value->estado==2 || $value->estado==3){
                    $valor=2;
                }
            }
            return $valor;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $explode = explode(':', $id);
        // dd($explode[1]);
        $id_user = $explode[0];
        $consumidor = Consumidor::where('id_user', $id_user)->first();

        $listas = Listas::join('horario', 'horario.id', '=', 'listas.id_horario')->where('id_consumidor', $consumidor->id)
                    ->where('listas.created_at', 'like', $explode[1].'%')
                    ->select('listas.created_at AS fecha_lista',
                    'listas.codigo_lista', 'listas.total_lista', 'horario.fecha_fin', 'horario.fecha_inicio', 'listas.id')
                    ->orderBy('listas.id', 'desc')
                    ->get();

        foreach ($listas as $value ) {
            $fecha = new Carbon($value->fecha_lista);
            $fecha_recojo_inicio = new Carbon($value->fecha_inicio);
            $fecha_recojo_fin = new Carbon($value->fecha_fin);
            $value->fecha = $fecha->isoFormat('dddd D [de] MMMM');
            $value->fecha_recojo = $fecha_recojo_inicio->isoFormat('dddd D [de] MMMM') .' '. $fecha_recojo_inicio->isoFormat('hh:mm a'). ' - ' .$fecha_recojo_fin->isoFormat('hh:mm a');
            $value->pendientes= 0;
            $value->aceptados= 0;
            $value->recogidos = 0;
            $detalle_listas= Detalle_listas::where('id_lista', $value->id)->get();
            foreach ($detalle_listas as $valor) {
                switch ($valor->estado) {
                    case 1:
                        $value->pendientes++;
                        break;
                    case 2:
                        $value->aceptados++;
                        break;
                    case 3:
                        $value->recogidos++;
                        break;
                }
            }
        }
        return response()->json([
            'data' => $listas
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
        $data = $request->all();

        dd($data);

        $lista = Listas::find($id);

        $lista->id_horario = $data->id_horario;

        $lista->save();



        return response()->json([
            'data' => 'Ok :D'
        ], 200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $listas = Listas::where('listas.id',$id)->join('horario', 'horario.id', '=', 'listas.id_horario')
                    ->select('listas.created_at AS fecha_lista',
                    'listas.codigo_lista', 'listas.total_lista','horario.id as horario_id', 'horario.fecha_fin', 'horario.fecha_inicio', 'listas.id')
                    ->orderBy('listas.id', 'desc')
                    ->first();
       //AUMENTAR CANTIDAD DE PERSONAS
        $horario= Horario::find($listas->horario_id);
        $horario->cupo=$horario->cupo+1;
        $horario->save();
        // ELIMINAR DETALLES LISTAS
        $detalles= Detalle_listas::where('id_lista',$id)->join('comerciante_productos', 'comerciante_productos.id', '=', 'detalle_listas.id_comerciante_producto')
        ->join('puestos', 'puestos.id', '=', 'comerciante_productos.id_puesto')
        ->join('comerciantes', 'comerciantes.id', '=', 'puestos.id_comerciante')
        ->join('users', 'users.id', '=', 'comerciantes.id_user')
        ->join('productos', 'productos.id', '=', 'comerciante_productos.id_producto')
        ->select('productos.*','detalle_listas.*')
        ->get();
        foreach ($detalles as $value) {
            $com_pro = Comerciante_productos::find($value->id_comerciante_producto);
            $com_pro->stock = $com_pro->stock + $value->cantidad;
            $com_pro->save();
            Detalle_listas::destroy($value->id);
        }
        //ELIMINAR LISTA
        Listas::destroy($id);
    }
}
