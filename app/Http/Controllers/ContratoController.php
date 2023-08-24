<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContratoRequest;
use App\Models\Ciudad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function viewCiudad()
    {
        try {
            $user = Auth::user()->onPersonal()->first();
            $ciudad = Ciudad::where('id', $user->id_ciudad)->first();
            $list_ciudades = Ciudad::all();
            return view('contrato/contrato-ciudad-view', [
                'ciudad' => $ciudad,
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

            return view('contrato/contrato-ciudad-tablero-view',[
            'ciudad'=>$ciudad->city_name,
            ]);

        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }

    public function tableroIndex(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function RowTableroCreate(ContratoRequest $request)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function rowTableroUpdate(ContratoRequest $request,)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function rowTableroDestroy(Request $request)
    {
        //
    }
}
