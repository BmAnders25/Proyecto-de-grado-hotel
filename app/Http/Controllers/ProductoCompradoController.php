<?php

namespace App\Http\Controllers;

use App\Models\ProductoComprado;
use App\Models\Producto;
use App\Models\Empleado;
use Illuminate\Http\Request;

class ProductoCompradoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-productos-comprados|crear-productos-comprados|editar-productos-comprados|borrar-productos-comprados', ['only' => ['index']]);
        $this->middleware('permission:crear-productos-comprados', ['only' => ['create','store']]);
        $this->middleware('permission:editar-productos-comprados', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-productos-comprados', ['only' => ['destroy']]);
    }

    public function index()
    {
        $compras = ProductoComprado::with(['producto', 'empleado'])->get();
        return view('productoscomprados.index', compact('compras'));
    }

    public function create()
    {
        $productos = Producto::where('estado', 'Activo')->get();
        $empleados = Empleado::where('estado', 'Activo')->get();

        return view('productoscomprados.create', compact('productos', 'empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'unidades' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
            'registrado_por' => 'nullable|exists:empleados,id',
        ]);

        $total = $request->unidades * $request->precio;

        ProductoComprado::create([
            'producto_id' => $request->producto_id,
            'unidades' => $request->unidades,
            'precio' => $request->precio,
            'total' => $total,
            'fecha_compra' => now(), // Fecha real automática
            'registrado_por' => $request->registrado_por,
        ]);

        // Aumentar el stock del producto
        $producto = Producto::findOrFail($request->producto_id);
        $producto->increment('stock', $request->unidades);

        return redirect()->route('productoscomprados.index')
            ->with('success', 'Compra registrada correctamente.');
    }

    public function show($id)
    {
        $compra = ProductoComprado::with(['producto', 'empleado'])->findOrFail($id);
        return view('productoscomprados.show', compact('compra'));
    }

    public function edit($id)
    {
        $compra = ProductoComprado::findOrFail($id);
        $productos = Producto::where('estado', 'Activo')->get();
        $empleados = Empleado::where('estado', 'Activo')->get();

        return view('productoscomprados.edit', compact('compra', 'productos', 'empleados'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'unidades' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
            'registrado_por' => 'nullable|exists:empleados,id',
        ]);

        $compra = ProductoComprado::findOrFail($id);
        $producto = Producto::findOrFail($request->producto_id);

        // Calcular diferencia de stock
        $diferenciaUnidades = $request->unidades - $compra->unidades;
        $producto->increment('stock', $diferenciaUnidades);

        $total = $request->unidades * $request->precio;

        $compra->update([
            'producto_id' => $request->producto_id,
            'unidades' => $request->unidades,
            'precio' => $request->precio,
            'total' => $total,
            'fecha_compra' => now(), // Fecha real automática
            'registrado_por' => $request->registrado_por,
        ]);

        return redirect()->route('productoscomprados.index')
            ->with('success', 'Compra actualizada correctamente.');
    }

    public function destroy($id)
    {
        $compra = ProductoComprado::findOrFail($id);

        // Reducir stock
        $producto = $compra->producto;
        $producto->decrement('stock', $compra->unidades);

        $compra->delete();

        return redirect()->route('productoscomprados.index')
            ->with('success', 'Compra eliminada correctamente.');
    }
}
