<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-proveedores|crear-proveedores|editar-proveedores|borrar-proveedores', ['only' => ['index']]);
         $this->middleware('permission:crear-proveedores', ['only' => ['create','store']]);
         $this->middleware('permission:editar-proveedores', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-proveedores', ['only' => ['destroy']]);
    }

    public function index()
    {
        // Obtener todos las lineas de aportes
        $proveedores = Proveedor::all();
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);

        // Crear un nueva proveedor en la base de datos
        Proveedor::create($request->all());
        // Mensaje de éxito
        session()->flash('success', 'Proveedor creado correctamente.');

        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Obtener la proveedor por su ID
        $proveedor = Proveedor::findOrFail($id);

        return view('proveedores.show', compact('proveedor'));
    }

    public function edit($id)
    {
        // Obtener la Gasto por su ID
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, $id)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);

        // Actualizar Gasto en la base de datos
        $proveedor = Proveedor ::findOrFail($id);
        $proveedor->update($request->all());
        // Mensaje de éxito
        session()->flash('success', 'Proveedor actualizado correctamente.');

        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor actualizado exitosamente');
    }


    public function destroy($id)
    {
        // Eliminar la Gasto de la base de datos
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();

        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor eliminado exitosamente');
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'tipo_documento' => 'nullable|string|max:5',
            'numero' => 'required|string|max:10',
            'primer_nombre' => 'nullable|string|max:20',
            'telefono' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:100',
            'estado' => 'nullable|string|max:10',
        ]);
    }
}