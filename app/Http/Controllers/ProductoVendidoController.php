<?php

namespace App\Http\Controllers;

use App\Models\ProductoVendido;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Habitacion; // Importar el modelo de Habitacion
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
        $clientes = Cliente::all();
        $empleados = Empleado::all();
        $habitaciones = Habitacion::all(); // Obtener todas las habitaciones disponibles

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

    public function show($id)
    {
        $venta = ProductoVendido::with(['producto','cliente','empleado'])->findOrFail($id);
        return view('productosvendidos.show', compact('venta'));
    }

    public function edit($id)
    {
        $venta = ProductoVendido::findOrFail($id);
        $productos = Producto::where('estado', 'Activo')->get(); // Solo productos activos
        $clientes = Cliente::all();
        $empleados = Empleado::all();
        $habitaciones = Habitacion::all(); // Obtener habitaciones disponibles

        return view('productosvendidos.edit', compact('venta', 'productos', 'clientes', 'empleados', 'habitaciones'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cliente_id' => 'required|exists:clientes,id',
            'unidades' => 'required|integer|min:1',
            'vendido_por' => 'nullable|exists:empleados,id',
            'habitacion_id' => 'required|exists:habitaciones,id',
        ]);

        $venta = ProductoVendido::findOrFail($id);

        $producto = Producto::findOrFail($request->producto_id);
        $precio = $producto->precio;
        $total = $request->unidades * $precio;

        // Actualizar la venta
        $venta->update([
            'producto_id' => $request->producto_id,
            'cliente_id' => $request->cliente_id,
            'unidades' => $request->unidades,
            'precio' => $precio, // Precio del producto
            'total' => $total,
            'fecha_venta' => $request->fecha_venta ?? now(),
            'vendido_por' => $request->vendido_por,
            'habitacion_id' => $request->habitacion_id,
        ]);

        return redirect()->route('productosvendidos.index')
            ->with('success', 'Venta actualizada correctamente.');
    }

    public function destroy($id)
    {
        $venta = ProductoVendido::findOrFail($id);
        $venta->delete();

        return redirect()->route('productosvendidos.index')
            ->with('success', 'Venta eliminada correctamente.');
    }
}
