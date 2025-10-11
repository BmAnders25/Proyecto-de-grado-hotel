@extends('adminlte::page')

@section('title', 'Tipos de Habitaciones')

@section('content_header')
    <h1 class="m-0 text-dark">Administración de Tipos de Habitaciones</h1>
@stop

@section('content')
<x-adminlte-card>
    @can('crear-tipo-habitaciones')
        <a class="btn btn-primary mb-3" href="{{ route('tipo_habitaciones.create') }}">
            <i class="fa fa-plus"></i> Nuevo Tipo de Habitación
        </a>
    @endcan

    <div class="card-body">
        @php
            $heads = ['ID', 'Nombre', 'Descripción', 'Precio Base', 'Acciones'];
            $config['language'] = ['url' => asset('vendor/datatables/es-CO.json')];
        @endphp

        <x-adminlte-datatable id="tipoHabitacionesTable" :heads="$heads" head-theme="dark"
            :config="$config" striped hoverable with-buttons>

            @foreach ($tipos as $tipo)
                <tr>
                    <td>{{ $tipo->id }}</td>
                    <td><strong>{{ $tipo->nombre }}</strong></td>
                    <td>{{ $tipo->descripcion ?? '-' }}</td>
                    <td>${{ number_format($tipo->precio_base, 0, ',', '.') }}</td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('tipo_habitaciones.show', $tipo->id) }}">
                            <i class="far fa-eye fa-fw"></i>
                        </a>

                        @can('editar-tipo-habitaciones')
                        <a class="btn btn-success btn-sm" href="{{ route('tipo_habitaciones.edit', $tipo->id) }}">
                            <i class="fas fa-pencil-alt fa-fw"></i>
                        </a>
                        @endcan

                        @can('borrar-tipo-habitaciones')
                        <form method="POST" action="{{ route('tipo_habitaciones.destroy', $tipo->id) }}" 
                            style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm delete-button">
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
    {{-- Mensaje de éxito con SweetAlert --}}
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

    {{-- Confirmación al eliminar --}}
    <script>
        var deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var form = this.closest('form');
                Swal.fire({
                    title: "¿Eliminar tipo de habitación?",
                    text: "No podrás recuperar la información.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Sí, eliminar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            });
        });
    </script>
@stop
