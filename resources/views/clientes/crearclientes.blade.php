@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">CREAR NUEVO CLIENTE</h1>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
@stop

@section('content')
        <form id="clienteForm" method="post" action="{{ route('clientes.crearclientes') }}" enctype="multipart/form-data">
            @csrf
            <div class="container">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="col-md-12 text-right mb-3">
                        <button type="button" class="btn btn-danger btn-lg" id="btnLimpiar">
                            <i class="fas fa-times-circle mr-2"></i>Limpiar
                        </button>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <x-jet-label for="Carnet_cliente" value="{{ __('CARNET/DNI') }}" />
                    <x-jet-input  maxlength="15" id="Carnet_cliente" class="form-control" type="text" name="Carnet_cliente" :value="old('Carnet_cliente')" required autofocus autocomplete="Carnet_cliente" />
                    <x-jet-input-error for="Carnet_cliente" class="mt-2 text-danger" />
                </div>
                <div class="form-group col-md-6">
                    <x-jet-label for="nombre_cliente" value="{{ __('NOMBRES') }}" />
                    <x-jet-input maxlength="20" id="nombre_cliente" class="form-control" type="text" name="nombre_cliente" :value="old('nombre_cliente')" required autofocus autocomplete="nombre_cliente" />
                    <x-jet-input-error for="nombre_cliente" class="mt-2 text-danger" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <x-jet-label for="apellido_cliente" value="{{ __('APELLIDOS') }}" />
                    <x-jet-input maxlength="20" id="apellido_cliente" class="form-control" type="text" name="apellido_cliente" :value="old('apellido_cliente')" required autofocus autocomplete="apellido_cliente" />
                    <x-jet-input-error for="apellido_cliente" class="mt-2 text-danger" />
                </div>
                <div class="form-group">
                    <label for="zona_id">Zona</label>
                    <select class="form-control" id="zona_id" name="zona_id">
                        @foreach ($zonas as $zona)
                            <option value="{{ $zona->id }}">{{ $zona->nombre_zona }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <x-jet-label for="direccion_cliente" value="{{ __('DIRECCION') }}" />
                    <x-jet-input maxlength="30"  id="direccion_cliente" class="form-control" type="text" name="direccion_cliente" :value="old('direccion_cliente')" required autofocus autocomplete="direccion_cliente" />
                    <x-jet-input-error for="direccion_cliente" class="mt-2 text-danger" />
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <x-jet-label for="email_cliente" value="{{ __('CORREO ELECTRONICO/EMAIL') }}" />
                    <x-jet-input maxlength="30" id="email_cliente" class="form-control" type="email" name="email_cliente" :value="old('email_cliente')" required autofocus autocomplete="email_cliente" />
                    <x-jet-input-error for="email_cliente" class="mt-2 text-danger" />
                </div>
                <div class="form-group col-md-6">
                    <x-jet-label for="telefono_cliente" value="{{ __('TELEFONO') }}" />
                    <x-jet-input maxlength="8" id="telefono_cliente" class="form-control" type="text" name="telefono_cliente" :value="old('telefono_cliente')" required autofocus autocomplete="telefono_cliente" />
                    <x-jet-input-error for="telefono_cliente" class="mt-2 text-danger" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <x-jet-label for="edad_cliente" value="{{ __('EDAD') }}" />
                    <x-jet-input maxlength="2" id="edad_cliente" class="form-control" type="text" name="edad_cliente" :value="old('edad_cliente')" required autofocus autocomplete="edad_cliente" />
                    <x-jet-input-error for="edad_cliente" class="mt-2" />
                </div>
                <div class="form-group col-md-6">
                    <x-jet-label for="telefono_referencia" value="{{ __('TELEFONO REFERENCIA') }}" />
                    <x-jet-input maxlength="8" id="telefono_referencia" class="form-control" type="text" name="telefono_referencia" :value="old('telefono_referencia')" required />
                    <x-jet-input-error for="telefono_referencia" class="mt-2 text-danger" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <x-jet-label for="estado_cliente" value="{{ __('ESTADO CLIENTE') }}" />
                        <select name="estado_cliente">
                            <option value="CLIENTE NUEVO">CLIENTE NUEVO</option>
                            <option value="BUEN CLIENTE">BUEN CLIENTE</option>
                            <option value="MAL CLIENTE">MAL CLIENTE</option>
                        </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <x-jet-label for="id_foto" value="{{ __('FOTO ANVERSO CARNET') }}" />
                    <x-jet-input  id="id_foto" class="form-control" type="FILE" name="id_foto" :value="old('id_foto')" required />
               </div>
                <div class="form-group col-md-6">
                    <x-jet-label for="id_fotocarnet" value="{{ __('FOTO REVERSO CARNET') }}" />
                    <x-jet-input  id="id_fotocarnet" class="form-control" type="FILE" name="id_fotocarnet" :value="old('id_fotocarnet')" required />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <x-jet-label for="id_fotorecibo" value="{{ __('FOTO RECIBO AGUA/LUZ') }}" />
                    <x-jet-input  id="id_fotorecibo" class="form-control" type="FILE" name="id_fotorecibo" :value="old('id_fotorecibo')" required />
                </div>
                <div class="form-group col-md-6">
                    <x-jet-label for="id_fotocroquis" value="{{ __('FOTO CROQUIS CASA') }}" />
                    <x-jet-input  id="id_fotocroquis" class="form-control" type="FILE" name="id_fotocroquis" :value="old('id_fotocroquis')" required />
                </div>
            </div>
            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="btn btn-success btn-lg d-flex align-items-center ml-auto" onclick="confirmSave()">
                  <i class="fa fa-save mr-2" style="font-size: 1.8em;"></i>
                  <h4 class="mb-0">{{ __('Crear') }}</h4>
                </x-jet-button>
              </div>
        </div>
        </form>
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
    </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
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


@stop





