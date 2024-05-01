<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;
use App\Models\Inventario;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventarioExport;
use App\Http\Requests\InventarioRequest;
use App\Models\Contratista;
use App\Models\UserHasPermiso;
use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{

    public function viewCiudad()
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

            return view('inventario/inventario-ciudad-view', [
                'ciudades' => $ciudades,
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }

    public function viewTablero(String $city)
    {
        try {
            return view('inventario/tablero-inventario-ciudad-view', [
                'ciudad' => $city,
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }


    public function viewGrafico(String $city)
    {
        try {
            return view('inventario/grafico-inventario-ciudad-view', [
                'ciudad' => $city,
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }

    public function viewCalendario(String $city)
    {
        try {
            return view('inventario/calendario-inventario-ciudad-view', [
                'ciudad' => $city
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }


    public function viewGantt(String $city)
    {
        try {
            //verificamos si los paorametros de la url son validos
            return view('inventario/gantt-inventario-ciudad-view', [
                'ciudad' => $city,
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
            if ($request->input('month') == 'todos') {
                $inventario = Inventario::join('contratistas', 'contratistas.id', '=', 'inventario.id_contratista')
                    ->join('contratos', 'contratos.id', '=', 'contratistas.id_contrato')
                    ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('contratos.n_contrato as n_contrato_contratista', 'inventario.*')
                    ->where('inventario.status', true)
                    ->where('contratistas.status', true)
                    ->where('contratos.status', true)
                    ->where('clientes.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('inventario.fecha_ingreso', $request->input('year'))
                    ->get();
            } else {
                $inventario = Inventario::join('contratistas', 'contratistas.id', '=', 'inventario.id_contratista')
                    ->join('contratos', 'contratos.id', '=', 'contratistas.id_contrato')
                    ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('contratos.n_contrato as n_contrato_contratista', 'inventario.*')
                    ->where('inventario.status', true)
                    ->where('contratistas.status', true)
                    ->where('contratos.status', true)
                    ->where('clientes.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('inventario.fecha_ingreso', $request->input('year'))
                    ->whereMonth('inventario.fecha_ingreso', $meses[$request->input('month')])
                    ->get();
            }
            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $inventario,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => [],
            ], 500);
        }
    }

    public function rowTableroCreate(InventarioRequest $request)
    {
        try {
            //el $fillable del modelo son todos los campos que se insertan en la base de datos
            //si el campo a insertar no esta listado en el array $fillable entonces
            //ese campo no se insertara en la base de datos, aunque en $request->all() este ese campo
            //ese campo sera omitido
            $inventario = new Inventario($request->all());
            $inventario->status = true;
            $inventario->save();
            return response()->json([
                'record' => $inventario,
                'status' => true,
                'message' => "Registro creado!",
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'record' => null,
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function buscarContratoByContratista(Request $request)
    {
        try {
            $inventario = Contratista::join('contratos', 'contratos.id', '=', 'contratistas.id_contrato')
                ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                ->select('contratistas.id', 'contratos.n_contrato as n_contrato_contratista')
                ->where('clientes.status', true)
                ->where('contratos.status', true)
                ->where('contratistas.status', true)
                ->where('ciudades.city_name', $request->input('ciudad'))
                ->where('contratos.n_contrato', $request->input('numero_contrato_contratista'))
                ->first();

            if ($inventario == null) {
                return response()->json([
                    'status' => false,
                    'message' => "Ningun registro coincide con el n° de contrato/contratista {$request->input('numero_contrato_contratista')}, 
                     verifique si el contrato/contratista esta registrado
                     y/o el contrato/contratista no pertenece a la ciudad de {$request->input('ciudad')}!",
                    'record' => [],
                ], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Registro encontrado!',
                    'record' => $inventario,
                ], 200);
            }
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => null,
            ], 500);
        }
    }

    public function rowTableroUpdate(InventarioRequest $request)
    {
        try {
            //el $fillable del modelo son todos los campos que se insertan en la base de datos
            //si el campo a insertar no esta listado en el array $fillable entonces
            //ese campo no se insertara en la base de datos, aunque en $request->all() este ese campo
            //ese campo sera omitido
            $inventario = Inventario::where('status', true)->where('id', $request->input('id'))->first();
            $inventario->update($request->all());

            return response()->json([
                'status' => true,
                'message' => "Registro modificado exitosamente!",
                'record' => $inventario,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => null,
            ], 500);
        }
    }

    public function rowTableroDestroy(Request $request)
    {
        try {
            $inventario = Inventario::find($request->input('id'));
            $inventario->status = false;
            $inventario->update();

            return response()->json([
                'status' => true,
                'message' => "Material del inventario, eliminado exitosamente!",
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function generateExcel(Request $request)
    {
        try {
            // Descargar el archivo Excel directamente usando Excel::download
            //enviarlo como respuesta de tipo blob
            return Excel::download(new InventarioExport($request), 'archivo.xlsx', \Maatwebsite\Excel\Excel::XLSX, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename=archivo.xlsx'
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function graphicMaterial(Request $request)
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

            if ($request->input('month') == 'todos') {
                $inventario = Inventario::join('contratistas','contratistas.id','=','inventario.id_contratista')
                ->join('contratos', 'contratos.id', '=', 'contratistas.id_contrato')
                    ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('inventario.material', DB::raw('SUM(inventario.cantidad) as cantidad_total'))
                    ->where('clientes.status', true)
                    ->where('contratos.status', true)
                    ->where('contratistas.status', true)
                    ->where('inventario.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('inventario.fecha_ingreso', $request->input('year'))
                    ->groupBy('inventario.material')
                    ->get();

            } else {
                $inventario = Inventario::join('contratistas','contratistas.id','=','inventario.id_contratista')
                ->join('contratos', 'contratos.id', '=', 'contratistas.id_contrato')
                    ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('inventario.material', DB::raw('SUM(inventario.cantidad) as cantidad_total'))
                    ->where('clientes.status', true)
                    ->where('contratos.status', true)
                    ->where('contratistas.status', true)
                    ->where('inventario.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('inventario.fecha_ingreso', $request->input('year'))
                    ->whereMonth('inventario.fecha_ingreso', $meses[$request->input('month')])
                    ->groupBy('inventario.material')
                    ->get();
            }



            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $inventario,
            ], 200);
        } catch (Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => [],
            ], 500);
        }
    }


    public function  calendarFechaIngreso(Request $request)
    {
        try {
            $inventario = Inventario::join('contratistas', 'contratistas.id', 'inventario.id_contratista')
                ->join('contratos', 'contratos.id', '=', 'contratistas.id_contrato')
                ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                ->select('inventario.material', 'inventario.fecha_ingreso', 'contratos.n_contrato')
                ->where('clientes.status', true)
                ->where('contratos.status', true)
                ->where('contratistas.status', true)
                ->where('inventario.status', true)
                ->where('ciudades.city_name',  $request->input('ciudad'))
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $inventario,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => null,
            ], 500);
        }
    }

    public function ganttFechaIngreso(Request $request)
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

            if ($request->input('month') == 'todos') {
                $inventario = Inventario::join('contratistas', 'contratistas.id', '=', 'inventario.id_contratista')
                    ->join('contratos', 'contratos.id', '=', 'contratistas.id_contrato')
                    ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('inventario.material', 'contratos.n_contrato', 'inventario.fecha_ingreso', 'inventario.n_recibo')
                    ->where('clientes.status', true)
                    ->where('contratos.status', true)
                    ->where('contratistas.status', true)
                    ->where('inventario.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('inventario.fecha_ingreso', $request->input('year'))
                    ->get();
            } else {
                $inventario = Inventario::join('contratistas', 'contratistas.id', '=', 'inventario.id_contratista')
                    ->join('contratos', 'contratos.id', '=', 'contratistas.id_contrato')
                    ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('inventario.material', 'contratos.n_contrato', 'inventario.fecha_ingreso', 'inventario.n_recibo')
                    ->where('clientes.status', true)
                    ->where('contratos.status', true)
                    ->where('contratistas.status', true)
                    ->where('inventario.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('inventario.fecha_ingreso', $request->input('year'))
                    ->whereMonth('inventario.fecha_ingreso', $meses[$request->input('month')])
                    ->get();
            }

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $inventario,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => null,
            ], 500);
        }
    }
}//class
