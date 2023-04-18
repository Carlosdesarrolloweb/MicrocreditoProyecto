{{-- @extends('adminlte::page')

@section('title', 'Obtener Monto de Cuota')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">NUEVO PRESTAMO</h1>

<th>
    <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }}</P>
</th>
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
                            <label for="cliente_id" class="col-md-4 col-form-label text-md-right">{{ __('Cliente') }}</label>

                            <div class="col-md-6">
                                <select id="cliente_id" name="cliente_id" class="form-control @error('cliente_id') is-invalid @enderror" required>
                                    <option value="" disabled selected>--Seleccione un cliente--</option>
                                    @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre_cliente }} {{ $cliente->apellido_cliente }}</option>
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
                            <label for="monto" class="col-md-4 col-form-label text-md-right">{{ __('Monto') }}</label>

                            <div class="col-md-6">
                                <input id="monto" type="number" class="form-control @error('monto') is-invalid @enderror" name="monto" value="{{ old('monto') }}" required autocomplete="monto">

                                @error('monto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fecha" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>

                            <div class="col-md-6">
                                <input id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror" name="fecha" value="{{ old('fecha') }}" required autocomplete="fecha">

                                @error('fecha')
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
        </div>
    </div>
</div>
@stop



@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#cliente_id").change(function(){
                var clienteId = $(this).val();
                $.ajax({
                    url: "{{ route('cliente.prestamo') }}",
                    type: "GET",
                    data: {cliente_id: clienteId},
                    success: function(respuesta){
                        $("#proyecto_id").empty();
                        $.each(respuesta,function(id,proyecto){
                            $("#proyecto_id").append('<option value="'+id+'">'+proyecto+'</option>');
                        });
                    },
                    error: function() {
                        console.log('Ha ocurrido un error.');
                    }
                });
            });
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
 --}}
