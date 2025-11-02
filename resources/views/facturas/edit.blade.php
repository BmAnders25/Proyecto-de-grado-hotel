@extends('adminlte::page')

@section('title', 'Editar Factura')

@section('content_header') <h1>Editar Factura</h1>
@stop

@section('content')
@if ($errors->any()) <div class="alert alert-danger"> <ul>
@foreach ($errors->all() as $error) <li>{{ $error }}</li>
@endforeach </ul> </div>
@endif

@if (session('success')) <div class="alert alert-success">{{ session('success') }}</div>
@endif

<x-adminlte-card>
    <form method="POST" action="{{ route('facturas.update', $factura->id) }}">
        @csrf
        @method('PUT')

    <div class="row">
        <x-adminlte-select name="cliente_id" label="Cliente" fgroup-class="col-md-6" required>
            <x-slot name="prependSlot">
                <div class="input-group-text bg-gradient-info">
                    <i class="fas fa-user"></i>
                </div>
            </x-slot>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ $factura->cliente_id == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->nombre }}
                </option>
            @endforeach
        </x-adminlte-select>

        <x-adminlte-input name="fecha" type="date" label="Fecha" value="{{ $factura->fecha }}"
            fgroup-class="col-md-6" required />
    </div>

    <div class="row">
        <x-adminlte-input name="total" label="Total" type="number" step="0.01" placeholder="Total de la factura"
            value="{{ $factura->total }}" fgroup-class="col-md-6" />
    </div>

    <h4 class="mt-4 mb-2">Detalles de la Factura</h4>

    <table class="table table-bordered" id="detalles-table">
        <thead class="table-light">
            <tr>
                <th>Producto</th>
                <th width="150">Cantidad</th>
                <th width="180">Precio Unitario</th>
                <th width="50">Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($factura->detalles as $index => $detalle)
                <tr>
                    <td>
                        <select name="detalles[{{ $index }}][producto_id]" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}" {{ $detalle->producto_id == $producto->id ? 'selected' : '' }}>
                                    {{ $producto->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="detalles[{{ $index }}][cantidad]" class="form-control" min="0.01" step="0.01" value="{{ $detalle->cantidad }}"></td>
                    <td><input type="number" name="detalles[{{ $index }}][precio_unitario]" class="form-control" min="0" step="0.01" value="{{ $detalle->precio_unitario }}"></td>
                    <td class="text-center">
                        <button class="btn btn-danger btn-sm btn-delete-row"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach

            @if ($factura->detalles->isEmpty())
                <tr>
                    <td>
                        <select name="detalles[0][producto_id]" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="detalles[0][cantidad]" class="form-control" min="0.01" step="0.01" value=""></td>
                    <td><input type="number" name="detalles[0][precio_unitario]" class="form-control" min="0" step="0.01" value=""></td>
                    <td class="text-center">
                        <button class="btn btn-danger btn-sm btn-delete-row"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="text-end mb-3">
        <button id="add-detalle" class="btn btn-success"><i class="fas fa-plus"></i> Agregar Detalle</button>
    </div>

    <div class="mt-4">
        <x-adminlte-button class="btn btn-primary" type="submit" label="Actualizar Factura" icon="fas fa-save" />
        <a href="{{ route('facturas.index') }}" class="btn btn-secondary"><i class="fas fa-undo"></i> Cancelar</a>
    </div>
</form>


</x-adminlte-card>
@stop

@section('js')

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tableBody = document.querySelector('#detalles-table tbody');
    const addBtn = document.querySelector('#add-detalle');
    const form = document.querySelector('form');

    function reindexRows() {
        tableBody.querySelectorAll('tr').forEach((row, i) => {
            row.querySelectorAll('input, select').forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    const newName = name.replace(/\detalles\[\d+\]/, `detalles[${i}]`);
                    input.setAttribute('name', newName);
                }
            });
        });
    }

    addBtn.addEventListener('click', function (e) {
        e.preventDefault();
        const firstRow = tableBody.querySelector('tr');
        const newRow = firstRow.cloneNode(true);
        newRow.querySelectorAll('input').forEach(input => input.value = '');
        newRow.querySelectorAll('select').forEach(select => select.value = '');
        tableBody.appendChild(newRow);
        reindexRows();
    });

    tableBody.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-delete-row') || e.target.closest('.btn-delete-row')) {
            e.preventDefault();
            const row = e.target.closest('tr');
            if (tableBody.querySelectorAll('tr').length > 1) {
                row.remove();
                reindexRows();
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: 'Debe haber al menos un detalle en la factura.'
                });
            }
        }
    });

    form.addEventListener('submit', function (e) {
        let allEmpty = true;
        tableBody.querySelectorAll('tr').forEach(row => {
            const cantidad = row.querySelector('input[name*="[cantidad]"]').value;
            const precio = row.querySelector('input[name*="[precio_unitario]"]').value;
            const producto = row.querySelector('select[name*="[producto_id]"]').value;
            if (producto && cantidad && precio) allEmpty = false;
        });
        if (allEmpty) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos vacíos',
                text: 'Debes agregar al menos un detalle válido antes de guardar.'
            });
        }
    });
});
</script>

@stop
