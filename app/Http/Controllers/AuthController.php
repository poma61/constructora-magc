<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthProfileRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;

class AuthController extends Controller
{

    public function index()
    {
        return view("auth/login");
    }

    public function login(Request $request)
    {

        $user = User::where("usuario", $request->input('usuario'))->where("status", true)->first();

        if ($user != null) {
            if (Hash::check($request->input("password"), $user->password)) {
                Auth::login($user);
                return redirect()->route("r-home");
            } else {
                throw ValidationException::withMessages(["failed-user" => "Usuario y/o contraseña incorrectos"]);
            }
        } else {
            throw ValidationException::withMessages(["failed-user" => "Usuario y/o contraseña incorrectos"]);
        }
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route("r-view-login");
    }

    public function viewMe()
    {
        return view('auth/user-profile-view');
    }

    public function me()
    {
        try {
            $user_autenticate = User::join('personals', 'personals.id', '=', 'users.id_personal')
                ->select('users.id as id_usuario', 'users.usuario', 'personals.*')
                ->where('personals.status', true)
                ->where('users.status', true)
                ->where('users.id', Auth::user()->id)
                ->first();

            return response()->json([
                'status' => true,
                'message' => 'OK',
                'record' => $user_autenticate,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => null
            ], 500);
        }
    }

    public function updateCredentials(AuthProfileRequest $request)
    {
        try {

            $user = User::where('id', Auth::user()->id)
                ->where('status', true)
                ->first();

            if ($user != null) {
                $user->usuario = $request->input('usuario');
                $user->password = Hash::make($request->input('new_password'));
                $user->update();
                return response()->json([
                    'record' => $user,
                    'message' => 'Credenciales actualizados!',
                    'status' => true,
                ], 200);
            } else {
                return response()->json([
                    'record' => $user,
                    'message' => '',
                    'status' => false,
                ], 200);
            }
        } catch (Throwable $th) {
            return response()->json([
                'record' => [],
                'message' => $th->getMessage(),
                'status' => false,
            ], 500);
        }
    }


    public function isPermission()
    {
        try {
            $list_user_permission = Auth::user()->onPermission();

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
    
}//class
