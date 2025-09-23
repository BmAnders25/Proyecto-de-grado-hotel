@extends('adminlte::page')

@section('title', 'Productos Vendidos')

@section('content_header')
<h1 class="m-0 text-dark">Historial de Productos Vendidos</h1>
@stop

@section('content')
<x-adminlte-card>
    @can('crear-productos-vendidos')
    <a class="btn btn-primary mr-2" href="{{ route('productosvendidos.create') }}" role="button"><i class="fa fa-plus"></i> Registrar Venta</a>
    @endcan

    <div class="card-body">
        @php
        $config['language'] = ['url' => asset('vendor/datatables/es-CO.json')];
        @endphp
        <x-adminlte-datatable id="table1" :heads="['Id', 'Producto','Cliente','Empleado', 'Habitación','Unidades','Precio','Total','Fecha','Acciones']" head-theme="dark"
            :config=$config striped hoverable with-buttons>
            @foreach ($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->producto->nombre ?? 'Producto eliminado' }}</td>
                <td>{{ $venta->cliente->nombre ?? 'Cliente eliminado' }}</td>
                <td>{{ $venta->empleado->nombre ?? 'No Registrado' }}</td>
                <td>{{ $venta->habitacion->numero ?? 'No asignada' }}</td> 
                <td>{{ $venta->unidades }}</td>
                <td>${{ number_format($venta->precio, 2) }}</td>
                <td>${{ number_format($venta->total, 2) }}</td>
                <td>{{ $venta->fecha_venta->format('d/m/Y H:i') }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('productosvendidos.show', $venta->id) }}" role="button">
                        <i class="far fa-eye fa-fw"></i></a>

                    @can('editar-productos-vendidos')
                    <a class="btn btn-success" href="{{ route('productosvendidos.edit', $venta->id) }}" role="button">
                        <i class="fas fa-pencil-alt fa-fw"></i></a>
                    @endcan
                    
                    @can('borrar-productos-vendidos')
                    <form method="POST" action="{{ route('productosvendidos.destroy', $venta->id) }}" style="display: inline;" class="delete-form">
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
    <p><img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo Fralgom"> © {{ date('Y') }} S.O.AH
        . Todos los derechos reservados.</p>
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
            title: "¿Estás seguro de eliminar esta venta?",
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
