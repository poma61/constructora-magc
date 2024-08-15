<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UpdatingMode
{

    public function handle(Request $request, Closure $next): Response
    {
        $system_is_updating = config('app.system_is_updating');

        // Auth::check() => verificar si el usuario esta logueado
        // Verificamos porque podria ser que el usuario haya dejado la sesion abierta y la session se haya expirado
        // y si no agregamos Auth::check() podria ingresar por el if y ejecutar    Auth::logout(); y podria dar error
        if ($system_is_updating && Auth::check()) {
            //verificamos que tipo de peticiones son
            // si son peticiones axios
            if ($request->is('microservice/*')) {
                Auth::logout();
                return response()->json([
                    'status' => false,
                    'message' => 'Estamos trabajando en las actualizaciones del sistema.',
                ], 401);
            } else {
                // si son peticiones desde la web
                Auth::logout();
                return  redirect('/'); // redireccionamos a la pagina de inicio
            }
        }


        return $next($request);
    }
}
