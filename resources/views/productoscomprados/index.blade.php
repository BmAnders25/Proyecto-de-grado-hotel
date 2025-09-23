@extends('adminlte::page')

@section('title', 'Productos Comprados')

@section('content_header')
<h1 class="m-0 text-dark">Historial de Productos Comprados</h1>
@stop

@section('content')
<x-adminlte-card>
    @can('crear-productos-comprados')
    <a class="btn btn-primary mr-2" href="{{ route('productoscomprados.create') }}" role="button"><i class="fa fa-plus"></i> Registrar Compra</a>
    @endcan

    <div class="card-body">
        @php
        $config['language'] = ['url' => asset('vendor/datatables/es-CO.json')];
        @endphp
        <x-adminlte-datatable id="table1" 
            :heads="['Id', 'Producto', 'Empleado', 'Unidades', 'Precio', 'Total', 'Fecha Compra', 'Acciones']" 
            head-theme="dark"
            :config="$config" striped hoverable with-buttons>
            @foreach ($compras as $compra)
            <tr>
                <td>{{ $compra->id }}</td>
                <td>{{ $compra->producto->nombre ?? 'Producto eliminado' }}</td>
                <td>{{ $compra->empleado->nombre ?? 'No Registrado' }}</td>
                <td>{{ $compra->unidades }}</td>
                <td>${{ number_format($compra->precio, 2) }}</td>
                <td>${{ number_format($compra->total, 2) }}</td>
                <td>{{$compra->fecha_compra->format('d/m/Y H:i') }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('productoscomprados.show', $compra->id) }}" role="button">
                        <i class="far fa-eye fa-fw"></i>
                    </a>

                    @can('editar-productos-comprados')
                    <a class="btn btn-success" href="{{ route('productoscomprados.edit', $compra->id) }}" role="button">
                        <i class="fas fa-pencil-alt fa-fw"></i>
                    </a>
                    @endcan

                    @can('borrar-productos-comprados')
                    <form method="POST" action="{{ route('productoscomprados.destroy', $compra->id) }}" style="display: inline;" class="delete-form">
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
    <p><img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo Fralgom"> © {{ date('Y') }} S.O.A.H. Todos los derechos reservados.</p>
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
            title: "¿Estás seguro de eliminar esta compra?",
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
