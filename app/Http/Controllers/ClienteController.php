<?php

namespace App\Http\Controllers;

use App\Exports\ClienteExport;
use App\Http\Requests\ClienteRequest;

use App\Models\Ciudad;
use App\Models\Cliente;
use App\Models\Grupo;
use App\Models\Responsable;
use App\Models\UserHasPermiso;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use Maatwebsite\Excel\Facades\Excel;

class ClienteController extends Controller
{
    public function indexView()
    {
        try {
            $user = Auth::user();
            $user_has_permiso = UserHasPermiso::join("permisos", "permisos.id", "=", 'users_has_permisos.id_permiso')
                ->select("permisos.*")
                ->where("users_has_permisos.id_user", $user->id)
                ->where("users_has_permisos.status", true)
                ->orderBy("permisos.id", "ASC")
                ->get();

            $ciudades = [];
            foreach ($user_has_permiso as $row) {
                if ($row->type_content == 'cities') {
                    $ciudades[] = $row->code_content;
                }
            }

            $city_groups = [];
            foreach ($user_has_permiso as $row) {
                if ($row->type_content == 'groups') {
                    // el numero de grupo viene asi Santa-Cruz_01 , Santa-Cruz_02 
                    // Entonces debemos separar la ciudad y su correspondiente grupo
                    // al aplicar explode, tenemnos un array, de este tipo ['Santa-Cruz', '02']
                    $parts = explode('_', $row->code_content);

                    $city_groups[] = [
                        "ciudad" => $parts[0],
                        "grupo" =>  $parts[1],
                    ];
                }
            }

            return view(
                'cliente/ciudad-view',
                [
                    'ciudades' => $ciudades,
                    'city_groups' => $city_groups,
                ]
            );
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }

    public function tableroView(string $city, string $grupo_num)
    {
        try {
            //obtenemos todos los grupos que tiene acceso el usuario
            $user = Auth::user();
            $user_has_permiso = UserHasPermiso::join("permisos", "permisos.id", "=", 'users_has_permisos.id_permiso')
                ->select("permisos.*")
                ->where("users_has_permisos.id_user", $user->id)
                ->where("users_has_permisos.status", true)
                ->get();

            $manage_groups = [];
            foreach ($user_has_permiso as $row) {
                if ($row->type_content == 'groups') {
                    // el numero de grupo viene asi Santa-Cruz_01 , Santa-Cruz_02 
                    // Entonces debemos separar la ciudad y su correspondiente grupo
                    // al aplicar explode, tenemnos un array, de este tipo ['Santa-Cruz', '02']
                    $parts = explode('_', $row->code_content);
                    if ($parts[0] == $city) {
                        $manage_groups[] = $parts[1];
                    }
                }
            }

            // Ordenamos los grupos de forma ascendente
            // porque podria haber la posibilidad de que esten desordenados [10, 02, 03, 01, 04]
            sort($manage_groups);

            return view('cliente/tablero-grupo-cliente-view', [
                "manage_groups" => $manage_groups,
                'city' => $city,
                'grupo_active' => $grupo_num
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }

    public function graficoView(string $city, string $grupo_num)
    {
        try {
            //obtenemos todos los grupos que tiene acceso el usuario
            $user = Auth::user();
            $user_has_permiso = UserHasPermiso::join("permisos", "permisos.id", "=", 'users_has_permisos.id_permiso')
                ->select("permisos.*")
                ->where("users_has_permisos.id_user", $user->id)
                ->where("users_has_permisos.status", true)
                ->get();

            $manage_groups = [];
            foreach ($user_has_permiso as $row) {
                if ($row->type_content == 'groups') {
                    // el numero de grupo viene asi Santa-Cruz_01 , Santa-Cruz_02 
                    // Entonces debemos separar la ciudad y su correspondiente grupo
                    // al aplicar explode, tenemnos un array, de este tipo ['Santa-Cruz', '02']
                    $parts = explode('_', $row->code_content);
                    if ($parts[0] == $city) {
                        $manage_groups[] = $parts[1];
                    }
                }
            }

            // Ordenamos los grupos de forma ascendente
            // porque podria haber la posibilidad de que esten desordenados [10, 02, 03, 01, 04]
            sort($manage_groups);

            return view('cliente/grafico-grupo-cliente-view', [
                "manage_groups" => $manage_groups,
                'city' => $city,
                'grupo_active' => $grupo_num
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }

    public function calendarioView(string $city, string $grupo_num)
    {
        try {
            //obtenemos todos los grupos que tiene acceso el usuario
            $user = Auth::user();
            $user_has_permiso = UserHasPermiso::join("permisos", "permisos.id", "=", 'users_has_permisos.id_permiso')
                ->select("permisos.*")
                ->where("users_has_permisos.id_user", $user->id)
                ->where("users_has_permisos.status", true)
                ->get();

            $manage_groups = [];
            foreach ($user_has_permiso as $row) {
                if ($row->type_content == 'groups') {
                    // el numero de grupo viene asi Santa-Cruz_01 , Santa-Cruz_02 
                    // Entonces debemos separar la ciudad y su correspondiente grupo
                    $parts = explode('_', $row->code_content);
                    if ($parts[0] == $city) {
                        $manage_groups[] = $parts[1];
                    }
                }
            }

            // Ordenamos los grupos de forma ascendente
            // porque podria haber la posibilidad de que esten desordenados [10, 02, 03, 01, 04]
            sort($manage_groups);

            return view('cliente/calendar-grupo-cliente-view', [
                "manage_groups" => $manage_groups,
                'city' => $city,
                'grupo_active' => $grupo_num
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }


    public function ganttView(string $city, string $grupo_num)
    {
        try {
            //obtenemos todos los grupos que tiene acceso el usuario
            $user = Auth::user();
            $user_has_permiso = UserHasPermiso::join("permisos", "permisos.id", "=", 'users_has_permisos.id_permiso')
                ->select("permisos.*")
                ->where("users_has_permisos.id_user", $user->id)
                ->where("users_has_permisos.status", true)
                ->get();

            $manage_groups = [];
            foreach ($user_has_permiso as $row) {
                if ($row->type_content == 'groups') {
                    // el numero de grupo viene asi Santa-Cruz_01 , Santa-Cruz_02 
                    // Entonces debemos separar la ciudad y su correspondiente grupo
                    // obtenemos un array de esta manera ['Santa-Cruz', '02']
                    $parts = explode('_', $row->code_content);
                    if ($parts[0] == $city) {
                        $manage_groups[] = $parts[1];
                    }
                }
            }
            // Ordenamos los grupos de forma ascendente
            // porque podria haber la posibilidad de que esten desordenados [10, 02, 03, 01, 04]
            sort($manage_groups);


            return view('cliente/gantt-grupo-cliente-view', [
                "manage_groups" => $manage_groups,
                'city' => $city,
                'grupo_active' => $grupo_num
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }

    public function tableroIndex(Request $request)
    {
        try {
            $meses = [
                'enero' => '01',
                'febrero' => '02',
                'marzo' => '03',
                'abril' => '04',
                'mayo' => '05',
                'junio' => '06',
                'julio' => '07',
                'agosto' => '08',
                'septiembre' => '09',
                'octubre' => '10',
                'noviembre' => '11',
                'diciembre' => '12',
            ];

            $ciudad = Ciudad::where(
                'city_name',
                $request->input('ciudad')
            )->first();
            $grupo = Grupo::where('id_ciudad', $ciudad->id)
                ->where('grup_number', $request->input('grupo'))
                ->first();

            $user_permissions = Auth::user()->onPermission();
            $list_records_cliente_permissions = [];
            foreach ($user_permissions as $row) {
                if ($row->type == 'records') {
                    $list_records_cliente_permissions[] = $row->code_content;
                }
            }

            if (in_array('responsable_clients_records', $list_records_cliente_permissions)) {

                $cliente = Cliente::join('responsables', 'responsables.id_cliente', '=', 'clientes.id')
                    ->select("clientes.*")
                    ->where('clientes.id_grupo', $grupo->id)
                    ->where('responsables.id_personal', Auth::user()->id_personal)
                    ->where('clientes.status', true)
                    ->whereYear('clientes.fecha_reunion', $request->input('year'))
                    ->when(
                        $request->input('month') != 'todos', // si la expresion es verdadero aplica la funcion query
                        function ($query) use ($meses, $request) {
                            return $query->whereMonth('clientes.fecha_reunion', $meses[$request->input('month')]);
                        }
                    )
                    ->get();
            } elseif (in_array('all_clients_records', $list_records_cliente_permissions)) {

                $cliente = Cliente::where('status', true)
                    ->where('id_grupo', $grupo->id)
                    ->whereYear('fecha_reunion', $request->input('year'))
                    ->when(
                        $request->input('month') != 'todos',
                        function ($query) use ($meses, $request) {
                            return $query->whereMonth('fecha_reunion', $meses[$request->input('month')]);
                        }
                    )
                    ->get();
            } else {
                $cliente = null;
            }

            if ($cliente == null) {
                return response()->json([
                    'status' => false,
                    'records' => [],
                    'message' => 'No tienes acceso a los registros!',
                ], 401);
            }

            return response()->json([
                'status' => true,
                'records' => $cliente,
                'message' => 'OK',

            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'records' => [],
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function rowTableroCreate(ClienteRequest $request)
    {
        try {
            $ciudad = Ciudad::where('city_name', $request->input('ciudad'))->first();

            $grupo = Grupo::where('id_ciudad', $ciudad->id)
                ->where('grup_number', $request->input('grupo'))
                ->first();

            $cliente = new Cliente($request->except('ciudad', 'grupo'));
            $cliente->id_grupo = $grupo->id;
            $cliente->status = true;
            $cliente->save();

            //guardamos el responsable del cliente 
            $personal = Auth::user()->onPersonal()->first();
            $responsable = new Responsable();
            $responsable->id_personal = $personal->id;
            $responsable->id_cliente = $cliente->id;
            $responsable->save();

            // Formatear la hora antes de incluirla en la respuesta JSON
            //esto solo se debe   hacer a un update y create
            // cuando hacemos un update a la base de datos el formato de hora se vuelve asi '23:59' lo mismo pasa al hacer un create
            //entonces '23:59', ya no es un formato de hora valido
            $cliente->hora_reunion = Carbon::parse($cliente->hora_reunion)->format('H:i:s');


            return response()->json([
                'status' => true,
                'message' => 'Registro creado exitosamente!',
                'record' => $cliente,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => [],
            ], 500);
        }
    }


    public function rowTableroUpdate(ClienteRequest $request)
    {
        try {
            $user_permissions = Auth::user()->onPermission();
            $list_records_cliente_permissions = [];
            foreach ($user_permissions as $row) {
                if ($row->type == 'records') {
                    $list_records_cliente_permissions[] = $row->code_content;
                }
            }

            // verificar si el responsable del cliente esta editando 
            if (in_array('responsable_clients_records', $list_records_cliente_permissions)) {

                $cliente = Cliente::join('responsables', 'responsables.id_cliente', '=', 'clientes.id')
                    ->select("clientes.*")
                    ->where('responsables.id_personal', Auth::user()->id_personal)
                    ->where('clientes.id', $request->input('id'))
                    ->first();

                if ($cliente == null) {
                    return response()->json([
                        'status' => false,
                        'records' => [],
                        'message' => 'No tienes acceso al cliente registrado!',
                    ], 401);
                }
            } elseif (in_array('all_clients_records', $list_records_cliente_permissions)) {

                $cliente = Cliente::where('status', true)
                    ->where('id', $request->input('id'))
                    ->first();
            } else {
                $cliente = null;
            }

            if ($cliente == null) {
                return response()->json([
                    'status' => false,
                    'records' => [],
                    'message' => 'No se encontro ningun registro!',
                ], 404);
            }

            $personal = Auth::user()->onPersonal()->first();

            // verificamos si el responsable esta registrado o es un nuevo responsable que esta editando el registro
            $verified_responable = Responsable::where('id_cliente', $cliente->id)
                ->where('id_personal', $personal->id)
                ->first();

            if ($verified_responable == null) {
                $responsable = new Responsable();
                $responsable->id_personal = $personal->id;
                $responsable->id_cliente = $cliente->id;
                $responsable->save();
            }
            $cliente->fill($request->except('grupo', 'ciudad'));
            $cliente->update();

            // Formatear la hora antes de incluirla en la respuesta JSON
            //esto solo se debe   hacer a un update y create
            // cuando hacemos un update a la base de datos el formato de hora se vuelve asi '23:59' lo mismo pasa al hacer un create
            //entonces '23:59', ya no es un formato de hora valido
            $cliente->hora_reunion = Carbon::parse($cliente->hora_reunion)->format('H:i:s');


            return response()->json([
                'status' => true,
                'message' => 'Registro modificado exitosamente!',
                'record' => $cliente,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => null,
            ], 500);
        }
    }


    public function  rowTableroDestroy(Request $request)
    {
        try {
            $user_permissions = Auth::user()->onPermission();
            $list_records_cliente_permissions = [];
            foreach ($user_permissions as $row) {
                if ($row->type == 'records') {
                    $list_records_cliente_permissions[] = $row->code_content;
                }
            }

            // verificar si el responsable del cliente esta editando 
            if (in_array('responsable_clients_records', $list_records_cliente_permissions)) {

                $cliente = Cliente::join('responsables', 'responsables.id_cliente', '=', 'clientes.id')
                    ->select("clientes.*")
                    ->where('responsables.id_personal', Auth::user()->id_personal)
                    ->where('clientes.id', $request->input('id'))
                    ->first();

                if ($cliente == null) {
                    return response()->json([
                        'status' => false,
                        'records' => [],
                        'message' => 'No tienes acceso al cliente registrado!',
                    ], 401);
                }
            } elseif (in_array('all_clients_records', $list_records_cliente_permissions)) {

                $cliente = Cliente::where('status', true)
                    ->where('id', $request->input('id'))
                    ->first();
            } else {
                $cliente = null;
            }

            if ($cliente == null) {
                return response()->json([
                    'status' => false,
                    'records' => [],
                    'message' => 'No tienes acceso a los registros!',
                ], 401);
            }

            //verificamos si el responsable esta editando y si no es asi no permitimos la edicion 
            $personal = Auth::user()->onPersonal()->first();

            //si no encuentro el responsable significa que es un nuevo responsable  el que esta eliminando el registro del cliente
            // entonces agreamos al  otro responsable del cliente
            //de esta forma sabremos quienes manipularon este registro
            $verified_responable = Responsable::where('id_cliente', $cliente->id)
                ->where('id_personal', $personal->id)
                ->first();
            if ($verified_responable == null) {
                $responsable = new Responsable();
                $responsable->id_personal = $personal->id;
                $responsable->id_cliente = $cliente->id;
                $responsable->save();
            }
            $cliente->status = false;
            $cliente->update();

            return response()->json([
                'status' => true,
                'message' => 'Registro eliminado!',
            ], 200);
        } catch (Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function recordClienteResponsable(Request $request)
    {
        try {
            $cliente = Cliente::join('responsables', 'responsables.id_cliente', '=', 'clientes.id')
                ->join('personals', 'personals.id', '=', 'responsables.id_personal')
                ->select(
                    'personals.nombres',
                    'personals.apellido_paterno',
                    'personals.apellido_materno',
                    'responsables.*',
                )
                ->where('clientes.id', $request->input('id_cliente'))
                ->orderBy('responsables.id', 'ASC')
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $cliente,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => [],
            ], 200);
        }
    }

    public function generateExcel(Request $request)
    {
        try {
            // Descargar el archivo Excel directamente usando Excel::download
            //enviarlo como respues a vue donde axios 
            return Excel::download(new ClienteExport($request), 'archivo.xlsx', \Maatwebsite\Excel\Excel::XLSX, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename=archivo.xlsx'
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'excel' => null,
            ], 500);
        }
    }

    public function graphicEstado(Request $request)
    {
        try {
            $ciudad = Ciudad::where('city_name', $request->input('ciudad'))
                ->first();

            $grupo = Grupo::where('id_ciudad', $ciudad->id)
                ->where('grup_number', $request->input('grupo'))
                ->first();

            $meses = [
                'enero' => '01',
                'febrero' => '02',
                'marzo' => '03',
                'abril' => '04',
                'mayo' => '05',
                'junio' => '06',
                'julio' => '07',
                'agosto' => '08',
                'septiembre' => '09',
                'octubre' => '10',
                'noviembre' => '11',
                'diciembre' => '12',
            ];

            $user_permissions = Auth::user()->onPermission();
            $list_records_cliente_permissions = [];
            foreach ($user_permissions as $row) {
                if ($row->type == 'records') {
                    $list_records_cliente_permissions[] = $row->code_content;
                }
            }
            if (in_array('responsable_clients_records', $list_records_cliente_permissions)) {

                $cliente = Cliente::join('responsables', 'responsables.id_cliente', '=', 'clientes.id')
                    ->select('clientes.estado', DB::raw('COUNT(clientes.estado) as total'))
                    ->where('clientes.id_grupo', $grupo->id)
                    ->where('responsables.id_personal', Auth::user()->id_personal)
                    ->where('clientes.status', true)
                    ->whereYear('clientes.fecha_reunion', $request->input('year'))
                    ->when(
                        $request->input('month') !=  'todos',
                        function ($query) use ($meses, $request) {
                            return $query->whereMonth('clientes.fecha_reunion', $meses[$request->input('month')]);
                        }
                    )
                    ->groupBy('clientes.estado')
                    ->get();
            } elseif (in_array('all_clients_records', $list_records_cliente_permissions)) {

                $cliente = Cliente::select('estado', DB::raw('COUNT(estado) as total'))
                    ->where('id_grupo', $grupo->id)
                    ->where('status', true)
                    ->whereYear('fecha_reunion', $request->input('year'))
                    ->when(
                        $request->input('month') !=  'todos',
                        function ($query) use ($meses, $request) {
                            return $query->whereMonth('fecha_reunion', $meses[$request->input('month')]);
                        }
                    )
                    ->groupBy('estado')
                    ->get();
            } else {
                $cliente = null;
            }

            if ($cliente == null) {
                return response()->json([
                    'status' => false,
                    'records' => [],
                    'message' => 'No tienes acceso a los registros!',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $cliente,
            ], 200);
        } catch (Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => [],
            ], 500);
        }
    }

    public function  calendarMeeting(Request $request)
    {
        try {
            $ciudad = Ciudad::where('city_name', $request->input('ciudad'))
                ->first();

            $grupo = Grupo::where('id_ciudad', $ciudad->id)
                ->where('grup_number', $request->input('grupo'))
                ->first();


            $user_permissions = Auth::user()->onPermission();
            $list_records_cliente_permissions = [];
            foreach ($user_permissions as $row) {
                if ($row->type == 'records') {
                    $list_records_cliente_permissions[] = $row->code_content;
                }
            }
            if (in_array('responsable_clients_records', $list_records_cliente_permissions)) {

                $cliente = Cliente::join('responsables', 'responsables.id_cliente', '=', 'clientes.id')
                    ->select(
                        'clientes.nombres',
                        'clientes.apellido_paterno',
                        'clientes.apellido_materno',
                        'clientes.hora_reunion',
                        'clientes.fecha_reunion'
                    )
                    ->where('clientes.id_grupo', $grupo->id)
                    ->where('responsables.id_personal', Auth::user()->id_personal)
                    ->where('clientes.status', true)
                    ->get();
            } elseif (in_array('all_clients_records', $list_records_cliente_permissions)) {

                $cliente = Cliente::select('nombres', 'apellido_paterno', 'apellido_materno', 'hora_reunion', 'fecha_reunion')
                    ->where('id_grupo', $grupo->id)
                    ->where('status', true)
                    ->get();
            } else {
                $cliente = null;
            }

            if ($cliente == null) {
                return response()->json([
                    'status' => false,
                    'records' => [],
                    'message' => 'No tienes acceso a los registros!',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $cliente,
            ], 200);
        } catch (Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => [],
            ], 500);
        }
    }


    public function ganttMeeting(Request $request)
    {
        try {
            $meses = [
                'enero' => '01',
                'febrero' => '02',
                'marzo' => '03',
                'abril' => '04',
                'mayo' => '05',
                'junio' => '06',
                'julio' => '07',
                'agosto' => '08',
                'septiembre' => '09',
                'octubre' => '10',
                'noviembre' => '11',
                'diciembre' => '12',
            ];

            $ciudad = Ciudad::where('city_name', $request->input('ciudad'))
                ->first();
            $grupo = Grupo::where('id_ciudad', $ciudad->id)
                ->where('grup_number', $request->input('grupo'))
                ->first();

            $user_permissions = Auth::user()->onPermission();
            $list_records_cliente_permissions = [];
            foreach ($user_permissions as $row) {
                if ($row->type == 'records') {
                    $list_records_cliente_permissions[] = $row->code_content;
                }
            }
            if (in_array('responsable_clients_records', $list_records_cliente_permissions)) {

                $cliente = Cliente::join('responsables', 'responsables.id_cliente', '=', 'clientes.id')
                    ->select(
                        'clientes.nombres',
                        'clientes.apellido_paterno',
                        'clientes.apellido_materno',
                        'clientes.fecha_reunion',
                        'clientes.hora_reunion',
                    )
                    ->where('clientes.id_grupo', $grupo->id)
                    ->where('responsables.id_personal', Auth::user()->id_personal)
                    ->where('clientes.status', true)
                    ->whereYear('clientes.fecha_reunion', $request->input('year'))
                    ->when(
                        $request->input('month') !=  'todos',
                        function ($query) use ($meses, $request) {
                            return $query->whereMonth('clientes.fecha_reunion', $meses[$request->input('month')]);
                        }
                    )
                    ->get();
            } elseif (in_array('all_clients_records', $list_records_cliente_permissions)) {

                $cliente = Cliente::select('nombres', 'apellido_paterno', 'apellido_materno', 'fecha_reunion', 'hora_reunion')
                    ->where('id_grupo', $grupo->id)
                    ->where('status', true)
                    ->whereYear('fecha_reunion', $request->input('year'))
                    ->when(
                        $request->input('month') !=  'todos',
                        function ($query) use ($meses, $request) {
                            return $query->whereMonth('fecha_reunion', $meses[$request->input('month')]);
                        }
                    )
                    ->get();
            } else {
                $cliente = null;
            }

            if ($cliente == null) {
                return response()->json([
                    'status' => false,
                    'records' => [],
                    'message' => 'No tienes acceso a los registros!',
                ], 401);
            }

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $cliente,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => [],
            ], 500);
        }
    }
}//class
