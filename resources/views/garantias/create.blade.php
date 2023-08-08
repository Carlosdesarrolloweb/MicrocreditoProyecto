
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<center>
    <div class="logo-container">
        <img class="logo" src="{{ asset('creargarantia.png') }}" alt="Logo Microcréditos Mary">
        <h1 class="title">NUEVA GARANTIA</h1>
        <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
    </div>
</center>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stop

@section('content')
<div class="container">
    <div class="form-group col-md-12">
        <div class="form-group col-md-12 text-right">
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
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <form method="POST" action="{{ route('garantias.store') }}" enctype="multipart/form-data" id="garantiaForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="garantia">
                                        <span class="icon">
                                            <i class="far fa-file-alt"></i>
                                        </span>
                                        {{ __('Garantía') }}
                                    </label>
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
                                    <label for="Valor_Prenda">
                                        <span class="icon">
                                            <i class="fas fa-dollar-sign"></i>
                                        </span>
                                        {{ __('Valor Prenda') }}
                                    </label>
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
                                    <label for="Detalle_Prenda">
                                        <span class="icon">
                                            <i class="fas fa-list"></i>
                                        </span>
                                        {{ __('Detalle Prenda') }}
                                    </label>
                                    {{-- <x-jet-label for="Detalle_Prenda" value="{{ __('Detalle Prenda') }}" /> --}}
                                    <x-jet-input maxlength="20" id="Detalle_Prenda" class="form-control" type="text" name="Detalle_Prenda" :value="old('Detalle_Prenda')" required autofocus autocomplete="Detalle_Prenda" />
                                    <x-jet-input-error for="Detalle_Prenda" class="mt-2 text-danger" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cliente_id">
                                        <span class="icon">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        {{ __('Cliente') }}
                                    </label>
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
                                    <label for="id_prestamo">
                                        <span class="icon">
                                            <i class="fas fa-file-invoice"></i>
                                        </span>
                                        Prestamo
                                    </label>
                                    <input type="text" name="id_prestamo" id="id_prestamo" readonly class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fecha_entrega">
                                        <span class="icon">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                        {{ __('Fecha de Entrega') }}
                                    </label>
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
                                    <label for="estado">
                                        <span class="icon">
                                            <i class="fas fa-check-circle"></i>
                                        </span>
                                        {{ __('Estado') }}
                                    </label>
                                    <select id="estado" class="form-control @error('estado') is-invalid @enderror" name="estado" required>
                                        <option value="">Seleccione el estado de la garantía</option>
                                        <option value="ARTICULO NUEVO">ARTICULO NUEVO</option>
                                        <option value="ARTICULO USADO">ARTICULO USADO</option>
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
                                    <label for="id_foto">
                                        <span class="icon">
                                            <i class="far fa-image"></i>
                                        </span>
                                        {{ __('Imagen de la Prenda') }}
                                    </label>
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

                                    <button type="submit" class="btn btn-success btn-lg d-flex align-items-center ml-auto"><i class="fa fa-save mr-2" ></i>
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
</div>
    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
        <style>
        .box-body {
            background-color: #75606069;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
        }
        .label-icon {
            display: flex;
            flex-direction: row-reverse;
            align-items: center;
         }

        .label-icon .icon {
            margin-left: 5px;
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

        .title {
                text-align: center;
                font-weight: bold;
                color: black;
                font-size: 2em;
                margin: 0;
                margin-top: -5px;
            }

        h1 {
            text-align: center;
            font-weight: bold;
            color: black;
            font-size: 8em;
            margin-bottom: 0;
        }
        .input-label {
            display: flex;
            align-items: center;
            font-size: 5em;
            margin-bottom: 10px;
            }

        .input-label i {
            margin-right: 10px;
        }
        .custom-container {
                max-width: 1500px;
                margin: 0 auto; /* Para centrar horizontalmente */
                margin-top: 50px;
        }
        </style>
    @stop

    @section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5"></script>
    <script>
        //BOTON DE AYUDA
    document.getElementById('btnAyuda').addEventListener('click', function() {
        Swal.fire({
            title: 'Ayuda',
            html: '<embed src="/pdf/creargarantia.pdf" type="application/pdf" width="100%" height="800px" />',
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
    document.getElementById("garantiaForm").reset();
    });

    </script>

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
                    $('#id_prestamo').val(prestamo.id);
                    // $('#monto_prestamo').val(prestamo.monto_prestamo);
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
            // ALERTA DEL BOTON GUARDAR

        $(document).ready(function() {
        $('#garantiaForm').submit(function(e) {
        e.preventDefault(); // previene el envío del formulario

            // Mostrar alerta de confirmación antes de enviar el formulario
            Swal.fire({
                title: 'Esta Seguro?',
                text: "Se Registrara la garantia!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Registrar Garantia!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar el formulario
                    this.submit();

                    // Mostrar mensaje de éxito después de enviar el formulario
                    Swal.fire({
                        icon: 'success',
                        title: 'Garantia Registrada',
                        text: 'Tu registro ha sido guardado exitosamente.'
                    });
                }
            });
            });
        });
    });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
@stop
