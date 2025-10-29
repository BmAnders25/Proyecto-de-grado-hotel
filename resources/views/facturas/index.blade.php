@extends('adminlte::page')

@section('title', 'Facturas')

@section('content_header')

<h1 class="m-0 text-dark">Administración de Facturas</h1>
@stop

@section('content') <x-adminlte-card>
@can('crear-facturas') <a class="btn btn-primary mr-2" href="{{ route('facturas.create') }}" role="button"><i class="fa fa-plus"></i> Nueva factura</a>
@endcan


<div class="card-body">
    @php
    $heads = ['ID', 'Fecha', 'Número', 'Cliente', 'Habitación', 'Total', 'Acciones'];
    $config['language'] = ['url' => asset('vendor/datatables/es-CO.json')];
    @endphp

    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" :config="$config" striped hoverable with-buttons>
        @foreach ($facturas as $factura)
        <tr>
            <td>{{ $factura->id }}</td>
            <td>{{ optional($factura->fecha_emision)->format('d/m/Y H:i') ?? optional($factura->created_at)->format('d/m/Y') }}</td>
            <td><strong>{{ $factura->numero_factura }}</strong></td>
            <td>{{ optional($factura->cliente)->nombre ?? '—' }}</td>
            <td>{{ optional($factura->habitacion)->numero ?? optional($factura->habitacion)->nombre ?? '—' }}</td>
            <td class="text-right"><strong>${{ number_format($factura->total ?? 0, 2, ',', '.') }}</strong></td>
            <td>
                <a class="btn btn-info" href="{{ route('facturas.show', $factura->id) }}" role="button" title="Ver"><i class="far fa-eye fa-fw"></i></a>

                <a class="btn btn-secondary" href="{{ route('facturas.pdf', $factura->id) }}" role="button" title="Descargar PDF" target="_blank">
                    <i class="fas fa-file-pdf"></i>
                </a>

                @can('editar-facturas')
                <a class="btn btn-success" href="{{ route('facturas.edit', $factura->id) }}" role="button" title="Editar">
                    <i class="fas fa-pencil-alt fa-fw"></i></a>
                @endcan

                @can('borrar-facturas')
                <form method="POST" action="{{ route('facturas.destroy', $factura->id) }}" style="display:inline;" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-warning delete-button" title="Eliminar">
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
    <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH"> © {{ date('Y') }} S.O.A.H. Sistema De Organización y Administración Hotelera. Todos los derechos reservados.</p>
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
document.querySelectorAll('.delete-button').forEach(function(button) {
    button.addEventListener('click', function() {
        var form = this.parentElement;
        Swal.fire({
            title: "¿Estás seguro de eliminar esta factura?",
            text: "¡No se podrá recuperar la información!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Sí, eliminar"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>

@stop
