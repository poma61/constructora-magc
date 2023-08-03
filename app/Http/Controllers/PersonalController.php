<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonalRequest;
use App\Models\Ciudad;
use App\Models\Personal;
use App\Models\User;
use Illuminate\Http\Request;

use Throwable;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexView(string $nombre_ciudad)
    {
        try {
            $personal = false;
            $ciudad = Ciudad::all();

            //el nombre_ciudad debe ser el mismo que esta en la base de datos
            foreach ($ciudad as $row => $val) {
                //verificamos si la ciudad existe en la base de datos 
                if ($val->city_name == $nombre_ciudad) {
                   $personal=true;
                   break;
                }
            }

            if ($personal) {
                return view('personal/personal-view', ["city" => $nombre_ciudad]);
            }

            return view('error-page-view');
          

        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }


    public function index(Request $request)
    {
        try {
            $nombre_ciudad = $request->input('ciudad');
            $personal = null;
            $ciudad = Ciudad::all();

            //el nombre_ciudad debe ser el mismo que esta en la base de datos
            foreach ($ciudad as $row => $val) {
                //verificamos si la ciudad existe en la base de datos 
                if ($val->city_name == $nombre_ciudad) {
                    $personal = Personal::join("ciudades", "ciudades.id", "=", "personals.id_ciudad")
                        ->select("personals.*")
                        ->where('status', true)
                        ->where('ciudades.city_name', "=", $nombre_ciudad)
                        ->orderBy('id', 'ASC')
                        ->get();
                }
            }

            if ($personal == null) {
                return response()->json([
                    'records' => [],
                    'city' => $nombre_ciudad,
                    'message' => 'No existe la ciudad'
                ], 500);
            }

            return response()->json([
                'records' => $personal,
                'message' => 'OK'
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'records' => [],
                'city' => $nombre_ciudad,
                'message' => $th->getMessage(),
            ], 500);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(PersonalRequest $request)
    {
        try {

            $record_success = false;
            $nombre_ciudad = $request->input('ciudad');
            $ciudad = Ciudad::all();
            $record_success = false;

            $imagen_path = $request->file('foto')->store('imagenes', 'images');
            // $rutaCompleta = url(Storage::url($imagenPath));
            //el nombre_ciudad debe ser el mismo que esta en la base de datos
            foreach ($ciudad as $row => $val) {
                if ($val->city_name == $nombre_ciudad) {
                    $id_city = $val->id;
                    $personal = new Personal($request->except('ciudad', 'foto'));
                    $personal->id_ciudad = $id_city;
                    $personal->status = true;
                    $personal->foto = $imagen_path;
                    $personal->save();
                    $record_success = true;
                }
            }

            if ($record_success) {
                return response()->json([
                    'status' => true,
                    'message' => 'Registro creado!',
                    'record' => $personal,
                    'type' => 'create',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'No existe la ciudad!',
                    'record' => null,
                    'type' => 'create',
                ], 200);
            }
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => null,
                'type' => 'create',
            ], 500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        try {
            $id = $request->input('id');
            $personal = Personal::find($id);
            return response()->json([
                'status' => true,
                'message' => 'Ok',
                'record' => $personal,
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'record' => null,
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PersonalRequest $request)
    {
        try {

            $id = $request->input('id');
            //solo permitimos hacer un update cuando el registro este en status=true, es decir no se haya eliminado 
            $personal = Personal::where('id', $id)->where('status', true)->first();
            $personal->fill($request->except('foto'));

            if ($request->file('foto') != null) {
                $imagen_path = $request->file('foto')->store('imagenes', 'images');
                $personal->foto = $imagen_path;
            }

            $personal->update();


            return response()->json([
                'status' => true,
                'message' => "Registro modificado!",
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('id');
            $personal = Personal::find($id);
            $personal->status = false;
            $personal->save();

            //como tiene una relacion con la tabla users
            //entonces tambien eliminamos de la tabla usuarios
            $user = User::where('id_personal', $id)->first();
            $user->status=false;
            $user->save();
            
            return response()->json([
                'status' => true,
                'message' => 'Registro Eliminado!',
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
