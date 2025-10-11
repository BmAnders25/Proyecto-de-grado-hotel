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
        $habitaciones = Habitacion::with('tipo')->get();
        return view('habitaciones.index', compact('habitaciones'));
    }

    public function create()
    {
        $tipos = TipoHabitacion::all(); 
        return view('habitaciones.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|unique:habitaciones,numero',
            'estado' => 'required|in:disponible,ocupada,reservada',
            'precio_noche' => 'required|numeric|min:0',
            'precio_dia' => 'nullable|numeric|min:0',
            'tipo_habitacion_id' => 'nullable|exists:tipo_habitaciones,id',
        ]);

        Habitacion::create([
            'numero' => $request->numero,
            'estado' => $request->estado,
            'informacion' => $request->informacion,
            'precio_noche' => $request->precio_noche,
            'precio_dia' => $request->precio_dia,
            'tipo_habitacion_id' => $request->tipo_habitacion_id,
        ]);

        return redirect()->route('habitaciones.index')->with('success', 'Habitación creada con éxito.');
    }

    public function show($id)
    {
        $habitacion = Habitacion::with('tipo')->findOrFail($id);
        return view('habitaciones.show', compact('habitacion'));
    }

    public function edit(Habitacion $habitacion)
    {
        $tipos = TipoHabitacion::all();
        return view('habitaciones.edit', compact('habitacion', 'tipos'));
    }

    public function update(Request $request, Habitacion $habitacion)
    {
        $request->validate([
            'numero' => 'required|unique:habitaciones,numero,' . $habitacion->id,
            'estado' => 'required|in:disponible,ocupada,reservada',
            'precio_noche' => 'required|numeric|min:0',
            'precio_dia' => 'nullable|numeric|min:0',
            'tipo_habitacion_id' => 'nullable|exists:tipo_habitaciones,id',
        ]);

        $habitacion->update([
            'numero' => $request->numero,
            'estado' => $request->estado,
            'informacion' => $request->informacion,
            'precio_noche' => $request->precio_noche,
            'precio_dia' => $request->precio_dia,
            'tipo_habitacion_id' => $request->tipo_habitacion_id,
        ]);

        return redirect()->route('habitaciones.index')->with('success', 'Habitación actualizada con éxito.');
    }

    public function destroy(Habitacion $habitacion)
    {
        $habitacion->delete();
        return redirect()->route('habitaciones.index')->with('success', 'Habitación eliminada con éxito.');
    }
}
