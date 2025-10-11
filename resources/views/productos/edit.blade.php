@extends('adminlte::page')

@section('title', 'MIILE')

@section('content_header')
    <h1 class="m-0 text-dark">Editar Producto</h1>
@stop

@section('content')
    <x-adminlte-card>
        <form method="POST" action="{{ route('productos.update', $producto->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <x-adminlte-input name="producto_id" label="Id Producto" placeholder="Id del producto"
                    value="{{ old('producto_id', $producto->producto_id) }}" fgroup-class="col-md-2" required />
                
                <x-adminlte-input name="nombre" label="Nombre" placeholder="Nombre del producto"
                    value="{{ old('nombre', $producto->nombre) }}" fgroup-class="col-md-4" required />
            </div>

            <div class="row">

                <x-adminlte-input name="precio" label="Precio" placeholder="0.00" type="number"
                    step="0.01" value="{{ old('precio', $producto->precio) }}"
                    fgroup-class="col-md-3" required />

                <x-adminlte-input name="unidades" label="Unidades" placeholder="Cantidad" type="number"
                    value="{{ old('unidades', $producto->unidades) }}" fgroup-class="col-md-3" required />

                
            </div>

            <div class="row">
            

                <x-adminlte-input name="stock" label="Stock" placeholder="Stock disponible" type="number"
                    value="{{ old('stock', $producto->stock) }}" fgroup-class="col-md-3" required />

                <x-adminlte-select name="estado" label="Estado del Producto" fgroup-class="col-md-3">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-list"></i>
                        </div>
                    </x-slot>
                    <option value="Activo" {{ old('estado', $producto->estado) === 'Activo' ? 'selected' : '' }}>Activo</option>
                    <option value="Inactivo" {{ old('estado', $producto->estado) === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                </x-adminlte-select>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <x-adminlte-button class="btn btn-success mr-2" type="submit" label="Guardar Cambios" theme="primary"
                        icon="fas fa-save" />
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary mr-2">
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
       <p><img src="{{ asset('vendor/adminlte/dist/img/logo.png') }}" width="4%" style="border-radius: 15px" alt="Logo S.O.AH"> © {{ date('Y') }} S.O.A.H.  Sistema De Organización y Administración Hotelera . Todos los derechos reservados.</p>
    </footer>
@stop
