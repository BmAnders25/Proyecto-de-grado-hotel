@extends('adminlte::page')

@section('title', 'Detalles Inventario')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <!-- Header -->
                <div class="card-header bg-gradient-primary text-white text-center rounded-top-4">
                    <h3 class="mb-0">
                        <i class="fas fa-box-open me-2"></i> Detalles del Inventario
                    </h3>
                </div>

                <!-- Body -->
                <div class="card-body p-4">
                    <!-- Producto -->
                    <div class="mb-4">
                        <label class="fw-bold text-secondary">
                            <i class="fas fa-tag me-2 text-success"></i> Producto:
                        </label>
                        <p class="fs-5 mb-0 text-dark">
                            {{ $inventario->producto->nombre }}
                        </p>
                    </div>

                    <!-- Cantidad Inicial -->
                    <div class="mb-4">
                        <label class="fw-bold text-secondary">
                            <i class="fas fa-cubes me-2 text-warning"></i> Cantidad Inicial:
                        </label>
                        <p class="fs-5 mb-0">
                            <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                {{ $inventario->cantidad_inicial }}
                            </span>
                        </p>
                    </div>

                    <!-- Cantidad Actual -->
                    <div class="mb-4">
                        <label class="fw-bold text-secondary">
                            <i class="fas fa-box me-2 text-danger"></i> Cantidad Actual:
                        </label>
                        <p class="fs-5 mb-0">
                            @if ($inventario->cantidad_actual > 0)
                                <span class="badge bg-success px-3 py-2 rounded-pill">
                                    {{ $inventario->cantidad_actual }}
                                </span>
                            @else
                                <span class="badge bg-danger px-3 py-2 rounded-pill">
                                    Agotado
                                </span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer bg-light text-center">
                    <a href="{{ route('minibarinventario.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                    <a href="{{ route('minibarinventario.edit', $inventario->id) }}" class="btn btn-warning text-white">
                        <i class="fas fa-edit"></i> Editar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
