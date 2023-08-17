<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Ciudad;
use App\Models\Cliente;
use App\Models\ClienteResponsable;
use App\Models\Grupo;
use App\Models\Responsable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Throwable;



class ClienteController extends Controller
{

    public function indexView()
    {
        try {
            $user = Auth::user()->onPersonal()->first();
            $ciudad = Ciudad::where('id', $user->id_ciudad)->first();
            $grupo = Grupo::where('id', $user->id_grupo)->first();
            $list_ciudades = Ciudad::all();

            if ($ciudad == null) {
                return view('error-page-view');
            }

            return view('cliente/ciudad-view', ['city' => $ciudad->city_name, 'grupo' => $grupo->grup_number, 'list_ciudades' => $list_ciudades]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }


    public function tableroView(string $city, string $grupo_num)
    {
        try {
            $verified_ciudad = Ciudad::where('city_name', $city)->first();
            $verified_grupo = Grupo::where('grup_number', $grupo_num)->first();
            //verificamos si los parametros de la Url son validos
            //la opcion 'todos' es valida porque existe en la base de datos
            //pero cuando no existe el grupo 'todos' , si nos hace referencia 
            // que tiene acceso a los grupos del 1 al 10, entonces desde ese punto 
            //no dejamos entrar a la vista si el parametro de la url es todos 
            if ($verified_ciudad == null || $verified_grupo == null || $grupo_num == 'todos') {
                return view('error-page-view');
            }

            $user = Auth::user()->onPersonal()->first();
            $grupo = Grupo::where('id', $user->id_grupo)->first();

            return view('cliente/tablero-grupo-cliente-view', ['grupo' => $grupo->grup_number, 'city' => $verified_ciudad->city_name, 'grupo_active' => $verified_grupo->grup_number]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }

    public function graficoView(string $city, string $grupo_num)
    {
        try {
            $verified_ciudad = Ciudad::where('city_name', $city)->first();
            $verified_grupo = Grupo::where('grup_number', $grupo_num)->first();
            //verificamos si los parametros de la Url son validos
            //la opcion 'todos' es valida porque existe en la base de datos
            //pero cuando no existe el grupo 'todos' , si nos hace referencia 
            // que tiene acceso a los grupos del 1 al 10, entonces desde ese punto 
            //no dejamos entrar a la vista si el parametro de la url es todos 
            if ($verified_ciudad == null || $verified_grupo == null || $grupo_num == 'todos') {
                return view('error-page-view');
            }

            $user = Auth::user()->onPersonal()->first();
            $grupo = Grupo::where('id', $user->id_grupo)->first();

            return view('cliente/grafico-grupo-cliente-view', ['grupo' => $grupo->grup_number, 'city' => $verified_ciudad->city_name, 'grupo_active' => $verified_grupo->grup_number]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $ciudad = Ciudad::where('city_name', $request->input('ciudad'))->first();
            $grupo = Grupo::where('grup_number', $request->input('grupo'))->first();
            //de esta manera verificamos si los parametros de la url son validos  yq ue existen en la base de datos
            if ($ciudad == null || $grupo == null) {
                return response()->json([
                    'status' => false,
                    'records' => [],
                    'message' => 'No existe la ciudad y/o el grupo',
                ], 500);
            }

            //Podriamos haber sacado el id del grupo del Auth::user()->onPersonal()
            //pero  se hace mas extenso el codigo ya que a que validar... si e administrador...
            //si administra los todos los grupos, entonces hagaramos directamente de la url
            //y los middleware protegen las rutas..segun el grupo que le corresponda al personal y segun el role que es      
            //en sintesis los middleware solo dejan acceder a las rutas que el personal tiene acceso  segun la ciudad y el grupo                  
            $grupo_obj1 = Grupo::where('id_ciudad', $ciudad->id)->where('grup_number', $request->input('grupo'))->first();

            $cliente = Cliente::where('id_grupo', $grupo_obj1->id)
                ->where('status', true)
                ->get();

            if ($cliente == null) {
                return response()->json([
                    'status' => true,
                    'records' => [],
                    'message' => 'OK',
                ], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'records' => $cliente,
                    'message' => 'OK',
                ], 200);
            }
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'records' => [],
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ClienteRequest $request)
    {
        try {
            $ciudad = Ciudad::where('city_name', $request->input('ciudad'))->first();
            $grupo = Grupo::where('grup_number', $request->input('grupo'))->first();
            //de esta manera verificamos si los parametros de la url son validos
            if ($ciudad == null || $grupo == null) {
                return response()->json([
                    'status' => false,
                    'records' => [],
                    'message' => 'No existe la ciudad y/o el grupo.',
                ], 500);
            }

            $cliente = new Cliente($request->except('ciudad', 'grupo'));

            //tambien se podria haber sacado el id del grupo del Auth::user()->onPersonal()
            //pero  se hace mas extenso el codigo ya que a que validar... si e administrador...
            //si administra los todos los grupos, entonces hagaramos directamente de la url
            //y los middleware protegen las rutas..segun el grupo que le corresponda al personal y segun el role que es   
            //en sintesis los middleware solo dejan acceder a las rutas que el personal tiene acceso  segun la ciudad y el grupo          
            $grupo_obj1 = Grupo::where('id_ciudad', $ciudad->id)->where('grup_number', $request->input('grupo'))->first();
            $cliente->id_grupo = $grupo_obj1->id;
            $cliente->status = true;
            $cliente->save();

            //guardamos el responsable del cliente como es una relacion de muchos a muchos entre responsables y clientes
            //se crea una tabla extra clientes_responsables
            $personal = Auth::user()->onPersonal()->first();
            $responsable = new Responsable();
            $responsable->nombres = $personal->nombres;
            $responsable->apellido_paterno = $personal->apellido_paterno;
            $responsable->apellido_materno = $personal->apellido_materno;
            $responsable->id_personal = $personal->id;
            $responsable->save();
            //guardamos datos en la tabla extra clientes_responsables
            $cliente_responsable = new ClienteResponsable();
            $cliente_responsable->id_cliente = $cliente->id;
            $cliente_responsable->id_responsable = $responsable->id;
            $cliente_responsable->save();


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



    /**
     * Update the specified resource in storage.
     */
    public function update(ClienteRequest $request)
    {
        try {
            $cliente = Cliente::where('status', true)->where('id', $request->input('id'))->first();
            $personal = Auth::user()->onPersonal()->first();

            //si no encuentro el responsable significa que es un nuevo responsable  el que esta editando este  dato del cliente
            // entonces agreamos al  otro responsable del cliente
            $verified_responable = Responsable::where('id_personal', $personal->id)->first();
            if ($verified_responable == null) {
                //se crea una tabla extra clientes_responsables
                $responsable = new Responsable();
                $responsable->nombres = $personal->nombres;
                $responsable->apellido_paterno = $personal->apellido_paterno;
                $responsable->apellido_materno = $personal->apellido_materno;
                $responsable->id_personal = $personal->id;
                $responsable->save();
                //guardamos datos en la tabla extra clientes_responsables
                $cliente_responsable = new ClienteResponsable();
                $cliente_responsable->id_cliente = $cliente->id;
                $cliente_responsable->id_responsable = $responsable->id;
                $cliente_responsable->save();
            }
            $cliente->update($request->except('grupo', 'ciudad'));

            return response()->json([
                'status' => true,
                'message' => 'Registro modificado exitosamente!',
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $cliente = Cliente::find($request->input('id'));
            //verificamos si el responsable esta editando y si no es asi no permitimos la edicion 
            $personal = Auth::user()->onPersonal()->first();

            //si no encuentro el responsable significa que es un nuevo responsable  el que esta eliminando el registro del cliente
            // entonces agreamos al  otro responsable del cliente
            //de esta forma sabremos quienes maniplaron este registro
            $verified_responable = Responsable::where('id_personal', $personal->id)->first();
            if ($verified_responable == null) {
                //se crea una tabla extra clientes_responsables
                $responsable = new Responsable();
                $responsable->nombres = $personal->nombres;
                $responsable->apellido_paterno = $personal->apellido_paterno;
                $responsable->apellido_materno = $personal->apellido_materno;
                $responsable->id_personal = $personal->id;
                $responsable->save();
                //guardamos datos en la tabla extra clientes_responsables
                $cliente_responsable = new ClienteResponsable();
                $cliente_responsable->id_cliente = $cliente->id;
                $cliente_responsable->id_responsable = $responsable->id;
                $cliente_responsable->save();
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
            $cliente = Cliente::join('clientes_responsables', 'clientes_responsables.id_cliente', '=', 'clientes.id')
                ->join('responsables', 'responsables.id', '=', 'clientes_responsables.id_responsable')
                ->select('responsables.*', 'clientes_responsables.id_responsable', 'clientes_responsables.id_cliente')
                ->where('clientes.id', $request->input('id_cliente'))
                ->orderBy('id', 'ASC')
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
}//class