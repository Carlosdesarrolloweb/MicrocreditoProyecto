@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="logo-container">
    <img class="logo" src="{{ asset('nuevocliente.png') }}" alt="Logo Microcréditos Mary">
    <h1 class="title">CREAR CLIENTE</h1>
    <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@stop

@section('content')
        <form id="clienteForm" method="post" action="{{ route('clientes.crearclientes') }}" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="form-group col-md-12">
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
                </div>
                <div class="custom-box">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Carnet_cliente" value="{{ __('CARNET/DNI') }}" > <i class="fas fa-id-card"></i> Carnet/DNI</label>
                            <x-jet-input  maxlength="15" id="Carnet_cliente" class="form-control" type="text" name="Carnet_cliente" :value="old('Carnet_cliente')" required autofocus autocomplete="Carnet_cliente" />
                            <x-jet-input-error for="Carnet_cliente" class="mt-2 text-danger" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nombre_cliente" value="{{ __('NOMBRES') }}" > <i class="fas fa-user"></i> Nombres</label>
                            <x-jet-input maxlength="20" id="nombre_cliente" class="form-control" type="text" name="nombre_cliente" :value="old('nombre_cliente')" required autofocus autocomplete="nombre_cliente" />
                            <x-jet-input-error for="nombre_cliente" class="mt-2 text-danger" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="apellido_cliente" value="{{ __('APELLIDOS') }}" > <i class="fas fa-user"></i> Apellidos</label>
                            <x-jet-input maxlength="20" id="apellido_cliente" class="form-control" type="text" name="apellido_cliente" :value="old('apellido_cliente')" required autofocus autocomplete="apellido_cliente" />
                            <x-jet-input-error for="apellido_cliente" class="mt-2 text-danger" />
                        </div>
                        <div class="form-group">
                            <label for="zona_id"><i class="fas fa-map-marker-alt"></i> Zona</label>
                            <select class="form-control" id="zona_id" name="zona_id">
                                @foreach ($zonas as $zona)
                                    <option value="{{ $zona->id }}">{{ $zona->nombre_zona }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="direccion_cliente" value="{{ __('DIRECCION') }}" > <i class="fas fa-map-marker-alt"></i> Dirección</label>
                            <x-jet-input maxlength="30"  id="direccion_cliente" class="form-control" type="text" name="direccion_cliente" :value="old('direccion_cliente')" required autofocus autocomplete="direccion_cliente" />
                            <x-jet-input-error for="direccion_cliente" class="mt-2 text-danger" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email_cliente" value="{{ __('CORREO ELECTRONICO/EMAIL') }}" > <i class="fas fa-envelope"></i> Email</label>
                            <x-jet-input maxlength="30" id="email_cliente" class="form-control" type="email" name="email_cliente" :value="old('email_cliente')" required autofocus autocomplete="email_cliente" />
                            <x-jet-input-error for="email_cliente" class="mt-2 text-danger" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telefono_cliente" value="{{ __('TELEFONO') }}" > <i class="fas fa-phone"></i> Telefono</label>
                            <x-jet-input maxlength="8" id="telefono_cliente" class="form-control" type="text" name="telefono_cliente" :value="old('telefono_cliente')" required autofocus autocomplete="telefono_cliente" />
                            <x-jet-input-error for="telefono_cliente" class="mt-2 text-danger" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="edad_cliente" value="{{ __('EDAD') }}" > <i class="fas fa-birthday-cake"></i> Edad</label>
                            <x-jet-input maxlength="2" id="edad_cliente" class="form-control" type="text" name="edad_cliente" :value="old('edad_cliente')" required autofocus autocomplete="edad_cliente" />
                            <x-jet-input-error for="edad_cliente" class="mt-2" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="telefono_referencia" value="{{ __('TELEFONO REFERENCIA') }}" > <i class="fas fa-phone"></i> Telefono Referencia</label>
                            <x-jet-input maxlength="8" id="telefono_referencia" class="form-control" type="text" name="telefono_referencia" :value="old('telefono_referencia')" required />
                            <x-jet-input-error for="telefono_referencia" class="mt-2 text-danger" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="estado_cliente" value="{{ __('ESTADO CLIENTE') }}" > <i class="fas fa-check-circle"></i> Estado Cliente</label>
                                <select name="estado_cliente">
                                    <option value="CLIENTE NUEVO">CLIENTE NUEVO</option>
                                    <option value="BUEN CLIENTE">BUEN CLIENTE</option>
                                    <option value="MAL CLIENTE">MAL CLIENTE</option>
                                </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="id_foto" value="{{ __('FOTO ANVERSO CARNET') }}">
                                <i class="far fa-image"></i> Foto Anverso Carnet
                            </label>
                            <input id="id_foto" class="form-control-file" type="file" name="id_foto" :value="old('id_foto')" required onchange="handleImageUpload(event)" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="id_fotocarnet" value="{{ __('FOTO REVERSO CARNET') }}">
                                <i class="far fa-image"></i> Foto Reverso Carnet
                            </label>
                            <input id="id_fotocarnet" class="form-control-file" type="file" name="id_fotocarnet" :value="old('id_fotocarnet')" required onchange="handleImageUpload(event)" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="id_fotorecibo" value="{{ __('FOTO RECIBO AGUA/LUZ') }}">
                                <i class="far fa-image"></i> Foto Recibo Agua/Luz
                            </label>
                            <input id="id_fotorecibo" class="form-control-file" type="file" name="id_fotorecibo" :value="old('id_fotorecibo')" required onchange="handleImageUpload(event)" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="id_fotocroquis" value="{{ __('FOTO CROQUIS CASA') }}">
                                <i class="far fa-image"></i> Foto Croquis Casa
                            </label>
                            <input id="id_fotocroquis" class="form-control-file" type="file" name="id_fotocroquis" :value="old('id_fotocroquis')" required onchange="handleImageUpload(event)" />
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="btn btn-success btn-lg d-flex align-items-center ml-auto" onclick="confirmSave()">
                        <i class="fa fa-save mr-2" style="font-size: 1.8em;"></i>
                        <h4 class="mb-0">{{ __('Crear') }}</h4>
                        </x-jet-button>
                    </div>
                </div>
            </div>
        </form>
                <!-- Mostrar errores -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
    <style>
        /* Aumentar el tamaño del botón y la fuente */
        .btn-lg {
            font-size: 1.25rem;
            padding: 0.5rem 1rem;
        }
        /* Agregar margen derecho al icono */
        .fa-times-circle {
            margin-right: 0.5rem;
        }
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
    <script> console.log('Hi!'); </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5"></script>
    <script>
        document.getElementById('btnAyuda').addEventListener('click', function() {
            Swal.fire({
                title: 'Ayuda',
                html: '<embed src="/pdf/crearcliente.pdf" type="application/pdf" width="100%" height="800px" />',
                confirmButtonText: 'Cerrar',
                customClass: {
                content: 'modal-lg',
                popup: 'custom-modal'
                }
            });
        });
        document.getElementById('btnSalir').addEventListener('click', function() {
        window.location.href = "{{ route('dashboard') }}";
        });
    </script>
    <script>
                // Selecciona el botón "Limpiar" y agrega un evento click
                document.getElementById('btnLimpiar').addEventListener('click', function(event) {
                    // Evita que se recargue la página cuando se hace click en el botón
                    event.preventDefault();

                    // Establece el valor de cada campo del formulario a su valor predeterminado
                    document.getElementById('Carnet_cliente').value = '';
                    document.getElementById('nombre_cliente').value = '';
                    document.getElementById('apellido_cliente').value = '';
                    document.getElementById('zona_id').selectedIndex = 0; // selecciona el primer elemento de la lista de opciones
                    document.getElementById('direccion_cliente').value = '';
                    document.getElementById('email_cliente').value = '';
                    document.getElementById('telefono_cliente').value = '';
                    document.getElementById('edad_cliente').value = '';
                    document.getElementById('telefono_referencia').value = '';
                    document.getElementById('estado_cliente').selectedIndex = 0; // selecciona el primer elemento de la lista de opciones
                });

                // ALERTA DEL BOTON GUARDAR

                $(document).ready(function() {
            $('#clienteForm').submit(function(e) {
                e.preventDefault(); // previene el envío del formulario

                // Mostrar alerta de confirmación antes de enviar el formulario
                Swal.fire({
                    title: 'Esta Seguro?',
                    text: "Se guardaran todos los datos del Cliente!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Crear Cliente!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Enviar el formulario
                        this.submit();

                        // Mostrar mensaje de éxito después de enviar el formulario
                        Swal.fire({
                            icon: 'success',
                            title: 'Se Creo Correctamente al Cliente',
                            text: 'Tu registro ha sido guardado exitosamente.'
                        });
                    }
                });
            });
        });

    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
            $(document).ready(function() {
            // Manejar el evento keyup en el campo de carnet
            $('#Carnet_cliente').keyup(function() {
                var carnet = $(this).val();
                if (carnet !== '') {
                    obtenerDatosCliente(carnet);
                }
            });

            // Función para obtener los datos del cliente
            function obtenerDatosCliente(carnet) {
                $.ajax({
                    url: '/clientes/obtenerdatoscliente',
                    method: 'GET',
                    data: {
                        Carnet_cliente: carnet
                    },
                    success: function(response) {
                        console.log(response); // Imprimir en la consola los datos recibidos
                        if (response.success) {
                            var cliente = response.cliente;
                            if (cliente) {
                                // Llenar automáticamente los campos del formulario
                                $('#nombre_cliente').val(cliente.nombre_cliente);
                                $('#apellido_cliente').val(cliente.apellido_cliente);
                                $('#direccion_cliente').val(cliente.direccion_cliente);
                                $('#email_cliente').val(cliente.email_cliente);
                                $('#telefono_cliente').val(cliente.telefono_cliente);
                                $('#edad_cliente').val(cliente.edad_cliente);
                                $('#telefono_referencia').val(cliente.telefono_referencia);
                                $('#estado_cliente').val(cliente.estado_cliente);
                                // Llenar el resto de los campos del formulario
                            } else {
                                console.log('Cliente no encontrado');
                            }
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    </script>

@stop





