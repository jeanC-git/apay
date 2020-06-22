<?php

use Illuminate\Http\Request;
use App\Http\Middleware\Autenticar;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('apiProducto', 'Api\ApiProducto');
Route::apiResource('apiCategoria', 'Api\ApiCategoria');
Route::apiResource('apiSubCategoria', 'Api\ApiSubCategoria');
Route::apiResource('apiUnidadMedida', 'Api\ApiUnidadMedida');
Route::apiResource('apiComerciante', 'Api\ApiComerciante');
Route::apiResource('apiComercianteProductos', 'Api\ApiComercianteProductos');
Route::apiResource('apiProductosConsumidor', 'Api\ApiProductosConsumidor');


Route::apiResource('apiNotificaciones', 'Api\ApiNotificaciones');
