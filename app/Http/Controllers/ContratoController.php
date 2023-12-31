<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContratoAllRequest;

use App\Models\Ciudad;
use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\DetalleContrato;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Throwable;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContratoExport;


class ContratoController extends Controller
{

    public function viewCiudad()
    {
        try {
            $user = Auth::user()->onPersonal()->first();
            $ciudad = Ciudad::where('id', $user->id_ciudad)->first();
            $list_ciudades = Ciudad::all();
            return view('contrato/contrato-ciudad-view', [
                'ciudad' => $ciudad->city_name,
                'list_ciudades' => $list_ciudades,
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }

    public function viewTablero(String $city)
    {
        try {
            //verificamos si los paorametros de la url son validos
            $ciudad = Ciudad::where('city_name', $city)->first();
            if ($ciudad == null) {
                return view('error-page-view');
            }

            return view('contrato/tablero-contrato-ciudad-view', [
                'ciudad' => $ciudad->city_name,
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }


    public function viewCalendario(String $city)
    {
        try {
            //verificamos si los paorametros de la url son validos
            $ciudad = Ciudad::where('city_name', $city)->first();
            if ($ciudad == null) {
                return view('error-page-view');
            }

            return view('contrato/calendario-contrato-ciudad-view', [
                'ciudad' => $ciudad->city_name,
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }


    public function viewGantt(String $city)
    {
        try {
            //verificamos si los paorametros de la url son validos
            $ciudad = Ciudad::where('city_name', $city)->first();
            if ($ciudad == null) {
                return view('error-page-view');
            }

            return view('contrato/gantt-contrato-ciudad-view', [
                'ciudad' => $ciudad->city_name,
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
                $contrato = Contrato::join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('clientes.nombres', 'clientes.apellido_paterno', 'clientes.apellido_materno', 'contratos.*')
                    ->where('clientes.status', true)
                    ->where('contratos.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('contratos.fecha_firma_contrato', $request->input('year'))
                    ->get();
            } else {
                $contrato = Contrato::join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('clientes.nombres', 'clientes.apellido_paterno', 'clientes.apellido_materno', 'contratos.*')
                    ->where('clientes.status', true)
                    ->where('contratos.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('contratos.fecha_firma_contrato', $request->input('year'))
                    ->whereMonth('contratos.fecha_firma_contrato', $meses[$request->input('month')])
                    ->get();
            }

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $contrato,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => [],
            ], 500);
        }
    }

  
    public function rowTableroCreate(ContratoAllRequest $request)
    {
        try {
            //el $fillable del modelo son todos los campos que se insertan en la base de datos
            //si el campo a insertar no esta listado en el array $fillable entonces
            //ese campo no se insertara en la base de datos, aunque en $request->all() este ese campo
            //ese campo sera omitido
            $contrato = new Contrato($request->all());
            $contrato->n_contrato = $this->generateNumContrato($request->input('ciudad'));
            $contrato->status = true;
            $contrato->save();

            $detalle_contrato = new DetalleContrato($request->except('ciudad'));
            $detalle_contrato->status = true;
            $detalle_contrato->id_contrato = $contrato->id;
            $detalle_contrato->save();

            $contrato->archivo_pdf = $this->generatePdfContrato($contrato->id);
            $contrato->save();

            return response()->json([
                'status' => true,
                'message' => "Contrato generado exitosamente!",
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

    public function generateNumContrato(string $ciudad)
    {
        $ciudades_key = [
            'Santa-Cruz' => 'SC',
            'Chuquisaca' => 'CH',
            'Cochabamba' => 'CB',
            'Potosi' => 'PT',
            'Beni' => 'BN',
            'La-Paz' => 'LP',
            'Pando'  => 'PA',
            'Tarija'  => 'TJ',
            'Oruro' => 'OR',
            'Otros' => 'OTS',
        ];

        //obtenemos ultimo contrato registrato por ciudad
        //y no necesitamos verificar el status
        // ya que aunque el registro se haya eliminado igualmente contatos los registros de contratos para generar un n_contrato
        $ultimo_contrato_id = Contrato::join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
            ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
            ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
            ->select('clientes.nombres', 'clientes.apellido_paterno', 'clientes.apellido_materno', 'contratos.*')
            ->where('ciudades.city_name',  $ciudad)
            ->max('contratos.id');
        $ultimo_contrato = Contrato::find($ultimo_contrato_id);


        // verificamos si es el primer registro, entonces es nulo y asignamos el numero cero
        $old_numero_contrato = ($ultimo_contrato == null) ? '0000/0000_AS' : $ultimo_contrato->n_contrato;

        $parts = explode('/', $old_numero_contrato); // Divide la cadena en partes usando "/"
        $middle_part = $parts[1]; // Obtiene la segunda parte, que es '009_LP'
        $sub_parts = explode('_', $middle_part); // Divide la parte intermedia usando "_"
        $num_result = $sub_parts[0]; // Obtiene la primera subparte, que es '009'

        $num_result = $num_result + 1;
        $num_result = str_pad($num_result, 4, '0', STR_PAD_LEFT); //agregar ceros al numero
        $year =  date('Y');;
        return  "{$year}/{$num_result}_{$ciudades_key[$ciudad]}";
    }

  
    public function rowTableroUpdate(ContratoAllRequest $request,)
    {
        try {
            //el $fillable del modelo son todos los campos que se insertan en la base de datos
            //si el campo a insertar no esta listado en el array $fillable entonces
            //ese campo no se insertara en la base de datos, aunque en $request->all() este ese campo
            //ese campo sera omitido
            $contrato = Contrato::where('status', true)->where('id', $request->input('id'))->first();
            $contrato->update($request->all());

            $detalle_contrato = DetalleContrato::where('status', true)->where('id_contrato', $request->input('id'))->first();
            $detalle_contrato->update($request->all());

            //obtenemos el path del pdf antiguo
            $antiguo_pdf_path = $contrato->archivo_pdf;
            //agregamos el nuevo archivo
            $contrato->archivo_pdf = $this->generatePdfContrato($contrato->id);
            $contrato->update();

            // si todo es ok entonces eliminados el archivo pdf antiguo
            Storage::disk('public')->delete(str_replace("storage/", "", $antiguo_pdf_path));

            return response()->json([
                'status' => true,
                'message' => "Contrato modificado exitosamente!",
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


    public function rowTableroDestroy(Request $request)
    {
        try {
            $contrato = Contrato::find($request->input('id'));
            $contrato->status = false;
            $contrato->update();

            $detalle_contrato = DetalleContrato::where('id_contrato', $request->input('id'))->first();
            $detalle_contrato->status = false;
            $detalle_contrato->update();

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

    public function buscarCliente(Request $request)
    {
        try {
            $cliente = Cliente::join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                ->select('clientes.id', 'clientes.nombres', 'clientes.apellido_paterno', 'clientes.apellido_materno')
                ->where('clientes.status', true)
                ->where('ciudades.city_name', $request->input('ciudad'))
                ->where('clientes.ci', $request->input('ci'))
                ->where('clientes.estado', 'Firma de contrato')
                ->first();

            if ($cliente == null) {
                return response()->json([
                    'status' => false,
                    'message' => "Ningun registro coincide con el ci {$request->input('ci')},
                    verifique el estado del cliente, 
                    verifique si el cliente esta registrado
                     y/o el cliente no pertenece a la ciudad de {$request->input('ciudad')}!",
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

    public function rowTableroByIdDetalleContrato(Request $request)
    {
        try {
            $detalle_contrato = DetalleContrato::where('status', true)->where('id_contrato', $request->input('id_contrato'))->first();

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'record' => $detalle_contrato,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => [],
            ], 500);
        }
    }

    public function generatePdfContrato(int $id)
    {
        $contrato = Contrato::join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
            ->join('detalles_contratos', 'detalles_contratos.id_contrato', '=', 'contratos.id')
            ->select(
                'clientes.nombres',
                'clientes.apellido_paterno',
                'clientes.apellido_materno',
                'clientes.ci',
                'clientes.ci_expedido',
                'contratos.*',
                'detalles_contratos.*',
            )
            ->where('clientes.status', true)
            ->where('contratos.status', true)
            ->where('detalles_contratos.status', true)
            ->where('contratos.id', $id)
            ->first();

        $pdf = PDF::loadView('contrato/pdf-contrato-ciudad', ['contrato' => $contrato,]);
        //debemos parsear el numero de contrato porque tiene el formato '2023/0001_LP' 
        // no se puede guardar archivos con ese tipo de nombre entonces  obtenemos el nombre de este formato '2023_0001_LP'
        $n_contrato_parse = str_replace('/', '_', $contrato->n_contrato);
        $pdf_path = "pdfs-contratos/{$n_contrato_parse}_{$contrato->nombres}_{$contrato->apellido_paterno}_{$contrato->apellido_materno}_" . uniqid() . ".pdf";

        Storage::disk('public')->put($pdf_path,  $pdf->download()->getOriginalContent());
        return  'storage/' . $pdf_path;
    }

    public function generateExcel(Request $request)
    {
        try {
            // Descargar el archivo Excel directamente usando Excel::download
            //enviarlo como respuesta de tipo blob
            return Excel::download(new ContratoExport($request), 'archivo.xlsx', \Maatwebsite\Excel\Excel::XLSX, [
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



    public function  calendarContract(Request $request)
    {
        try {
            $contrato = Contrato::join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                ->select('clientes.nombres', 'clientes.apellido_paterno', 'clientes.apellido_materno', 'contratos.fecha_firma_contrato')
                ->where('clientes.status', true)
                ->where('contratos.status', true)
                ->where('ciudades.city_name',  $request->input('ciudad'))
                ->get();

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $contrato,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => [],
            ], 500);
        }
    }


    public function ganttContract(Request $request)
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
                $contrato = Contrato::join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('clientes.nombres', 'clientes.apellido_paterno', 'clientes.apellido_materno', 'contratos.fecha_firma_contrato','contratos.n_contrato')
                    ->where('clientes.status', true)
                    ->where('contratos.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('contratos.fecha_firma_contrato', $request->input('year'))
                    ->get();
            } else {
                $contrato = Contrato::join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('clientes.nombres', 'clientes.apellido_paterno', 'clientes.apellido_materno', 'contratos.fecha_firma_contrato','contratos.n_contrato')
                    ->where('clientes.status', true)
                    ->where('contratos.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('contratos.fecha_firma_contrato', $request->input('year'))
                    ->whereMonth('contratos.fecha_firma_contrato', $meses[$request->input('month')])
                    ->get();
            }

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $contrato,
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
