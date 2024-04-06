<?php

namespace App\Http\Middleware;

use App\Models\Ciudad;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCityAccess
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

        $user = Auth::user()->onPersonal()->first();


        $ciudad = Ciudad::where('id', $user->id_ciudad)->first();
        if (empty($request->input('ciudad'))) {
            //'ciudad' debe coincidir con el nombre del parámetro en tu ruta
            // Extraer el parámetro 'ciudad' del cuerpo de la solicitud
            // Extraer el parámetro 'ciudad' de la URL en solicitudes GET      
            $requeste_city = $request->route('ciudad');
        } else {
            // Extraer el parámetro 'ciudad' de la URL en solicitudes POST
            $requeste_city = $request->input('ciudad');
        }

        if ($ciudad->city_name == $requeste_city) {
            return $next($request);
        }

        //si las rutas son para peticiones axios enviamos un json como respuesta
        if ($request->is('microservice/*')) {
            return response()->json([
                'status' => false,
                'message' => 'ACCESO NO AUTORIZADO!',
            ], 401);
        }

        return response()->view('no-autorizado-view');
    }
}
