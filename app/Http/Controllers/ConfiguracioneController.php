<?php

namespace App\Http\Controllers;

use App\Models\Configuracione;
use Illuminate\Http\Request;

class ConfiguracioneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configuracion = Configuracione::first();
        /**$user = auth()->user();*/
        
        return view('configuracion.index', compact('configuracion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $configuracion = Configuracione::first();
        /**$user = auth()->user();*/

        return view('configuracion.index', compact('configuracion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Configuracione $configuracion)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);
        
        $configuracion->update($request->all());

        return redirect()->route('configuracion.index')->with('success', 'Configuración actualizada con éxito.');
    }

    /**
     * Método privado para validar el request.
     */
    private function validateRequest(Request $request)
    {
        $request->validate([
            'nit' => 'required|string|max:25',
            'nombre' => 'required|string|max:150',
            'direccion' => 'required|string|max:150',
            'telefono' => 'required|string|max:30',
            'email' => 'required|email|max:150',

        ]);
    }
}
