<?php

namespace App\Http\Controllers;

use App\Models\TipoHabitacion;
use Illuminate\Http\Request;

class TipoHabitacionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-tipo-habitaciones|crear-tipo-habitaciones|editar-tipo-habitaciones|borrar-tipo-habitaciones', ['only' => ['index']]);
        $this->middleware('permission:crear-tipo-habitaciones', ['only' => ['create','store']]);
        $this->middleware('permission:editar-tipo-habitaciones', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-tipo-habitaciones', ['only' => ['destroy']]);
    }

    public function index()
    {
        $tipos = TipoHabitacion::all();
        return view('tipo_habitaciones.index', compact('tipos'));
    }

    public function create()
    {
        return view('tipo_habitaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:tipo_habitaciones,nombre',
            'descripcion' => 'nullable|string',
            'precio_base' => 'required|numeric|min:0',
        ]);

        TipoHabitacion::create($request->all());

        return redirect()->route('tipo_habitaciones.index')->with('success', 'Tipo de habitación creado con éxito.');
    }

    public function show(TipoHabitacion $tipo)
    {
        return view('tipo_habitaciones.show', compact('tipo'));
    }

    public function edit(TipoHabitacion $tipo)
    {
        return view('tipo_habitaciones.edit', compact('tipo'));
    }

    public function update(Request $request, TipoHabitacion $tipo)
    {
        $request->validate([
            'nombre' => 'required|unique:tipo_habitaciones,nombre,' . $tipo->id,
            'descripcion' => 'nullable|string',
            'precio_base' => 'required|numeric|min:0',
        ]);

        $tipo->update($request->all());

        return redirect()->route('tipo_habitaciones.index')->with('success', 'Tipo de habitación actualizado con éxito.');
    }

    public function destroy(TipoHabitacion $tipo)
    {
        $tipo->delete();

        return redirect()->route('tipo_habitaciones.index')->with('success', 'Tipo de habitación eliminado con éxito.');
    }
}
