@extends('adminlte::page')

@section('title', 'Habitaciones')

@section('content_header')
    <h1 class="m-0 text-dark">Administración de Habitaciones</h1>
@stop

@section('content')
<x-adminlte-card>
    @can('crear-habitaciones')
        <a class="btn btn-primary mb-3" href="{{ route('habitaciones.create') }}">
            <i class="fa fa-plus"></i> Nueva Habitación
        </a>
    @endcan

    <div class="card-body">
        @php
            // Agregado el encabezado "Tipo de Habitación"
            $heads = ['ID', 'Número', 'Tipo de Habitación', 'Información', 'Estado', 'Precio Noche', 'Precio Día', 'Acciones'];
            $config['language'] = ['url' => asset('vendor/datatables/es-CO.json')];
        @endphp

        <x-adminlte-datatable id="habitacionesTable" :heads="$heads" head-theme="dark"
            :config="$config" striped hoverable with-buttons>

            @foreach ($habitaciones as $habitacion)
                <tr>
                    <td>{{ $habitacion->id }}</td>
                    <td><strong>Nro: {{ $habitacion->numero }}</strong></td>

                    {{-- Mostrar nombre del tipo de habitación --}}
                    <td>
                        {{ $habitacion->tipo ? $habitacion->tipo->nombre : '—' }}
                    </td>

                    <td><strong>{{ $habitacion->informacion }}</strong></td>
                    
                    <td>
                        @if ($habitacion->estado == "disponible")
                            <h5><span class="badge badge-success">{{ $habitacion->estado }}</span></h5>
                        @elseif ($habitacion->estado == "ocupada")
                            <h5><span class="badge badge-danger">{{ $habitacion->estado }}</span></h5>
                        @elseif ($habitacion->estado == "reservada")
                            <h5><span class="badge badge-primary">{{ $habitacion->estado }}</span></h5>
                        @else
                            <h5><span class="badge badge-secondary">{{ $habitacion->estado }}</span></h5>
                        @endif
                    </td>

                    <td>${{ number_format($habitacion->precio_noche, 0, ',', '.') }}</td>
                    <td>
                        @if($habitacion->precio_dia !== null)
                            ${{ number_format($habitacion->precio_dia, 0, ',', '.') }}
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>

                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('habitaciones.show', $habitacion->id) }}">
                            <i class="far fa-eye fa-fw"></i>
                        </a>

                        @can('editar-habitaciones')
                        <a class="btn btn-success btn-sm" href="{{ route('habitaciones.edit', $habitacion->id) }}">
                            <i class="fas fa-pencil-alt fa-fw"></i>
                        </a>
                        @endcan

                        @can('borrar-habitaciones')
                        <form method="POST" action="{{ route('habitaciones.destroy', $habitacion->id) }}" 
                            style="display:inline;" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-warning btn-sm delete-button">
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
    <p><img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo Fralgom">
        © {{ date('Y') }} Fralgóm Ingeniería Informática. Todos los derechos reservados.
    </p>
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
                    title: "¿Eliminar habitación?",
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
