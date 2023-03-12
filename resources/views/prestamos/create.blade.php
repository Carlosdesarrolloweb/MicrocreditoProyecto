@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    <h1>REGISTRAR NUEVO PRESTAMO</h1>
</center>
@stop

@extends('adminlte::page')

@section('title', 'Nuevo Préstamo')

@section('content_header')
    <h1>Nuevo Préstamo</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <form action="{{ route('prestamos.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="monto_prestamo">Monto del Préstamo</label>
                            <input type="number" name="monto_prestamo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="duracion_prestamo">Duración del Préstamo (en meses)</label>
                            <input type="number" name="duracion_prestamo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="calculo_cuota">Cálculo de Cuota</label>
                            <input type="number" name="calculo_cuota" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="garantia">Garantía</label>
                            <input type="text" name="garantia" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cantidad_cuotas">Cantidad de Cuotas</label>
                            <input type="number" name="cantidad_cuotas" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="monto_cancelado">Monto Cancelado</label>
                            <input type="number" name="monto_cancelado" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="monto_prestado">Monto Prestado</label>
                            <input type="number" name="monto_prestado" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="id_cliente">Cliente</label>
                            <select name="id_cliente" class="form-control" required>
                                <option value="">Seleccione un cliente</option>
                                @foreach($clientes as $clientesv)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_usuario">Usuario que otorga el préstamo</label>
                            <select name="id_usuario" class="form-control" required>
                                <option value="">Seleccione un usuario</option>
                                @foreach($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_interes">Tipo de Interés</label>
                            <select name="id_interes" class="form-control" required>
                                <option value="">Seleccione un tipo de interés</option>
                                @foreach($intereses as $interes)
                                    <option value="{{ $interes->id }}">{{ $interes->tipo_interes }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_modo_pago">Modo de Pago</label>
                            <select name="id_modo_pago" class="form-control" required>
                                <option value="">Seleccione un modo de pago</option>
                                @foreach($modos_pago as $modo_pago)
                                    <option value="{{ $modo_pago->id }}">{{ $modo_pago->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script> console.log('Hi!'); </script> -->
@stop
