@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <h1 style="text-align: center;font-weight: bold; color: black;">CREAR NUEVO USUARIO</h1>
     <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
@stop

@section('content')
    <form method="post" action="{{ route('user.create') }}">
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
                <p> </p><p>  </p>

                <div class="custom-box" style="background-color: #75606069; border: 1px solid #ccc; padding: 20px; border-radius: 5px;">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Carnet_usuario" class="col-md-8 col-form-label">
                                <i class="fas fa-user"></i> {{ __('CARNET/DNI') }}
                            </label>
                            <x-jet-input  maxlength="15" id="Carnet_usuario" class="form-control"   type="text" name="Carnet_usuario" :value="old('Carnet_usuario')" required autofocus autocomplete="Carnet_usuario" />
                            <x-jet-input-error for="Carnet_usuario" class="mt-2 text-danger" />
                            </div>
                        <div class="form-group col-md-6">
                            <label for="name" class="col-md-8 col-form-label">
                                <i class="fas fa-user"></i> {{ __('NOMBRES') }}
                            </label>
                            <x-jet-input maxlength="20" id="name" class="form-control" type="text"   name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-jet-input-error for="name" class="mt-2 text-danger" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellido_usuario" class="col-md-8 col-form-label">
                                <i class="fas fa-user"></i> {{ __('APELLIDOS') }}
                            </label>
                            <x-jet-input maxlength="20" id="apellido_usuario" class="form-control"  type="text" name="apellido_usuario" :value="old('apellido_usuario')" required autofocus autocomplete="apellido_usuario" />
                            <x-jet-input-error for="apellido_usuario" class="mt-2 text-danger" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Nombre_usuario" class="col-md-8 col-form-label">
                                <i class="fas fa-user"></i> {{ __('NOMBRE DE USUARIO') }}
                            </label>
                            <x-jet-input maxlength="20"  id="Nombre_usuario" class="form-control"   type="text" name="Nombre_usuario" :value="old('Nombre_usuario')" required autofocus autocomplete="Nombre_usuario" />
                            <x-jet-input-error for="Nombre_usuario" class="mt-2 text-danger" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="estado_usuario" class="col-md-8 col-form-label">
                                <i class="fas fa-user"></i> {{ __('ESTADO USUARIO') }}
                            </label>
                            <select name="estado_usuario">
                            <option value="ACTIVO">ACTIVO</option>
                            <option value="INACTIVO">INACTIVO</option>
                            </select>

                        </div>
                        <div class="form-group col-md-6">
                            <label for="Cargo" class="col-md-8 col-form-label">
                                <i class="fas fa-user"></i> {{ __('CARGO LABORAL') }}
                            </label>
                            <select name="cargo_usuario">
                            <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                            <option value="ENCARGADO">ENCARGADO</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="direccion_usuario" class="col-md-8 col-form-label">
                                <i class="fas fa-map-marker-alt"></i> {{ __('DIRECCION') }}
                            </label>
                            <x-jet-input maxlength="40" id="direccion_usuario"  class="form-control" type="text" name="direccion_usuario" :value="old('direccion_usuario')" required autofocus autocomplete="direccion_usuario" />
                            <x-jet-input-error for="direccion_usuario" class="mt-2 text-danger" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="telefono_usuario" class="col-md-8 col-form-label">
                                <i class="fas fa-phone"></i> {{ __('TELEFONO') }}
                            </label>
                            <x-jet-input maxlength="8" id="telefono_usuario"  class="form-control" type="text" name="telefono_usuario" :value="old('telefono_usuario')" required autofocus autocomplete="telefono_usuario" />
                            <x-jet-input-error for="telefono_usuario" class="mt-2 text-danger" />
                            </div>
                        <div class="form-group col-md-6">
                            <label for="email" class="col-md-8 col-form-label">
                                <i class="fas fa-envelope"></i> {{ __('CORREO ELECTRONICO') }}
                            </label>
                            <x-jet-input maxlength="40" id="email" class="form-control" type="email"  name="email" :value="old('email')" required />
                            <x-jet-input-error for="email" class="mt-2 text-danger" />
                            </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password" class="col-md-8 col-form-label">
                                <i class="fas fa-lock"></i> {{ __('CONTRASEÑA') }}
                            </label>
                            <x-jet-input  id="password" class="form-control"   type="password" name="password" required autocomplete="new-password" />
                            <x-jet-input-error for="password" class="mt-2 text-danger" />
                            </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation" class="col-md-8 col-form-label">
                                <i class="fas fa-lock"></i> {{ __('CONFIRMAR CONTRASEÑA') }}
                            </label>
                            <x-jet-input  id="password_confirmation" class="form-control"   type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-jet-input-error for="password_confirmation" class="mt-2 text-danger" />
                        </div>
                    </div>

                   {{--  <div class="flex items-center justify-end mt-4">

                        <x-jet-button class="btn btn-success btn-lg" ><i class='fa fa-user-plus'></i>
                            {{ __('REGISTRAR') }}
                        </x-jet-button>
                    </div> --}}
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4 text-center align-items-center">
                            <button type="submit" class="btn btn-success btn-lg d-flex justify-content-center">
                                <i class="fa fa-user-plus"></i> {{ __(' REGISTRAR') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </form>









@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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
   </style>
@stop

@section('js')
    <script> console.log('Hi!'); </script> -->
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
        document.getElementById("Carnet_usuario").value = "";
        document.getElementById("name").value = "";
        document.getElementById("apellido_usuario").value = "";
        document.getElementById("Nombre_usuario").value = "";
        document.getElementById("estado_usuario").selectedIndex = 0;
        document.getElementById("Cargo").selectedIndex = 0;
        document.getElementById("direccion_usuario").value = "";
        document.getElementById("telefono_usuario").value = "";
        document.getElementById("email").value = "";
        document.getElementById("password").value = "";
        document.getElementById("password_confirmation").value = "";
    });

</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
@stop


