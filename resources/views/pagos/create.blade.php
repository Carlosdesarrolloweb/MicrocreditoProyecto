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
                        <form id="pagoForm" method="POST" action="{{ route('pagos.store')}}">
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

                                    @error('id_cliente')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <input id="id_prestamo" type="hidden" name="id_prestamo"/>


                            <div class="form-group row">
                                <label for="monto_prestamo" class="col-md-4 col-form-label text-md-right">{{ __('Monto del Préstamo') }}</label>

                                <div class="col-md-6">
                                    <input id="monto_prestamo" type="text" class="form-control @error('monto_prestamo') is-invalid @enderror" name="monto_prestamo" readonly required autocomplete="monto_prestamo">

                                    @error('monto_prestamo')
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
                                <label for="Numero_Cuota" class="col-md-4 col-form-label text-md-right">{{ __('Número de Cuota') }}</label>

                                <div class="col-md-6">
                                    <input id="Numero_Cuota" type="text" class="form-control @error('Numero_Cuota') is-invalid @enderror" name="Numero_Cuota" value="{{ old('Numero_Cuota') }}" required readonly>

                                    @error('Numero_Cuota')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="monto_pago" class="col-md-4 col-form-label text-md-right">{{ __('Monto a Pagar') }}</label>

                                <div class="col-md-6">
                                    <input id="monto_pago" type="text"  class="form-control @error('monto_pago') is-invalid @enderror" name="monto_pago" value="{{ old('monto_pago') }}" required>

                                    @error('monto')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripcion') }}</label>
                                <div class="col-md-6">
                                    <textarea id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" rows="5" cols="50" required>{{ old('descripcion') }}</textarea>
                                    @error('descripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Guardar Pago') }}
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


@section('css')

@stop

@section('js')
<script>
    $(document).ready(function() {
        // Obtener los elementos del formulario
        var clienteSelect = $('#id_cliente');
        var idprestamo = $('#id_prestamo');
        var montoInput = $('#monto_prestamo');
        var cuotaInput = $('#cuota');
        var numeroCuotaInput = $('#Numero_Cuota');

        // Agregar un evento de cambio al selector de cliente
        clienteSelect.change(function() {
            var clienteId = $(this).val(); // Obtener el ID del cliente seleccionado
            console.log(clienteId);
            // Hacer una solicitud AJAX al servidor
            $.ajax({
                url: "{{ route('pagos.obtenerPorCliente', ':clienteId') }}".replace(':clienteId', clienteId),
                type: "GET",
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    // Llenar los campos con los datos del préstamo
                    montoInput.val(response.prestamo.monto_prestamo);
                    cuotaInput.val(response.prestamo.calculo_cuota);
                    numeroCuotaInput.val(response.cuota);
                    idprestamo.val(response.prestamo.id);
                },
                error: function(response) {
                    console.log(response); // Manejar errores
                }
            });
        });

        $('#pagoForm').submit(function(e) {
            e.preventDefault(); // previene el envío del formulario

            // Mostrar alerta de confirmación antes de enviar el formulario
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Se registrará el pago del cliente!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, Registrar Pago!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar el formulario
                    this.submit();

                    // Mostrar mensaje de éxito después de enviar el formulario
                    Swal.fire({
                        icon: 'success',
                        title: 'Pago Registrado',
                        text: 'Tu registro ha sido guardado exitosamente.'
                    });
                }
            });
        });
    });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

@stop


