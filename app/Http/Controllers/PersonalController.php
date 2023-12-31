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
            $personal = false;
            $ciudad = Ciudad::all();

            //el nombre_ciudad debe ser el mismo que esta en la base de datos
            foreach ($ciudad as $row => $val) {
                //verificamos si la ciudad existe en la base de datos
                if ($val->city_name == $nombre_ciudad) {
                    $personal = true;
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
                        ->join('grupos', 'grupos.id', '=', 'personals.id_grupo')
                        ->select("personals.*", 'grupos.grup_number')
                        ->where('personals.status', true)
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



    public function create(PersonalRequest $request)
    {
        try {

            $record_success = false;
            $nombre_ciudad = $request->input('ciudad');
            $ciudad = Ciudad::all();

            $record_success = false;

            $imagen_path = $request->file('foto')->store('imagenes', 'public');

            //el nombre_ciudad debe ser el mismo que esta en la base de datos
            foreach ($ciudad as $row => $val) {
                if ($val->city_name == $nombre_ciudad) {
                    $id_city = $val->id;
                    $grup_number = $request->input('grup_number');
                    $grupo = Grupo::where('id_ciudad', $id_city)->where('grup_number', $grup_number)->first();
                    if ($grupo != null) {
                        $personal = new Personal($request->except('ciudad', 'foto', 'grupo'));
                        $personal->id_ciudad = $id_city;
                        $personal->status = true;
                        $personal->foto = 'storage/' . $imagen_path;
                        $personal->id_grupo = $grupo['id'];
                        $personal->save();
                        //agregamos el grupo.. al modelo personal..para que se visualize el cambio en el datatable
                        $personal->grup_number = $grup_number;
                        $record_success = true;
                    }
                }
            }

            if ($record_success) {
                return response()->json([
                    'status' => true,
                    'message' => 'Registro creado!',
                    'record' => $personal,
                    'type' => 'create',
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'No existe la ciudad y/o el grupo!',
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


  
    public function edit(Request $request)
    {
        try {
            $id = $request->input('id');
            $personal = Personal::join('grupos', 'grupos.id', '=', 'personals.id_grupo')
                ->select('personals.*', 'grupos.grup_number')
                ->where('personals.id', $id)
                ->where('personals.status', true)
                ->first();
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


    public function update(PersonalRequest $request)
    {
        try {

            $id = $request->input('id');
            //solo permitimos hacer un update cuando el registro este en status=true, es decir no se haya eliminado
            $personal = Personal::where('id', $id)->where('status', true)->first();
            $personal->fill($request->except('foto', 'grupo'));

            $antiguo_foto_path = null;
            if ($request->file('foto') != null) {
                $antiguo_foto_path = $personal->foto;
                //creamos el nuevo path de la nueva imagen
                $imagen_path = $request->file('foto')->store('imagenes', 'public');
                $personal->foto = 'storage/' . $imagen_path;
            }

            $grup_number = $request->input('grup_number');
            $grupo = Grupo::where('id_ciudad', $personal->id_ciudad)->where('grup_number', $grup_number)->first();
            $personal->id_grupo = $grupo['id'];

            $personal->update();
            //agregamos el grupo.. al modelo personal..para que se visualize el cambio en el datatable
            $personal->grup_number = $grup_number;

            if ($antiguo_foto_path  != null) {
                //si todo es ok eliminamos la antigua imagen 
                Storage::disk('public')->delete(str_replace("storage/", "", $antiguo_foto_path));
            }

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

  
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('id');
            $personal = Personal::find($id);
            $personal->status = false;
            $personal->save();

            //como tiene una relacion con la tabla users
            //entonces tambien eliminamos de la tabla usuarios
            $user = User::where('id_personal', $id)->update(['status' => false]);

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
