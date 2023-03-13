
@extends('adminlte::page')

@section('title', 'Nuevo Préstamo')

@section('content_header')
<center>
    <h1>NUEVO PRESTAMO</h1>
</center>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body">
                    <form action="{{ route('prestamos.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="monto_prestamo">Monto del Préstamo</label>
                            <input type="number" id="monto"name="monto_prestamo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="duracion_prestamo">Duración del Préstamo (en meses)</label>
                            <input type="number" id="duracion" name="duracion_prestamo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="calculo_cuota">Cálculo de Cuota</label>
                            <input type="number" id="calculo_cuota" name="calculo_cuota" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="garantia">Garantía</label>
                            <input type="text" id="garantia" name="garantia" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="cantidad_cuotas">Cantidad de Cuotas</label>
                            <input type="number" id="cantidad_cuotas" name="cantidad_cuotas" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="monto_cancelado">Monto Cancelado</label>
                            <input type="number"  id="monto_cancelar"name="monto_cancelado" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="monto_prestado">Monto Prestado</label>
                            <input type="number" id="monto_prestado" name="monto_prestado" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="id_cliente">Cliente</label>
                            <select name="id_cliente" class="form-control" required>
                                <option value="">Seleccione un cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre_cliente }}</option>
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
                                    <option value="{{ $interes->id }}">{{ $interes->interes_prestamo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_modo_pago">Modo de Pago</label>
                            <select name="id_modo_pago" class="form-control" required>
                                <option value="">Seleccione un modo de pago</option>
                                @foreach($modos_pago as $modo_pago)
                                    <option value="{{ $modo_pago->id }}">{{ $modo_pago->modalidad_pago }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>


</script>



@stop
