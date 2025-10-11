<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Habitacion;
use App\Models\CheckIn;
use App\Models\Empleado;
use Illuminate\Http\Request;

class CheckInController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-checkins|crear-checkins|editar-checkins|borrar-checkins', ['only' => ['index']]);
        $this->middleware('permission:crear-checkins', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-checkins', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-checkins', ['only' => ['destroy']]);
    }

    /**
     * Mostrar listado de check-ins
     */
    public function index()
    {
        $checkins = CheckIn::with('reserva.cliente', 'habitacion')->latest()->paginate(10);
        return view('checkins.index', compact('checkins'));
    }

    /**
     * Formulario para registrar un nuevo check-in
     */
    public function create()
    {
        // Traer reservas confirmadas y habitaciones disponibles
        $reservas = Reserva::with('habitacion', 'cliente')
            ->where('estado', 'confirmada')
            ->whereHas('habitacion', function($q) {
                $q->where('estado', 'disponible');
            })
            ->get();

        $empleados = Empleado::select('id', 'nombre')->get();

        return view('checkins.create', compact('reservas', 'empleados'));
    }

    /**
     * Guardar un nuevo check-in
     */
    public function store(Request $request)
    {
        $request->validate([
            'reserva_id' => 'required|exists:reservas,id',
        ]);

        $reserva = Reserva::with('habitacion')->findOrFail($request->reserva_id);

        // Validar que la habitación esté disponible
        if ($reserva->habitacion->estado !== 'disponible') {
            return back()->withErrors(['La habitación no está disponible.']);
        }

        // Validar que la reserva esté confirmada
        if ($reserva->estado !== 'confirmada') {
            return back()->withErrors(['La reserva no está confirmada.']);
        }

        // Crear el registro de check-in
        CheckIn::create([
            'reserva_id' => $reserva->id,
            'habitacion_id' => $reserva->habitacion_id,
            'empleado_id' => auth()->id(), // empleado autenticado
            'fecha_check_in' => now(),
        ]);

        // Actualizar estados
        $reserva->update([
            'estado' => 'pendiente',
            'fecha_entrada_real' => now(),
        ]);

        $reserva->habitacion->update([
            'estado' => 'ocupada',
        ]);

        return redirect()->route('checkins.index')
            ->with('success', 'Check-in registrado correctamente.');
    }

    /**
     * Mostrar un check-in específico
     */
    public function show(CheckIn $checkin)
    {
        return view('checkins.show', compact('checkin'));
    }

    /**
     * Formulario para editar un check-in
     */
    public function edit(CheckIn $checkin)
    {
        $reservas = Reserva::with('habitacion', 'cliente')
            ->where(function ($q) use ($checkin) {
                $q->where('estado', 'confirmada')
                  ->orWhere('id', $checkin->reserva_id);
            })
            ->get();

        $empleados = Empleado::select('id', 'nombre')->get();

        return view('checkins.edit', compact('checkin', 'reservas', 'empleados'));
    }

    /**
     * Actualizar un check-in
     */
    public function update(Request $request, CheckIn $checkin)
    {
        $request->validate([
            'empleado_id' => 'nullable|exists:empleados,id',
        ]);

        $checkin->update($request->only('empleado_id'));

        return redirect()->route('checkins.index')
            ->with('success', 'Check-in actualizado correctamente.');
    }

    /**
     * Eliminar un check-in
     */
    public function destroy(CheckIn $checkin)
    {
        $checkin->delete();

        return redirect()->route('checkins.index')
            ->with('success', 'Check-in eliminado correctamente.');
    }
}
