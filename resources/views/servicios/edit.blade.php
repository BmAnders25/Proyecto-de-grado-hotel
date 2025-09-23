@extends('adminlte::page')

@section('title', 'MIILE')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Servicio</h1>
@stop

@section('content')
    <x-adminlte-card>
        <form method="POST" action="{{ route('servicios.update', $servicio->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <x-adminlte-input name="codigo" label="Código" placeholder="Código del servicio"
                    value="{{ old('codigo', $servicio->codigo) }}" fgroup-class="col-md-3" required />
                
                <x-adminlte-input name="nombre" label="Nombre" placeholder="Nombre del servicio"
                    value="{{ old('nombre', $servicio->nombre) }}" fgroup-class="col-md-5" required />
            </div>

            <div class="row">
                <x-adminlte-input name="categoria_id" label="Categoría"
                    value="{{ old('categoria_id', $servicio->categoria_id) }}" fgroup-class="col-md-4" min="1" required>
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-tags"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>

                <x-adminlte-input name="precio_entrada" label="Precio Entrada" placeholder="0.00" type="number"
                    step="0.01" value="{{ old('precio_entrada', $servicio->precio_entrada) }}"
                    fgroup-class="col-md-4" required />

                <x-adminlte-input name="precio_salida" label="Precio Salida" placeholder="0.00" type="number"
                    step="0.01" value="{{ old('precio_salida', $servicio->precio_salida) }}"
                    fgroup-class="col-md-4" required />
            </div>

            <div class="row">
                <x-adminlte-input name="unidades" label="Unidades" placeholder="Cantidad" type="number"
                    value="{{ old('unidades', $servicio->unidades) }}" fgroup-class="col-md-3" required />

                <x-adminlte-input name="stock" label="Stock" placeholder="Stock disponible" type="number"
                    value="{{ old('stock', $servicio->stock) }}" fgroup-class="col-md-3" required />

                <x-adminlte-select name="estado" label="Estado del servicio" fgroup-class="col-md-3">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-list"></i>
                        </div>
                    </x-slot>
                    <option value="Activo" {{ old('estado', $servicio->estado) === 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ old('estado', $servicio->estado) === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </x-adminlte-select>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <x-adminlte-button class="btn btn-success mr-2" type="submit" label="Guardar Cambios" theme="primary"
                        icon="fas fa-save" />
                    <a href="{{ route('servicios.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-undo"></i> Cancelar
                    </a>
                </div>
            </div>
        </form>
    </x-adminlte-card>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
@stop

@section('footer')
    <footer>
        <p><img src="{{ asset('vendor/adminlte/dist/img/fralgom-foot.png') }}" alt="Logo Fralgom"> © {{ date('Y') }} Fralgóm Ingeniería
            Informática. Todos los derechos reservados.</p>
    </footer>
@stop
