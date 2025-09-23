<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-clientes|crear-clientes|editar-clientes|borrar-clientes', ['only' => ['index']]);
         $this->middleware('permission:crear-clientes', ['only' => ['create','store']]);
         $this->middleware('permission:editar-clientes', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-clientes', ['only' => ['destroy']]);
    }

    public function index()
    {
        // Obtener todos los clientes
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);

        // Crear un nueva Empleado en la base de datos
        Cliente::create($request->all());
        // Mensaje de éxito
        session()->flash('success', 'Empleado creado correctamente.');

        return redirect()->route('clientes.index')
                         ->with('success', 'Empleado creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Obtener la Empleado por su ID
        $cliente = Cliente::findOrFail($id);

        return view('clientes.show', compact('cliente'));
    }

    public function edit($id)
    {
        // Obtener la Gasto por su ID
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);

        // Actualizar Gasto en la base de datos
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());
        // Mensaje de éxito
        session()->flash('success', 'Empleado actualizado correctamente.');

        return redirect()->route('clientes.index')
                         ->with('success', 'Empleado actualizado exitosamente');
    }


    public function destroy($id)
    {
        // Eliminar la Gasto de la base de datos
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')
                         ->with('success', 'Empleado eliminado exitosamente');
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'nit' => 'nullable|string|max:25',
            'nombre' => 'required|string|max:50',
            'direccion' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:100',
            'estado' => 'nullable|string|max:10',
        ]);
    }
}