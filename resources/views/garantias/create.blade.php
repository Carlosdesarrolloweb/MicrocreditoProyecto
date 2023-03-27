
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
     <h1>REGISTRAR GARANTIA</h1>


</center>

@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <form method="POST" action="{{ route('garantias.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="garantia" class="col-md-4 col-form-label text-md-right">{{ __('Garantía') }}</label>
                                     <input id="garantia" type="text" class="form-control @error('garantia') is-invalid @enderror" name="garantia" value="{{ old('garantia') }}" required autocomplete="garantia" autofocus>
                                    @error('garantia')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                     <label for="Valor_Prenda" class="col-md-4 col-form-label text-md-right">{{ __('Valor Prenda') }}</label>
                                    <input id="Valor_Prenda" type="text" class="form-control @error('Valor_Prenda') is-invalid @enderror" name="Valor_Prenda" value="{{ old('Valor_Prenda') }}" required autocomplete="Valor_Prenda">
                                    @error('Valor_Prenda')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Detalle_Prenda" class="col-md-4 col-form-label text-md-center">{{ __('Detalle Prenda') }}</label>
                                    {{-- <x-jet-label for="Detalle_Prenda" value="{{ __('Detalle Prenda') }}" /> --}}
                                    <x-jet-input maxlength="20" id="Detalle_Prenda" class="form-control" type="text" name="Detalle_Prenda" :value="old('Detalle_Prenda')" required autofocus autocomplete="Detalle_Prenda" />
                                    <x-jet-input-error for="Detalle_Prenda" class="mt-2 text-danger" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cliente_id" class="col-md-4 col-form-label text-md-right">{{ __('Cliente') }}</label>
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

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_prestamo">Prestamo</label>
                                    <input type="text" name="id_prestamo" id="id_prestamo" readonly class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_entrega" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de Entrega') }}</label>
                                    <input id="fecha_entrega" type="date" class="form-control @error('fecha_entrega') is-invalid @enderror" name="fecha_entrega" value="{{ old('fecha_entrega') }}" required autocomplete="fecha_entrega">

                                    @error('fecha_entrega')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('Estado') }}</label>
                                    <select id="estado" class="form-control @error('estado') is-invalid @enderror" name="estado" required>
                                        <option value="">Seleccione el estado de la garantía</option>
                                        <option value="En Trámite">ARTICULO NUEVO</option>
                                        <option value="Entregada">ARTICULO USADO</option>
                                    </select>

                                    @error('estado')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_foto" class="col-md-4 col-form-label text-md-right">{{ __('Imagen de la Prenda') }}</label>
                                    <input id="id_foto" type="file" class="form-control @error('id_foto') is-invalid @enderror" name="id_foto" required>

                                    @error('imagen')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <p>
                            <p></p>
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">

                                    <button type="submit" class="btn btn-success">
                                        {{ __('Crear Garantía') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <script>
        $("#cliente_id").change(function(){
      var clienteId= document.getElementById('cliente_id').value
        console.log(clienteId);
        if (clienteId) {
            $.ajax({
                url: "{{ route('garantias.prestamos_by_cliente', ':clienteId') }}".replace(':clienteId', clienteId),
                type: "GET",
                dataType: "json",
                success: function (data) {
                    var prestamo = data.prestamos[0]; // asumiendo que solo hay un préstamo por cliente
                    console.log(data);
                    $('#id_prestamo').val(prestamo.monto_prestado);
                    // $('#monto_cancelado').val(prestamo.monto_cancelado);
                    // $('#fecha_inicio').val(prestamo.fecha_prestamo);
                    // $('#num_pagos').val(prestamo.cantidad_cuotas);
                    // $('#cuota').val(prestamo.calculo_cuota);
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
