<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Autenticar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return response()->json([
                'mensaje' => 'Necesita estar autenticado para acceder a esta ruta.'
            ], 511);
        }

        // $user = Auth::user();

        return $next($request);
    }
}
