<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class ControlDeObrasController extends Controller
{

    public function viewCiudad()
    {
        try {
            $user = Auth::user()->onPersonal()->first();
            $ciudad = Ciudad::where('id', $user->id_ciudad)->first();
            $list_ciudades = Ciudad::all();
            return view('control-de-obra/control-de-obra-ciudad-view', [
                'ciudad' => $ciudad->city_name,
                'list_ciudades' => $list_ciudades,
            ]);
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
