@extends('adminlte::page')

@section('title', 'Pacientes')

@section('content_header')
<h1 class="m-0 text-dark">Administración de Pacientes</h1>
@stop

@section('content')
<x-adminlte-card>
    @can('crear-gastos')
    <a class="btn btn-primary mr-2" href="{{ route('pacientes.create') }}" role="button"><i class="fa fa-plus"></i> Nuevo Pacientes</a>
    @endcan

    <div class="card-body">
        @php
        $config['language'] = ['url' => asset('vendor/datatables/es-CO.json')];
        //$config['paging'] = true;
        //$config['lengthMenu'] = [10, 50, 100, 500];
        @endphp
        <x-adminlte-datatable id="table1"
    :heads="[
        'Id', 'Tipo de documento', 'Número', 'Primer nombre', 'Segundo nombre',
        'Primer apellido', 'Segundo apellido', 'Fecha de nacimiento', 'Edad', 'Lugar nacimiento',
        'Nacionalidad', 'Responsable', 'Género', 'RH', 'Estado civil', 'Nivel educativo',
        'Último año', 'Dirección', 'Estrato', 'Zona', 'Celular', 'Email', 'Estado', 'Acciones'
    ]"
    head-theme="dark"
    :config="$config"
    striped
    hoverable
    with-buttons
>
    @foreach ($pacientes as $paciente)
    <tr>
        <td>{{ $paciente->id }}</td>
        <td>{{ $paciente->tipo_documento }}</td>
        <td>{{ $paciente->numero }}</td>
        <td>{{ $paciente->primer_nombre }}</td>
        <td>{{ $paciente->segundo_nombre }}</td>
        <td>{{ $paciente->primer_apellido }}</td>
        <td>{{ $paciente->segundo_apellido }}</td>
        <td>{{ $paciente->fecha_nacimiento ? $paciente->fecha_nacimiento->format('Y-m-d') : '' }}</td>
        <td>{{ $paciente->edad }}</td>
        <td>{{ $paciente->lugar_nacimiento }}</td>
        <td>{{ $paciente->nacionalidad }}</td>
        <td>{{ $paciente->responsable }}</td>
        <td>{{ $paciente->genero }}</td>
        <td>{{ $paciente->rh }}</td>
        <td>{{ $paciente->estado_civil }}</td>
        <td>{{ $paciente->nivel_educativo }}</td>
        <td>{{ $paciente->ultimo_año }}</td>
        <td>{{ $paciente->direccion }}</td>
        <td>{{ $paciente->estrato }}</td>
        <td>{{ $paciente->zona }}</td>
        <td>{{ $paciente->celular }}</td>
        <td>{{ $paciente->email }}</td>
        <td>
            @if ($paciente->estado === 'Activo')
                <h5><span class="badge badge-success">{{ $paciente->estado }}</span></h5>
            @elseif ($paciente->estado === 'Inactivo')
                <h5><span class="badge badge-danger">{{ $paciente->estado }}</span></h5>
            @else
                <h5><span class="badge badge-secondary">{{ $paciente->estado ?? 'Desconocido' }}</span></h5>
            @endif
        </td>
        <td>
            <a class="btn btn-info" href="{{ route('pacientes.show', $paciente->id) }}" title="Ver">
                <i class="far fa-eye fa-fw"></i>
            </a>

            @can('editar-pacientes')
            <a class="btn btn-success" href="{{ route('pacientes.edit', $paciente->id) }}" title="Editar">
                <i class="fas fa-pencil-alt fa-fw"></i>
            </a>
            @endcan

            @can('borrar-pacientes')
            <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Seguro que quieres eliminar este paciente?');">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-warning delete-button" title="Eliminar">

                    <i class="far fa-trash-alt fa-fw"></i>
                </button>
            </form>
            @endcan
        </td>
    </tr>
    @endforeach
</x-adminlte-datatable>

    </div>
</x-adminlte-card>
@stop

@section('footer')
<footer>
    <p><img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo Fralgom"> © {{ date('Y') }} Fralgóm
        Ingeniería
        Informática. Todos los derechos reservados.</p>
</footer>
@stop

@section('js')

@if ($message = Session::get('success'))
<script>
Swal.fire({
    title: "Operación Exitosa!",
    text: "{{ $message }}",
    timer: 2000,
    icon: "success"
});
</script>
@endif




<script>
var deleteButtons = document.querySelectorAll('.delete-button');
deleteButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var form = this.parentElement;
        Swal.fire({
            title: "¿Estás seguro de Eliminar este paciente?",
            text: "¡No se podrá recuperar la información!",
            icon: "error",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "¡Sí, Eliminar!"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
});
</script>

@stop