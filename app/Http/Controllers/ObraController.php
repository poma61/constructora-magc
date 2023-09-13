<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObraRequest;
use App\Models\Ciudad;
use App\Models\Contrato;
use App\Models\Obra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ObraController extends Controller
{
    public function viewCiudad()
    {
        try {
            $user = Auth::user()->onPersonal()->first();
            $ciudad = Ciudad::where('id', $user->id_ciudad)->first();
            $list_ciudades = Ciudad::all();
            return view('control-de-obra/control-de-obra-ciudad-view', [
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

            return view('control-de-obra/tablero-control-de-obra-ciudad-view', [
                'ciudad' => $ciudad->city_name,
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }


    public function viewGrafico(String $city)
    {
        try {
            //verificamos si los paorametros de la url son validos
            $ciudad = Ciudad::where('city_name', $city)->first();
            if ($ciudad == null) {
                return view('error-page-view');
            }

            return view('control-de-obra/grafico-control-de-obra-ciudad-view', [
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

            return view('control-de-obra/calendario-control-de-obra-ciudad-view', [
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

            return view('control-de-obra/gantt-control-de-obra-ciudad-view', [
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
                $obra = Obra::join('contratos', 'contratos.id', '=', 'obras.id_contrato')
                    ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('contratos.n_contrato', 'obras.*', 'clientes.nombres', 'clientes.apellido_paterno', 'clientes.apellido_materno')
                    ->where('clientes.status', true)
                    ->where('contratos.status', true)
                    ->where('obras.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('obras.fecha_inicio', $request->input('year'))
                    ->get();
            } else {
                $obra = Obra::join('contratos', 'contratos.id', '=', 'obras.id_contrato')
                    ->join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                    ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                    ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                    ->select('contratos.n_contrato', 'obras.*', 'clientes.nombres', 'clientes.apellido_paterno', 'clientes.apellido_materno')
                    ->where('clientes.status', true)
                    ->where('contratos.status', true)
                    ->where('obras.status', true)
                    ->where('ciudades.city_name',  $request->input('ciudad'))
                    ->whereYear('obras.fecha_inicio', $request->input('year'))
                    ->whereMonth('obras.fecha_inicio', $meses[$request->input('month')])
                    ->get();
            }

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'records' => $obra,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => [],
            ], 500);
        }
    }

    public function rowTableroCreate(ObraRequest $request)
    {
        try {
            //el $fillable del modelo son todos los campos que se insertan en la base de datos
            //si el campo a insertar no esta listado en el array $fillable entonces
            //ese campo no se insertara en la base de datos, aunque en $request->all() este ese campo
            //ese campo sera omitido
            $obra = new Obra($request->all());
            $obra->status = true;
            $obra->save();

            return response()->json([
                'status' => true,
                'message' => "Registro creado!",
                'record' => $obra,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => null,
            ], 500);
        }
    }

    public function buscarContrato(Request $request)
    {
        try {
            $contrato = Contrato::join('clientes', 'clientes.id', '=', 'contratos.id_cliente')
                ->join('grupos', 'grupos.id', '=', 'clientes.id_grupo')
                ->join('ciudades', 'ciudades.id', '=', 'grupos.id_ciudad')
                ->select('contratos.id', 'contratos.n_contrato', 'clientes.nombres', 'clientes.apellido_paterno', 'clientes.apellido_materno')
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
                    'record' => null,
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
                'record' => null,
            ], 500);
        }
    }

    public function rowTableroUpdate(ObraRequest $request)
    {
        try {
            //el $fillable del modelo son todos los campos que se insertan en la base de datos
            //si el campo a insertar no esta listado en el array $fillable entonces
            //ese campo no se insertara en la base de datos, aunque en $request->all() este ese campo
            //ese campo sera omitido
            $obra = Obra::where('status', true)->where('id', $request->input('id'))->first();
            $obra->update($request->all());

            return response()->json([
                'status' => true,
                'message' => "Registro modificado exitosamente!",
                'record' => $obra,
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
            $obra = Obra::find($request->input('id'));
            $obra->status = false;
            $obra->update();

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


}//class
