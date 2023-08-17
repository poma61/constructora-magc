<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Ciudad;
use App\Models\Grupo;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{

    public function indexView(string $nombre_ciudad)
    {

        try {
            $ciudad = Ciudad::where('city_name', $nombre_ciudad)->first();

            if ($ciudad == null) {
                return view('error-page-view');
            }

            return view('user/user-view', ['city' => $nombre_ciudad]);
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
            $city = $request->input('ciudad');
            $user = null;
            $ciudad = Ciudad::where('city_name', $city)->first();

            if ($ciudad != null) {
                $user = User::join('personals', 'personals.id', '=', 'users.id_personal')
                    ->join('ciudades', 'ciudades.id', '=', 'personals.id_ciudad')
                    ->select('users.*', 'personals.nombres', 'personals.apellido_paterno', 'personals.apellido_materno', 'ciudades.city_name as ciudad')
                    ->where('personals.id_ciudad', $ciudad->id)
                    ->where('personals.status', true)
                    ->where('users.status', true)
                    ->get();

                return response()->json([
                    'records' => $user,
                    'message' => 'OK',
                    'status' => true,
                ], 200);
            }
        } catch (Throwable $th) {

            return response()->json([
                'records' => [],
                'message' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(UserRequest $request)
    {
        try {
            $nom_ciudad = $request->input('ciudad');
            $ciudad = Ciudad::where('city_name', $nom_ciudad)->first();

            if ($ciudad != null) {
                $user = new User();
                $user->usuario = $request->input('usuario');
                $user->password = Hash::make($request->input('password'));
                $user->id_personal = $request->input('id_personal');
                $user->status = true;
                $user->role = $request->input('role');
                $user->save();
                $user_join = User::join('personals', 'personals.id', '=', 'users.id_personal')
                    ->join('ciudades', 'ciudades.id', '=', 'personals.id_ciudad')
                    ->select('users.*', 'personals.nombres', 'personals.apellido_paterno', 'personals.apellido_materno', 'ciudades.city_name as ciudad')
                    ->where('users.id', $user->id)
                    ->first();

                return response()->json([
                    'record' => $user_join,
                    'status' => true,
                    'message' => 'Registro creado!',
                ], 200);
            }

            return response()->json([
                'record' => [],
                'status' => false,
                'message' => 'No existe la ciudad!',
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'record' => [],
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request)
    {
        try {
            //usamos un validacion de status = true porque como manejamos datos con javascript
            //puede que desde otra computadora se haya eliminado el registro... y como la pagina no se actualiza
            //entonces puede que estemos queriendo hacer un update  aun registro que fue eliminado desde otra PC
            $user = User::where('id', $request->input('id'))
                ->where('status', true)
                ->first();

            $user->usuario = $request->input('usuario');
            //el campo password no esta vacio entonces empty devolvera false y se encriptara la contraseña
            if (empty($request->input('password')) == false) {
                $user->password = Hash::make($request->input('password'));
            }

            $user->id_personal = $request->input('id_personal');
            $user->role = $request->input('role');
            $user->update();

            $user_join = User::join('personals', 'personals.id', '=', 'users.id_personal')
                ->join('ciudades', 'ciudades.id', '=', 'personals.id_ciudad')
                ->select('users.*', 'personals.nombres', 'personals.apellido_paterno', 'personals.apellido_materno', 'ciudades.city_name as ciudad')
                ->where('users.id', $user->id)
                ->first();

            return response()->json([
                'record' => $user_join,
                'message' => 'Registro modificado exitosamente!',
                'status' => true,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'record' => [],
                'message' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            // como es eliminacion del registro no usamos un where status= true, porque si el registro fue eliminado desde otra Pc
            // y volver a eliminarlo desde la pc actual no afecta en  nada en rendimiento del sistemas
            //user tiene relacion con la table personals, pero no es necesario eliminar el registro de la tabla personals
            // ya que el usuario podria eliminarse
            // solo debemos eliminar en cascada cuando se elimine un registro de personals entonces eliminamos users
            $user = User::find($request->input('id'));
            $user->status = false;
            $user->update();
            return response()->json([
                'status' => true,
                'message' => 'Registro Eliminado!',
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    } //destroy

    public function buscarPersonal(Request $request)
    {
        try {
            $nom_ciudad = $request->input('ciudad');
            $ci = $request->input('ci');
            $ciudad = Ciudad::where('city_name', $nom_ciudad)->first();
            $personal = null;

            if ($ciudad != null) {
                $personal = Personal::where('id_ciudad', $ciudad->id)
                    ->where('ci', $ci)
                    ->where('status', true)
                    ->select('id', 'nombres', 'apellido_paterno', 'apellido_materno')
                    ->first();
            }

            if ($personal == null) {
                return response()->json([
                    'record' => null,
                    'message' => 'No existe la ciudad o el ci es incorrecto!',
                    'status' => false,
                ], 200);
            }

            return response()->json([
                'record' => $personal,
                'message' => 'OK',
                'status' => true,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'record' => null,
                'message' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    } //buscarPersonsl
}//classs
