<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        
        //si el usuaripo no esta autenticado redireccionamos a la siguiente pagina
        return $request->expectsJson() ? null : route('r-view-login');

        // if ($request->is('api/*')) {
        //     if ($token = $request->cookie('cookie_auth_token')) {

        //         $request->headers->set('Authorization', 'Bearer ' . $token);
        //         $request->headers->set("Accept", "application/json");
        //     }
        // }

    }
}
