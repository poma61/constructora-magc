<?php

namespace App\Http\Middleware;

use App\Models\Ciudad;
use App\Models\Grupo;
use App\Models\UserHasPermiso;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckGrupAccess
{

    public function handle(Request $request, Closure $next): Response
    { {
            //VERIFICAR QUE TIPO DE METODO ES 
            if ($request->isMethod('GET')) {
                // SI ES METODO GET
                // Extraer el parámetro 'ciudad' de la URL en solicitudes GET      
                $request_group = $request->route('grupo');
                $request_city = $request->route('ciudad');
            }

            if ($request->isMethod('POST') || $request->isMethod('PUT')) {
                // SI ES METODO POST
                // Extraer el parámetro 'ciudad' de la URL en solicitudes POST
                $request_group = $request->input('grupo');
                $request_city = $request->input('ciudad');
            }

            //veriricamos si el recurso solicitado existe
            $verified_group  = Grupo::where('grup_number', $request_group)
                ->exists(); // devuelve true si al menos existe UN registro
            $verified_city  = Ciudad::where('city_name', $request_city)
                ->exists(); // devuelve true si al menos existe UN registro

            if ($verified_group == false || $verified_city == false) {
                //si las rutas son para peticiones axios (desde js) enviamos un json como respuesta
                if ($request->is('microservice/*')) {
                    return response()->json([
                        'status' => false,
                        'message' => "No se encontro el grupo {$request_group} y/o la ciudad {$request_city}!",
                    ], 404);
                } else {
                    // si son peticiones del navegador 
                    return response()->view('not-found');
                }
            } // $verified_group

            $user_permisos = UserHasPermiso::join("permisos", 'permisos.id', '=', 'users_has_permisos.id_permiso')
                ->select("permisos.*")
                ->where("permisos.content_type", 'grupos')
                ->where("users_has_permisos.status", true)
                ->where("users_has_permisos.id_user", Auth::user()->id)
                ->get();

            $manage_groups = [];
            foreach ($user_permisos  as  $row) {
                // el numero de grupo viene asi Santa-Cruz_01 , Santa-Cruz_02 
                // Entonces debemos separar la ciudad y su correspondiente grupo
                // obtenemos un array de esta manera ['Santa-Cruz', '02']
                $parts = explode("_", $row->code_content);
                if ($parts[0] == $request_city) { // verificamos si tiene acceso a algun grupo segun la  ciudad
                    $manage_groups[] = $parts[1];
                }
            }

            // in_array($request_group, $manage_groups) => si el valor de $request_group esta en el array $manage_groups entonces devuelve true
            if (in_array($request_group, $manage_groups)) {
                return $next($request);
            } else {
                //si las rutas son para peticiones axios (desde js ) enviamos un json como respuesta
                if ($request->is('microservice/*')) {
                    return response()->json([
                        'status' => false,
                        'message' => 'ACCESO NO AUTORIZADO!',
                    ], 401);
                } else {
                    // si son peticiones normales
                    return response()->view('no-autorizado-view');
                }
            } // in_array
        }
    }
}
