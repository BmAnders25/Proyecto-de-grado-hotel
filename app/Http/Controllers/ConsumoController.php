<?php

namespace App\Http\Controllers;

use App\Models\Consumo;
use App\Models\Producto;
use App\Models\Habitacion;
use Illuminate\Http\Request;

class ConsumoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-consumos', ['only' => ['index']]);
        $this->middleware('permission:crear-consumos', ['only' => ['create','store']]);
    }

    // Historial de consumos
    public function index()
    {
        $consumos = Consumo::with(['producto', 'habitacion', 'piso'])
            ->orderBy('fecha_venta', 'desc')
            ->get();

        return view('consumos.index', compact('consumos'));
    }

    // Formulario de nuevo consumo
    public function create()
    {
        $habitaciones = Habitacion::where('estado', 'ocupada')->get();
        $productos    = Producto::where('estado', 'Activo')->get();

        return view('consumos.create', compact('habitaciones', 'productos'));
    }

    // Guardar consumo
    public function store(Request $request)
    {
        $request->validate([
            'habitacion_id' => 'required|exists:habitaciones,id',
            'producto_id'   => 'required|exists:productos,id',
            'unidades'      => 'required|integer|min:1',
            'piso_id'       => 'nullable|integer'
        ]);

        $producto = Producto::findOrFail($request->producto_id);
        $total    = $producto->precio * $request->unidades;

        Consumo::create([
            'habitacion_id' => $request->habitacion_id,
            'producto_id'   => $request->producto_id,
            'piso_id'       => $request->piso_id ?? null,
            'unidades'      => $request->unidades,
            'precio'        => $producto->precio,
            'total'         => $total,
            'fecha_venta'   => now(),
        ]);

        return redirect()->route('consumos.index')
            ->with('success', "Consumo registrado: {$request->unidades} x {$producto->nombre} en Habitación {$request->habitacion_id}");
    }
}    