<?php

namespace App\Http\Controllers;

use App\Models\MinibarHabitacion;
use App\Models\Habitacion;
use App\Models\Producto;
use Illuminate\Http\Request;

class MinibarHabitacionController extends Controller
{

    /**
     * Mostrar todas las habitaciones con su minibar.
     */
    public function index()
    {
        $habitaciones = Habitacion::with(['productos'])->paginate(4);
        return view('minibar.index', compact('habitaciones'));
    }

// Formulario para agregar productos a una habitación
    public function create(Habitacion $habitacion)
    {
        $productos = Producto::all();
        return view('minibar.create', compact('habitacion', 'productos'));
    }

   public function store(Request $request)
{
    // Validación inicial
    $request->validate([
        'habitacion_id' => 'required|exists:habitaciones,id',
        'cantidad' => 'required|array',
        'cantidad.*' => 'integer|min:0', // max lo validamos manualmente abajo
    ]);

    $habitacion = Habitacion::findOrFail($request->habitacion_id);

    $productos = Producto::all()->keyBy('id'); // traer todos los productos para comparar stock

    $cantidades = $request->input('cantidad', []);

    foreach ($cantidades as $productoId => $cantidad) {
        if (!isset($productos[$productoId])) {
            return back()->withErrors(['error' => "Producto #$productoId no encontrado"]);
        }

        $producto = $productos[$productoId];

        if ($cantidad > $producto->stock) {
            return back()->withErrors([
                "cantidad.$productoId" => "La cantidad de {$producto->nombre} no puede superar el stock disponible ({$producto->stock})."
            ])->withInput();
        }

        if ($cantidad > 0) {
            // Crear o actualizar registro en la tabla pivot o en Minibar
            MinibarHabitacion::create([
            'habitacion_id' => $habitacion->id,
            'producto_id' => $producto->id,
            'cantidad' => $cantidad,
            'cantidad_inicial' => $cantidad, 
            'cantidad_actual' => $cantidad,
            'precio_unitario' => $producto->precio,
]);
        }
    }

    return redirect()->route('minibar.index')
                    ->with('success', 'Productos agregados correctamente.');
}


    /**
     * Mostrar el inventario de una habitación específica.
     */
    public function show($habitacion_id)
    {
        $habitacion = Habitacion::with('productos')->findOrFail($habitacion_id);
        return view('minibar.show', compact('habitacion'));
    }

    /**
     * Editar los productos del minibar de una habitación.
     */
    public function edit($habitacion_id)
    {
        $habitacion = Habitacion::with('productos')->findOrFail($habitacion_id);
        $productos = Producto::where('estado', 'Activo')->get();

        return view('minibar.edit', compact('habitacion', 'productos'));
    }

    /**
     * Actualizar las cantidades o agregar nuevos productos al minibar.
     */
    public function update(Request $request, $habitacion_id)
    {
        $request->validate([
            'productos' => 'required|array',
            'productos.*.id' => 'exists:productos,id',
            'productos.*.cantidad_inicial' => 'required|integer|min:0',
            'productos.*.cantidad_actual' => 'required|integer|min:0',
        ]);

        $habitacion = Habitacion::findOrFail($habitacion_id);

        // Limpiamos relaciones previas y actualizamos todas
        $syncData = [];
        foreach ($request->productos as $prod) {
            $syncData[$prod['id']] = [
                'cantidad_inicial' => $prod['cantidad_inicial'],
                'cantidad_actual' => $prod['cantidad_actual'],
            ];
        }

        $habitacion->productos()->sync($syncData);

        return redirect()->route('minibar.index')
            ->with('success', 'Minibar de la habitación actualizado correctamente.');
    }

    /**
     * Eliminar un producto del minibar de una habitación.
     */
    public function destroy($habitacion_id, $producto_id)
    {
        $habitacion = Habitacion::findOrFail($habitacion_id);
        $habitacion->productos()->detach($producto_id);

        return back()->with('success', 'Producto eliminado del minibar correctamente.');
    }
}
