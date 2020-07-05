<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\SubidaProductos;
class SubidaMasiva extends Controller
{
    function subir(Request $request){
        $Excel_datos=file_get_contents($request->file('archivo'));
        Storage::disk('public')->put('productos.xls',$Excel_datos);
        Excel::import(new SubidaProductos(),'productos.xls','public');
        Storage::disk('public')->delete('productos.xls');
        return json_encode(['data' => 'subido']);
    }
}
