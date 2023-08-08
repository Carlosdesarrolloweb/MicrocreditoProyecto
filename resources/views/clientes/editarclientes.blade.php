@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="logo-container">
    <img class="logo" src="{{ asset('actcliente.png') }}" alt="Logo Microcréditos Mary">
    <h1 class="title">CREAR CLIENTE</h1>
    <p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
</div>
@stop

@section('content')
        <form method="post" action="{{ route('clientes.update',$clientesv->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <p> </p>
                <p>  </p>
            <div class="custom-box" style="background-color: #75606069; border: 1px solid #ccc; padding: 20px; border-radius: 5px;">
                <div class="form-row">
                    @method('post')
                    <input type="hidden" name="id" value="{{ $clientesv->id }}">
                    <div class="form-group col-md-6">
                        <label for="Carnet_cliente" value="{{ __('CARNET/DNI') }}" > <i class="fas fa-id-card"></i> Carnet/DNI</label>
                        <x-jet-input  maxlength="15" id="Carnet_cliente" class="form-control" type="text" name="Carnet_cliente" value="{{$clientesv->Carnet_cliente}}" required autofocus autocomplete="Carnet_cliente" />
                        <x-jet-input-error for="Carnet_cliente" class="mt-2 text-danger" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nombre_cliente" value="{{ __('NOMBRES') }}" > <i class="fas fa-user"></i> Nombres</label>
                        <x-jet-input maxlength="20" id="nombre_cliente" class="form-control" type="text" name="nombre_cliente" value="{{$clientesv->nombre_cliente}}" required autofocus autocomplete="nombre_cliente" />
                        <x-jet-input-error for="nombre_cliente" class="mt-2 text-danger" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="apellido_cliente" value="{{ __('APELLIDOS') }}" > <i class="fas fa-user"></i> Apellidos</label>
                        <x-jet-input maxlength="20" id="apellido_cliente" class="form-control" type="text" name="apellido_cliente" value="{{$clientesv->apellido_cliente}}" required autofocus autocomplete="apellido_cliente" />
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
                        <x-jet-input maxlength="30"  id="direccion_cliente" class="form-control" type="text" name="direccion_cliente" value="{{$clientesv->direccion_cliente}}" required autofocus autocomplete="direccion_cliente" />
                        <x-jet-input-error for="direccion_cliente" class="mt-2 text-danger" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email_cliente" value="{{ __('CORREO ELECTRONICO/EMAIL') }}" > <i class="fas fa-envelope"></i> Email</label>
                        <x-jet-input maxlength="30" id="email_cliente" class="form-control" type="email" name="email_cliente" value="{{$clientesv->email_cliente}}" required autofocus autocomplete="email_cliente" />
                        <x-jet-input-error for="email_cliente" class="mt-2 text-danger" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="telefono_cliente" value="{{ __('TELEFONO') }}" > <i class="fas fa-phone"></i> Telefono</label>
                        <x-jet-input maxlength="8" id="telefono_cliente" class="form-control" type="text" name="telefono_cliente" value="{{$clientesv->telefono_cliente}}" required autofocus autocomplete="telefono_cliente" />
                        <x-jet-input-error for="telefono_cliente" class="mt-2 text-danger" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="edad_cliente" value="{{ __('EDAD') }}" > <i class="fas fa-birthday-cake"></i> Edad</label>
                        <x-jet-input maxlength="2" id="edad_cliente" class="form-control" type="text" name="edad_cliente" value="{{$clientesv->edad_cliente}}" required autofocus autocomplete="edad_cliente" />
                        <x-jet-input-error for="edad_cliente" class="mt-2 text-danger" />
                    </div>

                    <div class="form-group col-md-6">
                        <label for="telefono_referencia" value="{{ __('TELEFONO REFERENCIA') }}" > <i class="fas fa-phone"></i> Telefono Referencia</label>
                        <x-jet-input maxlength="8" id="telefono_referencia" class="form-control" type="text" name="telefono_referencia" value="{{$clientesv->telefono_referencia}}" required />
                        <x-jet-input-error for="telefono_referencia" class="mt-2 text-danger" />
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
            </div>

                <!--     <div class="mt-4">
                    <x-jet-label for="id_foto" value="{{ __('FOTO ANVERSO CARNET') }}" />
                    <x-jet-input  id="id_foto" class="block mt-1 w-full" type="FILE" name="id_foto" value="old('id_foto')" required />
                </div>
                <div class="mt-4">
                    <x-jet-label for="id_fotocarnet" value="{{ __('FOTO REVERSO CARNET') }}" />
                    <x-jet-input  id="id_fotocarnet" class="block mt-1 w-full" type="FILE" name="id_fotocarnet" value="old('id_fotocarnet')" required />
                </div>
                <div class="mt-4">
                    <x-jet-label for="id_fotorecibo" value="{{ __('FOTO RECIBO AGUA/LUZ') }}" />
                    <x-jet-input  id="id_fotorecibo" class="block mt-1 w-full" type="FILE" name="id_fotorecibo" value="old('id_fotorecibo')" required />
                </div>
                <div class="mt-4">
                    <x-jet-label for="id_fotocroquis" value="{{ __('FOTO CROQUIS CASA') }}" />
                    <x-jet-input  id="id_fotocroquis" class="block mt-1 w-full" type="FILE" name="id_fotocroquis" value="old('id_fotocroquis')" required />
                </div> -->

                <div class="form-row">
                    <div class="flex items-center justify-end mt-4">

                        <x-jet-button class="btn btn-success"><i class='fa fa-save'></i>
                            {{ __(' ACTUALIZAR') }}
                        </x-jet-button>
                    </div>
                </div>
            </div>
        </form>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
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
    <script> console.log('Hi!'); </script> -->
@stop


