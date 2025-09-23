@extends('adminlte::page')

@section('title', 'Historial de Check-outs')

@section('content_header')
<h1 class="m-0 text-dark">Historial de Check-outs</h1>
@stop

@section('content')
<!-- Card con diseño limpio -->
<x-adminlte-card theme="primary" theme-mode="outline" class="shadow-lg rounded-lg">
    @can('crear-checkouts')
    <a class="btn btn-custom mb-3" href="{{ route('checkouts.create') }}" role="button">
        <i class="fa fa-plus"></i> Registrar Check-out
    </a>
    @endcan

    <div class="card-body p-4">
        @php
        $config['language'] = ['url' => asset('vendor/datatables/es-CO.json')];
        @endphp

        <x-adminlte-datatable id="table1" 
            :heads="['Id', 'Cliente', 'Habitación', 'Fecha Check-out', 'Total', 'Acciones']" 
            head-theme="dark" :config=$config striped hoverable with-buttons>

            @foreach ($checkouts as $checkout)
            <tr>
                <td>{{ $checkout->id }}</td>
                <td>{{ $checkout->reserva->cliente->nombre ?? 'Cliente eliminado' }}</td>
                <td>{{ $checkout->habitacion->numero ?? 'Habitación eliminada' }}</td>
                <td>{{ \Carbon\Carbon::parse($checkout->fecha_check_out)->format('d/m/Y H:i') }}</td>
                <td>${{ number_format($checkout->total, 2) }}</td>
                <td class="text-center">
                    @can('ver-checkouts')
                    <a class="btn btn-info btn-sm mb-1" href="{{ route('checkouts.show', $checkout->id) }}" role="button">
                        <i class="far fa-eye fa-fw"></i> Ver
                    </a>
                    @endcan

                    @can('editar-checkouts')
                    <a class="btn btn-success btn-sm mb-1" href="{{ route('checkouts.edit', $checkout->id) }}" role="button">
                        <i class="fas fa-pencil-alt fa-fw"></i> Editar
                    </a>
                    @endcan

                    @can('borrar-checkouts')
                    <form method="POST" action="{{ route('checkouts.destroy', $checkout->id) }}" style="display: inline;" class="delete-form">
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
    <p><img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo Fralgom" class="mb-2"> © {{ date('Y') }} S.O.AH. Todos los derechos reservados.</p>
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
            title: "¿Estás seguro de eliminar este check-out?",
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
    background-color: #3498db;
    color: white;
    padding: 12px 30px;
    border-radius: 30px;
    font-size: 16px;
    transition: background-color 0.3s;
}

.btn-custom:hover {
    background-color: #2980b9;
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

.badge-success {
    background-color: #28a745;
}

.badge-warning {
    background-color: #ffc107;
}

.badge-danger {
    background-color: #dc3545;
}

.badge-info {
    background-color: #17a2b8;
}

footer {
    background-color: #33a2b6a2;
    color: white;
    padding: 20px 0;
    border-top: 1px solid #ccc;
}
</style>
@stop
