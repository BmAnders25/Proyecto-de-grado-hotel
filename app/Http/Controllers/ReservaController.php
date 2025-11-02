<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Cliente;
use App\Models\Habitacion;
use App\Models\Piso;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReservaController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-reservas|crear-reservas|editar-reservas|borrar-reservas', ['only' => ['index']]);
        $this->middleware('permission:crear-reservas', ['only' => ['create','store']]);
        $this->middleware('permission:editar-reservas', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-reservas', ['only' => ['destroy']]);
    }

    // Muestra todas las reservas
    public function index()
    {
        $reservas = Reserva::with(['cliente', 'habitacion', 'piso'])->get();
        return view('reservas.index', compact('reservas'));
    }

    // Muestra el formulario para crear una nueva reserva
    public function create()
    {
        $clientes = Cliente::where('estado', 'Activo')->get();
        $habitaciones = Habitacion::where('estado', 'disponible')->get();
        $pisos = Piso::whereIn('id', [2, 3])->get();
        return view('reservas.create', compact('clientes', 'habitaciones', 'pisos'));
    }

    // Guarda la nueva reserva
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'habitacion_id' => 'required|exists:habitaciones,id',
            'piso_id' => 'required|exists:pisos,id', 
            'fecha_entrada' => 'required|date|after_or_equal:today',
            'fecha_salida' => 'required|date|after:fecha_entrada',
            'numero_personas' => 'required|integer|min:1',
            'estado' => 'required|in:pendiente,confirmada,cancelada,completada',
        ]);

        // Calcular precio total automáticamente
        $habitacion = Habitacion::findOrFail($request->habitacion_id);
        $dias = Carbon::parse($request->fecha_entrada)->diffInDays(Carbon::parse($request->fecha_salida));
        $precioTotal = $dias * $habitacion->precio_noche;

        Reserva::create([
            'cliente_id' => $request->cliente_id,
            'habitacion_id' => $request->habitacion_id,
            'piso_id' => $request->piso_id, 
            'fecha_entrada' => $request->fecha_entrada,
            'fecha_salida' => $request->fecha_salida,
            'numero_personas' => $request->numero_personas,
            'precio_total' => $precioTotal,
            'estado' => $request->estado,
        ]);

        return redirect()->route('reservas.index')->with('success', 'Reserva creada correctamente.');
    }

    // Muestra los detalles de una reserva
    public function show($id)
    {
        $reserva = Reserva::with(['cliente', 'habitacion', 'piso'])->findOrFail($id);
        return view('reservas.show', compact('reserva'));
    }

    // Muestra el formulario para editar una reserva
    public function edit($id)
    {
        $reserva = Reserva::findOrFail($id);
        $clientes = Cliente::where('estado', 'Activo')->get();
        $habitaciones = Habitacion::where('estado', 'disponible')->get();
        $pisos = Piso::whereIn('id', [2,3])->get();
        return view('reservas.edit', compact('reserva', 'clientes', 'habitaciones', 'pisos'));
    }

    // Actualiza los datos de una reserva
    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'habitacion_id' => 'required|exists:habitaciones,id',
            'piso_id' => 'required|exists:pisos,id', 
            'fecha_entrada' => 'required|date|after_or_equal:today',
            'fecha_salida' => 'required|date|after:fecha_entrada',
            'numero_personas' => 'required|integer|min:1',
            'estado' => 'required|in:pendiente,confirmada,cancelada,completada',
        ]);

        $reserva = Reserva::findOrFail($id);

        // Recalcular precio total si cambian fechas o habitación
        $habitacion = Habitacion::findOrFail($request->habitacion_id);
        $dias = Carbon::parse($request->fecha_entrada)->diffInDays(Carbon::parse($request->fecha_salida));
        $precioTotal = $dias * $habitacion->precio_noche;

        $reserva->update([
            'cliente_id' => $request->cliente_id,
            'habitacion_id' => $request->habitacion_id,
            'piso_id' => $request->piso_id, 
            'fecha_entrada' => $request->fecha_entrada,
            'fecha_salida' => $request->fecha_salida,
            'numero_personas' => $request->numero_personas,
            'precio_total' => $precioTotal,
            'estado' => $request->estado,
        ]);

        return redirect()->route('reservas.index')->with('success', 'Reserva actualizada correctamente.');
    }

    // Elimina una reserva
    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada correctamente.');
    }
}
