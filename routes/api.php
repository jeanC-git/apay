<?php

use Illuminate\Http\Request;
use App\Http\Middleware\Autenticar;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('apiProducto', 'Api\ApiProducto');
Route::apiResource('apiCategoria', 'Api\ApiCategoria');
Route::apiResource('apiSubCategoria', 'Api\ApiSubCategoria');
Route::apiResource('apiUnidadMedida', 'Api\ApiUnidadMedida');
Route::apiResource('apiComercianteProductos', 'Api\ApiComercianteProductos');


