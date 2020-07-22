<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Api_Datos_comerciante extends Controller
{
    public function show($id)
    {
        $data = User::find($id);
        return response()->json(['data' => $data]);
    }
    public function store(Request $request){
        $user= User::find($request["data"]["id"]);
        $user->lastname=$request["data"]["lastname"];
        $user->name=$request["data"]["name"];
        $user->email=$request["data"]["email"];
        $user->save();
        return response()->json(['data' => 'subido :u']);
    }
}
