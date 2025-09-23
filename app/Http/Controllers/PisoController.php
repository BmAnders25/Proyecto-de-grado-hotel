<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Piso;

class PisoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-pisos|crear-pisos|editar-pisos|borrar-pisos', ['only' => ['index']]);
        $this->middleware('permission:crear-pisos', ['only' => ['create','store']]);
        $this->middleware('permission:editar-pisos', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-pisos', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos las lineas de aportes
        $pisos = Piso::all();
        return view('pisos.index', compact('pisos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pisos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);

        // Crear un nueva Piso en la base de datos
        Piso::create($request->all());
        // Mensaje de éxito
        session()->flash('success', 'Piso creado correctamente.');

        return redirect()->route('pisos.index')
                        ->with('success', 'Piso creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Obtener la Piso por su ID
        $piso = Piso::findOrFail($id);

        return view('pisos.show', compact('piso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Obtener la Piso por su ID
        $piso = Piso::findOrFail($id);
        return view('pisos.edit', compact('piso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);

        // Actualizar Piso en la base de datos
        $piso = Piso::findOrFail($id);
        $piso->update($request->all());
        // Mensaje de éxito
        session()->flash('success', 'Piso actualizado correctamente.');

        return redirect()->route('pisos.index')
                        ->with('success', 'Piso actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Eliminar la Piso de la base de datos
        $piso = Piso::findOrFail($id);
        $piso->delete();

        return redirect()->route('pisos.index')
                         ->with('success', 'Piso eliminado exitosamente');
    }

    /**
     * Método privado para validar el request.
     */
    private function validateRequest(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:80',
            'estado' => 'nullable|string|max:20',
        ]);
    }
}