<!-- Archivo: resources/views/loans/create.blade.php -->
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    {{-- <h1>REGISTRAR GARANTIA</h1> --}}


</center>

@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Crear Garantía') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('garantias.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="garantia" class="col-md-4 col-form-label text-md-right">{{ __('Garantía') }}</label>

                            <div class="col-md-6">
                                <input id="garantia" type="text" class="form-control @error('garantia') is-invalid @enderror" name="garantia" value="{{ old('garantia') }}" required autocomplete="garantia" autofocus>

                                @error('garantia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Valor_Prenda" class="col-md-4 col-form-label text-md-right">{{ __('Valor Prenda') }}</label>

                            <div class="col-md-6">
                                <input id="Valor_Prenda" type="text" class="form-control @error('Valor_Prenda') is-invalid @enderror" name="Valor_Prenda" value="{{ old('Valor_Prenda') }}" required autocomplete="Valor_Prenda">

                                @error('Valor_Prenda')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Detalle_Prenda" class="col-md-4 col-form-label text-md-right">{{ __('Detalle Prenda') }}</label>

                            <div class="col-md-6">
                                <textarea id="Detalle_Prenda" class="form-control @error('Detalle_Prenda') is-invalid @enderror" name="Detalle_Prenda" required>{{ old('Detalle_Prenda') }}</textarea>

                                @error('Detalle_Prenda')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="id_cliente">Cliente</label>
                            <select name="id_cliente" class="form-control" required>
                                <option value="">Seleccione un cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}.  . {{ $cliente->Carnet_cliente }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fecha_entrega" class="col-md-4 col-form-label text-md-right">{{ __('Fecha de Entrega') }}</label>

                        <div class="col-md-6">
                            <input id="fecha_entrega" type="date" class="form-control @error('fecha_entrega') is-invalid @enderror" name="fecha_entrega" value="{{ old('fecha_entrega') }}" required autocomplete="fecha_entrega">

                            @error('fecha_entrega')
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

                    <div class="form-group row">
                        <label for="imagen" class="col-md-4 col-form-label text-md-right">{{ __('Imagen de la Prenda') }}</label>

                        <div class="col-md-6">
                            <input id="imagen" type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen" required>

                            @error('imagen')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Crear Garantía') }}
                            </button>
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
    <script src="{{ asset('vendor/components/jquery/jquery.min.js') }}"></script>
 <script>
   $(document).ready(function() {
    // Obtener los selects de préstamos y clientes
    var prestamoSelect = $('#id_prestamo');
    var clienteSelect = $('#id_cliente');

    // Al cambiar el select de clientes
    clienteSelect.on('change', function() {
        // Obtener el id del cliente seleccionado
        var clienteId = $(this).val();

        // Si no se seleccionó ningún cliente, deshabilitar y limpiar el select de préstamos
        if (!clienteId) {
            prestamoSelect.prop('disabled', true);
            prestamoSelect.empty();
            prestamoSelect.append($('<option/>', {
                value: '',
                text: '-- Seleccionar préstamo --'
            }));
            return;
        }

        // Hacer una petición AJAX para obtener los préstamos del cliente seleccionado
        $.ajax({
            url: '/prestamos/' + clienteId + '/cliente',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Limpiar el select de préstamos y agregar opción por defecto
                prestamoSelect.empty();
                prestamoSelect.append($('<option/>', {
                    value: '',
                    text: '-- Seleccionar préstamo --'
                }));

                // Agregar las opciones de préstamos correspondientes al cliente seleccionado
                $.each(response, function(i, prestamo) {
                    prestamoSelect.append($('<option>', {
                        value: prestamo.id,
                        text: 'Préstamo #' + prestamo.id + ' - ' + prestamo.created_at
                    }));
                });

                // Habilitar el select de préstamos
                prestamoSelect.prop('disabled', false);
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log('Error al obtener los préstamos: ' + errorThrown);
            }
        });
    });

    // Agregar una nueva opción al select de préstamos al hacer click en el botón "Agregar"
    $('#agregar_prestamo').on('click', function() {
        var option = $('<option>', {
            value: 'nuevaopcion',
            text: 'Nueva opción'
        });
        prestamoSelect.append(option);
    });
});
 </script>

    @stop
