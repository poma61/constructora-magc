<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdministrativeModulePermission
{

    public function handle(Request $request, Closure $next, ...$permissions_code_content): Response
    {
        $user_permissions = Auth::user()->onPermission();

        $module_user_permissions = [];
        foreach ($user_permissions  as $row) {
            if ($row->type == 'module') {
                $module_user_permissions[] = $row->code_content;
            }
        } //foreach




        foreach ($permissions_code_content as $permission) {

            if (in_array($permission, $module_user_permissions)) {
                return $next($request);
            } else {
                // si las rutas son para peticiones axios (desde js ) enviamos un json como respuesta
                if ($request->is('microservice/*')) {
                    return response()->json([
                        'status' => false,
                        'message' => 'ACCESO NO AUTORIZADO!',
                    ], 401);
                } else {
                    // si son peticiones normales
                    return response()->view('no-autorizado-view');
                }
            }
        }

        // si las rutas son para peticiones axios (desde js ) enviamos un json como respuesta
        if ($request->is('microservice/*')) {
            return response()->json([
                'status' => false,
                'message' => 'ACCESO NO AUTORIZADO!',
            ], 401);
        } else {
            // si son peticiones normales
            return response()->view('no-autorizado-view');
        }
    } //handle
}//class
