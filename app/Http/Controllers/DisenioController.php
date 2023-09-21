<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisenioRequest;
use App\Models\Disenio;
use Illuminate\Http\Request;
use Throwable;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DisenioExport;
use App\Http\Requests\ModificacionDisenioRequest;
use App\Http\Requests\RevisionDisenioRequest;
use App\Models\Cliente;
use App\Models\EstadoDisenio;
use App\Models\ModificacionDisenio;
use App\Models\ProcesoDisenio;
use App\Models\RevisionDisenio;
use Illuminate\Support\Facades\DB;


class DisenioController extends Controller
{
    //vistas
    public function viewTablero()
    {
        return view('disenio/tablero-disenio-view');
    }

    public function viewGrafico()
    {
        return view('disenio/grafico-disenio-view');
    }

    public function viewCalendario()
    {
        return view('disenio/calendario-disenio-view');
    }

    //tablero diseño
    public function tableroIndexDisenio(Request $request)
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
                $disenio = Disenio::join('clientes', 'clientes.id', '=', 'disenios.id_cliente')
                    ->select('disenios.*', 'clientes.nombres', 'clientes.apellido_paterno', 'clientes.apellido_materno')
                    ->where('clientes.status', true)
                    ->where('disenios.status', true)
                    ->whereYear('disenios.fecha', $request->input('year'))
                    ->get();
            } else {
                $disenio = Disenio::join('clientes', 'clientes.id', '=', 'disenios.id_cliente')
                    ->select('disenios.*', 'clientes.nombres', 'clientes.apellido_paterno', 'clientes.apellido_materno')
                    ->where('clientes.status', true)
                    ->where('disenios.status', true)
                    ->whereYear('disenios.fecha', $request->input('year'))
                    ->whereMonth('disenios.fecha', $meses[$request->input('month')])
                    ->get();
            }

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $disenio,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => null,
            ], 500);
        }
    }


    public function rowTableroCreateDisenio(DisenioRequest $request)
    {
        try {
            $disenio = new Disenio($request->all());
            $disenio->status = true;
            $disenio->save();


            return response()->json([
                'status' => true,
                'message' => "Registro creado!",
                'record' => $disenio,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => null,
            ], 500);
        }
    }

    public function buscarCliente(Request $request)
    {
        try {
            $cliente = Cliente::where('clientes.status', true)
                ->where('clientes.ci', $request->input('ci'))
                ->first();

            if ($cliente == null) {
                return response()->json([
                    'status' => false,
                    'message' => "Ningun registro coincide con el ci {$request->input('ci')}.
                    Verifique si el cliente esta registrado en el sistema.",
                    'record' => [],
                ], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Registro encontrado!',
                    'record' => $cliente,
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

    public function rowTableroUpdateDisenio(DisenioRequest $request)
    {
        try {

            $disenio = Disenio::where('status', true)->where('id', $request->input('id'))->first();
            $disenio->update($request->all());

            return response()->json([
                'status' => true,
                'message' => "Registro modificado exitosamente!",
                'record' => $disenio,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => null,
            ], 500);
        }
    }

    public function rowTableroDestroyDisenio(Request $request)
    {
        try {
            $disenio = Disenio::find($request->input('id'));
            $disenio->status = false;
            $disenio->update();

            return response()->json([
                'status' => true,
                'message' => "Registro eliminado exitosamente!",
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function generateExcelDisenio(Request $request)
    {
        try {
            // Descargar el archivo Excel directamente usando Excel::download
            //enviarlo como respuesta de tipo blob
            return Excel::download(new DisenioExport($request), 'archivo.xlsx', \Maatwebsite\Excel\Excel::XLSX, [
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


    //procesos
    public function indexProceso(Request $request)
    {
        try {
            $proceso_disenio = ProcesoDisenio::join('disenios', 'disenios.id', '=', 'procesos.id_disenio')
                ->select('procesos.*')
                ->where('disenios.status', true)
                ->where('disenios.id', $request->input('id_disenio'))
                ->first();


            return response()->json([
                'status' => true,
                'message' => "OK",
                'records' => $proceso_disenio,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => null,
            ], 500);
        }
    }

    public function isRefreshProceso(Request $request)
    {
        try {
            if ($request->input('id') > 0) {
                $proceso_disenio = ProcesoDisenio::find($request->input('id'));
                $proceso_disenio->update($request->all());
            } else {
                $proceso_disenio = new ProcesoDisenio($request->all());
                $proceso_disenio->save();
            }

            return response()->json([
                'status' => true,
                'message' => "Procesos actualizados!",
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function graphicProceso(Request $request)
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
                $proceso_disenio = ProcesoDisenio::join('disenios', 'disenios.id', '=', 'procesos.id_disenio')
                    ->select("procesos.{$request->input('field')}", DB::raw("COUNT(procesos.{$request->input('field')}) as total"))
                    ->where('disenios.status', true)
                    ->whereYear('disenios.fecha', $request->input('year'))
                    ->groupBy("procesos.{$request->input('field')}")
                    ->get();
            } else {
                $proceso_disenio = ProcesoDisenio::join('disenios', 'disenios.id', '=', 'procesos.id_disenio')
                    ->select("procesos.{$request->input('field')}", DB::raw("COUNT(procesos.{$request->input('field')}) as total"))
                    ->where('disenios.status', true)
                    ->whereYear('disenios.fecha', $request->input('year'))
                    ->whereMonth('disenios.fecha', $meses[$request->input('month')])
                    ->groupBy("procesos.{$request->input('field')}")
                    ->get();
            }

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $proceso_disenio,
            ], 200);
        } catch (Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => [],
            ], 500);
        }
    }

    //estados
    public function indexEstado(Request $request)
    {
        try {
            $estado_disenio = EstadoDisenio::join('disenios', 'disenios.id', '=', 'estados.id_disenio')
                ->select('estados.*')
                ->where('disenios.status', true)
                ->where('disenios.id', $request->input('id_disenio'))
                ->first();

            //estado_disenio=> no es null, entonces el estado ya fue generado con su respectivo codigo
            //entonces separamos el codigo
            if ($estado_disenio != null) {
                $parts_codigo = explode('-', $estado_disenio->codigo); // Divide la cadena en partes usando "-"
                $estado_disenio['prefix_codigo'] = $parts_codigo[0] . "-";
                $estado_disenio['suffix_codigo'] = $parts_codigo[1];
            }

            return response()->json([
                'status' => true,
                'message' => "OK",
                'records' => $estado_disenio,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => null,
            ], 500);
        }
    }

    public function isRefreshEstado(Request $request)
    {
        try {
            if ($request->input('id') > 0) {
                $estado_disenio = EstadoDisenio::find($request->input('id'));
                $estado_disenio->fill($request->all());
                $estado_disenio->codigo = $request->input('prefix_codigo') . $request->input('suffix_codigo');
                $estado_disenio->update();
            } else {
                $estado_disenio = new EstadoDisenio($request->all());
                $estado_disenio->codigo = $request->input('prefix_codigo') . $request->input('suffix_codigo');
                $estado_disenio->save();
            }

            return response()->json([
                'status' => true,
                'message' => "Estado actualizado!",
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function generateNumCodigoEstado(Request $request)
    {
        try {
            //obtenemos ultimo estado registrato
            //y no necesitamos verificar el status
            // ya que aunque el registro se haya eliminado igualmente contatos los registros de estados para generar un codigos
            $ultimo_estado_id = EstadoDisenio::join('disenios', 'disenios.id', '=', 'estados.id_disenio')
                ->join('clientes', 'clientes.id', '=', 'disenios.id_cliente')
                ->select('clientes.nombres', 'clientes.apellido_paterno', 'clientes.apellido_materno', 'estados.*')
                ->max('estados.id');

            $ultimo_estado = EstadoDisenio::find($ultimo_estado_id);
            $cliente = Cliente::where('status', true)->where('id', $request->input('id_cliente'))->first();
            //generamos el numero que sigue
            // verificamos si es el primer registro, entonces es nulo y asignamos el numero cero
            $old_codigo = ($ultimo_estado == null) ? 'NNNN_YYYY/0000-AAAAA' : $ultimo_estado->codigo;

            $parts = explode('/', $old_codigo); // Divide la cadena en partes usando "/"
            $num_parts = explode('-', $parts[1]); // Divide la parte después del "/" usando "-" como delimitador
            $num = $num_parts[0]; // Obtenemos "0000"

            $num = $num + 1;
            $num_result = str_pad($num, 4, '0', STR_PAD_LEFT); //agregar ceros al numero
            $year =  date('Y');;

            $fisrt_letter[0] = strtoupper(substr($cliente->nombres, 0, 1));
            $fisrt_letter[1] = strtoupper(substr($cliente->apellido_paterno, 0, 1));
            $fisrt_letter[2] = strtoupper(substr($cliente->apellido_materno, 0, 1));

            $codigo_generado =  "{$fisrt_letter[0]}{$fisrt_letter[1]}{$fisrt_letter[2]}_{$year}/$num_result-";
            return response()->json([
                'status' => true,
                'message' => 'OK',
                'record' => ['prefix_codigo' => $codigo_generado],
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => null,
            ], 500);
        }
    }

    public function  calendarFechaAllEstado(Request $request)
    {
        try {
            $revision_disenio = EstadoDisenio::join('disenios', 'disenios.id', '=', 'estados.id_disenio')
                ->join('clientes', 'clientes.id', '=', 'disenios.id_cliente')
                ->select(
                    'clientes.nombres',
                    'clientes.apellido_paterno',
                    'clientes.apellido_materno',
                    "estados.{$request->input('field')}",
                )
                ->where('clientes.status', true)
                ->where('disenios.status', true)
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $revision_disenio,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => [],
            ], 500);
        }
    }

    //revision
    public function tableroIndexRevisionDisenio(Request $request)
    {

        try {
            $revision_disenio = RevisionDisenio::join('disenios', 'disenios.id', '=', 'revisiones.id_disenio')
                ->select('revisiones.*')
                ->where('disenios.status', true)
                ->where('revisiones.status', true)
                ->where('disenios.id', $request->input('id_disenio'))
                ->get();

            return response()->json([
                'status' => true,
                'message' => "OK",
                'records' => $revision_disenio,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => null,
            ], 500);
        }
    }

    public function rowTableroCreateRevisionDisenio(RevisionDisenioRequest $request)
    {
        try {
            $revision_disenio = new RevisionDisenio($request->all());
            $revision_disenio->status = true;
            $revision_disenio->save();

            return response()->json([
                'status' => true,
                'message' => 'Registro creado exitosamente!',
                'record' => $revision_disenio,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => null,
            ], 500);
        }
    }

    public function rowTableroUpdateRevisionDisenio(RevisionDisenioRequest $request)
    {

        try {

            $revision_disenio = RevisionDisenio::where('status', true)->where('id', $request->input('id'))->first();
            $revision_disenio->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Registro modificado exitosamente!',
                'record' => $revision_disenio,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => null,
            ], 500);
        }
    }

    public function rowTableroDestroyRevisionDisenio(Request $request)
    {
        try {
            $revision_disenio = RevisionDisenio::find($request->input('id'));
            $revision_disenio->status = false;
            $revision_disenio->update();

            return response()->json([
                'status' => true,
                'message' => 'Registro eliminado exitosamente!',
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function  calendarFechaAllRevision(Request $request)
    {
        try {
            $revision_disenio = RevisionDisenio::join('disenios', 'disenios.id', '=', 'revisiones.id_disenio')
                ->join('clientes', 'clientes.id', '=', 'disenios.id_cliente')
                ->select(
                    'clientes.nombres',
                    'clientes.apellido_paterno',
                    'clientes.apellido_materno',
                    "revisiones.{$request->input('field')}",
                )
                ->where('clientes.status', true)
                ->where('disenios.status', true)
                ->where('revisiones.status', true)
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $revision_disenio,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => [],
            ], 500);
        }
    }

    //Modificacion
    public function tableroIndexModificacionDisenio(Request $request)
    {

        try {
            $modificacion_disenio = ModificacionDisenio::join('disenios', 'disenios.id', '=', 'modificaciones.id_disenio')
                ->select('modificaciones.*')
                ->where('disenios.status', true)
                ->where('modificaciones.status', true)
                ->where('disenios.id', $request->input('id_disenio'))
                ->get();

            return response()->json([
                'status' => true,
                'message' => "OK",
                'records' => $modificacion_disenio,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => null,
            ], 500);
        }
    }

    public function rowTableroCreateModificacionDisenio(ModificacionDisenioRequest $request)
    {
        try {
            $modificacion_disenio = new ModificacionDisenio($request->all());
            $modificacion_disenio->status = true;
            $modificacion_disenio->save();

            return response()->json([
                'status' => true,
                'message' => 'Registro creado exitosamente!',
                'record' => $modificacion_disenio,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => null,
            ], 500);
        }
    }

    public function rowTableroUpdateModificacionDisenio(ModificacionDisenioRequest $request)
    {
        try {
            $modificacion_disenio = ModificacionDisenio::where('status', true)->where('id', $request->input('id'))->first();
            $modificacion_disenio->update($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Registro modificado exitosamente!',
                'record' => $modificacion_disenio,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => null,
            ], 500);
        }
    }

    public function rowTableroDestroyModificacionDisenio(Request $request)
    {
        try {
            $modificacion_disenio = ModificacionDisenio::find($request->input('id'));
            $modificacion_disenio->status = false;
            $modificacion_disenio->update();

            return response()->json([
                'status' => true,
                'message' => 'Registro eliminado exitosamente!',
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    public function  calendarFechaModificacion(Request $request)
    {
        try {
            $revision_disenio = ModificacionDisenio::join('disenios', 'disenios.id', '=', 'modificaciones.id_disenio')
                ->join('clientes', 'clientes.id', '=', 'disenios.id_cliente')
                ->select(
                    'clientes.nombres',
                    'clientes.apellido_paterno',
                    'clientes.apellido_materno',
                    "modificaciones.fecha",
                )
                ->where('clientes.status', true)
                ->where('disenios.status', true)
                ->where('modificaciones.status', true)
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $revision_disenio,
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
