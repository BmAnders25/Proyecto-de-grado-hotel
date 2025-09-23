@extends('adminlte::page')

@section('title', 'Inventario Minibar')

@section('content_header')
<h1 class="m-0 text-dark">Inventario del Minibar</h1>
@stop

@section('content')
<div class="container mt-5">
    <div class="row g-4">
        @foreach ($inventarios as $inventario)
        <div class="col-12 col-sm-6 col-md-4 d-flex">
            <div class="card shadow-lg border-0 rounded-4 w-100 h-100 d-flex flex-column mb-4">
                
                <!-- Header -->
                <div class="card-header bg-gradient-primary text-white text-center rounded-top-4">
                    <h5 class="mb-0">
                        <i class="fas fa-box-open me-2"></i> {{ $inventario->producto->nombre }}
                    </h5>
                </div>

                <!-- Body -->
                <div class="card-body flex-grow-1 d-flex flex-column justify-content-between">
                    <div>
                        <p class="mb-2"><strong>Precio:</strong>
                            <span class="badge bg-primary">${{ number_format($inventario->producto->precio, 0, ',', '.') }}</span>
                        </p>
                        <div class="mb-3 d-flex flex-wrap gap-2">
                            <span class="badge bg-success">Stock Inicial: {{ $inventario->cantidad_inicial }}</span>
                            @if($inventario->cantidad_actual > 0)
                                <span class="badge bg-warning text-dark">Stock Actual: {{ $inventario->cantidad_actual }}</span>
                            @else
                                <span class="badge bg-danger">Agotado</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-2 mt-3 flex-wrap">
                        <a class="btn btn-info btn-sm flex-grow-1" href="{{ route('minibarinventario.show', $inventario->id) }}">
                            <i class="far fa-eye"></i> Ver
                        </a>
                        @can('editar-minibar-inventario')
                        <a class="btn btn-warning btn-sm text-white flex-grow-1" href="{{ route('minibarinventario.edit', $inventario->id) }}">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        @endcan
                        @can('borrar-minibar-inventario')
                        <form method="POST" action="{{ route('minibarinventario.destroy', $inventario->id) }}" class="flex-grow-1">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm w-100 delete-button">
                                <i class="far fa-trash-alt"></i> Eliminar
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>

                <div class="card-footer text-muted text-center small">
                    Última actualización: {{ $inventario->updated_at->format('d/m/Y H:i') }}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-4">
        {{ $inventarios->links('pagination::bootstrap-4') }}
    </div>
</div>
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
        var form = this.closest('form');
        Swal.fire({
            title: "¿Estás seguro?",
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
        })
    });
});
</script>
@stop