<?php

namespace App\Http\Controllers;

use App\Models\ProductoVendido;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Habitacion; 
use Illuminate\Http\Request;

class ProductoVendidoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-productos-vendidos|crear-productos-vendidos|editar-productos-vendidos|borrar-productos-vendidos', ['only' => ['index']]);
        $this->middleware('permission:crear-productos-vendidos', ['only' => ['create','store']]);
        $this->middleware('permission:editar-productos-vendidos', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-productos-vendidos', ['only' => ['destroy']]);
    }

    public function index()
    {
        $ventas = ProductoVendido::with(['producto', 'cliente', 'empleado'])->get();
        return view('productosvendidos.index', compact('ventas'));
    }

    public function create()
    {
        $productos = Producto::where('estado', 'Activo')->get(); // Solo productos activos
        $clientes = Cliente::where('estado', 'Activo')->get(); // Solo clientes activos
        $empleados = Empleado::where('estado', 'Activo')->get();// Solo emplaedos activos
        $habitaciones = Habitacion::where('estado', 'Ocupada')->get(); // Solo habitaciones ocupadas

        return view('productosvendidos.create', compact('productos', 'clientes', 'empleados', 'habitaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cliente_id' => 'required|exists:clientes,id',
            'unidades' => 'required|integer|min:1',
            'vendido_por' => 'nullable|exists:empleados,id',
            'habitacion_id' => 'required|exists:habitaciones,id',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        // Validación de stock antes de registrar la venta
        if ($producto->stock < $request->unidades) {
            return back()->withErrors([
                'unidades' => 'Stock insuficiente. Solo hay ' . $producto->stock . ' unidades disponibles.',
            ])->withInput();
        }

        $precio = $producto->precio;
        $total = $request->unidades * $precio;

        // Descontar stock antes de guardar
        $producto->decrement('stock', $request->unidades);

        ProductoVendido::create([
            'producto_id' => $request->producto_id,
            'cliente_id' => $request->cliente_id,
            'unidades' => $request->unidades,
            'precio' => $precio,
            'total' => $total,
            'fecha_venta' => now(),
            'vendido_por' => $request->vendido_por,
            'habitacion_id' => $request->habitacion_id,
        ]);

        return redirect()->route('productosvendidos.index')
            ->with('success', 'Venta registrada correctamente.');
    }

    

}
