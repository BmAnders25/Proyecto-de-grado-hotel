@extends('adminlte::page')

@section('title', 'MIILE')

@section('content_header')
    <h1 class="m-0 text-dark">Detalle del Servicio</h1>
@stop

@section('content')
    <x-adminlte-card>
    <div class="row">
        <div class="col-md-6">
            <x-adminlte-info-box title="Código" text="{{ $servicio->codigo }}" icon="fas fa-barcode" theme="info" />
        </div>
        <div class="col-md-6">
            <x-adminlte-info-box title="Nombre" text="{{ $servicio->nombre }}" icon="fas fa-tag" theme="info" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <x-adminlte-info-box title="Categoría ID" text="{{ $servicio->categoria_id }}" icon="fas fa-tags" theme="info" />
        </div>
        <div class="col-md-6">
            <x-adminlte-info-box title="Precio Entrada" text="${{ number_format($servicio->precio_entrada, 2) }}" icon="fas fa-dollar-sign" theme="info" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <x-adminlte-info-box title="Precio Salida" text="${{ number_format($servicio->precio_salida, 2) }}" icon="fas fa-dollar-sign" theme="info" />
        </div>
        <div class="col-md-6">
            <x-adminlte-info-box title="Unidades" text="{{ $servicio->unidades }}" icon="fas fa-boxes" theme="info" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <x-adminlte-info-box title="Stock" text="{{ $servicio->stock }}" icon="fas fa-warehouse" theme="info" />
        </div>
        <div class="col-md-6">
    <x-adminlte-info-box
        title="Estado"
        text="{{ $servicio->estado }}"
        :icon="$servicio->estado === 'Activo' ? 'fas fa-check-circle' : 'fas fa-times-circle'"
        :theme="$servicio->estado === 'Activo' ? 'success' : 'danger'" />
</div>

    <div class="row">
        <div class="form-group col-md-6">
            <a class="btn btn-secondary" href="{{ route('servicios.index') }}"><i class="fas fa-undo"></i> Regresar</a>
        </div>
    </div>
</x-adminlte-card>
@stop

@section('footer')
    <footer>
        <p><img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo Fralgom"> © {{ date('Y') }}
            Fralgóm Ingeniería Informática. Todos los derechos reservados.</p>
    </footer>
@stop

