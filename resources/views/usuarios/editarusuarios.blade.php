@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <h1 style="text-align: center;font-weight: bold; color: black;">ACTUALIZAR DATOS</h1>
@stop

@section('content')



        <form method="get" action="{{ route('user.update',$usersv->id) }}">
            @csrf
            <div class="container">
                <p> </p>
                <p>  </p>
            <div class="form-row">
                <input type="hidden" value="{{$usersv->id}}">
                <div class="form-group col-md-6">
                    <x-jet-label for="Carnet" value="{{ __('CARNET/DNI') }}" />
                    <x-jet-input  id="Carnet_usuario" class="form-control" type="text" name="Carnet_usuario" value="{{$usersv->Carnet_usuario}}" required autofocus autocomplete="Carnet_usuario" />
                    <x-jet-input-error for="Carnet_usuario" class="mt-2 text-danger" />
                    </div>

                <div class="form-group col-md-6">
                    <x-jet-label for="name" value="{{ __('NOMBRES') }}" />
                    <x-jet-input  id="name" class="form-control" type="text" name="name" value="{{$usersv->name}}" required autofocus autocomplete="name" />
                    <x-jet-input-error for="name" class="mt-2 text-danger" />
                    </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <x-jet-label for="Apellidos" value="{{ __('APELLIDOS') }}" />
                    <x-jet-input  id="apellido_usuario" class="form-control" type="text" name="apellido_usuario" value="{{$usersv->apellido_usuario}}" required autofocus autocomplete="apellido_usuario" />
                    <x-jet-input-error for="apellido_usuario" class="mt-2 text-danger" />
                    </div>
                <div class="form-group col-md-6">
                    <x-jet-label for="NombreUsuario" value="{{ __('NOMBRE DE USUARIO') }}" />
                    <x-jet-input   id="Nombre_usuario" class="form-control" type="text" name="Nombre_usuario" value="{{$usersv->Nombre_usuario}}" required autofocus autocomplete="Nombre_usuario" />
                    <x-jet-input-error for="Nombre_usuario" class="mt-2 text-danger" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <x-jet-label for="estado_usuario" value="{{ __('ESTADO USUARIO') }}" />
                    <select name="estado_usuario">
                     <option value="ACTIVO">ACTIVO</option>
                     <option value="INACTIVO">INACTIVO</option>
                    </select>

               </div>
                <div class="form-group col-md-6">
                    <x-jet-label for="Cargo" value="{{ __('CARGO LABORAL') }}" />
                    <select name="cargo_usuario">
                        <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                        <option value="ENCARGADO">ENCARGADO</option>
                    </select>

               </div>
                <div class="form-group col-md-6">
                    <x-jet-label for="Direccion" value="{{ __('DIRECCION') }}" />
                    <x-jet-input  id="direccion_usuario" class="form-control" type="text" name="direccion_usuario" value="{{$usersv->direccion_usuario}}" required autofocus autocomplete="direccion_usuario" />
                    <x-jet-input-error for="direccion_usuario" class="mt-2 text-danger" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <x-jet-label for="Telefono" value="{{ __('TELEFONO') }}" />
                    <x-jet-input  id="telefono_usuario" class="form-control" type="text" name="telefono_usuario" value="{{$usersv->telefono_usuario}}" required autofocus autocomplete="telefono_usuario" />
                    <x-jet-input-error for="telefono_usuario" class="mt-2 text-danger" />
                    </div>
                <div class="form-group col-md-6">
                    <x-jet-label for="email" value="{{ __('CORREO ELECTRONICO') }}" />
                    <x-jet-input  id="email" class="form-control" type="email" name="email" value="{{$usersv->email}}" required />
                    <x-jet-input-error for="email" class="mt-2 text-danger" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <x-jet-label for="password" value="{{ __('CONTRASEÑA') }}" />
                    <x-jet-input  id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                    <x-jet-input-error for="password" class="mt-2 text-danger" />
                </div>
                <div class="form-group col-md-6">
                    <x-jet-label for="password_confirmation" value="{{ __('CONFIRMAR CONTRASEÑA') }}" />
                    <x-jet-input  id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-jet-input-error for="password_confirmation" class="mt-2 text-danger" />
                </div>
            </div>
            <div class="flex items-center justify-end mt-4">

                <x-jet-button class="btn btn-success"><i class='fa fa-save'></i>
                    {{ __('ACTUALIZAR') }}
                </x-jet-button>
            </div>
        </form>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script> -->
@stop


