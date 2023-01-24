@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
     <h1>CREAR NUEVO CLIENTE</h1> 
@stop

@section('content')

<x-guest-layout >
    <x-jet-authentication-card >
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="post" action="{{ route('clientes.crearclientes') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <x-jet-label for="Carnet_cliente" value="{{ __('Carnet/Dni') }}" />
                <x-jet-input  maxlength="15" id="Carnet_cliente" class="block mt-1 w-full" type="text" name="Carnet_cliente" :value="old('Carnet_cliente')" required autofocus autocomplete="Carnet_cliente" />
            </div>

            <div>
                <x-jet-label for="nombre_cliente" value="{{ __('Nombres') }}" />
                <x-jet-input maxlength="20" id="nombre_cliente" class="block mt-1 w-full" type="text" name="nombre_cliente" :value="old('nombre_cliente')" required autofocus autocomplete="nombre_cliente" />
            </div>
            <div>
                <x-jet-label for="apellido_cliente" value="{{ __('Apellidos') }}" />
                <x-jet-input maxlength="20" id="apellido_cliente" class="block mt-1 w-full" type="text" name="apellido_cliente" :value="old('apellido_cliente')" required autofocus autocomplete="apellido_cliente" />
            </div>
            <div>
                <x-jet-label for="direccion_cliente" value="{{ __('Direccion cliente') }}" />
                <x-jet-input maxlength="30"  id="direccion_cliente" class="block mt-1 w-full" type="text" name="direccion_cliente" :value="old('direccion_cliente')" required autofocus autocomplete="direccion_cliente" />
            </div>
            <div>
                <x-jet-label for="email_cliente" value="{{ __('Email') }}" />
                <x-jet-input maxlength="20" id="email_cliente" class="block mt-1 w-full" type="email" name="email_cliente" :value="old('email_cliente')" required autofocus autocomplete="email_cliente" />
            </div>
            <div>
                <x-jet-label for="telefono_cliente" value="{{ __('Telefono') }}" />
                <x-jet-input maxlength="8" id="telefono_cliente" class="block mt-1 w-full" type="text" name="telefono_cliente" :value="old('telefono_cliente')" required autofocus autocomplete="telefono_cliente" />
            </div>
            <div>
                <x-jet-label for="edad_cliente" value="{{ __('Edad') }}" />
                <x-jet-input maxlength="2" id="edad_cliente" class="block mt-1 w-full" type="text" name="edad_cliente" :value="old('edad_cliente')" required autofocus autocomplete="edad_cliente" />
            </div>

            <div class="mt-4">
                <x-jet-label for="telefono_referencia" value="{{ __('Telefono Referencia') }}" />
                <x-jet-input maxlength="8" id="telefono_referencia" class="block mt-1 w-full" type="text" name="telefono_referencia" :value="old('telefono_referencia')" required />
            </div>
          <!--   <div class="mt-4">
                <x-jet-label for="estado_cliente" value="{{ __('Estado') }}" />
                <x-jet-input maxlength="30" id="estado_cliente" class="block mt-1 w-full" type="text" name="estado_cliente" :value="old('estado_cliente')" required />
            </div> -->
             <x-jet-label for="estado_cliente" value="{{ __('ESTADO CLIENTE') }}" />
                <select name="estado_cliente">
                <option value="ADMINISTRADOR">DEUDA PENDIENTE</option>
                <option value="ENCARGADO">DEUDA CANCELADA</option>
                </select>
            <div class="mt-4">
                <x-jet-label for="id_foto" value="{{ __('FOTO ANVERSO CARNET') }}" />
                <x-jet-input  id="id_foto" class="block mt-1 w-full" type="FILE" name="id_foto" :value="old('id_foto')" required />
            </div>
            <div class="mt-4">
                <x-jet-label for="id_fotocarnet" value="{{ __('FOTO REVERSO CARNET') }}" />
                <x-jet-input  id="id_fotocarnet" class="block mt-1 w-full" type="FILE" name="id_fotocarnet" :value="old('id_fotocarnet')" required />
            </div>
            <div class="mt-4">
                <x-jet-label for="id_fotorecibo" value="{{ __('FOTO RECIBO AGUA/LUZ') }}" />
                <x-jet-input  id="id_fotorecibo" class="block mt-1 w-full" type="FILE" name="id_fotorecibo" :value="old('id_fotorecibo')" required />
            </div>
            <div class="mt-4">
                <x-jet-label for="id_fotocroquis" value="{{ __('FOTO CROQUIS CASA') }}" />
                <x-jet-input  id="id_fotocroquis" class="block mt-1 w-full" type="FILE" name="id_fotocroquis" :value="old('id_fotocroquis')" required />
            </div>

        
            <div class="flex items-center justify-end mt-4">          

                <x-jet-button class="ml-4">
                    {{ __('CREAR') }}
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





