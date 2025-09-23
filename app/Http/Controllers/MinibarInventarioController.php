<?php

namespace App\Http\Controllers;

use App\Models\MinibarInventario;
use App\Models\Producto;
use Illuminate\Http\Request;

class MinibarInventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-minibar-inventario|editar-minibar-inventario|borrar-minibar-inventario', ['only' => ['index']]);
        $this->middleware('permission:editar-minibar-inventario', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-minibar-inventario', ['only' => ['destroy']]);
    }

    public function index()
    {
        // Eliminamos la relación con Habitacion
        $inventarios = MinibarInventario::whereHas('producto', function($query) {
            $query->where('estado', 'Activo');
        })
        ->with(['producto']) // Eliminamos 'habitacion' de la carga
        ->paginate(9);

        return view('minibarinventario.index', compact('inventarios'));
    }

    public function show($id)
    {
        // Eliminamos la relación con Habitacion
        $inventario = MinibarInventario::with(['producto'])->findOrFail($id);

        // Puedes usar esto en la vista para mostrar alerta si el inventario está bajo
        $alertaInventario = $inventario->cantidad_actual < 3;

        return view('minibarinventario.show', compact('inventario', 'alertaInventario'));
    }

    public function edit($id)
    {
        $inventario = MinibarInventario::findOrFail($id);
        $productos = Producto::all();

        return view('minibarinventario.edit', compact('inventario', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad_inicial' => 'required|integer|min:1',
            'cantidad_actual' => 'required|integer|min:0',
        ]);

        // Verificar si ya existe ese producto en el inventario
        $existe = MinibarInventario::where('producto_id', $request->producto_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($existe) {
            return back()->withErrors(['producto_id' => 'Este producto ya está registrado en el inventario.'])->withInput();
        }

        $inventario = MinibarInventario::findOrFail($id);
        $inventario->update([
            'producto_id' => $request->producto_id,
            'cantidad_inicial' => $request->cantidad_inicial,
            'cantidad_actual' => $request->cantidad_actual,
        ]);

        return redirect()->route('minibarinventario.index')
                        ->with('success', 'Inventario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $inventario = MinibarInventario::findOrFail($id);
        $inventario->delete();

        return redirect()->route('minibarinventario.index')
                        ->with('success', 'Inventario eliminado correctamente.');
    }
}
