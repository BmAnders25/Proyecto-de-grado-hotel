@extends('adminlte::page')

@section('title', 'Historial de Check-ins')

@section('content_header')

<h1 class="m-0 text-dark">Historial de Check-ins</h1>
@stop

@section('content') <x-adminlte-card>
@can('crear-checkins') <a class="btn btn-primary mr-2" href="{{ route('checkins.create') }}" role="button"> <i class="fa fa-plus"></i> Registrar Check-in </a>
@endcan


<div class="card-body">
    @php
    $config['language'] = ['url' => asset('vendor/datatables/es-CO.json')];
    @endphp

    <x-adminlte-datatable id="table1" :heads="['Id', 'Cliente', 'Habitación', 'Empleado', 'Fecha Check-in', 'Acciones']"
        head-theme="dark" :config=$config striped hoverable with-buttons>
        
        @foreach ($checkins as $checkin)
        <tr>
            <td>{{ $checkin->id }}</td>
            <td>{{ $checkin->reserva->cliente->nombre ?? 'Cliente eliminado' }}</td>
            <td>{{ $checkin->habitacion->numero ?? 'Habitación eliminada' }}</td>
            <td>{{ $checkin->empleado->nombre ?? 'Empleado eliminado' }}</td>
            <td>{{ \Carbon\Carbon::parse($checkin->fecha_check_in)->format('d/m/Y H:i') }}</td>
            <td>
                @can('ver-checkins')
                <a class="btn btn-info" href="{{ route('checkins.show', $checkin->id) }}" role="button">
                    <i class="far fa-eye fa-fw"></i>
                </a>
                @endcan

                @can('editar-checkins')
                <a class="btn btn-success" href="{{ route('checkins.edit', $checkin->id) }}" role="button">
                    <i class="fas fa-pencil-alt fa-fw"></i>
                </a>
                @endcan

                @can('borrar-checkins')
                <form method="POST" action="{{ route('checkins.destroy', $checkin->id) }}"
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
```

</x-adminlte-card>
@stop

@section('footer')

<footer>
    <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.A.H"> 
    © {{ date('Y') }} S.O.A.H.  Sistema De Organización y Administración Hotelera. Todos los derechos reservados.</p>
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
            title: "¿Estás seguro de eliminar este check-in?",
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
