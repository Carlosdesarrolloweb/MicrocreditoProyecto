@extends('adminlte::page')

@section('title', 'Obtener Monto de Cuota')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">NUEVO PRESTAMO</h1>

<th>
    <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</P>
</th>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <form method="POST" action="{{ route('pagos.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="cliente_id" class="col-md-4 col-form-label text-md-right">{{ __('Cliente') }}</label>
                            <div class="col-md-6">
                                <select name="cliente_id" id="cliente_id" class="form-control @error('cliente_id') is-invalid @enderror" required>
                                    <option value="">Seleccione un cliente</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}</option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <h2>Detalles del préstamo</h2>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="monto">Monto Total Del Prestamo:</label>
                                <input type="text" name="monto" id="monto" readonly class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="monto_cancelado">Tasa de interés:</label>
                                <input type="text" name="monto_cancelado" id="monto_cancelado" readonly class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="fecha_inicio">Fecha del Prestamo</label>
                                <input type="text" name="fecha_inicio" id="fecha_inicio" readonly class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="num_pagos">Número de pagos:</label>
                                <input type="text" name="num_pagos" id="num_pagos" readonly class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="cuota">cuota a pagar</label>
                                <input type="text" name="cuota" id="cuota" readonly class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="monto" class="col-md-4 col-form-label text-md-right">{{ __('Monto a pagar') }}</label>
                            <div class="col-md-6">
                                <input id="monto" type="number" step="0.01" class="form-control @error('monto') is-invalid @enderror" name="monto" value="{{ old('monto') }}" required>
                                @error('monto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                {{ __('Registrar Pago') }}
                                </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</div>

</div>
@stop

@section('js')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    //  $('#cliente_id').on('change', function () {
        $("#cliente_id").change(function(){
        //  var clienteId = $(this).val();
      var clienteId= document.getElementById('cliente_id').value
        console.log(clienteId);
        if (clienteId) {
            $.ajax({
                url: "{{ route('pagos.prestamos_by_cliente', ':clienteId') }}".replace(':clienteId', clienteId),
                type: "GET",
                dataType: "json",
                success: function (data) {
                    var prestamo = data.prestamos[0]; // asumiendo que solo hay un préstamo por cliente
                    console.log(data);
                    $('#monto').val(prestamo.monto_prestado);
                    $('#monto_cancelado').val(prestamo.monto_cancelado);
                    $('#fecha_inicio').val(prestamo.fecha_prestamo);
                    $('#num_pagos').val(prestamo.cantidad_cuotas);
                    $('#cuota').val(prestamo.calculo_cuota);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            });
        }
    });

    $('#prestamo_id').on('change', function () {
        var prestamoId = $(this).val();
        if (prestamoId) {
            $.ajax({
                url: "{{ route('prestamos.show', ':prestamoId') }}".replace(':prestamoId', prestamoId),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // Aquí se pueden agregar acciones cuando se recibe la respuesta exitosamente
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Aquí se pueden agregar acciones en caso de error
                }
            });
        }
    });
</script>
@stop
