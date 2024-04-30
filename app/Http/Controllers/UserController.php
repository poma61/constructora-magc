<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Ciudad;
use App\Models\Permiso;
use App\Models\User;
use App\Models\UserHasPermiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserController extends Controller
{
    public function indexView()
    {
        try {
            return view('user/user-view');
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }

    public function index(Request $request)
    {
        try {
            $city = $request->input('ciudad');

            if ($city == "todos") {
                $user = User::join('personals', 'personals.id', '=', 'users.id_personal')
                    ->join('ciudades', 'ciudades.id', '=', 'personals.id_ciudad')
                    ->select('users.*', 'personals.nombres', 'personals.apellido_paterno', 'personals.apellido_materno', 'ciudades.city_name as ciudad')
                    ->where('personals.status', true)
                    ->where('users.status', true)
                    ->get();

                return response()->json([
                    'records' => $user,
                    'message' => 'OK',
                    'status' => true,
                ], 200);
            } {
                $user = User::join('personals', 'personals.id', '=', 'users.id_personal')
                    ->join('ciudades', 'ciudades.id', '=', 'personals.id_ciudad')
                    ->select('users.*', 'personals.nombres', 'personals.apellido_paterno', 'personals.apellido_materno', 'ciudades.city_name as ciudad')
                    ->where('ciudades.city_name', $city)
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

    public function create(UserRequest $request)
    {
        try {
            $user = new User();
            $user->usuario = $request->input('usuario');
            $user->password = Hash::make($request->input('password'));
            $user->id_personal = $request->input('id_personal');
            $user->status = true;
            $user->role = $request->input('role');
            $user->save();


            //asignamos todos los permisos necesarios
            $permissions_request = $request->input('permissions');
            for ($i = 0; $i < count($permissions_request); $i++) {
                $permiso = Permiso::where('code_content', $permissions_request[$i])
                    ->first();
                $user_has_permiso = new UserHasPermiso();
                $user_has_permiso->id_user = $user->id;
                $user_has_permiso->status = true;
                $user_has_permiso->id_permiso = $permiso->id;
                $user_has_permiso->save();
            }


            $user = User::join('personals', 'personals.id', '=', 'users.id_personal')
                ->join('ciudades', 'ciudades.id', '=', 'personals.id_ciudad')
                ->select('users.*', 'personals.nombres', 'personals.apellido_paterno', 'personals.apellido_materno', 'ciudades.city_name as ciudad')
                ->where('users.id', $user->id)
                ->first();

            return response()->json([
                'record' => $user,
                'status' => true,
                'message' => 'Registro creado!',
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'record' => [],
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function update(UserRequest $request)
    {
        try {
            $user = User::where('id', $request->input('id'))
                ->where('status', true)
                ->first();

            if ($user == null) {
                return response()->json([
                    'record' => null,
                    'message' => "No se encontro ningun registro con id {$request->input('id')}!",
                    'status' => false,
                ], 404);
            }


            $user->usuario = $request->input('usuario');
            //el campo password NO esta vacio entonces empty devolvera false y se encriptara la contraseña
            if (empty($request->input('password')) == false) {
                $user->password = Hash::make($request->input('password'));
            }

            $user->id_personal = $request->input('id_personal');
            $user->role = $request->input('role');
            $user->update();


            // Eliminamos visualmente todos los permisos actualizando el status (status => indica si el registro fue elinminado)
            // Los datos de la base de datos no se deben eliminar  por buenas praticas de sistemas
            UserHasPermiso::join('permisos', 'permisos.id', '=', 'users_has_permisos.id_permiso')
                ->select('permisos.*')
                ->where('users_has_permisos.id_user', $request->input('id'))
                ->update(['status' => false]);


            $permissions_request = $request->input('permissions');
            for ($i = 0; $i < count($permissions_request); $i++) {
                //Creamos los nuevos permisos
                $permiso = Permiso::where('code_content', $permissions_request[$i])
                    ->first();
                $user_has_permiso = new UserHasPermiso();
                $user_has_permiso->id_user = $user->id;
                $user_has_permiso->status = true;
                $user_has_permiso->id_permiso = $permiso->id;
                $user_has_permiso->save();
            }


            $user = User::join('personals', 'personals.id', '=', 'users.id_personal')
                ->join('ciudades', 'ciudades.id', '=', 'personals.id_ciudad')
                ->select('users.*', 'personals.nombres', 'personals.apellido_paterno', 'personals.apellido_materno', 'ciudades.city_name as ciudad')
                ->where('users.id', $user->id)
                ->first();

            return response()->json([
                'record' => $user,
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

    public function userPermission(Request $request)
    {
        try {
            $list_user_permission = UserHasPermiso::join('permisos', 'permisos.id', '=', 'users_has_permisos.id_permiso')
                ->select('permisos.*')
                ->where('users_has_permisos.id_user', $request->input('id'))
                ->where('users_has_permisos.status', true)
                ->get();

            return response()->json([
                'records' => $list_user_permission,
                'message' => "OK",
                'status' => true,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'records' => [],
                'message' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    } //listUserPermissions
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


}//classs
