<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
                if ($remember) {
                    $rememberToken = Str::random(60);
                    $user->remember_token = $rememberToken;
                    $user->update();
                    Cookie::queue('remember_token', $rememberToken, 1440); // Guardar el token en una cookie durante 24 horas

                }
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
}
