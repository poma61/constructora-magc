<?php

namespace App\Http\Middleware;

use App\Models\Grupo;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckGrupAccess
{
    /**
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //codigo comentado recientemente
        // $user = Auth::user()->onPersonal()->first();
        // $grupo = Grupo::where('id', $user->id_grupo)->first();

        // if ($grupo->grup_number == 'todos') {
        //     return $next($request);
        // }


        // if (empty($request->input('grupo'))) {
        //     //'ciudad' debe coincidir con el nombre del parámetro en tu ruta
        //     // Extraer el parámetro 'ciudad' del cuerpo de la solicitud
        //     // Extraer el parámetro 'ciudad' de la URL en solicitudes GET      
        //     $requeste_grupo = $request->route('grupo');
        // } else {
        //     // Extraer el parámetro 'ciudad' de la URL en solicitudes POST
        //     $requeste_grupo = $request->input('grupo');
        // }

        // if ($requeste_grupo == $grupo->grup_number) {
        //     return $next($request);
        // }

        //  //si las rutas son para peticiones axios enviamos un json como respuesta
        //  if ($request->is('microservice/*')) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'ACCESO NO AUTORIZADO!',
        //     ], 401);
        // }

        // return response()->view('no-autorizado-view'); 
        //agreado recientemente
        return $next($request);
    }
}
