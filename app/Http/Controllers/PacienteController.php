<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-pacientes|crear-pacientes|editar-pacientes|borrar-pacientes', ['only' => ['index']]);
         $this->middleware('permission:crear-pacientes', ['only' => ['create','store']]);
         $this->middleware('permission:editar-pacientes', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-pacientes', ['only' => ['destroy']]);
    }

    public function index()
    {
        // Obtener todos las lineas de aportes
        $pacientes = Paciente::all();
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        return view('pacientes.create');
    }

    public function store(Request $request)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);

        // Crear un nueva paciente en la base de datos
        Paciente::create($request->all());
        // Mensaje de éxito
        session()->flash('success', 'Paciente creado correctamente.');

        return redirect()->route('pacientes.index')
                         ->with('success', 'Paciente creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Obtener la paciente por su ID
        $paciente = Paciente::findOrFail($id);

        return view('pacientes.show', compact('paciente'));
    }

    public function edit($id)
    {
        // Obtener la Gasto por su ID
        $paciente = Paciente::findOrFail($id);
        return view('pacientes.edit', compact('paciente'));
    }

    public function update(Request $request, $id)
    {
        // Validar la entrada de datos
        $this->validateRequest($request);

        // Actualizar Gasto en la base de datos
        $paciente = Paciente::findOrFail($id);
        $paciente->update($request->all());
        // Mensaje de éxito
        session()->flash('success', 'Paciente actualizado correctamente.');

        return redirect()->route('pacientes.index')
                         ->with('success', 'Paciente actualizado exitosamente');
    }


    public function destroy($id)
    {
        // Eliminar la Gasto de la base de datos
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return redirect()->route('pacientes.index')
                         ->with('success', 'Paciente eliminado exitosamente');
    }

    private function validateRequest(Request $request)
{
    $request->validate([
        'tipo_documento'    => 'nullable|string|max:5',
        'numero'            => 'required|string|max:10|unique:pacientes,numero,' . $request->route('paciente'),
        'primer_nombre'     => 'nullable|string|max:20',
        'segundo_nombre'    => 'nullable|string|max:20',
        'primer_apellido'   => 'nullable|string|max:20',
        'segundo_apellido'  => 'nullable|string|max:20',
        'fecha_nacimiento'  => 'nullable|date',
        'edad'              => 'nullable|integer|min:0|max:150',
        'lugar_nacimiento'  => 'nullable|string|max:20',
        'nacionalidad'      => 'nullable|string|max:20',
        'responsable'       => 'nullable|string|max:50',
        'genero'            => 'nullable|string|max:11',
        'rh'                => 'nullable|string|max:5',
        'estado_civil'      => 'nullable|string|max:15',
        'nivel_educativo'   => 'nullable|string|max:15',
        'ultimo_año'        => 'nullable|string|max:5',
        'direccion'         => 'nullable|string|max:100',
        'estrato'           => 'nullable|integer|digits_between:1,1|min:0|max:9',
        'zona'              => 'nullable|string|max:1',
        'celular'           => 'nullable|string|max:20',
        'email'             => 'nullable|email|max:80|unique:pacientes,email,' . $request->route('paciente'),
        'estado'            => 'nullable|string|max:10',
        'created_by'        => 'nullable|integer|exists:users,id',
        'updated_by'        => 'nullable|integer|exists:users,id',
    ]);
}

}