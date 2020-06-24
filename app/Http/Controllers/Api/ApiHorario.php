<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Horario;
use Carbon\Carbon;
class ApiHorario extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct (){
        Carbon::setLocale('es');
    }
    public function index()
    {
        $date = Carbon::now()->isoFormat('dddd');
        $fecha_ini = Carbon::now()->startOfWeek();
        $fecha_fin = Carbon::now()->endOfWeek();
        $horario;
        if($date!=='domingo'){
            $horario = Horario::whereBetween('fecha_inicio',[$fecha_ini,$fecha_fin])->get();
        }else{
            $fecha_ini = $fecha_ini->addWeek();
            $fecha_fin = $fecha_fin->addWeek();
            $horario = Horario::whereBetween('fecha_inicio',[$fecha_ini,$fecha_fin])->get();
        }
        return json_encode(array("data"=>$horario,"fecha_ini"=>$fecha_ini->format('Y-m-d'),"fecha_fin"=>$fecha_fin->format('Y-m-d')));
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
