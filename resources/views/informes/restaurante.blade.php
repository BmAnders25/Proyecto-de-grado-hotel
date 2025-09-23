@extends('adminlte::page')

@section('title', 'Toma y Liquidación de Pedido')

@section('content_header')
    <h1>Toma y Liquidación de Pedido</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form>
                <div class="form-group">
                    <label for="mesa">Número de Mesa</label>
                    <input type="text" class="form-control" id="mesa" name="mesa" placeholder="Número de Mesa">
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="text" class="form-control" id="fecha" name="fecha" placeholder="27/03/2019">
                </div>
                <div class="form-group">
                    <label for="pedido">Número de Pedido</label>
                    <input type="text" class="form-control" id="pedido" name="pedido" placeholder="24923">
                </div>
            </form>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Descripción del Producto</th>
                        <th>Unidades</th>
                        <th>Condiciones</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>H. MEGA TABLON</td>
                        <td>1</td>
                        <td>Normal</td>
                        <td>37,000</td>
                    </tr>
                    <tr>
                        <td>H. DOBLE TABLON</td>
                        <td>1</td>
                        <td>Normal</td>
                        <td>40,000</td>
                    </tr>
                    <tr>
                        <td>H. SUPER TABLON</td>
                        <td>1</td>
                        <td>Normal</td>
                        <td>50,000</td>
                    </tr>
                    <!-- Agrega más filas según sea necesario -->
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <button type="button" class="btn btn-primary">Grabar</button>
            <button type="button" class="btn btn-secondary">Buscar</button>
            <button type="button" class="btn btn-info">Generar Informe</button>
            <button type="button" class="btn btn-danger">Cerrar</button>
        </div>
        <div class="col-md-6 text-right">
            <p>Valor Adicional a Pagar: <strong>37,000</strong></p>
            <p>Efectivo: <strong>0</strong></p>
            <p>Cambio: <strong>-37,000</strong></p>
        </div>
    </div>
@stop.
