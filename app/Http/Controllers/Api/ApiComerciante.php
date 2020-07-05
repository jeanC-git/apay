<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Comerciante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ApiComerciante extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = (object) $request->data;

        $usuario = new User();
        $usuario->name = $data->name;
        $usuario->lastname = $data->lastname;
        $usuario->email = $data->email;
        $usuario->dni = $data->dni;
        $usuario->password = Hash::make($data->dni);
        $saved_usuario = $usuario->save();

        $usuario->assignRole('comerciante');

        $comerciante = new Comerciante();
        $comerciante->id_user = $usuario->id;
        $saved_comerciante = $comerciante->save();

        return ($saved_usuario && $saved_comerciante ) ?
        response()->json(['mensaje' => 'Created :) '], 200) :
        response()->json(['mensaje' => 'Error :( '], 404);
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
        $data = (object) $request->data;

        $usuario = User::find($id);
        $usuario->name = $data->name;
        $usuario->lastname = $data->lastname;
        $usuario->email = $data->email;
        $usuario->dni = $data->dni;
        $saved_usuario = $usuario->save();

        return ($saved_usuario) ?
        response()->json(['mensaje' => 'Updated :) '], 200) :
        response()->json(['mensaje' => 'Error :( '], 404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id_comerciante = Comerciante::where('id_user', $id)->first();

        $comerciante_productos = DB::table('comerciante_productos')->where('id_comerciante', '=', $id_comerciante->id)->delete();
        $puesto = DB::table('puestos')->where('id_comerciante', '=', $id_comerciante->id)->delete();
        $comerciante = DB::table('comerciantes')->where('id_user', '=', $id)->delete();
        $usuario = User::destroy($id);


        return ($usuario) ?
        response()->json(['mensaje' => 'Eliminated :) '], 200) :
        response()->json(['mensaje' => 'Error :( '], 404);
    }
}
