@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">ACTUALIZAR DATOS DEL CLIENTE</h1>
@stop

@section('content')



        <form method="get" action="{{ route('clientes.update',$clientesv->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <p> </p>
                <p>  </p>
            <div class="form-row">
                <input type="hidden" value="{{$clientesv->id}}"/>
                <div class="form-group col-md-6">
                    <x-jet-label for="Carnet_cliente" value="{{ __('CARNET/DNI') }}"/>
                    <x-jet-input  maxlength="15" id="Carnet_cliente" class="form-control" type="text" name="Carnet_cliente" value="{{$clientesv->Carnet_cliente}}" required autofocus autocomplete="Carnet_cliente" />
                    <x-jet-input-error for="Carnet_cliente" class="mt-2 text-danger" />
                </div>
                <div class="form-group col-md-6">
                    <x-jet-label for="nombre_cliente" value="{{ __('NOMBRES') }}" />
                    <x-jet-input maxlength="20" id="nombre_cliente" class="form-control" type="text" name="nombre_cliente" value="{{$clientesv->nombre_cliente}}" required autofocus autocomplete="nombre_cliente" />
                    <x-jet-input-error for="nombre_cliente" class="mt-2 text-danger" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <x-jet-label for="apellido_cliente" value="{{ __('APELLIDOS') }}" />
                    <x-jet-input maxlength="20" id="apellido_cliente" class="form-control" type="text" name="apellido_cliente" value="{{$clientesv->apellido_cliente}}" required autofocus autocomplete="apellido_cliente" />
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
                    <x-jet-label for="direccion_cliente" value="{{ __('DIRECCION CLIENTE') }}" />
                    <x-jet-input maxlength="30"  id="direccion_cliente" class="form-control" type="text" name="direccion_cliente" value="{{$clientesv->direccion_cliente}}" required autofocus autocomplete="direccion_cliente" />
                    <x-jet-input-error for="direccion_cliente" class="mt-2 text-danger" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <x-jet-label for="email_cliente" value="{{ __('EMAIL') }}" />
                    <x-jet-input maxlength="30" id="email_cliente" class="form-control" type="email" name="email_cliente" value="{{$clientesv->email_cliente}}" required autofocus autocomplete="email_cliente" />
                    <x-jet-input-error for="email_cliente" class="mt-2 text-danger" />
                </div>
                <div class="form-group col-md-6">
                    <x-jet-label for="telefono_cliente" value="{{ __('TELEFONO') }}" />
                    <x-jet-input maxlength="8" id="telefono_cliente" class="form-control" type="text" name="telefono_cliente" value="{{$clientesv->telefono_cliente}}" required autofocus autocomplete="telefono_cliente" />
                    <x-jet-input-error for="telefono_cliente" class="mt-2 text-danger" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <x-jet-label for="edad_cliente" value="{{ __('EDAD') }}" />
                    <x-jet-input maxlength="2" id="edad_cliente" class="form-control" type="text" name="edad_cliente" value="{{$clientesv->edad_cliente}}" required autofocus autocomplete="edad_cliente" />
                    <x-jet-input-error for="edad_cliente" class="mt-2 text-danger" />
                </div>

                <div class="form-group col-md-6">
                    <x-jet-label for="telefono_referencia" value="{{ __('TELEFONO RESIDENCIA') }}" />
                    <x-jet-input maxlength="8" id="telefono_referencia" class="form-control" type="text" name="telefono_referencia" value="{{$clientesv->telefono_referencia}}" required />
                    <x-jet-input-error for="telefono_referencia" class="mt-2 text-danger" />
                </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <x-jet-label for="estado_cliente" value="{{ __('ESTADO CLIENTE') }}" />
                    <select name="estado_cliente">
                        <option value="DEUDA PENDIENTE">DEUDA PENDIENTE</option>
                        <option value="DEUDA CANCELADA">DEUDA CANCELADA</option>
                        <option value="DEUDOR MOROSO">DEUDOR MOROSO</option>
                    </select>
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
                            {{ __('ACTUALIZAR') }}
                        </x-jet-button>
                    </div>
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


