<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthProfileRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;

class LoginController extends Controller
{

    public function index()
    {
        return view("auth/login");
    }

    public function login(Request $request)
    {

        $user = User::where("usuario", $request->input('usuario'))->where("status", true)->first();
        $remember = $request->filled("remember");

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
                ->select('users.id as id_usuario', 'users.role', 'users.usuario', 'personals.*')
                ->where('personals.status', true)
                ->where('users.status', true)
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

            $user->usuario = $request->input('usuario');
            $user->password = Hash::make($request->input('password'));

            $user->update();

            return response()->json([
                'record' => $user,
                'message' => 'Credenciales actualizados!',
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
}//class
