@extends('adminlte::page')

@section('title', 'Editar Inventario de Minibar')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Editar Inventario de Minibar</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('minibarinventario.update', $inventario->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Producto -->
                        <div class="mb-3">
                            <label for="producto_id" class="form-label">Producto</label>
                            <select class="form-select" id="producto_id" name="producto_id" required>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}"
                                        {{ $inventario->producto_id == $producto->id ? 'selected' : '' }}>
                                        {{ $producto->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Cantidad inicial -->
                        <div class="mb-3">
                            <label for="cantidad_inicial" class="form-label">Cantidad Inicial</label>
                            <input type="number" class="form-control" id="cantidad_inicial"
                                name="cantidad_inicial" value="{{ $inventario->cantidad_inicial }}" required>
                        </div>

                        <!-- Cantidad actual -->
                        <div class="mb-3">
                            <label for="cantidad_actual" class="form-label">Cantidad Actual</label>
                            <input type="number" class="form-control" id="cantidad_actual"
                                name="cantidad_actual" value="{{ $inventario->cantidad_actual }}" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('minibarinventario.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Volver
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection