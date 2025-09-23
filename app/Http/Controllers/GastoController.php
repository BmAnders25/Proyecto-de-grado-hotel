<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;

class GastoController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-gastos|crear-gastos|editar-gastos|borrar-gastos', ['only' => ['index']]);
         $this->middleware('permission:crear-gastos', ['only' => ['create','store']]);
         $this->middleware('permission:editar-gastos', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-gastos', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos las lineas de aportes
        $gastos = Gasto::all();
        return view('gastos.index', compact('gastos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gastos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);

        // Crear un nueva Gasto en la base de datos
        Gasto::create($request->all());
        // Mensaje de éxito
        session()->flash('success', 'Gasto creado correctamente.');

        return redirect()->route('gastos.index')
                         ->with('success', 'Gasto creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Obtener la Gasto por su ID
        $gastos = Gasto::findOrFail($id);

        return view('gastos.show', compact('gastos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Obtener la Gasto por su ID
        $gastos = Gasto::findOrFail($id);
        return view('gastos.edit', compact('gastos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);

        // Actualizar Gasto en la base de datos
        $gastos = Gasto::findOrFail($id);
        $gastos->update($request->all());
        // Mensaje de éxito
        session()->flash('success', 'Gasto actualizado correctamente.');

        return redirect()->route('gastos.index')
                         ->with('success', 'Gasto actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Eliminar la Gasto de la base de datos
        $gastos = Gasto::findOrFail($id);
        $gastos->delete();

        return redirect()->route('gastos.index')
                         ->with('success', 'Gasto eliminado exitosamente');
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