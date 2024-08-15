<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{

    protected function redirectTo(Request $request)
    {
        // si quieres personalizar el mensaje de error
        // ir a la ruta y modificar Illuminate/Auth/Middleware/Authenticate
        // Unauthenticated. = No autenticado.

        //si el usuario no esta autenticado redireccionamos a la siguiente ruta route('r-view-login')
        return $request->expectsJson() ? null : route('r-view-login');
       
    }
}
