<?php

namespace App\Http\Controllers\Api;

use App\Listas;
use App\Horario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiCambiarHorario extends Controller
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
        $data_lista = Listas::where('id' , $id)->get();

        $hoy = Carbon::now();
        $sabado = $hoy->weekday(6);

        return response()->json([
            'data' => $data_lista
        ], 200);
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
        $data = (object) $request->all();

        $lista = Listas::find($id);

    // RETORNAMOS EL CUPO AL ANTIGUO HORARIO
        $horario = Horario::find($lista->id_horario);
        $horario->cupo = $horario->cupo+1;
        $horario->save();

    // DISMINUIMOS EL CUPO AL NUEVO HORARIO
        $nuevo_horario = Horario::find($data->id);
        $nuevo_horario->cupo =  $nuevo_horario->cupo-1;
        $nuevo_horario->save();

    // ACTUALIZAMOS EL ID DE HORARIO DE LA NUEVA LISTA
        $lista->id_horario = $data->id;
        $lista->save();

        return response()->json([
            'data' => 'OK :D'
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
        //
    }
}
