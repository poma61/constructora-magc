<?php

namespace App\Providers;

use App\Models\Cliente;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // //Primera forma... o si nos crear una clase en App/Services/ donde tenga que listar todas las altertas del sistemas 
        // // Compartir 'clientes' solo en vistas que no sean la vista 'login'
        // if (!in_array(Route::currentRouteName(), ['r-login'])) {
        //     View::share('clientes', Cliente::all());
        // }

        Schema::defaultStringLength(400);
    }
}
