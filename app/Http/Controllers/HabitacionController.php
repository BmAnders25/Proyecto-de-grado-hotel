<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\TipoHabitacion;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-habitaciones|crear-habitaciones|editar-habitaciones|borrar-habitaciones', ['only' => ['index']]);
        $this->middleware('permission:crear-habitaciones', ['only' => ['create','store']]);
        $this->middleware('permission:editar-habitaciones', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-habitaciones', ['only' => ['destroy']]);
    }

    public function index()
    {
        $habitaciones = Habitacion::all();
        return view('habitaciones.index', compact('habitaciones'));
    }

    public function create()
    {
        $tipos = TipoHabitacion::all(); // Traer tipos para el select
        return view('habitaciones.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|unique:habitaciones,numero',
            'estado' => 'required|in:disponible,ocupada,reservada',
            'precio_noche' => 'required|numeric|min:0',
            'precio_dia' => 'nullable|numeric|min:0',
            'tipo_habitacion_id' => 'required|exists:tipos_habitacion,id', // Validar que exista el tipo
        ]);

        Habitacion::create([
            'numero' => $request->input('numero'),
            'estado' => $request->input('estado'),
            'informacion' => $request->input('informacion'),
            'precio_noche' => $request->input('precio_noche'),
            'precio_dia' => $request->input('precio_dia'),
            'tipo_habitacion_id' => $request->input('tipo_habitacion_id'), // Guardar tipo
        ]);

        return redirect()->route('habitaciones.index')->with('success', 'Habitación creada con éxito.');
    }

    public function show($id)
    {
        $habitacion = Habitacion::findOrFail($id);
        return view('habitaciones.show', compact('habitacion'));
    }

    public function edit(Habitacion $habitacion)
    {
        $tipos = TipoHabitacion::all(); // Para el select en el edit
        return view('habitaciones.edit', compact('habitacion', 'tipos'));
    }

    public function update(Request $request, Habitacion $habitacion)
    {
        $request->validate([
            'numero' => 'required|unique:habitaciones,numero,' . $habitacion->id,
            'estado' => 'required|in:disponible,ocupada,reservada',
            'precio_noche' => 'required|numeric|min:0',
            'precio_dia' => 'nullable|numeric|min:0',
            'tipo_habitacion_id' => 'required|exists:tipos_habitacion,id',
        ]);

        $habitacion->update([
            'numero' => $request->input('numero'),
            'estado' => $request->input('estado'),
            'informacion' => $request->input('informacion'),
            'precio_noche' => $request->input('precio_noche'),
            'precio_dia' => $request->input('precio_dia'),
            'tipo_habitacion_id' => $request->input('tipo_habitacion_id'),
        ]);

        return redirect()->route('habitaciones.index')->with('success', 'Habitación actualizada con éxito.');
    }

    public function destroy(Habitacion $habitacion)
    {
        $habitacion->delete();
        return redirect()->route('habitaciones.index')->with('success', 'Habitación eliminada con éxito.');
    }
}
