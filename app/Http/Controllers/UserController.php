<?php

namespace App\Http\Controllers;

use App\Models\Ciudad;
use Illuminate\Http\Request;
use Throwable;

class UserController extends Controller
{

    public function indexView(string $nombre_ciudad)
    {

        try {
            $key = false;
            $ciudad = Ciudad::all();
            foreach ($ciudad as $row => $value) {
                if ($value->city_name === $nombre_ciudad) {
                    $key = true;
                }
            }

            if ($key) {
                return view('user/user-view', ['city' => $nombre_ciudad]);
            }

            return view('error-page-view');
        } catch (Throwable $th) {
            return view('error-page-view');
        }
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        try {
            $city = $request->input('ciudad');
            $user = null;
            $ciudad = Ciudad::all();

            foreach ($ciudad as $row => $value) {
                if ($value->city_name == $city) {
                    
                }
            }

            if ($user == null) {
                return view('error-page-view');
            }
        } catch (Throwable $th) {
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
