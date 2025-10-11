@extends('adminlte::page')

@section('title', 'Historial de Check-ins')

@section('content_header')
<h1 class="m-0 text-dark">Historial de Check-ins</h1>
@stop

@section('content')
<!-- Card con diseño limpio -->
<x-adminlte-card theme="success" theme-mode="outline" class="shadow-lg rounded-lg">
    @can('crear-checkins')
    <a class="btn btn-custom mb-3" href="{{ route('checkins.create') }}" role="button">
        <i class="fa fa-plus"></i> Registrar Check-in
    </a>
    @endcan

    <div class="card-body p-4">
        @php
        $config['language'] = ['url' => asset('vendor/datatables/es-CO.json')];
        @endphp

        <x-adminlte-datatable id="table1"
            :heads="['Id', 'Cliente', 'Habitación', 'Empleado', 'Fecha Check-in', 'Acciones']"
            head-theme="dark" :config=$config striped hoverable with-buttons>

            @foreach ($checkins as $checkin)
            <tr>
                <td>{{ $checkin->id }}</td>
                <td>{{ $checkin->reserva->cliente->nombre ?? 'Cliente eliminado' }}</td>
                <td>{{ $checkin->habitacion->numero ?? 'Habitación eliminada' }}</td>
                <td>{{ $checkin->empleado->nombre ?? 'Empleado eliminado' }}</td>
                <td>{{ \Carbon\Carbon::parse($checkin->fecha_check_in)->format('d/m/Y H:i') }}</td>
                <td class="text-center">
                    @can('ver-checkins')
                    <a class="btn btn-info btn-sm mb-1" href="{{ route('checkins.show', $checkin->id) }}" role="button">
                        <i class="far fa-eye fa-fw"></i> Ver
                    </a>
                    @endcan

                    @can('editar-checkins')
                    <a class="btn btn-success btn-sm mb-1" href="{{ route('checkins.edit', $checkin->id) }}" role="button">
                        <i class="fas fa-pencil-alt fa-fw"></i> Editar
                    </a>
                    @endcan

                    @can('borrar-checkins')
                    <form method="POST" action="{{ route('checkins.destroy', $checkin->id) }}" style="display: inline;" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm mb-1 delete-button">
                            <i class="far fa-trash-alt fa-fw"></i> Eliminar
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
<footer class="text-center py-4">
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
            title: "¿Estás seguro de eliminar este check-in?",
            text: "¡No se podrá recuperar la información!",
            icon: "warning",
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

@section('css')
<style>
.card {
    background-color: #ffffff;
    color: #2c3e50;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.btn-custom {
    background-color: #27ae60;
    color: white;
    padding: 12px 30px;
    border-radius: 30px;
    font-size: 16px;
    transition: background-color 0.3s;
}

.btn-custom:hover {
    background-color: #1e8449;
}

.table th {
    background-color: #ecf0f1;
    color: #2c3e50;
    text-align: center;
    padding: 15px;
}

.table tbody tr:hover {
    background-color: #f4f6f7;
}

.table th, .table td {
    vertical-align: middle;
    padding: 12px;
    font-size: 14px;
    text-align: center;
}

.delete-button {
    background-color: #e74c3c;
    color: white;
    padding: 8px 12px;
    border-radius: 5px;
    font-size: 14px;
    border: none;
    transition: background-color 0.3s;
}

.delete-button:hover {
    background-color: #c0392b;
}

footer {
    background-color: #2ecc71a2;
    color: white;
    padding: 20px 0;
    border-top: 1px solid #ccc;
}
</style>
@stop
