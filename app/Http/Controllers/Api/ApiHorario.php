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
        $date_now = Carbon::now();
        $date_tomorrow= $date_now->addDay();
        $date_tomorrow_format=$date_tomorrow->isoFormat('dddd');
        
        $fecha_ini = $date_tomorrow->isoFormat('Y-MM-DD 08:00:00');
        $fecha_fin = Carbon::now()->endOfWeek()->sub('1 day')->isoFormat('Y-MM-DD 17:00:00');
        $horarios;
        if($date_tomorrow_format!=='sabado' && $date_tomorrow_format!=='domingo'){
            $fecha_fin_day = $date_tomorrow->isoFormat('Y-MM-DD 17:00:00');
            $horarios = Horario::whereBetween('fecha_inicio',[$fecha_ini,$fecha_fin_day])->get();
        }else{
            $fecha_ini = $date_now->startOfWeek()->addWeek();
            $fecha_fin_day = $fecha_fin->addWeek();
            $horarios = Horario::whereBetween('fecha_inicio',[$fecha_ini,$fecha_fin])->get();
        }
        $horarios_day=array();
        for ($i=0; $i < count($horarios) ; $i++) { 
            $hora_inicio    = strstr($horarios[$i]->fecha_inicio, ' ');
            $hora_fin       = strstr($horarios[$i]->fecha_fin, ' ');
            $disabled = ($horarios[$i]->cupo==0) ? true : false ;
                
            $horarios_day[$i]=[
                "hora_inicio"=> $hora_inicio.' - '.$horarios[$i]->cupo.' cupo(s)',
                "hora_fin"   => $hora_fin,
                "id"         =>$horarios[$i]->id,
                "disabled"  => $disabled
            ];
        }
        return response()->json(["data"=>$horarios_day,"fecha_ini"=>$date_tomorrow->isoFormat('Y-MM-DD'),"fecha_fin"=>$fecha_fin], 200);
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
        //ID-> Es la fecha de inicio 
        $fecha_ini=$id.' 08:00:00';
        $fecha_fin_day=$id.' 17:00:00';
        $horarios = Horario::whereBetween('fecha_inicio',[$fecha_ini,$fecha_fin_day])->get();
        $horarios_day=array();
        for ($i=0; $i < count($horarios) ; $i++) { 
            $hora_inicio    = strstr($horarios[$i]->fecha_inicio, ' ');
            $hora_fin       = strstr($horarios[$i]->fecha_fin, ' ');
            $disabled = ($horarios[$i]->cupo==0) ? true : false ;
                
            $horarios_day[$i]=[
                "hora_inicio"=> $hora_inicio.' - '.$horarios[$i]->cupo.' cupo(s)',
                "hora_fin"   => $hora_fin,
                "id"         =>$horarios[$i]->id,
                "disabled"  => $disabled
            ];
        }
        return response()->json(["data"=>$horarios_day], 200);
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
