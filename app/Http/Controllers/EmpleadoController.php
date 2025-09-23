<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-empleados|crear-empleados|editar-empleados|borrar-empleados', ['only' => ['index']]);
         $this->middleware('permission:crear-empleados', ['only' => ['create','store']]);
         $this->middleware('permission:editar-empleados', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-empleados', ['only' => ['destroy']]);
    }

    public function index()
    {
        // Obtener todos los empleados
        $empleados = Empleado::all();
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);

        // Crear un nueva Empleado en la base de datos
        Empleado::create($request->all());
        // Mensaje de éxito
        session()->flash('success', 'Empleado creado correctamente.');

        return redirect()->route('empleados.index')
                         ->with('success', 'Empleado creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Obtener la Empleado por su ID
        $empleado = Empleado::findOrFail($id);

        return view('empleados.show', compact('empleado'));
    }

    public function edit($id)
    {
        // Obtener la Gasto por su ID
        $empleado = Empleado::findOrFail($id);
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, $id)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);

        // Actualizar Gasto en la base de datos
        $empleado = Empleado::findOrFail($id);
        $empleado->update($request->all());
        // Mensaje de éxito
        session()->flash('success', 'Empleado actualizado correctamente.');

        return redirect()->route('empleados.index')
                         ->with('success', 'Empleado actualizado exitosamente');
    }


    public function destroy($id)
    {
        // Eliminar la Gasto de la base de datos
        $empleado = Empleado::findOrFail($id);
        $empleado->delete();

        return redirect()->route('empleados.index')
                         ->with('success', 'Empleado eliminado exitosamente');
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'cedula' => 'nullable|string|max:10',
            'nombre' => 'required|string|max:50',
            'direccion' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:100',
            'estado' => 'nullable|string|max:10',
        ]);
    }
}