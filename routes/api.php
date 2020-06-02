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


Route::middleware(Autenticar::class)->apiResource('apiProducto', 'Api\ApiProducto');
Route::middleware(Autenticar::class)->apiResource('apiCategoria', 'Api\ApiCategoria');
Route::middleware(Autenticar::class)->apiResource('apiSubCategoria', 'Api\ApiSubCategoria');
