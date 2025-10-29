@extends('adminlte::page')

@section('title', 'Detalles del Minibar')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-gradient-primary text-white text-center rounded-top-4">
                    <h3 class="mb-0">
                        <i class="fas fa-glass-cheers me-2"></i> Minibar - Habitación {{ $habitacion->numero }}
                    </h3>
                </div>

            <div class="card-body">
                @if ($habitacion->productos->isEmpty())
                    <div class="alert alert-secondary text-center">
                        <i class="fas fa-info-circle"></i> Esta habitación no tiene productos asignados.
                    </div>
                @else
                    <div class="row">
                        @foreach ($habitacion->productos as $producto)
                        <div class="col-md-6 mb-4">
                            <div class="border rounded p-3 shadow-sm position-relative">
                                <h5 class="text-primary mb-2">
                                    <i class="fas fa-box"></i> {{ $producto->nombre }}
                                </h5>
                                <p><strong>Precio:</strong> ${{ number_format($producto->precio, 0, ',', '.') }}</p>
                                <p><strong>Inicial:</strong> {{ $producto->pivot->cantidad_inicial }}</p>
                                <p><strong>Actual:</strong>
                                    @if ($producto->pivot->cantidad_actual > 0)
                                        <span class="badge bg-success">{{ $producto->pivot->cantidad_actual }}</span>
                                    @else
                                        <span class="badge bg-danger">Agotado</span>
                                    @endif
                                </p>

                                <form action="{{ route('minibar.habitacion.destroy', ['habitacion' => $habitacion->id, 'producto' => $producto->id]) }}" 
                                method="POST"                               
                                class="form-eliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="card-footer bg-light text-center">
                <a href="{{ route('minibar.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <a href="{{ route('minibar.edit', $habitacion->id) }}" class="btn btn-warning text-white">
                    <i class="fas fa-edit"></i> Editar
                </a>
            </div>
        </div>
    </div>
</div>


</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Detectar todos los formularios de eliminación
    const forms = document.querySelectorAll('.form-eliminar');

    forms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Evita el envío inmediato

            Swal.fire({
                title: '¿Eliminar producto?',
                text: "Este producto será removido del minibar de la habitación.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Envía el formulario si confirma
                }
            });
        });
    });
});
</script>
