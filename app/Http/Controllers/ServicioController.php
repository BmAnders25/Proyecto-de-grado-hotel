<?php

namespace App\Http\Controllers;

use App\Models\Servicio;        
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-servicios|crear-servicios|editar-servicios|borrar-servicios', ['only' => ['index']]);
        $this->middleware('permission:crear-servicios', ['only' => ['create','store']]);
        $this->middleware('permission:editar-servicios', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-servicios', ['only' => ['destroy']]);
    }

    public function index()
    {
        // Obtener todos los servicios
        $servicios = Servicio::all();
        return view('servicios.index', compact('servicios'));
    }

    public function create()
    {
        return view('servicios.create');
    }

    public function store(Request $request)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);

        // Crear un nueva Servicio en la base de datos
        Servicio::create($request->all());
        // Mensaje de éxito
        session()->flash('success', 'Servicio creado correctamente.');

        return redirect()->route('servicios.index')
                        ->with('success', 'Servicio creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Obtener la Servicio por su ID
        $servicio = Servicio::findOrFail($id);

        return view('servicios.show', compact('servicio'));
    }

    public function edit($id)
    {
        // Obtener la Gasto por su ID
        $servicio = Servicio::findOrFail($id);
        return view('servicios.edit', compact('servicio'));
    }

    public function update(Request $request, $id)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);

        // Actualizar Gasto en la base de dato
        $servicio = Servicio::findOrFail($id);
        $servicio->update($request->all());
        // Mensaje de éxito
        session()->flash('success', 'Servicio actualizado correctamente.');

        return redirect()->route('servicios.index')
                        ->with('success', 'Servicio actualizado exitosamente');
    }


    public function destroy($id)
    {
        // Eliminar la Gasto de la base de datos
        $servicio = Servicio::findOrFail($id);
        $servicio->delete();

        return redirect()->route('servicios.index')
                        ->with('success', 'Servicio eliminado exitosamente');
    }

    private function validateRequest(Request $request)
{
    $request->validate([
        'codigo' => 'required|string|max:20',
        'nombre' => 'required|string|max:50',
        'categoria_id' => 'required|string|max:255',
        'precio_entrada' => 'required|numeric|min:0',
        'precio_salida' => 'required|numeric|min:0',
        'unidades' => 'required|integer|min:0',
        'stock' => 'required|integer|min:0',
        'estado' => 'nullable|string|max:10',
    ]);
}

}
