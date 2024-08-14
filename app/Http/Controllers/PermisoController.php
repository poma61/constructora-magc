<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Throwable;

class PermisoController extends Controller
{
    public function index()
    {
        try {
            $list_permiso = Permiso::all();
            return response()->json([
                'status' => true,
                'message' => 'OK',
                "records" => $list_permiso,
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
                'records' => null,
            ]);
        }
    }
}// class

