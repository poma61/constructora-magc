<?php

namespace App\Http\Middleware;

use App\Models\Ciudad;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::user()->role == 'Administrador') {
            return $next($request);
        }

        //si las rutas son para peticiones axios enviamos un json como respuesta
        if ($request->is('microservice/*')) {
            return response()->json([
                'status' => false,
                'message' => 'ACCESO NO AUTORIZADO!',
            ], 401);
        }

        //si son peticiones por url get.. enviamos una vista
        return response()->view('no-autorizado-view'); 

    }
}
