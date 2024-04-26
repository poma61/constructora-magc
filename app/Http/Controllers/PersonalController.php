<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalRequest;
use App\Models\Ciudad;
use App\Models\Grupo;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Throwable;

class PersonalController extends Controller
{

    public function indexView(string $nombre_ciudad)
    {
        try {
            $ciudad = Ciudad::where('city_name', $nombre_ciudad)->first();

            if ($ciudad == null) {
                return view('error-page-view');
            } else {
                return view('personal/personal-view', ["city" => $nombre_ciudad]);
            }
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }

    public function index(Request $request)
    {
        try {
            // verificamos si existe la ciudad de la base de datos
            $personal = Personal::join("ciudades", "ciudades.id", "=", "personals.id_ciudad")
                ->select("personals.*")
                ->where('personals.status', true)
                ->where('ciudades.city_name', $request->input("ciudad"))
                ->orderBy('personals.id', 'ASC')
                ->get();

            return response()->json([
                'records' => $personal,
                'message' => 'OK'
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'records' => [],
                'city' => $request->input("ciudad"),
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    public function create(PersonalRequest $request)
    {
        try {
            //verificamos si la ciudad existe por extabilidad del sistema
            $ciudad = Ciudad::where('city_name', $request->input('ciudad'))->first();

            if ($ciudad == null) {
                return response()->json([
                    'status' => false,
                    'message' => "No existe la ciudad {$request->input('ciudad')}!",
                    'record' => null,
                    'type' => 'create',
                ], 404);
            }

            $imagen_path = $request->file('foto')->store('imagenes', 'public');

            $personal = new Personal($request->except('ciudad', 'foto'));
            $personal->id_ciudad = $ciudad->id;
            $personal->status = true;
            $personal->foto = 'storage/' . $imagen_path;
            $personal->save();

            return response()->json([
                'status' => true,
                'message' => 'Registro creado.',
                'record' => $personal,
                'type' => 'create',
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => null,
                'type' => 'create',
            ], 500);
        }
    }


    public function edit(Request $request)
    {
        try {
            $personal = Personal::where('id', $request->input('id'))
                ->where('status', true)
                ->first();

            if ($personal == null) {
                return response()->json([
                    'status' => false,
                    'message' => "No se encuentro ningun registro con id {$request->input('id')}",
                    'record' => null,
                ], 404);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'OK',
                    'record' => $personal,
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


    public function update(PersonalRequest $request)
    {
        try {
            //solo permitimos hacer un update cuando el registro este en status=true, es decir no se haya eliminado
            $personal = Personal::where('id', $request->input('id'))
                ->where('status', true)
                ->first();
            $personal->fill($request->except('foto'));

            if ($request->file('foto') != null) {
                $antiguo_foto_path = $personal->foto;
                //creamos el nuevo path de la nueva imagen
                $imagen_path = $request->file('foto')->store('imagenes', 'public');
                $personal->foto = 'storage/' . $imagen_path;
                //si todo es ok eliminamos la antigua imagen 
                Storage::disk('public')->delete(str_replace("storage/", "", $antiguo_foto_path));
            }

            $personal->update();

            return response()->json([
                'status' => true,
                'message' => "Registro actualizado.",
                'record' => $personal,
                'type' => 'update',
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => null,
                'type' => 'update',
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $personal = Personal::find($request->input('id'));
            $personal->status = false;
            $personal->update();

            //como tiene una relacion con la tabla users
            //entonces tambien eliminamos de la tabla usuarios siempre y cuando tenga un usuario creado el personal
            $user = User::where('id_personal', $request->input('id'))
                ->first();
            if ($user != null) {
                $user->update(['status' => false]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Registro Eliminado.',
                'type' => 'destroy',
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'type' => 'destroy',
            ], 200);
        }
    }
}//class
