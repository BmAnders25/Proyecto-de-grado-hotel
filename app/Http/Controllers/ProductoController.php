<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;        
use App\Models\MinibarHabitacion;

class ProductoController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-productos|crear-productos|editar-productos|borrar-productos', ['only' => ['index']]);
        $this->middleware('permission:crear-productos', ['only' => ['create','store']]);
        $this->middleware('permission:editar-productos', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-productos', ['only' => ['destroy']]);
    }

    public function index()
    {
        // Obtener todos los productos
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
{
    // Validar la entrada de datos
    $this->validateRequest($request);

    // Crear un nuevo Producto en la base de datos
    $producto = Producto::create($request->all());

    // Crear automáticamente el inventario para este producto
    if($producto->estado == 'Activo'){
    MinibarHabitacion::create([
    'producto_id' => $producto->id,
    'cantidad_inicial' => $producto->stock,  //  aquí va el stock inicial
    'cantidad_actual' => 0,  //  el admin lo ajusta manualmente después
]);
    }


    // Mensaje de éxito
    session()->flash('success', 'Producto creado correctamente y agregado al inventario.');

    return redirect()->route('productos.index')
                    ->with('success', 'Producto creado exitosamente');
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Obtener la Producto por su ID
        $producto = Producto::findOrFail($id);

        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        // Obtener el producto por su ID
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

   
    public function update(Request $request, $id)
{
    // Validar la entrada de datos
    $this->validateRequest($request);

    // Obtener el producto
    $producto = Producto::findOrFail($id);

    // Guardar el estado anterior
    $estadoAnterior = $producto->estado;

    // Actualizar el producto con los datos del request
    $producto->update($request->all());

    // Si el producto ahora está activo y antes estaba inactivo, crear o mantener inventario
    if ($producto->estado === 'Activo' && $estadoAnterior !== 'Activo') {
        // Verificar si ya existe inventario
        $inventario = MinibarHabitacion::where('producto_id', $producto->id)->first();
        if (!$inventario) {
            MinibarHabitacion::create([
                'producto_id' => $producto->id,
                'cantidad_inicial' => $producto->stock,
                'cantidad_actual' => 0,
            ]);
        }
    }

    // Si el producto ahora está inactivo, opcional: podrías ocultarlo del inventario o marcarlo
    if ($producto->estado === 'Inactive') {
        // Por ejemplo, no mostrar en listados de venta (se hace filtrando en los controladores de ventas)
        // O, si quieres, actualizar inventario actual a 0:
        $inventario = MinibarHabitacion::where('producto_id', $producto->id)->first();
        if ($inventario) {
            $inventario->cantidad_actual = 0;
            $inventario->save();
        }
    }

    // Mensaje de éxito
    session()->flash('success', 'Producto actualizado correctamente.');

    return redirect()->route('productos.index')
                    ->with('success', 'Producto actualizado exitosamente');
}



    public function destroy($id)
    {
        // Eliminar la Gasto de la base de datos
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')
                        ->with('success', 'Producto eliminado exitosamente');
    }

    private function validateRequest(Request $request)
{
    $request->validate([
        'producto_id' => 'required|string|max:20',
        'nombre' => 'required|string|max:50',
        'precio' => 'required|numeric|min:0',
        'unidades' => 'required|integer|min:0',
        'stock' => 'required|integer|min:0',
        'estado' => 'nullable|string|max:10',
    ]);
}

}
