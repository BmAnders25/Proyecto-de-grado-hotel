<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;        
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-vendedores|crear-vendedores|editar-vendedores|borrar-vendedores', ['only' => ['index']]);
         $this->middleware('permission:crear-vendedores', ['only' => ['create','store']]);
         $this->middleware('permission:editar-vendedores', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-vendedores', ['only' => ['destroy']]);
    }

    public function index()
    {
        // Obtener todos los vendedores
        $vendedores = Vendedor::all();
        return view('vendedores.index', compact('vendedores'));
    }

    public function create()
    {
        return view('vendedores.create');
    }

    public function store(Request $request)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);

        // Crear un nueva Empleado en la base de datos
        Vendedor::create($request->all());
        // Mensaje de éxito
        session()->flash('success', 'Empleado creado correctamente.');

        return redirect()->route('vendedores.index')
                         ->with('success', 'Empleado creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Obtener la Empleado por su ID
        $vendedor = Vendedor::findOrFail($id);

        return view('vendedores.show', compact('vendedor'));
    }

    public function edit($id)
    {
        // Obtener la Gasto por su ID
        $vendedor = Vendedor::findOrFail($id);
        return view('vendedores.edit', compact('vendedor'));
    }

    public function update(Request $request, $id)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);

        // Actualizar Gasto en la base de dato
        $vendedor = Vendedor::findOrFail($id);
        $vendedor->update($request->all());
        // Mensaje de éxito
        session()->flash('success', 'Empleado actualizado correctamente.');

        return redirect()->route('vendedores.index')
                         ->with('success', 'Empleado actualizado exitosamente');
    }


    public function destroy($id)
    {
        // Eliminar la Gasto de la base de datos
        $vendedor = Vendedor::findOrFail($id);
        $vendedor->delete();

        return redirect()->route('vendedores.index')
                         ->with('success', 'Empleado eliminado exitosamente');
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'cedula' => 'nullable|string|max:25',
            'nombre' => 'required|string|max:50',
            'direccion' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:100',
            'estado' => 'nullable|string|max:10',
        ]);
    }
}