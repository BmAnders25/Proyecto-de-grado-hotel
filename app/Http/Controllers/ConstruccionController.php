<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;

class ConstruccionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gastos = Gasto::all();
        return view('construccion.index', compact('gastos'));
    }

}
