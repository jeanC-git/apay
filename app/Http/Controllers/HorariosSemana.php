<?php

namespace App\Http\Controllers;

use App\Horario;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HorariosSemana extends Controller
{
    public function __construct (){
        Carbon::setLocale('es');
    }

    public function crearHorarioSemana  ()
    {
        // PRIMER DIA SIGUIENTE SEMANA
        $primer_dia_nextWeek_validar = Carbon::now()->addWeek()->startOfWeek();
        // SABADO DE LA SIGUIENTE SEMANA
        $sabado_validar_nextWeek = Carbon::now()->addWeek()->endOfWeek()->subDay();
        $hora_actual= Carbon::now();

        $validar = Horario::where('fecha_inicio', $primer_dia_nextWeek_validar->format('Y-m-d').' 08:00:00')->get();

        if (count($validar)) {
            $mensaje = 'Los horarios de la semana '.$primer_dia_nextWeek_validar->format('d-m-Y').' al '.$sabado_validar_nextWeek->format('d-m-Y').' ya fueron creados | '.$hora_actual->format('d-m-Y H:i:s');
            return response()->json($mensaje, 200);
        } else {
            $horarios_creados = collect();
            $hoy = Carbon::now();
            $hoy_addWeek = $hoy->addWeek();
            // PRIMER DIA DE LA SIGUIENTE SEMANA
            $primer_dia_nextWeek = $hoy_addWeek->startOfWeek();

            $horario = collect($primer_dia_nextWeek->format('Y-m-d'));
            for ($i=0; $i < 5; $i++) {
                $horario->push($primer_dia_nextWeek->addDay()->format('Y-m-d'));
            }
            $horas_recojo = [
                ['inicio' => '08:00:00', 'fin' => '09:00:00'],
                ['inicio' => '09:15:00', 'fin' => '10:15:00'],
                ['inicio' => '10:30:00', 'fin' => '11:30:00'],
                ['inicio' => '11:45:00', 'fin' => '12:45:00'],
                ['inicio' => '13:30:00', 'fin' => '14:30:00'],
                ['inicio' => '14:45:00', 'fin' => '15:45:00'],
            ];
            foreach ($horario as $index => $value) {
                foreach ($horas_recojo as $key => $value) {
                    $fecha_inicio = $horario[$index].' '.$value['inicio'];
                    $fecha_fin = $horario[$index].' '.$value['fin'];

                    $nuevo_horario = new Horario();
                    $nuevo_horario->fecha_inicio = $fecha_inicio;
                    $nuevo_horario->fecha_fin = $fecha_fin;
                    $nuevo_horario->cupo = 40;

                    $nuevo_horario->save();
                    $horarios_creados->push($nuevo_horario);
                }
            }
            return response()->json($horarios_creados, 200);
        }


    }
}
