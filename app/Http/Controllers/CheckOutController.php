<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Habitacion;
use App\Models\CheckOut;
use Illuminate\Http\Request;
use App\Models\Empleado;

class CheckOutController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-checkouts|crear-checkouts|editar-checkouts|borrar-checkouts', ['only' => ['index']]);
        $this->middleware('permission:crear-checkouts', ['only' => ['create','store']]);
        $this->middleware('permission:editar-checkouts', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-checkouts', ['only' => ['destroy']]);
    }

    /**
     * Mostrar listado de check-outs
     */
    public function index()
    {
        $checkouts = CheckOut::with('reserva.cliente', 'habitacion')->latest()->paginate(10);
        return view('checkouts.index', compact('checkouts'));
    }

    /**
     * Formulario para registrar un nuevo check-out
     */
    

public function create()
{
    $reservas = Reserva::with('habitacion', 'cliente')
        ->where('estado', 'confirmada')
        ->whereHas('habitacion', function($q) {
            $q->where('estado', 'ocupada');
        })
        ->get();

    // Obtener todos los empleados
    $empleados = Empleado::where('estado', 'Activo')->get();

    return view('checkouts.create', compact('reservas', 'empleados'));
}


    /**
     * Guardar un nuevo check-out
     */
    public function store(Request $request)
    {
        $request->validate([
            'reserva_id' => 'required|exists:reservas,id',
        ]);

        $reserva = Reserva::with('habitacion')->findOrFail($request->reserva_id);

        // Validaciones de estado
        if ($reserva->habitacion->estado !== 'ocupada') {
            return back()->withErrors(['La habitación no está ocupada.']);
        }

        if ($reserva->estado !== 'confirmada') {
            return back()->withErrors(['La reserva no está en curso.']);
        }

        // Calcular total (puedes adaptarlo a tu lógica)
        $total = $reserva->precio_total ?? 0;

        // Registrar check-out
        CheckOut::create([
            'reserva_id' => $reserva->id,
            'habitacion_id' => $reserva->habitacion_id,
            'empleado_id' => auth()->id(), // si usas autenticación
            'fecha_check_out' => now(),
            'total' => $total
        ]);

        // Actualizar estados
        $reserva->update([
            'estado' => 'completada',
            'fecha_salida_real' => now(),
        ]);

        // Verificar si hay otra reserva futura para esta habitación
        $hayReservaFutura = Reserva::where('habitacion_id', $reserva->habitacion_id)
            ->where('estado', 'confirmada')
            ->where('fecha_entrada', '>', now())
            ->exists();

        $reserva->habitacion->update([
            'estado' => $hayReservaFutura ? 'reservada' : 'disponible',
        ]);

        return redirect()->route('checkouts.index')
            ->with('success', 'Check-out registrado correctamente.');
    }

    /**
     * Mostrar un check-out específico
     */
    public function show(CheckOut $checkout)
    {
        return view('checkouts.show', compact('checkout'));
    }

    /**
     * Formulario para editar un check-out
     */
    public function edit(CheckOut $checkout)
{
    // Cargar reservas (incluyendo la actual aunque no cumpla el filtro)
    $reservas = Reserva::with('habitacion', 'cliente')
        ->where(function ($q) use ($checkout) {
            $q->where('estado', 'confirmada')
              ->orWhere('id', $checkout->reserva_id);
        })
        ->get();

    // Cargar empleados
    $empleados = Empleado::where('estado', 'Activo')->get();

    return view('checkouts.edit', compact('checkout', 'reservas', 'empleados'));
}


    /**
     * Actualizar un check-out
     */
    public function update(Request $request, CheckOut $checkout)
    {
        $request->validate([
            'total' => 'required|numeric|min:0',
        ]);

        $checkout->update($request->only('total'));

        return redirect()->route('checkouts.index')
            ->with('success', 'Check-out actualizado correctamente.');
    }

    /**
     * Eliminar un check-out
     */
    public function destroy(CheckOut $checkout)
    {
        $checkout->delete();

        return redirect()->route('checkouts.index')
            ->with('success', 'Check-out eliminado correctamente.');
    }
}
