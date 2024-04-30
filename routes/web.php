<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\DisenioController;
use App\Http\Controllers\ObraController;
use App\Http\Controllers\FinanzasDeConstruccionController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\CCDController;
use App\Http\Controllers\PermisoController;
use App\Models\Permiso;

// en un hosting muchas veces no se puede ejecutar php artisan
// para generar storage link en un hosting se puede hacer desde una peticion get
Route::get('/storage-link', function () {
    if (file_exists(public_path('storage'))) {
        return 'The "public/storage" directory already exists.';
    }

    app('files')->link(
        storage_path('app/public'),
        public_path('storage')
    );

    return 'The [public/storage] directory has bee linked.';
});



//middleware('guest') si el usuario esta autenticado no permite que el usuario acceda a la vista login
//entonces esto redirige a la vista principal donde se configura en la siguiente ruta del archivo php
//app/Providers/RouteServiceProvider.php
Route::get('/', [LoginController::class, 'index'])->name('r-view-login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name("r-login");

//auth
Route::group(['middleware' => ['auth']], function () {
    Route::get("/salir", [LoginController::class, 'logout'])->name("r-salir");
    Route::get("/me", [LoginController::class, 'viewMe'])->name("r-me");
    Route::post("/microservice/index-me", [LoginController::class, 'me']);
    Route::put("/microservice/update-credentials-me", [LoginController::class, 'updateCredentials']);
});


//home
Route::get("/home", [HomeController::class, 'index'])->name("r-home")->middleware("auth");


//personal
Route::group(['middleware' => ['auth', 'check.role.access']], function () {
    Route::get('/personal/view/{city}', [PersonalController::class, 'indexView'])->name("r-personal-index-view");
    Route::post('/microservice/personal/index', [PersonalController::class, 'index']);
    Route::post('/microservice/personal/create', [PersonalController::class, 'create']);
    Route::post('/microservice/personal/edit', [PersonalController::class, 'edit']);
    Route::put('/microservice/personal/update', [PersonalController::class, 'update']);
    Route::post('/microservice/personal/destroy', [PersonalController::class, 'destroy']);
    //para buscar personal
    Route::post('/microservice/personal/buscar-personal-registrado', [PersonalController::class, 'searchByCi']);
});

//user
Route::group(['middleware' => ['auth', 'check.role.access']], function () {
    Route::get('/user/view', [UserController::class, 'indexView'])->name('r-user-view');
    Route::post('/microservice/user/index', [UserController::class, 'index']);
    Route::post('/microservice/user/create', [UserController::class, 'create']);
    Route::put('/microservice/user/update', [UserController::class, 'update']);
    Route::post('/microservice/user/destroy', [UserController::class, 'destroy']);
    Route::post('/microservice/user/user-permisos', [UserController::class, 'userPermission']);
});

//permisos
Route::group(['middleware' => ['auth']], function () {
    Route::post('/microservice/permiso/list', [PermisoController::class, 'index']);
});


//clientes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/cliente/view', [ClienteController::class, 'indexView'])->name('r-cliente-index-view');
});
Route::group(['middleware' => ['auth', 'check.city.access', 'check.grup.access']], function () {
    //vistas
    Route::get('/cliente/tablero/{ciudad}/{grupo}', [ClienteController::class, 'tableroView'])->name('r-tablero-cliente-grupo-view');
    Route::get('/cliente/grafico/{ciudad}/{grupo}', [ClienteController::class, 'graficoView'])->name('r-grafico-cliente-grupo-view');
    Route::get('/cliente/calendario/{ciudad}/{grupo}', [ClienteController::class, 'calendarioView'])->name('r-calendario-cliente-grupo-view');
    Route::get('/cliente/gantt/{ciudad}/{grupo}', [ClienteController::class, 'ganttView'])->name('r-gantt-cliente-grupo-view');
    //tablero
    Route::post('/microservice/ciudad/grupo/cliente/index', [ClienteController::class, 'tableroIndex']);
    Route::post('/microservice/ciudad/grupo/cliente/create', [ClienteController::class, 'rowTableroCreate']);
    Route::put('/microservice/ciudad/grupo/cliente/update', [ClienteController::class, 'rowTableroUpdate']);
    Route::post('/microservice/ciudad/grupo/cliente/destroy', [ClienteController::class, 'rowTableroDestroy']);
    Route::post('/microservice/ciudad/grupo/cliente/record-cliente-responsable', [ClienteController::class, 'recordClienteResponsable']);
    Route::post('/microservice/ciudad/grupo/cliente/generate-excel', [ClienteController::class, 'generateExcel']);
    //grafico,calendario, gantt, 
    Route::post('/microservice/ciudad/grupo/cliente/graphic-estado', [ClienteController::class, 'graphicEstado']);
    Route::post('/microservice/ciudad/grupo/cliente/calendar-meeting', [ClienteController::class, 'calendarMeeting']);
    Route::post('/microservice/ciudad/grupo/cliente/gantt-meeting', [ClienteController::class, 'ganttMeeting']);
});


//Contratos
Route::get('/contrato/ciudad', [ContratoController::class, 'viewCiudad'])->middleware('auth')->name('r-ciudad-contrato');
Route::group(['middleware' => ['auth', 'check.city.access']], function () {
    //vistas
    Route::get('/contrato/tablero/{ciudad}', [ContratoController::class, 'viewTablero'])->name('r-tablero-contrato');
    Route::get('/contrato/calendario/{ciudad}', [ContratoController::class, 'viewCalendario'])->name('r-calendario-contrato');
    Route::get('/contrato/gantt/{ciudad}', [ContratoController::class, 'viewGantt'])->name('r-gantt-contrato');
    //tablero
    Route::post('/microservice/contrato/ciudad/tablero-index', [ContratoController::class, 'tableroIndex']);
    Route::post('/microservice/contrato/ciudad/tablero-create', [ContratoController::class, 'rowTableroCreate']);
    Route::put('/microservice/contrato/ciudad/tablero-update', [ContratoController::class, 'rowTableroUpdate']);
    Route::post('/microservice/contrato/ciudad/tablero-destroy', [ContratoController::class, 'rowTableroDestroy']);
    Route::post('/microservice/contrato/ciudad/buscar-cliente', [ContratoController::class, 'buscarCliente']);
    Route::post('/microservice/contrato/ciudad/by-id-detalle-contrato', [ContratoController::class, 'rowTableroByIdDetalleContrato']);
    Route::post('/microservice/contrato/ciudad/generate-excel', [ContratoController::class, 'generateExcel']);
    //calendario, gantt, 
    Route::post('/microservice/contrato/ciudad/calendar-contract', [ContratoController::class, 'calendarContract']);
    Route::post('/microservice/contrato/ciudad/gantt-contract', [ContratoController::class, 'ganttContract']);
});


//control de obras
Route::get('/control-de-obra/ciudad', [ObraController::class, 'viewCiudad'])->middleware('auth')->name('r-ciudad-control-de-obra');
Route::group(['middleware' => ['auth', 'check.city.access']], function () {
    //vistas
    Route::get('/control-de-obra/tablero/{ciudad}', [ObraController::class, 'viewTablero'])->name('r-tablero-control-de-obra');
    Route::get('/control-de-obra/grafico/{ciudad}', [ObraController::class, 'viewGrafico'])->name('r-grafico-control-de-obra');
    Route::get('/control-de-obra/calendario/{ciudad}', [ObraController::class, 'viewCalendario'])->name('r-calendario-control-de-obra');
    Route::get('/control-de-obra/gantt/{ciudad}', [ObraController::class, 'viewGantt'])->name('r-gantt-control-de-obra');
    //tablero
    Route::post('/microservice/control-de-obra/ciudad/tablero-index', [ObraController::class, 'tableroIndex']);
    Route::post('/microservice/control-de-obra/ciudad/tablero-create', [ObraController::class, 'rowTableroCreate']);
    Route::put('/microservice/control-de-obra/ciudad/tablero-update', [ObraController::class, 'rowTableroUpdate']);
    Route::post('/microservice/control-de-obra/ciudad/tablero-destroy', [ObraController::class, 'rowTableroDestroy']);
    Route::post('/microservice/control-de-obra/ciudad/buscar-contrato', [ObraController::class, 'buscarContrato']);
    Route::post('/microservice/control-de-obra/ciudad/generate-excel', [ObraController::class, 'generateExcel']);
    // //grafico,calendario,gantt 
    Route::post('/microservice/control-de-obra/ciudad/graphic-estado', [ObraController::class, 'graphicEstado']);
    Route::post('/microservice/control-de-obra/ciudad/calendar-fecha-inicio', [ObraController::class, 'calendarFechaInicio']);
    Route::post('/microservice/control-de-obra/ciudad/gantt-fecha-all', [ObraController::class, 'ganttFechaAll']);
});



//Finanzas de construccion
Route::get('/finanzas-de-construccion/ciudad', [FinanzasDeConstruccionController::class, 'viewCiudad'])->middleware('auth')->name('r-ciudad-finanzas-de-construccion');
Route::group(['middleware' => ['auth', 'check.city.access']], function () {
    //vistas
    Route::get('/finanzas-de-construccion/contratista/tablero/{ciudad}', [FinanzasDeConstruccionController::class, 'viewTableroContratista'])->name('r-tablero-finanzas-de-construccion');
    Route::get('/finanzas-de-construccion/contratista/grafico/{ciudad}', [FinanzasDeConstruccionController::class, 'viewGraficoContratista'])->name('r-grafico-finanzas-de-construccion');
    Route::get('/finanzas-de-construccion/contratista/calendario/{ciudad}', [FinanzasDeConstruccionController::class, 'viewCalendarioContratista'])->name('r-calendario-finanzas-de-construccion');
    Route::get('/finanzas-de-construccion/contratista/gantt/{ciudad}', [FinanzasDeConstruccionController::class, 'viewGanttContratista'])->name('r-gantt-finanzas-de-construccion');
    //tablero contratista
    Route::post('/microservice/finanzas-de-construccion/ciudad/contratista/tablero-index', [FinanzasDeConstruccionController::class, 'tableroIndexContratista']);
    Route::post('/microservice/finanzas-de-construccion/ciudad/contratista/tablero-create', [FinanzasDeConstruccionController::class, 'rowTableroCreateContratista']);
    Route::put('/microservice/finanzas-de-construccion/ciudad/contratista/tablero-update', [FinanzasDeConstruccionController::class, 'rowTableroUpdateContratista']);
    Route::post('/microservice/finanzas-de-construccion/ciudad/contratista/tablero-destroy', [FinanzasDeConstruccionController::class, 'rowTableroDestroyContratista']);
    Route::post('/microservice/finanzas-de-construccion/ciudad/contratista/buscar-contrato', [FinanzasDeConstruccionController::class, 'buscarContratoContratista']);
    Route::post('/microservice/finanzas-de-construccion/ciudad/contratista/generate-excel', [FinanzasDeConstruccionController::class, 'generateExcelContratista']);
    // tablero historial pago contratista
    Route::post('/microservice/finanzas-de-construccion/ciudad/contratista/historial-pago-tablero-index', [FinanzasDeConstruccionController::class, 'tableroIndexHistorialPagoContratista']);
    Route::post('/microservice/finanzas-de-construccion/ciudad/contratista/historial-pago-tablero-create', [FinanzasDeConstruccionController::class, 'rowTableroCreateHistorialPagoContratista']);
    Route::put('/microservice/finanzas-de-construccion/ciudad/contratista/historial-pago-tablero-update', [FinanzasDeConstruccionController::class, 'rowTableroUpdateHistorialPagoContratista']);
    Route::post('/microservice/finanzas-de-construccion/ciudad/contratista/historial-pago-tablero-destroy', [FinanzasDeConstruccionController::class, 'rowTableroDestroyHistorialPagoContratista']);
    //grafico, calendario,gantt 
    Route::post('/microservice/finanzas-de-construccion/ciudad/contratista/graphic-estado', [FinanzasDeConstruccionController::class, 'graphicEstadoContratista']);
    Route::post('/microservice/finanzas-de-construccion/ciudad/contratista/calendar-fecha-inicio', [FinanzasDeConstruccionController::class, 'calendarFechaInicioContratista']);
    Route::post('/microservice/finanzas-de-construccion/ciudad/contratista/gantt-fecha-inicio', [FinanzasDeConstruccionController::class, 'ganttFechaInicioContratista']);
});



//Inventario
Route::get('/inventario/ciudad', [InventarioController::class, 'viewCiudad'])->middleware('auth')->name('r-ciudad-inventario');
Route::group(['middleware' => ['auth', 'check.city.access']], function () {
    //vistas
    Route::get('/inventario/tablero/{ciudad}', [InventarioController::class, 'viewTablero'])->name('r-tablero-inventario');
    Route::get('/inventario/grafico/{ciudad}', [InventarioController::class, 'viewGrafico'])->name('r-grafico-inventario');
    Route::get('/inventario/calendario/{ciudad}', [InventarioController::class, 'viewCalendario'])->name('r-calendario-inventario');
    Route::get('/inventario/gantt/{ciudad}', [InventarioController::class, 'viewGantt'])->name('r-gantt-inventario');
    //tablero
    Route::post('/microservice/inventario/ciudad/tablero-index', [InventarioController::class, 'tableroIndex']);
    Route::post('/microservice/inventario/ciudad/tablero-create', [InventarioController::class, 'rowTableroCreate']);
    Route::put('/microservice/inventario/ciudad/tablero-update', [InventarioController::class, 'rowTableroUpdate']);
    Route::post('/microservice/inventario/ciudad/tablero-destroy', [InventarioController::class, 'rowTableroDestroy']);
    Route::post('/microservice/inventario/ciudad/buscar-contrato-by-contratista', [InventarioController::class, 'buscarContratoByContratista']);
    Route::post('/microservice/inventario/ciudad/generate-excel', [InventarioController::class, 'generateExcel']);
    // //grafico,calendario,gantt 
    Route::post('/microservice/inventario/ciudad/graphic-material', [InventarioController::class, 'graphicMaterial']);
    Route::post('/microservice/inventario/ciudad/calendar-fecha-ingreso', [InventarioController::class, 'calendarFechaIngreso']);
    Route::post('/microservice/inventario/ciudad/gantt-fecha-ingreso', [InventarioController::class, 'ganttFechaIngreso']);
});



//disenio
Route::group(['middleware' => ['auth']], function () {
    //vistas
    Route::get('/disenio/tablero/', [DisenioController::class, 'viewTablero'])->name('r-tablero-disenio');
    Route::get('/disenio/grafico/', [DisenioController::class, 'viewGrafico'])->name('r-grafico-disenio');
    Route::get('/disenio/calendario', [DisenioController::class, 'viewCalendario'])->name('r-calendario-disenio');
    //tablero
    Route::post('/microservice/disenio/tablero-index', [DisenioController::class, 'tableroIndexDisenio']);
    Route::post('/microservice/disenio/tablero-create', [DisenioController::class, 'rowTableroCreateDisenio']);
    Route::put('/microservice/disenio/tablero-update', [DisenioController::class, 'rowTableroUpdateDisenio']);
    Route::post('/microservice/disenio/tablero-destroy', [DisenioController::class, 'rowTableroDestroyDisenio']);
    Route::post('/microservice/disenio/buscar-cliente', [DisenioController::class, 'buscarCliente']);
    Route::post('/microservice/disenio/generate-excel', [DisenioController::class, 'generateExcelDisenio']);
    //tablero,proceso
    Route::post('/microservice/disenio/proceso/index-proceso', [DisenioController::class, 'indexProceso']);
    Route::post('/microservice/disenio/proceso/is-refresh-proceso', [DisenioController::class, 'isRefreshProceso']);
    //tablero,pestado
    Route::post('/microservice/disenio/estado/index-estado', [DisenioController::class, 'indexEstado']);
    Route::post('/microservice/disenio/estado/is-refresh-estado', [DisenioController::class, 'isRefreshEstado']);
    Route::post('/microservice/disenio/estado/generate-num-codigo-estado', [DisenioController::class, 'generateNumCodigoEstado']);
    //tablero,revision
    Route::post('/microservice/disenio/revision/tablero-index', [DisenioController::class, 'tableroIndexRevisionDisenio']);
    Route::post('/microservice/disenio/revision/tablero-create', [DisenioController::class, 'rowTableroCreateRevisionDisenio']);
    Route::put('/microservice/disenio/revision/tablero-update', [DisenioController::class, 'rowTableroUpdateRevisionDisenio']);
    Route::post('/microservice/disenio/revision/tablero-destroy', [DisenioController::class, 'rowTableroDestroyRevisionDisenio']);
    //tablero,modificacion
    Route::post('/microservice/disenio/modificacion/tablero-index', [DisenioController::class, 'tableroIndexModificacionDisenio']);
    Route::post('/microservice/disenio/modificacion/tablero-create', [DisenioController::class, 'rowTableroCreateModificacionDisenio']);
    Route::put('/microservice/disenio/modificacion/tablero-update', [DisenioController::class, 'rowTableroUpdateModificacionDisenio']);
    Route::post('/microservice/disenio/modificacion/tablero-destroy', [DisenioController::class, 'rowTableroDestroyModificacionDisenio']);
    //grafico, proceso
    Route::post('/microservice/disenio/proceso/graphic-proceso', [DisenioController::class, 'graphicProceso']);
    //calendario, revision
    Route::post('/microservice/disenio/revision/calendar-fecha-all', [DisenioController::class, 'calendarFechaAllRevision']);
    //calendario,estado
    Route::post('/microservice/disenio/estado/calendar-fecha-all', [DisenioController::class, 'calendarFechaAllEstado']);
    //calendario, modificacion
    Route::post('/microservice/disenio/modificacion/calendar-fecha', [DisenioController::class, 'calendarFechaModificacion']);
});


//CCD
Route::get('/operacion/ccd', [CCDController::class, 'index'])->middleware('auth')->name('r-ccd-operation');
