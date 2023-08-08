@extends('adminlte::page')

@section('title', 'Nuevo Préstamo')

@section('content_header')
<center>
    <div class="logo-container">
        <img class="logo" src="{{ asset('guardarpago.png') }}" alt="Logo Microcréditos Mary">
        <h1 class="title">REGISTRAR PAGO</h1>
        <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
    </div>
</center>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@stop
@section('content')
    <div class="container">
        <div class="form-group col-md-12">
            <div class="col-md-12 text-right mb-3">
                <button type="button" class="btn btn-danger btn-lg" id="btnLimpiar">
                    <i class="far fa-file-alt fa-lg"></i> Limpiar
                </button>
                <button type="button" class="btn btn-info btn-lg" id="btnAyuda" data-toggle="modal" data-target="#modalAyuda">
                    <i class="fas fa-question-circle fa-lg"></i> Ayuda
                </button>
                <button type="button" class="btn btn-primary btn-lg" id="btnSalir">
                    <i class="fas fa-sign-out-alt fa-lg"></i> Salir
                </button>
            </div>
        </div>
        <div class="custom-box" style="background-color: #75606069; border: 1px solid #ccc; padding: 20px; border-radius: 5px;">
            <form id="pagoForm" method="POST" action="{{ route('pagos.store')}}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="id_cliente" class="col-md-8 col-form-label">
                            <i class="fas fa-user fa-fw"></i> {{ __('Cliente') }}
                        </label>
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
                    <div class="col-md-6">
                        <label for="monto_prestamo" class="col-md-8 col-form-label">
                            <i class="fas fa-money-bill fa-fw"></i> {{ __('Monto del Préstamo') }}
                        </label>
                        <input id="id_prestamo" type="hidden" name="id_prestamo"/>
                            <input id="monto_prestamo" type="text" class="form-control @error('monto_prestamo') is-invalid @enderror" name="monto_prestamo" readonly required autocomplete="monto_prestamo">
                            @error('monto_prestamo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="cuota" class="col-md-8 col-form-label">
                            <i class="fas fa-dollar-sign fa-fw"></i> {{ __('Cuota a Pagar') }}
                        </label>
                            <input id="cuota" type="text" class="form-control @error('cuota') is-invalid @enderror" name="cuota" readonly required autocomplete="cuota">
                            @error('cuota')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="fecha_pago" class="col-md-8 col-form-label">
                            <i class="far fa-calendar-alt fa-fw"></i> {{ __('Fecha de Pago') }}
                        </label>
                            <input id="fecha_pago" type="date" class="form-control @error('fecha_pago') is-invalid @enderror" name="fecha_pago" value="{{ old('fecha_pago') }}" required autocomplete="fecha_pago" autofocus>
                            @error('fecha_pago')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="Numero_Cuota" class="col-md-8 col-form-label">
                            <i class="fas fa-list-ol fa-fw"></i> {{ __('Número de Cuota') }}
                        </label>
                            <input id="Numero_Cuota" type="text" class="form-control @error('Numero_Cuota') is-invalid @enderror" name="Numero_Cuota" value="{{ old('Numero_Cuota') }}" required readonly>
                            @error('Numero_Cuota')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="monto_pago" class="col-md-8 col-form-label">
                            <i class="fas fa-money-check-alt fa-fw"></i> {{ __('Monto a Pagar') }}
                        </label>
                            <input id="monto_pago" type="text"  class="form-control @error('monto_pago') is-invalid @enderror" name="monto_pago" value="{{ old('monto_pago') }}" required>
                            @error('monto_pago')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="descripcion" class="col-md-8 col-form-label">
                            <i class="fas fa-comment-alt fa-fw"></i> {{ __('Descripcion') }}
                        </label>
                            <textarea id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" rows="5" cols="50" required>{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <p></p> <p></p>

            {{-- <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-success">
                        {{ __('Guardar Pago') }}
                    </button>
                </div>
            </div> --}}
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4 text-center align-items-center">
                    <button type="submit" class="btn btn-success btn-lg d-flex justify-content-center">
                        <i class="fas fa-save fa-lg mr-2"></i> {{ __('Guardar Pago') }}
                    </button>
                </div>
            </div>
        </form>
    </div>


@stop


@section('css')
<style>
     .custom-box {
        background-color: #75606069;
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        }
    .custom-modal {
        width: 90% !important;
        max-width: 1200px !important;
        }
    .logo-container {
        text-align: center;
        }

    .logo {
        width: 100px;
        height: auto;
    }
</style>

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5"></script>
<script>
        //BOTON DE AYUDA
    document.getElementById('btnAyuda').addEventListener('click', function() {
        Swal.fire({
            title: 'Ayuda',
            html: '<embed src="/pdf/crearpago.pdf" type="application/pdf" width="100%" height="800px" />',
            confirmButtonText: 'Cerrar',
            customClass: {
            content: 'modal-lg',
            popup: 'custom-modal'
            }
        });
    });
        //BOTON DE SALIR
    document.getElementById('btnSalir').addEventListener('click', function() {
    window.location.href = "{{ route('dashboard') }}";
    });

        //BOTON DE LIMPIAR
    document.getElementById("btnLimpiar").addEventListener("click", function() {
        document.getElementById("pagoForm").reset();
    });

</script>
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


