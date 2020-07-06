<?php

namespace App\Http\Controllers\Api;

use App\Listas;
use Carbon\Carbon;
use App\Consumidor;
use App\Detalle_listas;
use Illuminate\Http\Request;
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
            $value->fecha_recojo = $fecha_recojo_inicio->isoFormat('dddd D [de] MMMM') .' '. $fecha_recojo_inicio->isoFormat('hh:mm:ss a'). ' - ' .$fecha_recojo_fin->isoFormat('hh:mm:ss a');

            $value->pendientes= 0;
            $value->aceptados= 0;
            $detalle_listas= Detalle_listas::where('id_lista', $value->id)->get();
            foreach ($detalle_listas as $valor) {
                ($valor->estado == '1') ? $value->pendientes++ : $value->aceptados++;
            }

        }
        return response()->json([
            'data' => $listas
            ]);
        dd($consumidor->id);
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
