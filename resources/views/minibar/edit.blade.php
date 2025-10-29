@extends('adminlte::page')

@section('title', 'Editar Minibar')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Editar Minibar - Habitación {{ $habitacion->numero }}</h4>
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

                    <form action="{{ route('minibar.update', $habitacion->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div id="productos-container">
                            @foreach ($productos as $producto)
                                @php
                                    $pivot = $habitacion->productos->firstWhere('id', $producto->id)?->pivot;
                                @endphp
                                <div class="border rounded p-3 mb-3">
                                    <h5>{{ $producto->nombre }}</h5>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <label>Cantidad Inicial</label>
                                            <input type="number" name="productos[{{ $loop->index }}][cantidad_inicial]"
                                                   value="{{ $pivot->cantidad_inicial ?? 0 }}" min="0" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label>Cantidad Actual</label>
                                            <input type="number" name="productos[{{ $loop->index }}][cantidad_actual]"
                                                   value="{{ $pivot->cantidad_actual ?? 0 }}" min="0" class="form-control">
                                        </div>
                                    </div>
                                    <input type="hidden" name="productos[{{ $loop->index }}][id]" value="{{ $producto->id }}">
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('minibar.index') }}" class="btn btn-secondary">
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
