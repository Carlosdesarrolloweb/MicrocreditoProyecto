@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <h1>update</h1> 
@stop

@section('content')

<x-guest-layout >
    <x-jet-authentication-card >
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="GET" action="{{ route('user.update',$usersv->id) }}">
            @csrf
            <input type="hidden" value="{{$usersv->id}}">
            <div>
                <x-jet-label for="Carnet" value="{{ __('Carnet/Dni') }}" />
                <x-jet-input  id="Carnet_usuario" class="block mt-1 w-full" type="text" name="Carnet_usuario" value="{{$usersv->Carnet_usuario}}" required autofocus autocomplete="Carnet_usuario" />
            </div>

            <div>
                <x-jet-label for="name" value="{{ __('Nombres') }}" />
                <x-jet-input  id="name" class="block mt-1 w-full" type="text" name="name" value="{{$usersv->name}}" required autofocus autocomplete="name" />
            </div>
            <div>
                <x-jet-label for="Apellidos" value="{{ __('Apellidos') }}" />
                <x-jet-input  id="apellido_usuario" class="block mt-1 w-full" type="text" name="apellido_usuario" value="{{$usersv->apellido_usuario}}" required autofocus autocomplete="apellido_usuario" />
            </div>
            <div>
                <x-jet-label for="NombreUsuario" value="{{ __('Nombre de Usuario') }}" />
                <x-jet-input   id="Nombre_usuario" class="block mt-1 w-full" type="text" name="Nombre_usuario" value="{{$usersv->Nombre_usuario}}" required autofocus autocomplete="Nombre_usuario" />
            </div>
            <div>
                <x-jet-label for="Cargo" value="{{ __('Cargo Laboral') }}" />
                <x-jet-input id="cargo_usuario" class="block mt-1 w-full" type="text" name="cargo_usuario" value="{{$usersv->cargo_usuario}}" required autofocus autocomplete="cargo_usuario" />
            </div>
            <div>
                <x-jet-label for="Direccion" value="{{ __('Direccion') }}" />
                <x-jet-input  id="direccion_usuario" class="block mt-1 w-full" type="text" name="direccion_usuario" value="{{$usersv->direccion_usuario}}" required autofocus autocomplete="direccion_usuario" />
            </div>
            <div>
                <x-jet-label for="Telefono" value="{{ __('Telefono') }}" />
                <x-jet-input  id="telefono_usuario" class="block mt-1 w-full" type="text" name="telefono_usuario" value="{{$usersv->telefono_usuario}}" required autofocus autocomplete="telefono_usuario" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Correo Electronico') }}" />
                <x-jet-input  id="email" class="block mt-1 w-full" type="email" name="email" value="{{$usersv->email}}" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" />
                <x-jet-input  id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input  id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            <div class="flex items-center justify-end mt-4">          

                <x-jet-button class="ml-4">
                    {{ __('Actualizar') }}
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


