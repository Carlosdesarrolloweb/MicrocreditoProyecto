@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <h1>CREAR NUEVO USUARIO</h1> 
@stop

@section('content')

<x-guest-layout >
    <x-jet-authentication-card >
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="post" action="{{ route('user.create') }}">
            @csrf
            <div>
                <x-jet-label for="Carnet" value="{{ __('Carnet/Dni') }}" />
                <x-jet-input  maxlength="15" id="Carnet_usuario" class="block mt-1 w-full" type="text" name="Carnet_usuario" :value="old('Carnet_usuario')" required autofocus autocomplete="Carnet_usuario" />
            </div>

            <div>
                <x-jet-label for="name" value="{{ __('Nombres') }}" />
                <x-jet-input maxlength="20" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>
            <div>
                <x-jet-label for="Apellidos" value="{{ __('Apellidos') }}" />
                <x-jet-input maxlength="20" id="apellido_usuario" class="block mt-1 w-full" type="text" name="apellido_usuario" :value="old('apellido_usuario')" required autofocus autocomplete="apellido_usuario" />
            </div>
            <div>
                <x-jet-label for="NombreUsuario" value="{{ __('Nombre de Usuario') }}" />
                <x-jet-input maxlength="15"  id="Nombre_usuario" class="block mt-1 w-full" type="text" name="Nombre_usuario" :value="old('Nombre_usuario')" required autofocus autocomplete="Nombre_usuario" />
            </div>
            <!--<div>
                <x-jet-label for="Cargo" value="{{ __('Cargo Laboral') }}" />
               <x-jet-input maxlength="15" id="cargo_usuario" class="block mt-1 w-full" type="text" name="cargo_usuario" :value="old('cargo_usuario')" required autofocus autocomplete="cargo_usuario" />
            </div> -->
            <x-jet-label for="Cargo" value="{{ __('Cargo Laboral') }}" />
                <select name="cargo_usuario">
                <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                <option value="ENCARGADO">ENCARGADO</option>
                </select>
            <div>
                <x-jet-label for="Direccion" value="{{ __('Direccion') }}" />
                <x-jet-input maxlength="40" id="direccion_usuario" class="block mt-1 w-full" type="text" name="direccion_usuario" :value="old('direccion_usuario')" required autofocus autocomplete="direccion_usuario" />
            </div>
            <div>
                <x-jet-label for="Telefono" value="{{ __('Telefono') }}" />
                <x-jet-input maxlength="8" id="telefono_usuario" class="block mt-1 w-full" type="text" name="telefono_usuario" :value="old('telefono_usuario')" required autofocus autocomplete="telefono_usuario" />
            </div>
            <div>
                <x-jet-label for="email" value="{{ __('Correo Electronico') }}" />
                <x-jet-input maxlength="40" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div>
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input  id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div >
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input  id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            <div class="flex items-center justify-end mt-4">          

                <x-jet-button class="ml-4">
                    {{ __('Registrar') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script> -->
@stop


