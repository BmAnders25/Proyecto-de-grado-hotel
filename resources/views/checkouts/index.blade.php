@extends('adminlte::page')

@section('title', 'Historial de Check-outs')

@section('content_header')

<h1 class="m-0 text-dark">Historial de Check-outs</h1>
@stop

@section('content') <x-adminlte-card>
@can('crear-checkouts') <a class="btn btn-primary mr-2" href="{{ route('checkouts.create') }}" role="button"> <i class="fa fa-plus"></i> Registrar Check-out </a>
@endcan

<div class="card-body">
    @php
    $config['language'] = ['url' => asset('vendor/datatables/es-CO.json')];
    @endphp

    <x-adminlte-datatable id="table1" :heads="['Id', 'Cliente', 'Habitación', 'Fecha Check-out', 'Total', 'Acciones']"
        head-theme="dark" :config=$config striped hoverable with-buttons>
        
        @foreach ($checkouts as $checkout)
        <tr>
            <td>{{ $checkout->id }}</td>
            <td>{{ $checkout->reserva->cliente->nombre ?? 'Cliente eliminado' }}</td>
            <td>{{ $checkout->habitacion->numero ?? 'Habitación eliminada' }}</td>
            <td>{{ \Carbon\Carbon::parse($checkout->fecha_check_out)->format('d/m/Y H:i') }}</td>
            <td>${{ number_format($checkout->total, 2) }}</td>
            <td>
                @can('ver-checkouts')
                <a class="btn btn-info" href="{{ route('checkouts.show', $checkout->id) }}" role="button">
                    <i class="far fa-eye fa-fw"></i>
                </a>
                @endcan

                @can('editar-checkouts')
                <a class="btn btn-success" href="{{ route('checkouts.edit', $checkout->id) }}" role="button">
                    <i class="fas fa-pencil-alt fa-fw"></i>
                </a>
                @endcan

                @can('borrar-checkouts')
                <form method="POST" action="{{ route('checkouts.destroy', $checkout->id) }}"
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
document.querySelectorAll('.delete-button').forEach(button => {
    button.addEventListener('click', function() {
        const form = this.parentElement;
        Swal.fire({
            title: "¿Estás seguro de eliminar este check-out?",
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
