<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// CANAL PRIVADO, TRANSMITIR EVENTOS NOTIFICACIONES -> COMERCIANTE RECIBE PEDIDO LISTA O PRODUCTOS
Broadcast::channel('lista-recibida.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
