<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
})->name('bienvenido');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//RUTA OFFLINE PWA
Route::get('/offline', function () {
    return view('vendor/laravelpwa/offline');
});
// RUTAS COMERCIANTE
Route::get('/registro-puesto', function () {
    return view('comerciante.registro_puesto');
});
Route::get('/mis-productos','ComercianteController@Mis_productos');
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
Route::get('/subida_masiva', function () {
    return view('administrador.subida_masiva');
});
//RUTAS AUTENTIFICACION FACEBOOK
Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

//RUTAS LIBRES
Route::get('/inicio-sesion', function () {
    return view('inicio-sesion');
});
Route::post('/subida_excel','SubidaMasiva@subir');

//RUTA CREACION DE HORARIOS DE RECOJO DE LA SEMANA
Route::get('/generar_horarios','HorariosSemana@crearHorarioSemana');

