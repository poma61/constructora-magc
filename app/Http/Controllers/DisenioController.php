<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisenioController extends Controller
{


    // solo esta creado
    // base de datos
    // las vistas son copias de "finanzas-de-construccion", pero las vistas no estan editas
    // las unicas vistas que estan editadas son tablero-disenio y disenio options => se debe actualizar las rutas segun las necesidades
    public function viewTablero()
    {

        return view('disenio/tablero-disenio-view');
    }


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
