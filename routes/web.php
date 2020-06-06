<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('app');
})->name('bienvenido');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//RUTA OFFLINE PWA
// Route::get('/offline', function () {
//     return view('vendor/laravelpwa/offline');
// });
// RUTAS COMERCIANTE
Route::get('/registro-puesto', function () {
    return view('comerciante.registro_puesto');
});

Route::get('/mis-productos',function(){
    return view('comerciante.mis-productos');
});
Route::post('/comerciante/registrar_puesto','ComercianteController@RegistrarPuesto');
Route::post('/comerciante/verificar_puestos','ComercianteController@Verificar_puestos');
// RUTAS CONSUMIDOR
Route::get('/catalogo', function () {
    return view('consumidor.catalogo');
});
Route::get('/informacion-personal', function () {
    return view('consumidor.informacion-personal');
});
// RUTAS ADMINISTRADOR
Route::get('/lista_consumidores','AdministradorController@listar_consumidores');
Route::get('/consumidores', function () {
    return view('administrador.consumidores');
});
Route::get('/lista_comerciantes','AdministradorController@listar_comerciantes');
Route::get('/comerciantes', function () {
    return view('administrador.comerciantes');
});
Route::get('/precios', function () {
    return view('administrador.precios');
});
//RUTAS AUTENTIFICACION FACEBOOK
Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');
