@extends('adminlte::page')

@section('title', 'Historial de Reservas')

@section('content_header')
    <h1 class="m-0 text-dark">Historial de Reservas</h1>
@stop

@section('content')
<x-adminlte-card>
    @can('crear-reservas')
        <a class="btn btn-primary mb-3" href="{{ route('reservas.create') }}">
            <i class="fa fa-plus"></i> Registrar Reserva
        </a>
    @endcan

    <div class="card-body">
        @php
            $heads = ['ID', 'Cliente', 'Habitación', 'Piso', 'Fecha Entrada', 'Fecha Salida', 'Personas', 'Precio Total', 'Estado', 'Acciones'];
            $config['language'] = ['url' => asset('vendor/datatables/es-CO.json')];
        @endphp

        <x-adminlte-datatable id="reservasTable" :heads="$heads" head-theme="dark" :config="$config" striped hoverable with-buttons>
            @foreach ($reservas as $reserva)
                @php
                    $estado = strtolower($reserva->estado);
                    $color = match($estado) {
                        'activa', 'confirmada', 'completada' => 'success',
                        'cancelada' => 'danger',
                        'pendiente' => 'warning',
                        default => 'secondary',
                    };
                @endphp

                <tr>
                    <td>{{ $reserva->id }}</td>
                    <td>{{ $reserva->cliente->nombre ?? 'Cliente eliminado' }}</td>
                    <td>{{ $reserva->habitacion->numero ?? 'Habitación eliminada' }}</td>
                    <td>{{ $reserva->piso->nombre ?? 'Piso eliminado' }}</td>
                    <td>{{ $reserva->fecha_entrada->format('d/m/Y H:i') }}</td>
                    <td>{{ $reserva->fecha_salida->format('d/m/Y H:i') }}</td>
                    <td>{{ $reserva->numero_personas }}</td>
                    <td>${{ number_format($reserva->precio_total, 0, ',', '.') }}</td>
                    <td><h5><span class="badge badge-{{ $color }}">{{ ucfirst($reserva->estado) }}</span></h5></td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('reservas.show', $reserva->id) }}">
                            <i class="far fa-eye fa-fw"></i>
                        </a>

                        @can('editar-reservas')
                            <a class="btn btn-success btn-sm" href="{{ route('reservas.edit', $reserva->id) }}">
                                <i class="fas fa-pencil-alt fa-fw"></i>
                            </a>
                        @endcan

                        @can('borrar-reservas')
                            <form method="POST" action="{{ route('reservas.destroy', $reserva->id) }}" style="display:inline;" class="delete-form">
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
    <p>
        <img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH">
        © {{ date('Y') }} S.O.A.H. Sistema De Organización y Administración Hotelera. Todos los derechos reservados.
    </p>
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
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                Swal.fire({
                    title: "¿Estás seguro de eliminar esta reserva?",
                    text: "¡No se podrá recuperar la información!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "¡Sí, eliminar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@stop