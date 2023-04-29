@extends('adminlte::page')

@section('title', 'Nuevo Préstamo')

@section('content_header')
<center>
    <h1 style="text-align: center;font-weight: bold; color: black;">REGISTRAR PAGO</h1>

    <th>
        <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</P>
    </th>

</center>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stop
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrar Pago') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('pagos.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="id_cliente" class="col-md-4 col-form-label text-md-right">{{ __('Cliente') }}</label>

                                <div class="col-md-6">
                                    <select id="id_cliente" class="form-control @error('id_cliente') is-invalid @enderror" name="id_cliente" required autocomplete="id_cliente" autofocus>
                                        <option value="">Seleccione un cliente</option>
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente->id }}" {{ old('id_cliente') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}</option>
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
                                <label for="monto" class="col-md-4 col-form-label text-md-right">{{ __('Monto del Préstamo') }}</label>

                                <div class="col-md-6">
                                    <input id="monto" type="text" class="form-control @error('monto') is-invalid @enderror" name="monto" readonly required autocomplete="monto">

                                    @error('monto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cuota" class="col-md-4 col-form-label text-md-right">{{ __('Cuota a Pagar') }}</label>

                                <div class="col-md-6">
                                    <input id="cuota" type="text" class="form-control @error('cuota') is-invalid @enderror" name="cuota" readonly required autocomplete="cuota">

                                    @error('cuota')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fecha_pago" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de Pago') }}</label>

                                <div class="col-md-6">
                                    <input id="fecha_pago" type="date" class="form-control @error('fecha_pago') is-invalid @enderror" name="fecha_pago" value="{{ old('fecha_pago') }}" required autocomplete="fecha_pago" autofocus>

                                    @error('fecha_pago')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>

                                <div class="col-md-6">
                                    <select id="estado" class="form-control @error('estado') is-invalid @enderror" name="estado" required>
                                        <option value="0" {{ old('estado') == 0 ? 'selected' : '' }}>PAGO EN FECHA</option>
                                        <option value="1" {{ old('estado') == 1 ? 'selected' : '' }}>PAGO CON RETRASO</option>
                                    </select>

                                    @error('estado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="numero_cuota" class="col-md-4 col-form-label text-md-right">{{ __('Número de Cuota') }}</label>

                                <div class="col-md-6">
                                    <input id="numero_cuota" type="number" class="form-control @error('numero_cuota') is-invalid @enderror" name="numero_cuota" value="{{ old('numero_cuota') }}" required readonly>

                                    @error('numero_cuota')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="monto" class="col-md-4 col-form-label text-md-right">{{ __('Monto a Pagar') }}</label>

                                <div class="col-md-6">
                                    <input id="monto" type="number" step="0.01" min="0.01" class="form-control @error('monto') is-invalid @enderror" name="monto" value="{{ old('monto') }}" required>

                                    @error('monto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Guardar Pago') }}
                                    </button>
                                </div>
                            </div>
    @stop


@section('css')

@stop

@section('js')
<script>
    $(document).ready(function() {
        // Obtener los elementos del formulario
        var clienteSelect = $('#id_cliente');
        var montoInput = $('#monto');
        var cuotaInput = $('#cuota');
        var numeroCuotaInput = $('#numero_cuota');

        // Agregar un evento de cambio al selector de cliente
        clienteSelect.change(function() {
            var clienteId = $(this).val(); // Obtener el ID del cliente seleccionado
            console.log(clienteId)
            // Hacer una solicitud AJAX al servidor
            $.ajax({
              /*   url: '/prestamos/' + clienteId, */ // Ruta para obtener el préstamo del cliente
                url: "{{ route('pagos.obtenerPorCliente', ':clienteId') }}".replace(':clienteId', clienteId),
                type: "GET",
                dataType: "json",
                success: function(response) {
                    console.log(response)
                    // Llenar los campos con los datos del préstamo
                    montoInput.val(response.prestamo[0].monto_prestamo);
                    cuotaInput.val(response.prestamo[0].calculo_cuota);
                    numeroCuotaInput.val(response.prestamo[0].cantidad_cuotas);
                },
                error: function(response) {
                    console.log(response); // Manejar errores
                }
            });
        });
    });
</script>

@stop


