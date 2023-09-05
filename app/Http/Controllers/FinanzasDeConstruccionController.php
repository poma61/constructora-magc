<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContratistaRequest;
use App\Models\Ciudad;
use App\Models\Contratista;
use App\Models\Contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContratistaExport;
use App\Http\Requests\HistorialPagoContratistaRequest;
use App\Models\HistorialPagoContratista;
use Illuminate\Support\Facades\DB;

class FinanzasDeConstruccionController extends Controller
{

    public function viewCiudad()
    {
        try {
            $user = Auth::user()->onPersonal()->first();
            $ciudad = Ciudad::where('id', $user->id_ciudad)->first();
            $list_ciudades = Ciudad::all();
            return view('finanzas-de-construccion/ciudad-finanzas-de-construccion-view', [
                'ciudad' => $ciudad,
                'list_ciudades' => $list_ciudades,
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }


    public function viewTableroContratista(String $city)
    {
        try {
            //verificamos si los paorametros de la url son validos
            $ciudad = Ciudad::where('city_name', $city)->first();
            if ($ciudad == null) {
                return view('error-page-view');
            }

            return view('finanzas-de-construccion/tablero-ciudad-contratista-view', [
                'ciudad' => $ciudad->city_name,
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }


    public function viewGraficoContratista(String $city)
    {
        try {
            //verificamos si los paorametros de la url son validos
            $ciudad = Ciudad::where('city_name', $city)->first();
            if ($ciudad == null) {
                return view('error-page-view');
            }

            return view('finanzas-de-construccion/grafico-ciudad-contratista-view', [
                'ciudad' => $ciudad->city_name,
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }

    public function viewCalendarioContratista(String $city)
    {
        try {
            //verificamos si los paorametros de la url son validos
            $ciudad = Ciudad::where('city_name', $city)->first();
            if ($ciudad == null) {
                return view('error-page-view');
            }

            return view('finanzas-de-construccion/calendario-ciudad-contratista-view', [
                'ciudad' => $ciudad->city_name,
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }


    public function viewGanttContratista(String $city)
    {
        try {
            //verificamos si los paorametros de la url son validos
            $ciudad = Ciudad::where('city_name', $city)->first();
            if ($ciudad == null) {
                return view('error-page-view');
            }

            return view('finanzas-de-construccion/gantt-ciudad-contratista-view', [
                'ciudad' => $ciudad->city_name,
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }


    public function tableroIndexContratista(Request $request)
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
                $contratista = Contratista::join('contratos', 'contratos.id', '=', 'contratistas.id_contrato')
                    ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('contratos.n_contrato', 'contratistas.*')
                    ->where('clientes.status', true)
                    ->where('contratos.status', true)
                    ->where('contratistas.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('contratistas.fecha_inicio', $request->input('year'))
                    ->get();
            } else {
                $contratista = Contratista::join('contratos', 'contratos.id', '=', 'contratistas.id_contrato')
                    ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('contratos.n_contrato', 'contratistas.*')
                    ->where('clientes.status', true)
                    ->where('contratos.status', true)
                    ->where('contratistas.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('contratistas.fecha_inicio', $request->input('year'))
                    ->whereMonth('contratistas.fecha_inicio', $meses[$request->input('month')])
                    ->get();
            }

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $contratista,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => [],
            ], 500);
        }
    }



    public function rowTableroCreateContratista(ContratistaRequest $request)
    {
        try {
            //el $fillable del modelo son todos los campos que se insertan en la base de datos
            //si el campo a insertar no esta listado en el array $fillable entonces
            //ese campo no se insertara en la base de datos, aunque en $request->all() este ese campo
            //ese campo sera omitido
            $contratista = new Contratista($request->all());
            $contratista->status = true;
            $contratista->save();


            return response()->json([
                'status' => true,
                'message' => "Registro creado!",
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function buscarContratoContratista(Request $request)
    {
        try {
            $contrato = Contrato::join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                ->select('contratos.id', 'contratos.n_contrato')
                ->where('clientes.status', true)
                ->where('contratos.status', true)
                ->where('ciudades.city_name', $request->input('ciudad'))
                ->where('contratos.n_contrato', $request->input('numero_contrato'))
                ->first();

            if ($contrato == null) {
                return response()->json([
                    'status' => false,
                    'message' => "Ningun registro coincide con el n° de contrato {$request->input('numero_contrato')}, 
                     verifique si el contrato esta registrado
                     y/o el contrato no pertenece a la ciudad de {$request->input('ciudad')}!",
                    'record' => [],
                ], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Registro encontrado!',
                    'record' => $contrato,
                ], 200);
            }
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => [],
            ], 500);
        }
    }

    public function rowTableroUpdateContratista(ContratistaRequest $request)
    {
        try {
            //el $fillable del modelo son todos los campos que se insertan en la base de datos
            //si el campo a insertar no esta listado en el array $fillable entonces
            //ese campo no se insertara en la base de datos, aunque en $request->all() este ese campo
            //ese campo sera omitido
            $contrato = Contratista::where('status', true)->where('id', $request->input('id'))->first();
            $contrato->update($request->all());

            return response()->json([
                'status' => true,
                'message' => "Registro modificado exitosamente!",
                'record' => $contrato,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => [],
            ], 500);
        }
    }

    public function rowTableroDestroyContratista(Request $request)
    {
        try {
            $contratista = Contratista::find($request->input('id'));
            $contratista->status = false;
            $contratista->update();

            return response()->json([
                'status' => true,
                'message' => "Contrato eliminado exitosamente!",
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function generateExcelContratista(Request $request)
    {
        try {
            // Descargar el archivo Excel directamente usando Excel::download
            //enviarlo como respuesta de tipo blob
            return Excel::download(new ContratistaExport($request), 'archivo.xlsx', \Maatwebsite\Excel\Excel::XLSX, [
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


    public function tableroIndexHistorialPagoContratista(Request $request)
    {
        try {
            $historial_pago_contratista = HistorialPagoContratista::join('contratistas', 'contratistas.id', '=', 'historial_pago_contratista.id_contratista')
                ->join('contratos', 'contratos.id', '=', 'contratistas.id_contrato')
                ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                ->select('historial_pago_contratista.*')
                ->where('clientes.status', true)
                ->where('contratos.status', true)
                ->where('contratistas.status', true)
                ->where('historial_pago_contratista.status', true)
                ->where('ciudades.city_name',  $request->input('ciudad'))
                ->where('historial_pago_contratista.id_contratista',  $request->input('id_contratista'))
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $historial_pago_contratista,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => [],
            ], 500);
        }
    }


    public function rowTableroCreateHistorialPagoContratista(HistorialPagoContratistaRequest $request)
    {
        try {
            //el $fillable del modelo son todos los campos que se insertan en la base de datos
            //si el campo a insertar no esta listado en el array $fillable entonces
            //ese campo no se insertara en la base de datos, aunque en $request->all() este ese campo
            //ese campo sera omitido
            $historial_pago_contratista = new HistorialPagoContratista($request->all());
            $historial_pago_contratista->status = true;
            $historial_pago_contratista->save();

            return response()->json([
                'status' => true,
                'message' => "Registro creado!",
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function rowTableroUpdateHistorialPagoContratista(HistorialPagoContratistaRequest $request)
    {
        try {
            $historial_pago_contratista = HistorialPagoContratista::where('status', true)->where('id', $request->input('id'))->first();
            $historial_pago_contratista->update($request->all());

            return response()->json([
                'status' => true,
                'message' => "Registro modificado exitosamente!",
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function rowTableroDestroyHistorialPagoContratista(Request $request)
    {
        try {
            $historial_pago_contratista = HistorialPagoContratista::find($request->input('id'));
            $historial_pago_contratista->status = false;
            $historial_pago_contratista->update();

            return response()->json([
                'status' => true,
                'message' => "Registro modificado exitosamente!",
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function graphicEstadoContratista(Request $request)
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
                $contratista = Contratista::join('contratos', 'contratos.id', '=', 'contratistas.id_contrato')
                    ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('contratistas.estado', DB::raw('COUNT(contratistas.estado) as total'))
                    ->where('clientes.status', true)
                    ->where('contratos.status', true)
                    ->where('contratistas.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('contratistas.fecha_inicio', $request->input('year'))
                    ->groupBy('contratistas.estado')
                    ->get();
            } else {
                $contratista = Contratista::join('contratos', 'contratos.id', '=', 'contratistas.id_contrato')
                    ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('contratistas.estado', DB::raw('COUNT(contratistas.estado) as total'))
                    ->where('clientes.status', true)
                    ->where('contratos.status', true)
                    ->where('contratistas.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('contratistas.fecha_inicio', $request->input('year'))
                    ->whereMonth('contratistas.fecha_inicio', $meses[$request->input('month')])
                    ->groupBy('contratistas.estado')
                    ->get();
            }



            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $contratista,
            ], 200);
        } catch (Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => [],
            ], 500);
        }
    }

    public function  calendarFechaInicioContratista(Request $request)
    {
        try {
            $contratista = Contratista::join('contratos', 'contratos.id', '=', 'contratistas.id_contrato')
                ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                ->select('contratistas.nombres', 'contratistas.apellido_paterno', 'contratistas.apellido_materno', 'contratistas.fecha_inicio')
                ->where('clientes.status', true)
                ->where('contratos.status', true)
                ->where('contratistas.status', true)
                ->where('ciudades.city_name',  $request->input('ciudad'))
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $contratista,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => [],
            ], 500);
        }
    }


    public function ganttFechaInicioContratista(Request $request)
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
                $contratista = Contratista::join('contratos', 'contratos.id', '=', 'contratistas.id_contrato')
                    ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('contratistas.nombres', 'contratistas.apellido_paterno', 'contratistas.apellido_materno', 'contratistas.fecha_inicio', 'contratos.n_contrato')
                    ->where('clientes.status', true)
                    ->where('contratos.status', true)
                    ->where('contratistas.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('contratistas.fecha_inicio', $request->input('year'))
                    ->get();
            } else {
                $contratista = Contratista::join('contratos', 'contratos.id', '=', 'contratistas.id_contrato')
                    ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('contratistas.nombres', 'contratistas.apellido_paterno', 'contratistas.apellido_materno', 'contratistas.fecha_inicio', 'contratos.n_contrato')
                    ->where('clientes.status', true)
                    ->where('contratos.status', true)
                    ->where('contratistas.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('contratistas.fecha_inicio', $request->input('year'))
                    ->whereMonth('contratistas.fecha_inicio', $meses[$request->input('month')])
                    ->get();
            }

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $contratista,
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
