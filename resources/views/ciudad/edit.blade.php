@extends('adminlte::page')

@section('title', 'Editar Ciudad')

@section('content_header')
<h1 style="text-align: center;font-weight: bold; color: black;">EDITAR CIUDAD</h1>
<p style="text-align: center;font-weight: bold; color: red;">USUARIO :  {{ Auth::user()->name }} {{ Auth::user()->apellido_usuario }} {{ date('d/m/Y') }}</P>
@stop

@section('content')

    <form action="{{ route('ciudades.update', $ciudad->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="container">
            <div class="form-group">
                <label for="cod_ciudad">Código de ciudad</label>
                <input type="text" class="form-control" id="cod_ciudad" name="cod_ciudad" value="{{ $ciudad->cod_ciudad }}">
            </div>

            <div class="form-group">
                <label for="nombre_ciudad">Nombre de ciudad</label>
                <input type="text" class="form-control" id="nombre_ciudad" name="nombre_ciudad" value="{{ $ciudad->nombre_ciudad }}">
            </div>

            <div class="form-group">
                <label for="zona_id">Zona</label>
                <select class="form-control" id="zona_id" name="zona_id">
                    @foreach ($zonas as $zona)
                        <option value="{{ $zona->id }}" {{ $zona->id == $ciudad->zona_id ? 'selected' : '' }}>{{ $zona->nombre_zona }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
