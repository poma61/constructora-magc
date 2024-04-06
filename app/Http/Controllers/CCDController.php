<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CCDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('operation/ccd-operation-view');
    }

}
