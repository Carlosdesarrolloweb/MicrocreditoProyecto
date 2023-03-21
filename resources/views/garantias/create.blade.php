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
    <h1>Crear Garantía</h1>
    <form method="POST" action="{{ route('garantias.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                 <label for="id_cliente" class="col-md-4 col-form-label text-md-right">{{ __('Cliente') }}</label>

                 <select name="id_cliente" id="id_cliente" class="form-control" required>
                    <option value="">Seleccione un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}.  . {{ $cliente->Carnet_cliente }}</option>
                    @endforeach
                </select>

                @error('id_cliente')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="id_prestamo" class="col-md-4 col-form-label text-md-right">{{ __('Préstamo') }}</label>
                <input id="id_prestamo" type="text" class="form-control @error('id_prestamo') is-invalid @enderror" name="id_prestamo" value="{{ $idPrestamo ?? null }}" required autocomplete="id_prestamo" readonly>
                @error('id_prestamo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="monto_prestamo" class="col-md-4 col-form-label text-md-right">{{ __('Monto del préstamo') }}</label>
                <input id="monto_prestamo" type="text" class="form-control @error('monto_prestamo') is-invalid @enderror" name="monto_prestamo" value="{{ $montoPrestamo ?? null }}" required autocomplete="monto_prestamo" readonly>
                @error('monto_prestamo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="garantia" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de la garantía') }}</label>
                    <input id="garantia" type="text" class="form-control @error('garantia') is-invalid @enderror" name="garantia" value="{{ old('garantia') }}" required autocomplete="garantia" autofocus>

                    @error('garantia')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                        <label for="Valor_Prenda" class="col-md-4 col-form-label text-md-right">{{ __('Valor de la prenda') }}</label>
                        <div class="col-md-6">
                            <input id="Valor_Prenda" type="text" class="form-control @error('Valor_Prenda') is-invalid @enderror" name="Valor_Prenda" value="{{ old('Valor_Prenda') }}" required autocomplete="Valor_Prenda" autofocus>

                            @error('Valor_Prenda')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                </div>
            </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Detalle_Prenda" class="col-md-4 col-form-label text-md-right">{{ __('Detalle de la prenda') }}</label>


                            <textarea id="Detalle_Prenda" class="form-control @error('Detalle_Prenda') is-invalid @enderror" name="Detalle_Prenda" required autocomplete="Detalle_Prenda">{{ old('Detalle_Prenda') }}</textarea>

                            @error('Detalle_Prenda')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="foto" class="col-md-4 col-form-label text-md-right">{{ __('Foto de la garantía') }}</label>


                            <input id="foto" type="file" class="form-control-file @error('foto') is-invalid @enderror" name="foto" required>

                            @error('foto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Guardar') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
    <script>
    $(document).ready(function () {
        $('#id_cliente').on('change', function () {
            var cliente_id = $(this).val();
            if (cliente_id) {
                $.ajax({
                    url: '/prestamos/detalles/' + cliente_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#id_prestamo').val(data.id);
                        $('#monto_prestamo').val(data.monto);
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });
    </script>

    @stop
