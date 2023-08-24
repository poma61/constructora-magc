<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\ContableController;
use App\Http\Controllers\ControlDeObrasController;
use App\Http\Controllers\InventarioController;

//middleware('guest') si el usuario esta autenticado no permite que el usuario acceda a la vista login
//entonces esto redirige a la vista principal donde se configura en la siguiente ruta del archivo php
//app/Providers/RouteServiceProvider.php
Route::get('/', [LoginController::class, 'index'])->name('r-view-login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name("r-login");
Route::get("/home", [HomeController::class, 'index'])->name("r-home")->middleware("auth");
Route::get("/salir", [LoginController::class, 'logout'])->name("r-salir")->middleware("auth");


//personal
Route::group(['middleware' => ['auth', 'check.role.access']], function () {
    Route::get('/personal/view/{city}', [PersonalController::class, 'indexView'])->name("r-personal-index-view");
    Route::post('/microservice/personal/index', [PersonalController::class, 'index']);
    Route::post('/microservice/personal/create', [PersonalController::class, 'create']);
    Route::post('/microservice/personal/edit', [PersonalController::class, 'edit']);
    Route::put('/microservice/personal/update', [PersonalController::class, 'update']);
    Route::post('/microservice/personal/destroy', [PersonalController::class, 'destroy']);
});


//user
Route::group(['middleware' => ['auth', 'check.role.access']], function () {
    Route::get('/user/view/{ciudad}', [UserController::class, 'indexView'])->name('r-user-view');
    Route::post('/microservice/user/index', [UserController::class, 'index']);
    Route::post('/microservice/user/create', [UserController::class, 'create']);
    Route::put('/microservice/user/update', [UserController::class, 'update']);
    Route::post('/microservice/user/destroy', [UserController::class, 'destroy']);
    Route::post('/microservice/user/buscar-personal-registrado', [UserController::class, 'buscarPersonal']);
});



//clientes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/cliente/view', [ClienteController::class, 'indexView'])->name('r-cliente-index-view');
});
Route::group(['middleware' => ['auth', 'check.city.access', 'check.grup.access']], function () {
    Route::get('/cliente/tablero/{ciudad}/{grupo}', [ClienteController::class, 'tableroView'])->name('r-tablero-cliente-grupo-view');
    Route::get('/cliente/grafico/{ciudad}/{grupo}', [ClienteController::class, 'graficoView'])->name('r-grafico-cliente-grupo-view');
    Route::get('/cliente/calendario/{ciudad}/{grupo}', [ClienteController::class, 'calendarioView'])->name('r-calendario-cliente-grupo-view');
    Route::get('/cliente/gantt/{ciudad}/{grupo}', [ClienteController::class, 'ganttView'])->name('r-gantt-cliente-grupo-view');
    Route::post('/microservice/ciudad/grupo/cliente/index', [ClienteController::class, 'tableroIndex']);
    Route::post('/microservice/ciudad/grupo/cliente/create', [ClienteController::class, 'rowTableroCreate']);
    Route::put('/microservice/ciudad/grupo/cliente/update', [ClienteController::class, 'rowTableroUpdate']);
    Route::post('/microservice/ciudad/grupo/cliente/destroy', [ClienteController::class, 'rowTableroDestroy']);
    Route::post('/microservice/ciudad/grupo/cliente/record-cliente-responsable', [ClienteController::class, 'recordClienteResponsable']);
    Route::post('/microservice/ciudad/grupo/cliente/graphic-estado', [ClienteController::class, 'graphicEstado']);
    Route::post('/microservice/ciudad/grupo/cliente/calendar-meeting', [ClienteController::class, 'calendarMeeting']);
    Route::post('/microservice/ciudad/grupo/cliente/gantt-meeting', [ClienteController::class, 'ganttMeeting']);
    Route::post('/microservice/ciudad/grupo/cliente/generate-excel', [ClienteController::class, 'generateExcel']);
});


//Contratos
Route::get('/contrato/ciudad', [ContratoController::class, 'viewCiudad'])->middleware('auth')->name('r-contrato-ciudad');
Route::group(['middleware' => ['auth', 'check.city.access']], function () {
    Route::get('/contrato/tablero/{ciudad}', [ContratoController::class, 'viewTablero'])->name('r-contrato-tablero');
    Route::get('/contrato/grafico/{ciudad}', [ContratoController::class, 'viewGrafico'])->name('r-contrato-grafico');
    Route::get('/contrato/calendario/{ciudad}', [ContratoController::class, 'viewCalendario'])->name('r-contrato-calendario');
    Route::get('/contrato/gantt/{ciudad}', [ContratoController::class, 'viewGantt'])->name('r-contrato-gantt');
    Route::post('/contrato/ciudad/tablero-index', [ContratoController::class, 'tableroIndex']);
    Route::post('/contrato/ciudad/tablero-create', [ContratoController::class, 'rowTableroCreate']);
    Route::put('/contrato/ciudad/tablero-update', [ContratoController::class, 'rowTableroUpdate']);
    Route::post('/contrato/ciudad/tablero-destroy', [ContratoController::class, 'rowTableroDestroy']);
});



//control de obras
Route::get('/control-de-obra/ciudad', [ControlDeObrasController::class, 'viewCiudad'])->middleware('auth')->name('r-control-de-obra-ciudad');


//Contable
Route::get('/contable/ciudad', [ContableController::class, 'viewCiudad'])->middleware('auth')->name('r-contable-ciudad');


//Inventario
Route::get('/inventario/ciudad', [InventarioController::class, 'viewCiudad'])->middleware('auth')->name('r-inventario-ciudad');


