@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
<h1 class="m-0 text-dark">Administración de Empleados</h1>
@stop

@section('content')
<x-adminlte-card>
    @can('crear-gastos')
    <a class="btn btn-primary mr-2" href="{{ route('empleados.create') }}" role="button"><i class="fa fa-plus"></i> Nuevo Empleado</a>
    @endcan

    <div class="card-body">
        @php
        $config['language'] = ['url' => asset('vendor/datatables/es-CO.json')];
        //$config['paging'] = true;
        //$config['lengthMenu'] = [10, 50, 100, 500];
        @endphp
        <x-adminlte-datatable id="table1" :heads="['Id', 'Cedula', 'Nombre', 'Dirección', 'Telefono', 'Email', 'Estado', 'Acciones']" head-theme="dark"
            :config=$config striped hoverable with-buttons>
            @foreach ($empleados as $empleado)
            <tr>
                <td>{{ $empleado->id }}</td>
                <td>{{ $empleado->cedula }}</td>
                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->direccion }}</td>
                <td>{{ $empleado->telefono }}</td>
                <td>{{ $empleado->email}}</td>
                
                <td>
                    @if ($empleado->estado == "Activo")
                    <h5><span class="badge badge-success">{{ $empleado->estado }}</span></h5>
                    @elseif ($empleado->estado == "Inactivo")
                    <h5><span class="badge badge-danger">{{ $empleado->estado }}</span></h5>
                    @endif
                </td>
                <td>
                    <a class="btn btn-info" href="{{ route('empleados.show', $empleado->id) }}" role="button">
                        <i class="far fa-eye fa-fw"></i></a>
                    @can('editar-gastos')
                    <a class="btn btn-success" href="{{ route('empleados.edit', $empleado->id) }}"
                        role="button">
                        <i class="fas fa-pencil-alt fa-fw"></i></a>
                    @endcan
                    
                    @can('borrar-gastos')
                    <form method="POST" action="{{ route('empleados.destroy', $empleado->id) }}"
                        style="display: inline;" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-warning delete-button">
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
    <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH"> © {{ date('Y') }} S.O.A.H.  Sistema De Organización y Administración Hotelera . Todos los derechos reservados.</p>
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
            title: "¿Estás seguro de Eliminar este Empleado?",
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