@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <h1 style="text-align: center;">CREAR NUEVO USUARIO</h1>
@stop

@section('content')




        <form method="post" action="{{ route('user.create') }}">
            @csrf
            <div class="container">
                <p> </p>
                <p>  </p>
            <div class="form-row">
                <div class="form-group col-md-6">
                     <x-jet-label  for="Carnet_usuario" value="{{ __('CARNET/DNI') }}" />
                     <x-jet-input  maxlength="15" id="Carnet_usuario" class="form-control"   type="text" name="Carnet_usuario" :value="old('Carnet_usuario')" required autofocus autocomplete="Carnet_usuario" />
                     <x-jet-input-error for="Carnet_usuario" class="mt-2 text-danger" />
                    </div>
                <div class="form-group col-md-6">
                     <x-jet-label for="name" value="{{ __('NOMBRES') }}" />
                     <x-jet-input maxlength="20" id="name" class="form-control" type="text"   name="name" :value="old('name')" required autofocus autocomplete="name" />
                     <x-jet-input-error for="name" class="mt-2 text-danger" />
                </div>
                <div class="form-group col-md-6">
                     <x-jet-label for="apellido_usuario" value="{{ __('APELLIDOS') }}" />
                     <x-jet-input maxlength="20" id="apellido_usuario" class="form-control"  type="text" name="apellido_usuario" :value="old('apellido_usuario')" required autofocus autocomplete="apellido_usuario" />
                     <x-jet-input-error for="apellido_usuario" class="mt-2 text-danger" />
                </div>
                 <div class="form-group col-md-6">
                     <x-jet-label for="Nombre_usuario" value="{{ __('NOMBRE DE USUARIO') }}" />
                     <x-jet-input maxlength="20"  id="Nombre_usuario" class="form-control"   type="text" name="Nombre_usuario" :value="old('Nombre_usuario')" required autofocus autocomplete="Nombre_usuario" />
                     <x-jet-input-error for="Nombre_usuario" class="mt-2 text-danger" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                     <x-jet-label for="Cargo" value="{{ __('CARGO LABORAL') }}" />
                     <select name="cargo_usuario">
                      <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                      <option value="ENCARGADO">ENCARGADO</option>
                     </select>

                </div>
            </div>
            <div class="form-row">
                 <div class="form-group col-md-12">
                     <x-jet-label for="direccion_usuario" value="{{ __('DIRECCION') }}" />
                    <x-jet-input maxlength="40" id="direccion_usuario"  class="form-control" type="text" name="direccion_usuario" :value="old('direccion_usuario')" required autofocus autocomplete="direccion_usuario" />
                    <x-jet-input-error for="direccion_usuario" class="mt-2 text-danger" />
                </div>
            </div>
            <div class="form-row">
                 <div class="form-group col-md-6">
                     <x-jet-label for="telefono_usuario" value="{{ __('TELEFONO') }}" />
                     <x-jet-input maxlength="8" id="telefono_usuario"  class="form-control" type="text" name="telefono_usuario" :value="old('telefono_usuario')" required autofocus autocomplete="telefono_usuario" />
                     <x-jet-input-error for="telefono_usuario" class="mt-2 text-danger" />
                    </div>
                 <div class="form-group col-md-6">
                     <x-jet-label for="email" value="{{ __('CORREO ELECTRONICO') }}" />
                     <x-jet-input maxlength="40" id="email" class="form-control" type="email"  name="email" :value="old('email')" required />
                     <x-jet-input-error for="email" class="mt-2 text-danger" />
                    </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                     <x-jet-label for="password" value="{{ __('CONTRASEÑA') }}" />
                     <x-jet-input  id="password" class="form-control"   type="password" name="password" required autocomplete="new-password" />
                     <x-jet-input-error for="password" class="mt-2 text-danger" />
                    </div>
                <div class="form-group col-md-6">
                     <x-jet-label for="password_confirmation" value="{{ __('CONFIRMAR CONTRASEÑA') }}" />
                     <x-jet-input  id="password_confirmation" class="form-control"   type="password" name="password_confirmation" required autocomplete="new-password" />
                     <x-jet-input-error for="password_confirmation" class="mt-2 text-danger" />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-jet-button class="btn btn-success btn-lg" ><i class='fa fa-user-plus'></i>
                    {{ __('REGISTRAR') }}
                </x-jet-button>
            </div>
        </div>
        </form>









@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script> -->
@stop


